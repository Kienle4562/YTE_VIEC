<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

    class process extends com_product_category
    {

        function process_addproduct($SPID, 
									$product_name,
									$alias,
									$product_image,									
									$attach_info, 
									$price, 
									$discounts, 
									$discount_type, 
									$properties_name, 
									$properties_value, 
									$description,
									$content,
									$hot_product,
									$num_view,
									$status,
									$status_product,
									$date_add,
									$order_num,
									$book_category_id,
									$book_author_id,
									$quality,
									$shipping_costs,
									$origin,
									$account_id,
									$manufacturer_id,
                                    $keyword,
                                    $show_comment)
		{
			$sql = " INSERT INTO book_product(	`SPID`, 
												`product_name`,
												`alias`,
												`product_image`,												
												`attach_info`,
												`price`, 
												`discounts`,
												`discount_type`, 
												`properties_name`, 
												`properties_value`,
												`description`, 
												`content`,
												`hot_product`, 
												`num_view`,
												`status`, 
												`status_product`,
												`date_add`, 
												`order_num`,
												`book_category_id`, 
												`author`,
												`quality`,
												`shipping_costs`,
												`origin`,
												`account_id`,
                                                `keyword`,
                                                `show_comment`)
					VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

			$max_proid = $this->dbObj->SqlQueryInputResult($sql, array(	$SPID, 
																		$this->dbObj->fix_quotes_dquotes($product_name), 
																		$alias,
																		$product_image, 																		
																		$attach_info, 
																		$price, 
																		$discounts, 
																		$discount_type, 
																		$properties_name, 
																		$properties_value, 
																		$this->txt_htmlspecialchars($description),
																		$this->txt_htmlspecialchars($content),
																		$hot_product,
																		$num_view,
																		$status,
																		$status_product,
																		$date_add,
																		$this->process_getmaxid("book_product", "order_num"),
																		$book_category_id,
																		$book_author_id,
																		$quality,
																		$shipping_costs,
																		$origin,
																		$account_id,
                                                                        $keyword,
                                                                        $show_comment), $lang);				
				
			if($max_proid > 0){
			    return $max_proid;
		    } else {
			    return -1;
		    }
		}
	    
	    // ham su lay so thu tu lon nhat cho moi mau tin
	    function process_getmaxid($table, $column){
		    $sql = "select MAX(`$column`)+1 As `MaxId` from `$table`;";
		    $result = $this->dbObj->SqlQueryOutputResult($sql, array(0));
		    if($row = $result->fetch()){
			    if($row['MaxId'] == 0)	return 1;
			    else return $row['MaxId'];
		    }
	    }
		
		function txt_htmlspecialchars($t="")
		{
			// Use forward look up to only convert & not &#123;
			// $t = str_replace( "<", "&lt;"  , $t );
			// $t = str_replace( ">", "&gt;"  , $t );
			$t = str_replace( "\\", ""  , $t );
			//$t = str_replace( '"', "", $t );
			
			return $t; // A nice cup of?
		}

    }
    
    /*  ___________________________
       |                           |
       |          HANDLER          |
       |___________________________|
    */

    switch($_POST["hidden"])
    {
        case "";
        	// khoi dau trang khong co gia tri submit. khong lam zi ca
        break;
        
        case "insert";
			
			$myprocess = new process;
			
			require_once $_SERVER['DOCUMENT_ROOT'] . '/libraries/excelreader/excel/reader.php';			
									
			$myprocess = new process();
				
			$type = '/(.jpg)|(.gif)|(.jpeg)|(.pjpeg)|(.x-png)| (.png)/';

			// ExcelFile($filename, $encoding);
			$data = new Spreadsheet_Excel_Reader();
			
			// Set output Encoding.
			$data->setOutputEncoding('UTF-8');
				
			$data->read( $_SERVER['DOCUMENT_ROOT']  . '/libraries/excelreader/san_go/sango1.xls');
			
			for ($i = 3; $i <= $data->sheets[0]['numRows']; $i++) {

				echo "\"".$data->sheets[11]['cells'][$i][1]."\",";
				echo "\"".$data->sheets[11]['cells'][$i][2]."\",";
				echo "\"".$data->sheets[11]['cells'][$i][3]."\",";
				echo "\"".$data->sheets[11]['cells'][$i][4]."\",";
				echo "\"".$data->sheets[11]['cells'][$i][5]."\",";
				echo "\"".$data->sheets[11]['cells'][$i][6]."\",";
				echo "\"".$data->sheets[11]['cells'][$i][7]."\",";
				echo "\"".$data->sheets[11]['cells'][$i][8]."\",";				

				$SPID = $data->sheets[11]['cells'][$i][2];
				if($SPID == NULL){ $SPID = rand(11111,999999); }
				
				$dvt = $data->sheets[11]['cells'][$i][5];
				if($dvt == NULL){ $dvt = ""; }
				
				$xuatxu = $data->sheets[11]['cells'][$i][7];
				if($xuatxu == NULL){ $xuatxu = ""; }
				
				$thongsokythuat = $data->sheets[11]['cells'][$i][8];
				if($thongsokythuat == NULL){ $thongsokythuat = ""; }
				
				$gia = $data->sheets[11]['cells'][$i][4];
				if($gia == NULL){ $gia = 0; }
				
				$product_img1 = $data->sheets[11]['cells'][$i][9];
				$product_img2 = $data->sheets[11]['cells'][$i][10];
				
				$imgs1 = explode("\\", $product_img1);
				$imgs2 = explode("\\", $product_img2);
				
				//$img = "/files/images/san_go/MY-FLOOR/".$imgs1[4].".jpg|" . "/files/images/san_go/MY-FLOOR/HINH2/".$imgs1[5].".jpg";
				$img = "/files/images/montessory/".$imgs1[4].".jpg";
				
				echo $img;
				
				$content = $data->sheets[11]['cells'][$i][6];
				
				$catid = 56;
				
				echo "<br><br>";

				$max_proid = $myprocess->process_addproduct(
						$SPID, 
						$data->sheets[11]['cells'][$i][3],
						$core_class->_removesigns( $data->sheets[11]['cells'][$i][3] . "-" . $data->sheets[11]['cells'][$i][2] ),
						$img,
						$thongsokythuat, 
						$gia,
						0, 
						0, 
						"", 
						"", 
						$content,
						$content,
						0,
						1,
						1,
						0,
						$core_class->_formatdate(date("d/m/Y")),
						$myprocess->process_getmaxid("book_product", "order_num"),
						$catid,
						$dvt,
						0,
						0,
						$xuatxu,
						1,
						0,
						0,
						0);
		
				if ($max_proid > 0){
					echo "<br><br> insert success ------------------------";
				}

			}
			
					
			/*
			require_once $_SERVER['DOCUMENT_ROOT'] . '/libraries/excelreader/excel/reader.php';
			
			// ExcelFile($filename, $encoding);
			$data = new Spreadsheet_Excel_Reader();
			
			
			// Set output Encoding.
			$data->setOutputEncoding('UTF-8');
				
			$data->read( $_SERVER['DOCUMENT_ROOT']  . '/libraries/excelreader/phuquoctours/HUONG_TOAN_ECO_RESORT/Book1.xls');
			
			echo "---------------------------------------------------------------------------- <br>";
			
			$tenkhachsan = explode(":", $data->sheets[2]['cells'][4][1]);		
			echo "Tên khách sạn: " . $tenkhachsan[1] . "<br>";
			
			$tieuchuansao = explode(":", $data->sheets[0]['cells'][5][1]);
			$tieuchuansao_id = intval($tieuchuansao[1]);
			if($tieuchuansao_id == 0) {$tieuchuansao_id = 1;}
			echo "Tiêu chuẩn sao: " . $tieuchuansao_id . "<br>";
			
			$diachi = explode(":", $data->sheets[0]['cells'][6][1]);		
			echo "Địa chỉ: " . $diachi[1] . "<br>";
			
			$sodienthoai = explode(":", $data->sheets[0]['cells'][7][1]);
			echo "Số điện thoại: " . $sodienthoai[1] . "<br>";
			
			$sodienthoai = explode(":", $data->sheets[0]['cells'][7][1]);		
			echo "Số điện thoại: " . $sodienthoai[1] . "<br>";
			
			$khuvuc = explode(":", $data->sheets[0]['cells'][10][1]);
			
			$khuvuc = explode("|", $khuvuc[1]);
			
			echo "Khu vực: " . $khuvuc[0] . "<br>";
	
			echo "Khu vực ID: " . $khuvuc[1];
			
			$tongsophong = explode(":", $data->sheets[0]['cells'][11][1]);		
			echo "Tổng Số lượng phòng: " . $tongsophong[1] . "<br>";
			
			$khoangcachsanbay = explode(":", $data->sheets[0]['cells'][12][1]);		
			echo "Khoảng cách sân bay: " . $khoangcachsanbay[1] . "<br>";
			
			$khoangcachbentau = explode(":", $data->sheets[0]['cells'][13][1]);
			echo "Khoảng cách bến tàu: " . $khoangcachbentau[1] . "<br>";
					
			$tienichkhachsan = explode(":", $data->sheets[0]['cells'][14][1]);
			echo $tienichkhachsan[0]. "<br>";
			$tienichkhachsan = explode(",", $tienichkhachsan[1]);
			for($i = 0; $i <= count($tienichkhachsan); $i++){
				echo $tienichkhachsan[$i] . "<br>";
			}
					
			$dichvukhachsan = explode(":", $data->sheets[0]['cells'][15][1]);
			echo $dichvukhachsan[0] . "<br>";
			$dichvukhachsan = explode(",", $dichvukhachsan[1]);
			for($i = 0; $i <= count($dichvukhachsan); $i++){
				echo $dichvukhachsan[$i] . "<br>";
			}
			
			echo $data->sheets[0]['cells'][16][1];
			$mota = explode(".", $data->sheets[0]['cells'][17][1]);
			for($i = 0; $i <= count($mota); $i++){
				echo $mota[$i] . ". <br>";
			}
			
			echo $data->sheets[0]['cells'][18][1];
			$chinhsach = explode("|", $data->sheets[0]['cells'][19][1]);
			for($i = 0; $i <= count($chinhsach); $i++){
				echo $chinhsach[$i] . ". <br>";
			}
			
			echo $data->sheets[0]['cells'][20][1];
			$treem = explode(".", $data->sheets[0]['cells'][21][1]);
			for($i = 0; $i <= count($treem); $i++){
				echo $treem[$i] . ". <br>";
			}
			
			$thongtin = '<div class="ct_ks_info">
							<ul class="bv_list_style">
								<li><span class="chitiet_hotel_span">Tên khách sạn:</span><strong style="color: #ec5b14;">'. $tenkhachsan[1] .'</strong></li>
								<li><span class="chitiet_hotel_span">Tiêu chuẩn sao</span>'. $tieuchuansao[1] .'</li>
								<li><span class="chitiet_hotel_span">Địa chỉ:</span>'. $diachi[1] .'</li>
								<li><span class="chitiet_hotel_span">Khu vực:</span>'. $khuvuc[0] .'</li>
								<li><span class="chitiet_hotel_span">Tổng Số lượng phòng:</span>'. $tongsophong[1] .'</li>
								<li><span class="chitiet_hotel_span">Khoảng cách sân bay:</span>'. $khoangcachsanbay[1] .'</li>
								<li><span class="chitiet_hotel_span">Khoảng cách bến tàu:</span>'. $khoangcachbentau[1] .'</li>
							</ul>
						</div>';
						
			$thongtin .= '<table style="width: 100%;">
							<tbody>
								<tr>
									<td style="text-align: left; padding: 10px;" valign="top"><span class="chitiet_hotel_span">' . $tienichkhachsan[0] . ':</span>
										<ul class="bv_list_style">';
											for($i = 0; $i < count($tienichkhachsan); $i++){
												$thongtin .= '<li>'. $tienichkhachsan[$i] .'</li>';
											}
							$thongtin .= '</ul>
									</td>
									<td style="text-align: left; padding: 10px;" valign="top">
										<span class="chitiet_hotel_span">' . $dichvukhachsan[0] . ': </span>
										<ul class="bv_list_style">';
											for($i = 0; $i < count($dichvukhachsan); $i++){
												$thongtin .= '<li>'. $dichvukhachsan[$i] .'</li>';
											}										
							$thongtin .= '</ul>
									</td>
								</tr>
							</tbody>
						</table>';
						
			$thongtin .= '<p>
							<span class="chitiet_hotel_span ul_list">'. $data->sheets[0]['cells'][16][1] .':</span>
							<span style="display: inline; line-height: 25px; color: #343434; font-weight: normal;">';
								for($i = 0; $i < count($mota); $i++){
									$thongtin .= $mota[$i] . '<br>';
								}							
				$thongtin .= '</span>
						</p>';
						
			$thongtin .= '<p>
							<span class="chitiet_hotel_span ul_list">' . $data->sheets[0]['cells'][18][1] . ' :</span>
							<span style="display: inline; line-height: 25px; color: #343434; font-weight: normal;">';
								for($i = 0; $i < count($chinhsach); $i++){
									$thongtin .= $chinhsach[$i] . '<br>';
								}
				$thongtin .= '</span>
						</p>';
						
			$thongtin .= '<p>
							<span class="chitiet_hotel_span ul_list">'. $data->sheets[0]['cells'][20][1] . ': </span>
							<span style="display: inline; line-height: 25px; color: #343434; font-weight: normal;">';
								for($i = 0; $i < count($treem); $i++){
									$thongtin .= $treem[$i] . '<br>';
								}
				$thongtin .= '</span>
						</p>';
						
			$thongtin .= '<div id="chitiet_hotel_hinh" class="clearfix">';
							$hotel_img = explode("|", $data->sheets[0]['cells'][23][1]);
							for($i = 0; $i < count($hotel_img); $i++){
								$thongtin .= '<img src="http://phuquoctours.com.vn/'. $hotel_img[$i] .'" height="208px" width="277px" />';
							}						
			$thongtin .= '</div>';
			
			$hinh_thump = $data->sheets[0]['cells'][25][1];
			$hinh_chinh = $data->sheets[0]['cells'][27][1];
			
			
			echo $thongtin;
	
			//for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
				//for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {				
					//echo "\"".$data->sheets[0]['cells'][$i][$j]."\",";
				//}
				//echo "<br>";		
			//}
			/*
			$id = $myprocess->process_getmaxid("ksnme_tour_hotel", "id");
			$title = $tenkhachsan[1];
			$alias = $core_class->_removesigns($tenkhachsan[1]);
			$thumb = $hinh_thump;
			$hinh_chinh = $hinh_chinh;
			$tieuchuan = $tieuchuansao_id;
			$diachi = $diachi[1];
			$gia = "";
			$sophong = $tongsophong[1];
			$mota = "";
			$bando = "";
			$diemdulich = "";
			$hinhanh = "";
			$thongtin = $thongtin;
			$khuvuc_id = $khuvuc[1];
			$state = 1;
			$publish_up = date("d/m/Y");
			$publish_down = date("d/m/Y");
			$published = 1;
			$ordering = $myprocess->process_getmaxid("ksnme_tour_hotel", "ordering");
			$sticky = 0;
			
			if( $myprocess->process_add_hotel($id, $title, $alias, $thumb, $hinh_chinh, $tieuchuan, $diachi, $gia, $sophong, $mota, $bando, $diemdulich, $hinhanh,
											  $thongtin, $khuvuc_id, $state, $publish_up, $publish_down, $published, $ordering, $sticky)){
				echo "insert success";
			}*/


        break;

        default:
            $core_class->_redirect(".");
            exit();
        break;
    }