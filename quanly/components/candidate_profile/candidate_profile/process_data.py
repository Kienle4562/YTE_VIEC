import pandas as pd

# Hàm xử lý giá trị rỗng và escape dấu nháy đơn
def clean_value(val):
    if pd.isna(val) or str(val).strip() == '':
        return 'Chưa cập nhật'
    return str(val).strip().replace("'", "''")

# Hàm xử lý ngày tháng năm sinh
def clean_date(val):
    if pd.isna(val) or str(val).strip() == '':
        return 'NULL'  # Để MySQL hiểu là giá trị NULL
    try:
        return f"'{pd.to_datetime(val).strftime('%Y-%m-%d')}'"  # Chuỗi ngày có ngoặc đơn
    except:
        return 'NULL'


# Đường dẫn file Excel
excel_path = r"E:\OpenServer\domains\quanly\components\candidate_profile\hosoungvien.xlsx"

# Đọc file và giữ số 0 ở đầu số điện thoại
df = pd.read_excel(excel_path, dtype={'Số điện thoại ': str})

# Lấy các cột cần thiết
df = df[['Tên Đầy Đủ', 'Email', 'Ngày tháng năm sinh', 'Số điện thoại ', 
         'Địa chỉ (Đường xá, Phường Xã, Quận Huyện)', 'Nghề nghiệp', 'Đơn vị công tác']]

df.columns = ['full_name', 'email', 'dob', 'phone', 'address', 'occupation', 'workplace']
table_name = "trn_candidate_profiles"

# SQL insert
sql_insert = f"INSERT INTO {table_name} (full_name, email, dob, phone, address, occupation, workplace) VALUES\n"

# Tạo danh sách giá trị
values = []
for index, row in df.iterrows():
    full_name = clean_value(row['full_name'])
    email = clean_value(row['email'])
    dob = clean_date(row['dob']) 
    phone = clean_value(row['phone'])
    address = clean_value(row['address'])
    occupation = clean_value(row['occupation'])
    workplace = clean_value(row['workplace'])

    values.append(f"('{full_name}', '{email}', {dob}, '{phone}', '{address}', '{occupation}', '{workplace}')")

sql_insert += ",\n".join(values) + ";"

# Ghi log sql
output_path = r"E:\OpenServer\domains\quanly\components\candidate_profile\insert_applicants.sql"
with open(output_path, "w", encoding="utf-8") as f:
    f.write(sql_insert)

print(f"✅ File SQL đã được tạo tại: {output_path}")
