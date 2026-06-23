

<ul style="height: 80px;overflow: hidden;" class="filterTT2">
  <?php if($_POST['typePack'] =='benhvien' || $_POST['typePack'] =='benhvien-1' || $_POST['typePack'] =='benhvien-2' ) {
	 
	  // mst_loaihinhhoatdong 4: bệnh viện tư
		$resultBVtu = $myprocess -> checkCongty(4);
		  $rowBVtu = $resultBVtu->fetch();
		 // mst_loaihinhhoatdong 4: bệnh viện công
		$resultBVCong = $myprocess -> checkCongty(8); 
		$rowBVCong = $resultBVCong->fetch();
		
  ?>

	<li>
		<label class="m-checkbox">
			<input onchange="window.location.href='<?php echo $index;?>benh-vien-tu.html?key=benhvien-1'" type="checkbox" <?php if($_POST['typePack'] =='benhvien-1'){ echo 'checked';} ?> value="1" class="chkCheckBox "> Bệnh viện tư<span> (<?php echo $rowBVtu['congty']; ?>)</span>
		</label>
		<!--<span class="f_right">(0)</span>-->
	</li>
	<li>
		<label class="m-checkbox">
			<input onchange="window.location.href='<?php echo $index;?>benh-vien-cong.html?key=benhvien-2'" type="checkbox" <?php if($_POST['typePack'] =='benhvien-2'){ echo 'checked';} ?> value="50" class="chkCheckBox "> Bệnh viện Công<span> (<?php echo $rowBVCong['congty']; ?>)</span>
		</label>
		<!--<span class="f_right">(0)</span>-->
	</li>
	<!--<li>
		<label class="m-checkbox">
			<input onchange="window.location.href='http://yteviec.com/benh-vien.html?key=benhvien'" type="checkbox" value="50" class="chkCheckBox "> Danh sách bệnh viện<span></span>
		</label>
		<span class="f_right">(0)</span>
	</li>-->
  <?php }else if($_POST['typePack'] =='phongkham' || $_POST['typePack'] =='phongkham-1' || $_POST['typePack'] =='phongkham-2' || $_POST['typePack'] =='phongkham-3') {
	   // 1 : nha khoa , 2: đa khoa, ,3 chuyen khoa
		  $resultDakhoa = $myprocess -> checkCongty(2);
		  $rowDK = $resultDakhoa->fetch();
		 // mst_loaihinhhoatdong 4: bệnh viện công
		  $resultNK = $myprocess -> checkCongty(8); 
		  $rowNK	  = $resultNK->fetch();
		  
		  $resultCK = $myprocess -> checkCongty(8); 
		  $rowCK	  = $resultCK->fetch();
	  ?>
	<!-- <li>
		<label class="m-checkbox">
			<input onchange="window.location.href='http://yteviec.com/phong-kham.html?key=phongkham'" type="checkbox" value="1" class="chkCheckBox ">Phòng khám<span></span>
		</label>
		<span class="f_right">(0)</span>
	</li>-->
	<li>
		<label class="m-checkbox">
			<input onchange="window.location.href='<?php echo $index;?>phong-kham-nha-khoa.html?key=phongkham-1'" type="checkbox" <?php if($_POST['typePack'] =='phongkham-1'){ echo 'checked';} ?> value="50" class="chkCheckBox "> Phòng Khám Nha Khoa<span> (<?php echo $rowNK['congty']; ?>)</span>
		</label>
		<!--<span class="f_right">(0)</span>-->
	</li>
	<li>
		<label class="m-checkbox">
			<input onchange="window.location.href='<?php echo $index;?>phong-kham-da-khoa.html?key=phongkham-2'" type="checkbox" <?php if($_POST['typePack'] =='phongkham-2'){ echo 'checked';} ?> value="50" class="chkCheckBox ">  Phòng Khám Đa Khoa<span> (<?php echo $rowDK['congty']; ?>)</span>
		</label>
		<!--<span class="f_right">(0)</span>-->
	</li>
	<li>
		<label class="m-checkbox">
			<input onchange="window.location.href='<?php echo $index;?>phong-kham-chuyen-khoa.html?key=phongkham-3'" type="checkbox" <?php if($_POST['typePack'] =='phongkham-3'){ echo 'checked';} ?> value="50" class="chkCheckBox "> Phòng Khám Chuyên Khoa<span> (<?php echo $rowCK['congty']; ?>)</span>
		</label>
		<!--<span class="f_right">(0)</span>-->
	</li>
	<!--<li>
		<label class="m-checkbox">
			<input onchange="window.location.href='http://yteviec.com/phong-kham.html?key=phongkham'" type="checkbox" value="50" class="chkCheckBox "> Danh Sách Phòng Khám<span></span>
		</label>
		<span class="f_right">(0)</span>
	</li>-->
  <?php }else if($_POST['typePack'] =='congtyyte' || $_POST['typePack'] =='congtyyte-1' || $_POST['typePack'] =='congtyyte-2') { 
			// 5: cty duoc
		  $result_ctDuoc = $myprocess -> checkCongty(5);
		  $rowDuoc = $result_ctDuoc->fetch();
		 // mst_loaihinhhoatdong 4: bệnh viện công
		  $resultTBYT = $myprocess -> checkCongty(6); 
		  $rowTBYT	  = $resultTBYT->fetch();
  ?>
	<!--<li>
		<label class="m-checkbox">
			<input onchange="window.location.href='http://yteviec.com/cong-ty.html?key=congtyyte'" type="checkbox" value="1" class="chkCheckBox "> Công Ty<span></span>
		</label>
		<span class="f_right">(0)</span>
	</li>-->
	<li>
		<label class="m-checkbox">
			<input onchange="window.location.href='<?php echo $index;?>cong-ty-duoc.html?key=congtyyte-1'" type="checkbox" <?php if($_POST['typePack'] =='congtyyte-1'){ echo 'checked';} ?>  value="50" class="chkCheckBox "> Công Ty Dược<span> (<?php echo $rowDuoc['congty']; ?>)</span>
		</label>
		<!--<span class="f_right">(0)</span>-->
	</li>
	<li>
		<label class="m-checkbox">
			<input onchange="window.location.href='<?php echo $index;?>cong-ty-thiet-bi-y-te.html?key=congtyyte-2'" type="checkbox" <?php if($_POST['typePack'] =='congtyyte-2'){ echo 'checked';} ?> value="50" class="chkCheckBox "> Công Ty Thiết Bị Y Tế<span> (<?php echo $rowTBYT['congty']; ?>)</span>
		</label>
		<!--<span class="f_right">(0)</span>-->
	</li>
	<!--<li>
		<label class="m-checkbox">
			<input onchange="window.location.href='http://yteviec.com/cong-ty-y-te.html?key=congtyyte'" type="checkbox" value="50" class="chkCheckBox "> Danh Sách Công Ty Y Tế<span></span>
		</label>
		<span class="f_right">(0)</span>
	</li>-->
   <?php }else if($_POST['typePack'] =='timtruongyvacosoytekhac' || $_POST['typePack'] =='timtruongyvacosoytekhac-1'|| $_POST['typePack'] =='timtruongyvacosoytekhac-2') {
	   
	   $resultnhathuoc = $myprocess -> checkCongty(10); 
		  $rowNT	  = $resultnhathuoc->fetch();
		$resultSPA = $myprocess -> checkCongty(7); 
		  $rowSPA	  = $resultSPA->fetch();
	   ?>
   <!--<li>
		<label class="m-checkbox">
			<input onchange="window.location.href='http://yteviec.com/tra-cuu-co-so-y-te.html?key=timtruongyvacosoytekhac'" type="checkbox" value="1" class="chkCheckBox ">Khác<span></span>
		</label>
		<span class="f_right">(0)</span>
	</li>-->
	<li>
		<label class="m-checkbox">
			<input onchange="window.location.href='<?php echo $index;?>nha-thuoc.html?key=timtruongyvacosoytekhac-1'" type="checkbox" <?php if($_POST['typePack'] =='timtruongyvacosoytekhac-1'){ echo 'checked';} ?> value="50" class="chkCheckBox "> Nhà Thuốc<span> (<?php echo $rowNT['congty']; ?>)</span>
		</label>
		<!--<span class="f_right">(0)</span>-->
	</li>
	<li>
		<label class="m-checkbox">
			<input onchange="window.location.href='<?php echo $index;?>spa-tham-my-vien.html?key=timtruongyvacosoytekhac-2'" type="checkbox" <?php if($_POST['typePack'] =='timtruongyvacosoytekhac-2'){ echo 'checked';} ?>  value="50" class="chkCheckBox "> Spa & Thẩm Mỹ Viện<span> (<?php echo $rowSPA['congty']; ?>)</span>
		</label>
		<!--<span class="f_right">(0)</span>-->
	</li>
	<!--<li>
		<label class="m-checkbox">
			<input onchange="window.location.href='http://yteviec.com/tra-cuu-co-so-y-te.html?key=timtruongyvacosoytekhac'" type="checkbox" value="50" class="chkCheckBox "> Tra Cứu Cơ Sở Y Tế<span></span>
		</label>
		<span class="f_right">(0)</span>
	</li>-->
  <?php } ?>
</ul>