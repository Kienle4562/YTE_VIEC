<?php defined( '_VALID_MOS' ) or die( include_once("../../404.php") );

include_once('com_ungvien.models.php');

include_once('protected/paging.php');

$myprocess =  new process();

$mst_tinhthanh = array(

  '11' => 'Cao Bằng',

  '12' => 'Lạng Sơn',

  '14' => 'Quảng Ninh',

  '16' => 'Hải Phòng',

  '17' => 'Thái Bình',

  '18' => 'Nam Định',

  '19' => 'Phú Thọ',

  '20' => 'Thái Nguyên',

  '21' => 'Yên Bái',

  '22' => 'Tuyên Quang',

  '23' => 'Hà Giang',

  '24' => 'Lào Cai',

  '25' => 'Lai Châu',

  '26' => 'Sơn La',

  '27' => 'Điện Biên',

  '28' => 'Hòa Bình',

  '29' => 'Hà Nội',

  '34' => 'Hải Dương',

  '35' => 'Ninh Bình',

  '36' => 'Thanh Hóa',

  '37' => 'Nghệ An',

  '38' => 'Hà Tĩnh',

  '43' => 'Đà Nẵng',

  '47' => 'Đắk Lắk',

  '48' => 'Đắk Nông',

  '49' => 'Lâm Đồng',

  '50' => 'Thành phố Hồ Chí Minh',

  '61' => 'Bình Dương',

  '62' => 'Long An',

  '63' => 'Tiền Giang',

  '64' => 'Vĩnh Long',

  '65' => 'Cần Thơ',

  '66' => 'Đồng Tháp',

  '67' => 'An Giang',

  '68' => 'Kiên Giang',

  '69' => 'Cà Mau',

  '70' => 'Tây Ninh',

  '71' => 'Bến Tre',

  '72' => 'Bà Rịa - Vũng Tàu',

  '73' => 'Quảng Bình',

  '74' => 'Quảng Trị',

  '75' => 'Thừa Thiên - Huế',

  '76' => 'Quảng Ngãi',

  '77' => 'Bình Định',

  '78' => 'Phú Yên',

  '79' => 'Khánh Hòa',

  '81' => 'Gia Lai',

  '82' => 'Kon Tum',

  '83' => 'Sóc Trăng',

  '84' => 'Trà Vinh',

  '85' => 'Ninh Thuận',

  '86' => 'Bình Thuận',

  '88' => 'Vĩnh Phúc',

  '89' => 'Hưng Yên',

  '90' => 'Hà Nam',

  '92' => 'Quảng Nam',

  '93' => 'Bình Phước',

  '94' => 'Bạc Liêu',

  '95' => 'Hậu Giang',

  '97' => 'Bắc Kạn',

  '6039' => 'Đồng Nai',

  '9813' => 'Bắc Giang',

  '9913' => 'Bắc Ninh',

);

$mst_chuyenkhoa = array(

  '1' => 'Nội tổng hợp',

  '2' => 'Ngoại',

  '3' => 'Nhi',

  '4' => 'Sản',

  '5' => 'Chuẩn Đoán Hình Ảnh',

  '6' => 'Răng Hàm Mặt',

  '7' => 'Da Liễu & Thẩm Mỹ',

  '8' => 'Mắt','danhmuccv_id',

  '9' => 'Tai Mũi Họng','danhmuccv_id',

  '10' => 'Y Học Cổ Truyền','danhmuccv_id',

  '11' => 'Bác sĩ đa khoa','danhmuccv_id',

  '12' => 'Khoa Khác','danhmuccv_id',

  '13' => 'Dược sĩ lâm sàng','danhmuccv_id',

  '14' => 'Dược sĩ nhà thuốc','danhmuccv_id',

  '15' => 'Dược sĩ QA/QC','danhmuccv_id',

  '16' => 'Trình dược viên','danhmuccv_id',

  '17' => 'Nghề dược sĩ khác','danhmuccv_id',

  '18' => 'Điều dưỡng','danhmuccv_id',

  '19' => 'Hộ sinh/hộ lý','danhmuccv_id',

  '20' => 'Kỹ thuật viên y học','danhmuccv_id',

  '21' => 'Thư ký y khoa','danhmuccv_id',

  '22' => 'Y sĩ/Y tế công cộng','danhmuccv_id'

);

/* predefine something */

$condition = "";

$count = "";

$key = "";

// if(!empty($_REQUEST["search"]) && $_REQUEST["search"] != ""){

//   $key = addslashes($_REQUEST["search"]);

//   $key = str_replace("bác sỹ", "Bác sĩ", $key);

//   $condition .= "AND (ttcn.firstname LIKE '%".$key."%' OR ttcn.lastname LIKE '%".$key."%' OR ttcn.bangcap1 LIKE '%".$key."%' OR ttcn.bangcap2 LIKE '%".$key."%' OR ttcn.nganhnghe LIKE '%".$key."%' ";

//   $count .= "AND ttcn.firstname LIKE '%".$key."%' OR ttcn.lastname LIKE '%".$key."%' OR ttcn.bangcap1 LIKE '%".$key."%' OR ttcn.bangcap2 LIKE '%".$key."%' OR ttcn.nganhnghe LIKE '%".$key."%' ";

// }

if(isset($_REQUEST["search"]) && $_REQUEST["search"] != ""){

  $check_profile = 1;

  $search_key = $_REQUEST["search"];

  $condition .= "

      AND ttcn.capbacmongmuon LIKE '%".$search_key."%'

      ";

}




// if(!empty($_REQUEST["kieu_luong"])){

//   $kieu_luong = $_REQUEST["kieu_luong"];

//   $condition .= " AND ttcn.mucluong LIKE '%".$kieu_luong."%' ";

//   //$count .= "AND ttcn.gender ='".$gender."";

// }






// if(!empty($_REQUEST["muc_luong_tu"])){

//   $muc_luong_tu = $_REQUEST["muc_luong_tu"];

//   $condition .= " AND ttcn.mucluong LIKE '%".$muc_luong_tu."%' ";

//   //$count .= "AND ttcn.gender ='".$gender."";

// }


// Tìm kiếm theo ngành nghề
if(!empty($_REQUEST["danhmuccv"]) 

    && $_REQUEST["danhmuccv"] != -1)

  {

  	$danhmuccv = $_REQUEST["danhmuccv"];
    
  	$dmcv = $_REQUEST["danhmuccv"];
    
  	$condition .= "AND ttcn.bangcap1 LIKE '%".$dmcv."%' ";
    
  	$count .= "AND ttcn.bangcap1 LIKE '%".$dmcv."%' ";
    
  }

// Tìm kiếm theo vị trí
if(!empty($_REQUEST["location"]) 

    && $_REQUEST["location"] != -1)
  {

    $location = $_REQUEST["location"];

    $searchString = $_REQUEST["location"];

    $condition .= " AND ttcn.noilamviecmongmuon LIKE '%".$searchString."%'";

    $count .= " AND ttcn.noilamviecmongmuon LIKE '%".$searchString."%' ";
  }




// // Tìm kiếm theo kinh nghiệm
if(!empty($_REQUEST["kinhnghiem_tu"]) && 

  !empty($_REQUEST["kinhnghiem_den"])) 

{

  $kinhnghiem_tu = $_REQUEST["kinhnghiem_tu"];

  $kinhnghiem_den = $_REQUEST["kinhnghiem_den"];


  $condition .= "

    AND ttcn.kinhnghiem >= '".$kinhnghiem_tu." '

    AND ttcn.kinhnghiem <= '".$kinhnghiem_den."'

    AND trn_profilecv.tim_kiem = '1'

    ";

}elseif(

  !empty($_REQUEST["kinhnghiem_tu"]) && 

  empty($_REQUEST["kinhnghiem_den"]))

{

  $kinhnghiem_tu = $_REQUEST["kinhnghiem_tu"];

  $condition .= "

    AND ttcn.kinhnghiem >= '".$kinhnghiem_tu."'

    AND trn_profilecv.tim_kiem = '1'

   ";

}elseif(!empty($_REQUEST["kinhnghiem_tu"]) && 

  empty($_REQUEST["kinhnghiem_den"]))

{

    $message = "Kinh nghiệm làm việc không hợp lệ";

    echo "<script type='text/javascript'>alert('$message');</script>";
  
}else{

  $kinhnghiem_tu = $_REQUEST["kinhnghiem_tu"];

   $condition .= "

      AND ttcn.kinhnghiem >= '".$kinhnghiem_tu." '

      AND trn_profilecv.tim_kiem = '1'

      ";
}

// Tìm kiếm theo ngôn ngữ
if(!empty($_REQUEST["ngon_ngu"])){

  $ngon_ngu = $_REQUEST["ngon_ngu"];

  $condition .= " AND ttcn.trinhdongoaingu LIKE '%".$ngon_ngu."%' ";

}


// Tìm kiếm theo giới tính
if(!empty($_REQUEST["gioitinh"])){

  $gender = $_REQUEST["gioitinh"];

  if ($gender != 'all') {

    $condition .= " AND ttcn.gender = '".$gender."'";

    $count .= "AND ttcn.gender ='".$gender."";

  }

}


//echo $condition;

/* get total row */

//echo $count."aaa";

$totalrow = $myprocess->get_career_count($condition); 

/* config items per page */

$itemPerPage = 12;



/* phan trang */

if(!isset($_GET["page"])) $currentPage = 1; else $currentPage = intval($_GET["page"]);

$Pager_cl =  new Pager();



$pager = $Pager_cl->getPagerData( $totalrow, $itemPerPage, $currentPage, $__append . $_GET["params"] . $GLOBALS['EXT'] . "?" );



$resultUngVien = $myprocess->get_list_career($condition, intval($pager->offset), intval($pager->limit));



//$category_title = $categoryProc->get_category_title($cat_id);    

$meta_title = $key == "" ? "Tất cả công việc có tại Y Tế Việc" : "Tìm kiếm việc làm với từ khóa \"$key\"";

?>

<?php if(!empty($_SESSION["session"]["Id"]) && $_SESSION["session"]["Id"] !=NULL){  ?>

<section id="ungvien">

  <div id="search-widget-wrapper">

    <div id="search-widget" class="collapse m-t-md in">

      <div class="search-form container">

        <div class="bg-blue">

          <div class="row">

            <div class="search-widget-area col-sm-12" id="search-box">

              <form name="timkiemungvien" type="POST" action="">

                <div class="col-sm-10">

                  <div class="row">

                    <div class="col-sm-4 keyword-search-wrapper">

                      <div class="textbox">

                        <span class="col-xs-12 no-padding">

                          <span class="twitter-typeahead">

                            <input value="<?php echo $key ?>" name="search" type="text" class="form-control search-all input-lg text-clip search-cv tt-input" placeholder="Nhập chức danh, vị trí, kỹ năng..." style="position: relative; vertical-align: top;">

                          </span>

                        </span>

                      </div>

                    </div>

                    <div class="col-sm-4 cate-search">

                      <div class="textbox">

                        <span class="col-xs-12 no-padding">

                          <select class="select-category" data-search-input-placeholder="Tìm kiếm theo ngành nghề" name="danhmuccv" data-placeholder="Chọn ngành nghề">

                            <option value="-1">Tất cả các khoa , ngành </option>

                            <?php

                              $result = $myprocess->getDanhmuccv();

                              $selected = "";

                              while($row = $result->fetch()){

                                $resultCK = $myprocess->getChuyenKhoa($row["danhmuccv_id"]);

                                if($resultCK->rowCount() > 0){

                            ?>

                              <optgroup label="<?php echo $row["tendanhmuccv"] ?>">

                                <?php

                                  while($rowCK = $resultCK->fetch()){

                                    $selected = $rowCK["chuyenkhoa_id"] == $_REQUEST["danhmuccv"] ? "selected" : "";

                                ?>

                                  <option <?php echo $selected ?> value="<?php echo $rowCK["chuyenkhoa_name"] ?>"><?php echo $rowCK["chuyenkhoa_name"] ?></option>

                                <?php

                                  }

                                ?>

                              </optgroup>

                            <?php

                                }else{

                                  $selected = $row["danhmuccv_id"] == $_REQUEST["danhmuccv"] ? "selected" : "";

                            ?>

                                  <option <?php echo $selected ?> value="<?php echo $row["danhmuccv_id"] ?>"><?php echo $row["tendanhmuccv"] ?></option>

                            <?php

                                }

                              }

                            ?>

                          </select>

                        </span>

                      </div>

                    </div>

                    <div class="col-sm-4 level-search">

                      <div class="textbox">

                        <span class="col-xs-12 no-padding">

                          <select class="select-location-2" data-search-input-placeholder="Tìm kiếm theo địa điểm" name="location" data-placeholder="Chọn địa điểm làm việc">

                            <option value="-1">Tất cả</option>

                            <?php

                              $result = $myprocess->getTinhThanh();

                              while($row = $result->fetch()){

                                $selected = "";

                                if($row["id"] == $location){

                                  $selected = "selected";

                                }else{

                                  $selected = "";

                                }

                            ?>

                              <option <?php echo $selected ?> value="<?php echo $row["ten_tinhthanh"] ?>"><?php echo $row["ten_tinhthanh"] ?></option>

                            <?php

                              }

                            ?>

                          </select>

                        </span>

                      </div>


                    </div>


                  </div>


                </div>

                <div class="col-sm-2" >

                  <a class="btn-lg btn-primary" id="search-cv">

                    <i></i>

                    Tìm kiếm

                  </a>

                </div>

              </form>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</section>

<div class="container">

  <?php

    //echo $_SESSION["session"]["Id"];

    $result = $myprocess->get_boloc($_SESSION["session"]["Id"]);

    if($row = $result ->fetch())

      {

        $boloc = unserialize($row['bo_loc']);

        $type_money =array(

          'Thỏa thuận' => 'Thỏa thuận',

          'VNĐ' => 'VNĐ' ,

          'USD' => 'USD' 

        );

        $trinhdonn =array(   

          '-1' => 'Tất cả',

          'Anh' => 'Anh' ,

          'Việt Nam' => 'Việt Nam',

          'Pháp' => 'Pháp' ,

          'Đức' => 'Đức' ,

          'Nga' => 'Nga' ,

          'Trung Quốc' => 'Trung Quốc' ,

          'Hàn Quốc' => 'Hàn Quốc' ,

          'Nhật Bản' => 'Nhật Bản' ,

        
        );

  ?>

  <div class="col-sm-12 col-md-3">

    <div class="block-sidebar d-block bg-white">

        <h3 class="title-sidebar">Bộ lọc CV</h3>

      <div class="content-sidebar-fillter">

        <form class="row box-right-home-job-search" id="m_form"  method="post">

          

        <!--<div class="col-sm-6 col-md-6 txt-lb">Mức lương</div>-->

        <!-- <div class="col-sm-6 col-md-6">

        <select class="form-control cs-money" id="type_money" name="type_money">

          

                   <?php 

                  foreach($type_money as $short_code => $descriptive)  { 

                    if($boloc['type_money'] == $descriptive)

                    {

                            

                ?>

                    <option value="<?php echo $short_code; ?>" selected ><?php echo $descriptive; ?></option>

              <?php  } else 



                  { ?>

   

                          <option value="<?php echo $short_code; ?>"><?php echo $descriptive; ?></option>

                <?php 

                    }

                }

                ?>  

          </select>

        </div> -->

            <!--<div class="col-sm-6 col-md-6">

                  <div class="box_text">Từ:</div>

                  <div class="box_frm">

                    <input required="" type="number" name="muc_luong_tu" class="form-control muc_luong_tu" maxlength="50" value = "<?php echo $boloc['muc_luong_tu']; ?>">

                    <p class="has-error"></p>

                  </div>

            </div>-->

            <!--<div class="col-sm-6 col-md-6">

                  <div class="box_text">Đến:</div>

                  <div class="box_frm">

                    <input required="" type="number" name="muc_luong_den" value = "<?php echo $boloc['muc_luong_den']; ?>" class="form-control muc_luong_den" maxlength="50">

                    <p class="has-error"></p>

                  </div>

            </div> -->

             <div class="col-sm-12 col-md-12 txt-lb">

              <div class="f_header_parent">

                <div class="f_header_child">

                  Năm kinh nghiệm 

                </div>

              </div>

            </div> 

              <div class="col-sm-6 col-md-6">

                <div class="box_text">Từ:</div>

                  <div class="box_frm">

                    <input required="" type="number" name="kinhnghiem_tu" id="kinhnghiem_tu" value = "<?php echo $boloc['kinhnghiem_tu']; ?>" class="form-control kinhnghiem_tu" maxlength="50">

                    <p class="has-error"></p>

                  </div>

              </div>

              <div class="col-sm-6 col-md-6">

                <div class="box_text">Đến:</div>

                  <div class="box_frm">

                    <input required="" type="number" name="kinhnghiem_den" id="kinhnghiem_den" value = "<?php echo $boloc['kinhnghiem_den']; ?>" class="form-control kinhnghiem_den" maxlength="50">

                    <p class="has-error"></p>

                  </div>

              </div>


<!--               <div class="col-sm-6 col-md-12">

                <div class="box_text">

                  Chưa có kinh nghiệm 

                  <input style="margin-left: 10px;" type="radio" name="chuacokinhnghiem">

                </div>

              </div>  -->
              

            <div class="col-sm-12 col-md-12 txt-lb">

              <div class="f_header_parent">

                <div class="f_header_child">

                Trình độ ngoại ngữ

              </div>

              </div>

            </div>  


              <div class="col-sm-12 col-md-12">

                <div class="box_frm">
     
                    <select name="trinhdonn" class="trinhdonn form-control m-bootstrap-select m_selectpicker" data-live-search="true"> 

                      <!-- <option selected value="<?php echo $key; ?>">Việt Nam</option>
 -->
                         <?php 

                          foreach($trinhdonn as $key => $value) { 

                          if($boloc['trinhdonn'] == $value)

                          {

                            $activer = 'selected';

                      ?>

                         <option value="<?php echo $key; ?>" selected  ><?php echo $value; ?></option>

                         <?php  }else 



                          { ?>

                         <option value="<?php echo $key; ?>"><?php echo $value; ?></option>

                       <?php 

                          }

                      }

                       ?> 

                    

                    </select>

                  </div>

              </div>

            

			<div class="col-sm-12 col-md-12 txt-lb">

				<div class="card-header f_header_parent">

					<span class="f_header_child">Giới tính</span>

				</div>
        
			</div> 

               <div class="col-sm-4 col-md-4">

                  <div class="box_frm">

                  <label>

                    <input required="" type="radio" class="gender" name="gender" <?php if($boloc['gender']== 'all'){ echo 'checked' ; } ?> value="all">

                      Bất kỳ

                    <p class="has-error"></p>

                  </label>

                  </div>

              </div>
              


                <div class="col-sm-4 col-md-4">

                    <div class="box_frm">

                      <label>

                        <input required="" type="radio" class="gender" name="gender"  <?php if($boloc['gender']== 'Nam') { echo 'checked' ; } ?>  value="Nam">

                          Nam

                        <p class="has-error"></p>

                      </label>

                    </div>

                </div>
              

              <div class="col-sm-4 col-md-4">

                  <div class="box_frm">

                    <label>

                      <input required="" type="radio" class="gender" name="gender" <?php if($boloc['gender']== 'Nữ'){ echo 'checked' ; } ?> value="Nữ">

                        Nữ

                      <p class="has-error"></p>

                    </label>

                  </div>

              </div>
              
            
            <!--<div class="col-sm-12 col-md-12 txt-lb">Tuổi</div>  

              <div class="col-sm-6 col-md-6">

                <div class="box_text">Từ:</div>

                  <div class="box_frm">

                    <input type="text" name="tuoi_tu" class="form-control tuoi_tu" value="<?php echo $boloc['tuoi_tu'] ?>" maxlength="50">

                    <p class="has-error"></p>

                  </div>

              </div>

              <div class="col-sm-6 col-md-6">

                <div class="box_text">Đến:</div>

                  <div class="box_frm">

                    <input type="text" name="tuoi_den" value="<?php echo $boloc['tuoi_den'] ?>" class="form-control tuoi_den" maxlength="50">

                    <p class="has-error"></p>

                  </div>

              </div> -->

              <div class="col-sm-12 col-md-12 txt-lb" style="text-align:center;">



                    <a href="javascript:void(0)" class="btn-fillter btn btn-lg btn-primary">

                      <i></i>

                      Lưu tìm kiếm

                    </a>

              </div>

        </form>

      </div>

  </div>  

</div>

  <?php } ?>

  <div id="main-career-list" class="job-search__main-job-list col-md-9">

    <div class="job-search-body" title="">

      <div class="job-list job-list-page_boxed">

        <div id="job-list">

          <div class="ais-hits">

            <div class="job-list" id="job-list">

              <div class="box p-t-none p-b-none top-level-job-list">

                <div class="box-top-level clearfix">

                  <?php

                    //$total= 0;

                  //  $total = $myprocess->count_cv_tim_kiem();

                  

                  //  echo "<h3> Có : ".$total." Cho phép tìm kiếm </h3>";          

                  ?>

                

                  <?php

                    $thongtin_bangcap = "";

                    if ($totalrow > 0){

                      while($row = $resultUngVien->fetch()){

                        $tenDMCV = str_replace("VIỆC LÀM", "", $row["nganhnghe"]);



                        $chuyenkhoa_arr = explode("|", $row["bangcap1"]);

                        

                        $bangcap_chinh = empty($row["bangcap1"]) ? "Chưa cập nhật" : $chuyenkhoa_arr[0];

                        $chuyenkhoa   = $chuyenkhoa_arr[1];

                  ?>

                  <div class="job-item item2">

                    <div class="relative">

                      <div class="row d-flex-sm">

                        <div class="col-md-3 job-search__logo-col d-flex-center-sm">

                          <div class="logo job-search__logo">

                                                      <?php 

                              

                              if($row['hinhanh'] == '') { ?>

                            <a>

                              <img title="Y Tế Việc" class="img-responsive" src="images/career.png">

                            </a>

                            <?php }else  {?>

                            <a>

                              <img title="Y Tế Việc" class="img-responsive" src="<?php echo $row['hinhanh'] ?>">

                            </a>

                            <?php } ?>

                          </div>

                        </div>

                        <div class="col-md-6 job-search__job-info-col" style="line-height:30px">

                          <div class="job-item-info relative">

                            <h3 class="job-title">

                            <?php if($row["fullname"] !=" "){ ?>

                            <span class="badge bg-success" style="background:lightcoral; font-size: 15px;">Ứng viên</span>

                            <a href="career <?php echo $row["thongtincanhan_id"] ?>.html">

                              <?php 

                                echo $row["fullname"] == " " ? "Chưa cập nhật" : mb_strtoupper($row["fullname"], utf8) ?>
                                  
                              </a>

                              <?php }

                            else { echo '<a href="javascript:void(0)" >CHƯA CẬP NHẬT </a>';} ?>

                            </h3>

                            <div class="company gray-light">

                              <!--<span title="<?php echo $tenDMCV ?>">

                                <?php echo $tenDMCV == "" ? " " : $tenDMCV ?>

                              </span><br> -->

                              <span title="Chuyên khoa: <?php echo $tenDMCV ?>">

                                - Bằng cấp: 
                                <span style="font-weight:bold;"><?php echo $bangcap_chinh ?><br></span>
                                

                                <?php if(!empty($chuyenkhoa)) 

                                { ?> 
                                  - Chuyên môn :
                                  <span style="font-weight:bold"><?php echo $chuyenkhoa ?> <?php } ?></span>

                              </span>

                            </div>

                            <div class="gray-light">
                        

                              <span class="job-search__location gray-light">

                                <strong class="" title="<?php echo $row["noilamviecmongmuon"] ?>"> 

                                  - Khu vực: 
                                  <span style="font-weight:bold"><?php echo $row["noilamviecmongmuon"] ?></span>
                                    
                                  </strong>

                              </span>

                            </div>

                             <div class="gray-light">

                              <!-- <span class="hidden-sm hidden-xs extraLabel">- Vị trí mong muốn:</span> -->

                              <span class="job-search__location gray-light">

                                <strong class="" title="<?php echo $row["capbacmongmuon"] ?>"> 

                                  - Vị trí mong muốn: 

                                  <span style="font-weight:bold"><?php echo $row["capbacmongmuon"] ?></span>
                                    
                                  </strong>

                              </span>

                            </div>

                            <div class="extra-info">

                              <span class="job-search__location gray-light">

                                - Ngày cập nhật: <?php echo date("d/m/Y", strtotime($row["INSERTDATE"])) ?>

                              </span>

                            </div>


                          </div>

                        </div>

                        <div class="col-md-3 job-search__job-info-col">

                            <div class="benefits">

                               <?php if($row["fullname"] !=" "){ ?>

                                  <a class="btn btn-primary" href="career<?php echo $row["thongtincanhan_id"] ?>.html">XEM HỒ SƠ ỨNG VIÊN</a>                            

                                <?php }

                                else{ echo '<a class = "btn btn-info" href="javascript:void(0)" >ỨNG VIÊN CHƯA CẬP NHẬT </a>';} ?>

                              <!-- <a href="#" class="btn btn-primary" >Xem thông tin ứng viên</a> -->
                              
                            </div>

                        </div>

                      </div>

                    </div>

                  </div>

                  <?php 

                      }

                    }

                    else{ 

                  ?>

                  <h3>Không tìm thấy kết quả nào</h3>

                <?php } ?>

                </div>

              </div>

            </div>

          </div>

        </div>

        <div class="text-center m-t-n m-b-lg">

          <ul class="pagination pagination-lg">

            <?php echo $pager->paging; ?>

          </ul>

        </div>

      </div>

    </div>

  </div>

</div>

<?php }else { ?>

<div style="max-width: 600px" class="sitemap-container container m_bottom_20">

    <div class="clearfix m_xs_bottom_10">

    <div class="bg_white p_15 r_corners m_bottom_20">

      <div class="col-lg-12 col-md-12 col-sm-12 f_none" style="margin:0 auto;">

        <div class="step-1 animated fadeIn">

          <h1 class="sitemap-header text-primary">ĐĂNG NHẬP NHÀ TUYỂN DỤNG</h1>

        </div>

        <div class="bg_white p_15 r_corners m_bottom_20">

          <div class="col-lg-12 col-md-12 col-sm-12 f_none" style="margin:0 auto;">

            <form autocomplete="off" class="awe-check" name="frmLogin" id="frmLogin" method="post">

              <div class="row">

                <div class="col-sm-12">

                  <div class="form-group">

                    <label>Email</label>

                    <input type="email" name="loginemail" class="form-control" required>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-sm-12">

                  <div class="form-group">

                    <label>Mật khẩu</label>

                    <input maxlength="50" type="password" name="loginpassword" class="form-control" required>

                  </div>

                </div>

              </div>

              <div class="row">

                <div class="col-md-12 col-xs-12 text-right">

                  <a class="inline m-t-sm forgot-password clickable" onclick="event.preventDefault(); globalForgotPasswordModal.showModal();">Quên mật khẩu?</a>

                </div>

              </div>

              <div class="row">

                <div class="col-sm-12">

                  <div class="form-group">

                    <button type="button" class="ntd_login btn btn-primary full-width btn-lg">

                      <span>Đăng nhập</span>

                    </button>

                  </div>

                </div>

              </div>

            </form> 

          </div>

          <hr class="hidden-xs"/>

          <div class="">

            <p class="text-center m-b-none sign-in">&nbsp;</p>

          </div>

        </div>

          </div>

        </div>

  </div>

</div>

<?php } ?>

<script>
          
// Nếu nhập kinh nghiệm đến < kinh nghiệm từ thì báo lỗi                 
$('#kinhnghiem_den').blur(function(){

  var checkCondition = $('#kinhnghiem_tu').val();

  var kinhnghiemden = $('#kinhnghiem_den').val();

  if(kinhnghiemden < checkCondition)
  {                     
    swal({
      title: "Thông tin lỗi", text: "Số năm kinh nghiệm không hợp lệ để thực hiện tìm kiếm", 
      type: "error"},
    );

  $(this).val(''); // claer dữ liệu không hợp lệ
  }else{return true};

});
            

$(".ntd_login").click(function(){

          var frm = $(this).parents("form").first().attr("id");

          var email = $("#" + frm + " input[name=loginemail]").val();

          var password = $("#" + frm + " input[name=loginpassword]").val();

          if(password.length < 6 || password.length > 50){

            swal({

              title: "Lỗi",

              text: "Mật khẩu có độ dài từ 6 đến 50 ký tự",

              type: "warning"

            })

            return false;

          }

      $.ajax({

        url: "login-ntd",

        type: "POST",

        data: {do: "login-ntd", email: email, password: password},

        success: function(rs){

          if(rs == 1){

            swal({

              title: "",

              text: "Đăng nhập thành công",

              type: "success"

            }, function (){

              window.location = $("#currentlink").val();

            })

                }else{

                  swal({

                    title: "",

                    text: "Địa chỉ email hoặc mật khẩu không đúng",

                    type: "warning"

                  })

                }

              }

            })

          })


  $(".btn-fillter").click(function(){

    var data= $('#m_form').serialize();

      $.ajax({

        url: 'fillter-cv',

        type: 'POST',

        dataType: 'JSON',

        data: {do: 'setup-fillter',data:data},

        success: function(response){

          if(response.status == 1){

            alert(response.message);

            location.reload();

          }else{

            //btn.prop("disabled", false);

            alert(response.message);

          } 

        }

      })

    })

  $("#search-cv").click(function(){

	var searchtxt = $(".search-cv").val();

	var s_khoa_nganh = $('select[name=danhmuccv]').val();

	var s_location = $('select[name=location]').val();
	  
	var s_gioitinh  =  $("input[type='radio']:checked").val();	

  var s_trinhdonn  = $('select[name=trinhdonn]').val();

  var kinhnghiem_tu = $('.kinhnghiem_tu').val();

  var kinhnghiem_den = $('.kinhnghiem_den').val();


    //   var s_type_money = $('select[name=type_money]').val();

    //   var muc_luong_tu = $('.muc_luong_tu').val();

    //   var muc_luong_den = $('.muc_luong_den').val();

// 
    



    //   var tuoi_tu = $('.tuoi_tu').val();

    //   var tuoi_den = $('.tuoi_den').val();

      //alert(s_trinhdonn);

	var link = window.location.pathname;

	var url = window.location.protocol + "//" + window.location.hostname + link + "?";

	if(searchtxt != ""){ url += "&search=" + searchtxt};

	if(s_khoa_nganh != "" && s_khoa_nganh != -1 ){ url += "&danhmuccv=" + s_khoa_nganh};

	if(s_location != "" && s_location != -1){ url += "&location=" + s_location};
	  
	if(s_gioitinh != ""){ url += "&gioitinh=" + s_gioitinh};

  if(s_trinhdonn != "" && s_trinhdonn != -1 ){ url += "&ngon_ngu=" + s_trinhdonn};  

  if(kinhnghiem_tu != ""){ url += "&kinhnghiem_tu=" + kinhnghiem_tu};

  if(kinhnghiem_den != ""){ url += "&kinhnghiem_den=" + kinhnghiem_den};


    //   if(s_type_money != ""){ url += "&kieu_luong=" + s_type_money};

    //   if(muc_luong_tu != ""){ url += "&muc_luong_tu=" + muc_luong_tu};

    //   if(muc_luong_den != ""){ url += "&muc_luong_den=" + muc_luong_den};





    //   if(tuoi_tu != ""){ url += "&tuoi_tu=" + tuoi_tu};

    //   if(tuoi_den != ""){ url += "&tuoi_den=" + tuoi_den};

      window.location = url;

    })

</script>