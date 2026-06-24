# Hướng dẫn chuyển YTE_VIEC: blinkthor.com (test) → yteviec.com (production)

> Tài liệu này tổng hợp toàn bộ kiến trúc deploy, **các lỗi đã gặp + cách sửa**, và
> **checklist cutover** để khi đổi sang `yteviec.com` không bị sót / lỗi lặp lại.
> Cập nhật lần cuối: 2026-06 (sau khi dựng môi trường test trên `*.yteviec.blinkthor.com`).

---

## 0. Tóm tắt kiến trúc deploy

- **VPS** Ubuntu, source bind-mount, chạy bằng **Docker**.
- Stack chính: `/home/lekien/apps/yteviec-stack/` (`docker-compose.yml`, `Dockerfile`).
  - `yteviec-web`: image `php:7.4-apache`, **bind-mount** source `/home/lekien/apps/YTE_VIEC` → `/var/www/html`. Publish `127.0.0.1:8085:80`. (Sửa PHP có hiệu lực ngay, không cần build lại.)
  - `yteviec-db`: `mysql:5.7`, database `ytvco_data`.
- **nginx trên host** (không phải container) làm reverse proxy `:80/:443` → `127.0.0.1:8085`, kèm SSL Let's Encrypt (certbot). Mỗi subdomain 1 file trong `/etc/nginx/sites-enabled/`.
- **3 ứng dụng = 3 vhost Apache** (xem `yteviec-stack/vhosts.conf`), mỗi cái 1 DocumentRoot:
  | Vai trò | Thư mục | Domain test (hiện tại) | Domain production (đích) |
  |---|---|---|---|
  | Website chính (ứng viên) | `/` | `yteviec.blinkthor.com` | `yteviec.com` |
  | Trang quản trị (admin) | `/quanly` | `quanly.yteviec.blinkthor.com` | `quanly.yteviec.com` |
  | Cổng nhà tuyển dụng | `/tuyendung` | `tuyendung.yteviec.blinkthor.com` | `tuyendung.yteviec.com` |
- Mã nguồn: GitHub `github.com/Kienle4562/YTE_VIEC` (branch `main`). VPS deploy bằng `git pull`.

---

## 1. Cơ chế cấu hình theo domain (RẤT QUAN TRỌNG)

Mỗi app đọc cấu hình qua **`$GLOBALS['MAP']`** keyed theo **`$_SERVER['SERVER_NAME']` chính xác**:

- `protected/global_config.php` (frontend)
- `quanly/protected/global_config.php` (admin)
- `tuyendung/protected/global_config.php` (tuyển dụng)

Nếu domain truy cập **không có key trong MAP** → `mapping()` trả `null` → không có DB → site hỏng (frontend hiện trang "maintenance"). **Đây là việc bắt buộc đầu tiên khi đổi domain.**

`$index = "https://" . $_SERVER['SERVER_NAME'] . "/"` → URL tài nguyên tự bám theo domain đang truy cập, **nên domain BẮT BUỘC phải có HTTPS hợp lệ** (xem mục lỗi #3).

---

## 2. Các lỗi đã gặp trên môi trường test & cách sửa (kiểm tra lại trên production)

> Tất cả sửa code dưới đây **đã nằm trong git** → cutover chỉ cần đảm bảo dùng đúng branch `main`.
> Các sửa **hạ tầng** (nginx/SSL, Docker env) **phải làm lại** cho domain mới.

| # | Triệu chứng | Nguyên nhân gốc | Cách sửa | Loại |
|---|---|---|---|---|
| 1 | Menu trang chủ biến mất (khoảng trắng) | PHP `display_errors=On` (image php mặc định) in warning vào trong `<ul navbar>` → đẩy menu ra khỏi vùng cao 60px | Tắt `display_errors` trong `Dockerfile` (`zz-app.ini`) **và** sửa hằng số trần `function_exists('menu'/'menu3')` | env + code |
| 2 | Bảng admin trống | `display_errors` chèn Notice/Deprecated vào JSON của AJAX → `json_decode` lỗi → KTDatatable trống | Như #1 (tắt `display_errors`) | env |
| 3 | Bảng admin vẫn trống (jQuery 404) | Trang admin chạy HTTP nhưng `$index="https://"` → nhúng `https://quanly.../jquery.js`, mà subdomain chưa có HTTPS → jQuery fail | **Bật HTTPS bằng certbot** cho mọi subdomain + đổi jQuery sang đường dẫn tương đối (`quanly/Header.php`) | infra + code |
| 4 | Admin "Uncaught SyntaxError: Invalid or unexpected token" | ~426 file trong `quanly/` bị line-ending **`\r\r\n`**; JS nối chuỗi bằng `\` cuối dòng bị dư `\r\n` lọt vào chuỗi | Chuẩn hoá line-ending về **LF** + thêm `.gitattributes` (`* text=auto eol=lf`) | code |
| 5 | Admin "Unexpected end of input" ở `scripts.bundle.js` | Lệnh strip `\r` (#4) lỡ tay làm hỏng **file minified** (vendors/scripts.bundle.js) | Khôi phục nguyên trạng các bundle minified (đánh dấu `binary` trong `.gitattributes` nếu cần) | code |
| 6 | Bundle tải lại 280KB mỗi lần load, dễ bị proxy cắt | `?ver=date("dmyHis")` đổi mỗi giây → không cache được | Đổi sang `latest_version()` (ver theo `filemtime`) trong `quanly/dist/myJS.php` | code |

**Lưu ý line-ending (#4/#5):** đã có `.gitattributes` ép LF; **không dùng `sed s/\r//g` trên file `.min.js`/`.bundle.js`**. Khi commit từ Windows nhớ `core.autocrlf=false` cho repo này.

**Mạng công ty:** nếu admin vẫn lỗi "Unexpected end of input" dù server OK, nhiều khả năng **proxy/AV của mạng (vd FPT)** cắt file JS lớn — test bằng **Incognito / mạng khác** để loại trừ.

---

## 3. CHECKLIST CUTOVER sang yteviec.com

### Bước 1 — DNS
- [ ] Trỏ `yteviec.com`, `www.yteviec.com`, `quanly.yteviec.com`, `tuyendung.yteviec.com` về IP VPS (`163.223.8.172`).
- [ ] Chờ DNS phân giải đúng (`nslookup yteviec.com`), port 80 mở ra internet (cho certbot HTTP-01).

### Bước 2 — Thêm domain production vào `$GLOBALS['MAP']` (3 file)
Trong **mỗi** file dưới, thêm key cho domain mới (giữ key blinkthor để vẫn test được):
- [ ] `protected/global_config.php` → thêm `'yteviec.com' => array('db_schema'=>'ytvco_data','db_host'=>'db','db_user'=>'ytvco_user','db_password'=>'<DB_PASS>','template'=>'yteviec')`
- [ ] `quanly/protected/global_config.php` → thêm `'quanly.yteviec.com' => array(... 'location'=>'../','frontpage'=>'https://yteviec.com')`
- [ ] `tuyendung/protected/global_config.php` → thêm `'tuyendung.yteviec.com' => array(... 'frontpage'=>'https://yteviec.com')`
- [ ] (Tùy chọn) xử lý `www.yteviec.com` (redirect www→non-www ở nginx là gọn nhất).
- [ ] Commit + push + `git pull` trên VPS.

### Bước 3 — Apache vhost (trong container) cho domain mới
- [ ] Sửa `yteviec-stack/vhosts.conf`: đổi/thêm `ServerName` `yteviec.com`, `quanly.yteviec.com`, `tuyendung.yteviec.com` (có thể dùng `ServerAlias` để chạy song song cả 2 bộ domain).
- [ ] `cd yteviec-stack && docker compose up -d --build web` (rebuild để nạp vhosts mới; cũng đảm bảo `display_errors=Off` còn trong Dockerfile).

### Bước 4 — nginx host + SSL cho domain mới
- [ ] Tạo server block `/etc/nginx/sites-available/yteviec.com` (+ quanly, tuyendung) proxy `→ http://localhost:8085` (mẫu: copy từ `yteviec.blinkthor.com`), `ln -s` sang `sites-enabled`, `nginx -t && systemctl reload nginx`.
- [ ] Cấp SSL: `sudo certbot --nginx -d yteviec.com -d www.yteviec.com --redirect` ; tương tự `-d quanly.yteviec.com` ; `-d tuyendung.yteviec.com`.
- [ ] Kiểm tra auto-renew: `certbot renew --dry-run`.

### Bước 5 — Database
- [ ] DB `ytvco_data` đã có sẵn trong container `yteviec-db` (đang dùng cho test). Production dùng **chung DB này** → **không cần import lại**, dữ liệu giữ nguyên.
- [ ] Nếu muốn DB sạch/khác: `mysqldump` từ hosting cũ rồi import vào `yteviec-db` (nhớ charset utf8). Backup trước khi đổi.
- [ ] Đổi `MYSQL_*` password trong `docker-compose.yml` nếu cần (đã lộ trong quá trình test → nên rotate).

### Bước 6 — Tài nguyên & link hardcode cần rà
- [ ] Logo meta: `index.php` dùng `http://anthy.net/files/images/logo.png` (stale) → đổi sang ảnh trên yteviec.com.
- [ ] Còn ~133 chỗ hardcode `yteviec.com` / `viecyte.com` trong template + email. Khi đích là `yteviec.com` thì các link `yteviec.com` **thành đúng**; chỉ cần soát `http://` → `https://` và bỏ `viecyte.com` cũ. (`grep -rn "viecyte.com\|http://yteviec.com" --include=*.php .`)
- [ ] Link trong **DB bảng `menu`** trỏ `http://tuyendung.yteviec.com/...` → đúng cho production (sai cho test). Kiểm tra lại sau cutover.
- [ ] Email gửi đi: `quanly/protected/core_class.php` dùng `info@yteviec.com` (SMTP) — xác nhận tài khoản/SMTP hoạt động.

### Bước 7 — Verify sau cutover (chạy trên VPS)
```bash
# Frontend
curl -sI https://yteviec.com/ | head -1                  # 200
curl -s https://yteviec.com/ | grep -c "Giới Thiệu"      # menu hiện (>0)
curl -s https://yteviec.com/ | grep -c "<b>Warning</b>"  # = 0 (không leak lỗi PHP)
# Admin: jQuery qua HTTPS phải 200, không 404
curl -sI https://quanly.yteviec.com/dist/assets/app/js/jquery.js | head -1
# Bundle JS hợp lệ (giải nén đủ, không cụt)
curl -s --compressed https://quanly.yteviec.com/dist/assets/web/base/scripts.bundle.js | wc -c   # ~281334
# Đăng nhập admin → các bảng (Hồ sơ ứng viên / CV / Công ty / Đơn hàng) có dữ liệu
```
- [ ] Mở admin bằng trình duyệt thật, F12 Console **không còn lỗi đỏ**, các datatable đổ dữ liệu.
- [ ] Test ở **Incognito** để loại trừ cache/extension/proxy.

### Bước 8 — Rollback nhanh nếu sự cố
- DNS có thể trỏ lại hosting cũ.
- Vì MAP giữ cả key blinkthor + yteviec.com, môi trường test `*.yteviec.blinkthor.com` vẫn chạy song song để so sánh.
- Git: `git log`, có thể `git revert`/`git checkout <commit>` rồi `git pull` trên VPS.

---

## 4. Lệnh thao tác VPS thường dùng
```bash
# SSH (nên chuyển sang SSH key, tắt password)
ssh lekien@163.223.8.172

# Deploy code mới
cd /home/lekien/apps/YTE_VIEC && git pull --ff-only origin main

# Rebuild web (khi đổi Dockerfile/vhosts)
cd /home/lekien/apps/yteviec-stack && docker compose up -d --build web

# DB
docker exec -it yteviec-db mysql -uroot -p ytvco_data

# Log
docker exec yteviec-web tail -f /var/log/apache2/quanly_error.log
docker exec yteviec-web tail -f /var/log/php_errors.log
```

---

## 5. Việc bảo mật cần làm trước khi production
- [ ] **Thu hồi GitHub PAT** và **đổi mật khẩu SSH + MySQL** (đã bị lộ trong quá trình setup/test).
- [ ] Chuyển SSH sang **key-based**, tắt đăng nhập mật khẩu.
- [ ] Mật khẩu DB hardcode trong `*/global_config.php` & `docker-compose.yml` — cân nhắc đổi và dùng biến môi trường.
- [ ] Đảm bảo `display_errors=Off` còn hiệu lực (Dockerfile) trên production.
