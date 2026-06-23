<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );
	
    class process_article extends com_content
	{

	   public function getData($where = "")

        {

            $sql = "SELECT

			trn_congty.hinhanh,

			trn_congty.tencongty,

			LOWER(trn_congviec.tencongviec) AS tencongviec,

			trn_congviec.congviec_id,

			trn_congviec.ngaydang,

			trn_congviec.ngayhethan,

			trn_congviec.hot_job,

			trn_congviec.motacongviec,

			trn_congviec.soluongcantuyen,

			trn_congviec.mucluongtoithieu,

			trn_congviec.mucluongtoida,

			trn_congviec.loaitien_id,

			mst_tinhthanh.ten_tinhthanh as diadiemlamviec

			FROM

			trn_congviec

			LEFT Join trn_congty ON trn_congty.congty_id = trn_congviec.congty_id

			LEFT Join mst_tinhthanh ON trn_congviec.tinhthanh_id = mst_tinhthanh.id

			{$where} ORDER BY trn_congviec.hot_job DESC, trn_congviec.pin DESC , trn_congviec.DISORDER DESC limit 0,56";
			

            $result = $this->dbObj->SqlQueryOutputResult($sql, array());

            return $result;

        } 

		public function get_article($congviec_id)
		{
			$sql = "SELECT
			trn_congty.congty_id,
			trn_congty.hinhanh,
			trn_congty.tencongty,
			trn_congty.web,
			trn_congty.diachicongty,
			trn_congty.gioithieungan,
			trn_congviec.congviec_id,
			trn_congviec.tencongviec,
			trn_congviec.nguoilienhe,
			trn_congviec.loaihinhcongviec_id,
			trn_congviec.yeucauhoso_id,
			trn_congviec.phucloi_id,
			trn_congviec.gioitinh_id,
			trn_congviec.dotuoi,
			trn_congviec.kinhnghiem_id,
			trn_congviec.capbac_id,
			trn_congviec.bangcap_id,
			trn_congviec.hyperlink,
			trn_congviec.yeucauhoso,
			trn_congviec.sonamkinhnghiem,
			trn_congviec.nophoso,
			mst_quymo.tenquymo as quymo,
			mst_loaihinhcongviec.tenloaihinhcongviec,
			trn_congviec.mucluongtoithieu,
			trn_congviec.noilamviec  as diadiemlamviec,
			trn_congviec.tinhthanh_id,
			trn_congviec.soluongcantuyen,
			trn_congviec.motacongviec,
			trn_congviec.quyenloi,
			trn_congviec.ngaydang,
			trn_congviec.chuyenmonyeucau,
			trn_congviec.luotxem,
			trn_congviec.congty_id,
			trn_congviec.mucluongtoithieu,
			trn_congviec.mucluongtoida,
			trn_congviec.loaitien_id,
			trn_congviec.ngayhethan,
			trn_congviec.email,
			trn_congviec.btn_ungtuyen,
			trn_danhmuccv.tendanhmuccv,
			mst_loaihinhhoatdong.tenloaihinhhoatdong,
			mst_chuyenkhoa.chuyenkhoa_name,
			trn_danhmuccv.danhmuccv_id,
			CASE WHEN trn_congty.hinhanhcongty1 = 'image/noimage.jpg' THEN NULL ELSE trn_congty.hinhanhcongty1 END hinhanhcongty1,
			CASE WHEN trn_congty.hinhanhcongty2 = 'image/noimage.jpg' THEN NULL ELSE trn_congty.hinhanhcongty2 END hinhanhcongty2,
			CASE WHEN trn_congty.hinhanhcongty3 = 'image/noimage.jpg' THEN NULL ELSE trn_congty.hinhanhcongty3 END hinhanhcongty3
			FROM
			trn_congviec
			Inner Join trn_congty ON trn_congty.congty_id = trn_congviec.congty_id
			left Join mst_loaihinhcongviec ON trn_congviec.loaihinhcongviec_id = mst_loaihinhcongviec.loaihinhcongviec_id
			left Join mst_tinhthanh ON trn_congviec.tinhthanh_id = mst_tinhthanh.id
			left Join mst_quymo ON trn_congty.quymo_id = mst_quymo.quymo_id
			left JOIN trn_danhmuccv ON trn_danhmuccv.danhmuccv_id = trn_congviec.danhmuccv_id
			LEFT JOIN mst_loaihinhhoatdong ON mst_loaihinhhoatdong.loaihinhhoatdong_id = trn_congty.loaihinhhoatdong_id
			LEFT JOIN mst_chuyenkhoa ON mst_chuyenkhoa.chuyenkhoa_id = trn_congviec.chuyenkhoa_id
			WHERE congviec_id = ? AND trn_congviec.trangthai = 1 AND trn_congviec.DELETE_FLG = 0
			";
			return $this->dbObj->SqlQueryOutputResult($sql, array($congviec_id));
		}
		
		public function get_other_job($congviec_id, $company_id)
		{
			$sql = "SELECT
			trn_congviec.tencongviec,
			trn_congviec.congviec_id,
			trn_congviec.disorder as ngaydang,
			trn_congty.tencongty,
			mst_tinhthanh.ten_tinhthanh as diadiemlamviec
			FROM
			trn_congviec
			LEFT Join trn_congty ON trn_congty.congty_id = trn_congviec.congty_id
			LEFT Join mst_tinhthanh ON trn_congviec.tinhthanh_id = mst_tinhthanh.id
			WHERE trn_congviec.congviec_id <> ?  AND trn_congty.congty_id = ?  AND trn_congviec.trangthai = 1 AND trn_congviec.DELETE_FLG = 0";
			return $this->dbObj->SqlQueryOutputResult($sql, array($congviec_id, $company_id));
		}
		
		public function add_ungtuyen($career_id, $congviec_id, $hoso, $gioithieungan, $sodienthoai)
        {
            return $this->dbObj->SqlQueryInputResult(
                "INSERT INTO 
                        trn_ungtuyen (career_id, congviec_id, hoso, gioithieungan, sodienthoai)
                        VALUES (?,?,?,?,?)", 
                array($career_id, $congviec_id, $hoso, $gioithieungan, $sodienthoai)
            );
		}
		
		public function get_other_job_recent($search_key, $tinhthanh_id)
		{
			$sql = "SELECT
			trn_congviec.tencongviec,
			trn_congviec.congviec_id,
			trn_congviec.DISORDER AS ngaydang,
			mst_tinhthanh.ten_tinhthanh AS diadiemlamviec,
			CASE 
			WHEN trn_congviec.mucluongtoithieu <> '' AND trn_congviec.mucluongtoida <> '' THEN
				CONCAT('Từ ', trn_congviec.mucluongtoithieu, ' Đến ', trn_congviec.mucluongtoida)
			WHEN trn_congviec.mucluongtoithieu <> '' THEN
				CONCAT('Tối thiểu ', trn_congviec.mucluongtoithieu)
			WHEN trn_congviec.mucluongtoida  <> '' THEN
				CONCAT('Lên đến ', trn_congviec.mucluongtoida)
			ELSE 'Thỏa thuận' END mucluong,
			trn_congviec.ngaydang
			FROM
						trn_congviec
						LEFT Join trn_congty ON trn_congty.congty_id = trn_congviec.congty_id
						LEFT Join mst_tinhthanh ON trn_congviec.tinhthanh_id = mst_tinhthanh.id
			WHERE trn_congviec.search_key like CONCAT('%',?,'%') AND trn_congviec.tinhthanh_id = ?
			ORDER BY trn_congviec.DISORDER DESC
			LIMIT 10
			";
			return $this->dbObj->SqlQueryOutputResult($sql, array($search_key, $tinhthanh_id));
		}
	}
	
	
	if(!empty($_REQUEST['do']))
    {
        switch ($_REQUEST['do'])
        {
            case 'uploadhoso':
            {
				$allowed =  array('doc','docx','pdf');
				$filename = $_FILES['file']['name'];
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if(!in_array($ext, $allowed) ) {
					echo -1;
				}else{
					if ( 0 < $_FILES['file']['error'] ) {
						echo 'Error: ' . $_FILES['file']['error'] . '<br>';
					}
					else {
						$folder = 'hosoungvien/'.$_SESSION['career']["career_id"]. "/";
						if (!file_exists('hosoungvien/'.$_SESSION['career']["career_id"])) {
							mkdir('hosoungvien/'.$_SESSION['career']["career_id"], 0777, true);
						}
						$filename_ =  strtotime(date("Y-m-d H:i:s"))."_";
						$temp = explode(".", $filename);
						$newfilename = round(microtime(true)). "_". $_FILES['file']['name'];
						move_uploaded_file($_FILES['file']['tmp_name'], $folder . $newfilename);
						echo $folder . $newfilename;
					}
				}
				break;
            }
			
			case 'ungtuyen':
            {
				$sodienthoai = $_POST["sodienthoai"];
				$gioithieungan = 'null';
				$hoso = $_POST["hoso"];
				$congviec_id = $_POST["congviec_id"];
				$career_id = $_SESSION['career']["career_id"];
				$myprocess = new process_article();
                if (empty($sodienthoai) && empty($congviec_id) && empty($hoso)){
					echo -1;
				}else{
					if ($myprocess->add_ungtuyen($career_id, $congviec_id, $hoso, $gioithieungan, $sodienthoai)) {
						// Gửi mail cho ứng viên khi ứng tuyển
						$tenCongViec = $core_class->findValues("trn_congviec", "tencongviec", array("congviec_id" => $_POST['congviec_id']));
						$tenCongTy = $core_class->findValues("trn_congty", "tencongty", array("congty_id" => $_POST['congty_id']));
						$tenUngVien = $_SESSION['career']["fullname"];
						$frontpage = $_SERVER['SERVER_NAME'];
						$subject = "Bạn vừa ứng tuyển vào ".$tenCongViec." tại Y Tế Việc";
						
						$mailHTML = "Chào ". $tenUngVien .",<br><br>";
						$mailHTML .= "Xin chúc mừng!<br>";
						$mailHTML .= "Hồ sơ của bạn đã được gửi đến <b>".$tenCongTy."</b>. Nhà tuyển dụng đang cân nhắc sẽ liên hệ với bạn trong thời gian sớm nhất nếu hồ sơ của bạn đạt yêu cầu tuyển dụng.<br>";
						
						$resultJobRecent = $myprocess->get_other_job_recent($core_class->_removesigns($_POST["tencongviec"]), $_POST["tinhthanh_id"]);
						if($resultJobRecent->rowCount() > 0){
							$mailHTML .= "<h3 style='margin-bottom:0px;'>Một vài cơ hội việc làm nổi bậc tương tự</h3>";
							while($rowJobRecent = $resultJobRecent->fetch()){
								$link = $frontpage."/".$core_class->_removesigns($rowJobRecent["tencongviec"])."-".$rowJobRecent["congviec_id"]."-cv.html";
								$mailHTML .= '<p><b style="color:blue"><a href="'.$link.'" target="_blank">'.$rowJobRecent['tencongviec'].'</a></b></p>';
								$mailHTML .= '<p>'.$rowJobRecent['tencongty'].'</p>';
								$mailHTML .= '<p style="color:gray">';
								$mailHTML .= 'Mức lương: <b>'.$rowJobRecent['mucluong'].'</b> | ';
								$mailHTML .= 'Ngày đăng tuyển: '.date("d/m/Y", strtotime($rowJobRecent['ngaydang']));
								$mailHTML .= '</p>';
								$mailHTML .= '<hr>';
							}
						}
						$mailContent = $core_class->sendMailWithTemplate($subject, $mailHTML);
						$emailTo = $_SESSION['career']["email"];
						$core_class->smtpSendMailCandidate($subject, $mailContent, $emailTo);

						// Gửi mail cho nhà tuyển dụng khi có ứng viên ứng tuyển
						$subject = "Một ứng viên vừa ứng tuyển vào vị trí ".$tenCongViec;
						$emailCongTy = $core_class->findValues("trn_congty", "email", array("congty_id" => $_POST['congty_id']));
						
						$mailHTML = "Chào ". $tenCongTy .",<br><br>";
						$mailHTML .= "Một ứng viên tiềm năng vừa ứng tuyển vào vị trí bạn đã đăng tuyển tại Website của chúng tôi.<br>";
						$mailHTML .= "Bạn vui lòng xem file đính kèm hoặc <a href='http://tuyendung.yteviec.com/'>đăng nhập</a> vào tài khoản của bạn tại Y Tế Việc để xem hồ sơ và quản lý ứng viên.<br>";
						
						$mailContent = $core_class->sendMailWithTemplate($subject, $mailHTML);
						$emailTo = $emailCongTy;
						if(!empty($emailTo)){
							$core_class->smtpSendMailCandidate($subject, $mailContent, $emailTo, $hoso);
						}
						echo 1;
					}else{
						echo 0;
					}
				}
				break;
            }
        }
    }
?>
