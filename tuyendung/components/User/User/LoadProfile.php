<?php defined( '_VALID_MOS' ) or die( include("404.php") );
	$myprocess = new process();
	$result = $myprocess->info_User();
	$row = $result -> fetch();
?>
<div class="row">
  <aside class="profile-nav col-lg-3">
    <section class="panel">
      <div class="user-heading round"> <a href="/#/Profile"> <img alt="" src="<?php if($row["Hinhanh"] != ""){?> <?=$row["Hinhanh"];}else{?> <?="dist/img/Default-avatar.jpg";}?>"></a>
        <h1><?= $row["Hoten"]; ?></h1>
        <p><?= $row["Email"]; ?></p>
      </div>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="/#/Profile"> <i class="fa fa-user"></i> Cá nhân</a></li>
        <li><a href="/#/Profile-Edit"> <i class="fa fa-edit"></i> Chỉnh sửa</a></li>
      </ul>
    </section>
  </aside>
  <aside class="profile-info col-lg-9">
    <section class="panel">
      <form>
        <textarea id="tamtrang" name="tamtrang" placeholder="Whats in your mind today?" rows="2" class="form-control input-lg p-text-area"></textarea>
      </form>
      <footer class="panel-footer">
        <button onclick="dangtamtrang()" class="btn btn-danger pull-right">Post</button>
        <ul class="nav nav-pills">
          <li> <a href="/#/Profile"><i class="fa fa-map-marker"></i></a> </li>
          <li> <a href="/#/Profile"><i class="fa fa-camera"></i></a> </li>
          <li> <a href="/#/Profile"><i class=" fa fa-film"></i></a> </li>
          <li> <a href="/#/Profile"><i class="fa fa-microphone"></i></a> </li>
        </ul>
      </footer>
    </section>
    <section class="panel">
      <div id="htcamxuc" class="bio-graph-heading"> <?= $row["Camxuc"]; ?></div>
      <div class="panel-body bio-graph-info">
        <h1>Hồ sơ cá nhân</h1>
        <div class="row">
          <div class="bio-row">
            <p><span>Họ tên </span>: <b id="HT_Profile"><?= $row["Hoten"]; ?></b> </p>
          </div>
          <div class="bio-row">
            <p><span>Ngày sinh </span>: <b id="NS_Profile"><?= ($row["Ngaysinh"]=="")?'<span style="color:#e26b7f;">Chưa cập nhật</span >':date("d/m/Y", $row["Ngaysinh"]) ?></b> </p>
          </div>
          <div class="bio-row">
            <p><span>Địa chỉ </span>: <b id="DC_Profile"><?= ($row["Diachi"]=="")?'<span style="color:#e26b7f;">Chưa cập nhật</span >':$row["Diachi"] ?></b> </p>
          </div>
          <div class="bio-row">
            <p><span>Di động </span>: <b id="DD_Profile"><?= ($row["Didong"]=="")?'<span style="color:#e26b7f;">Chưa cập nhật</span >':$row["Didong"] ?></b> </p>
          </div>
          <div class="bio-row">
            <p><span>Email </span>: <b id="Email_Profile"><?= ($row["Email"]=="")?'<span style="color:#e26b7f;">Chưa cập nhật</span >':$row["Email"] ?></b> </p>
          </div>
          <div class="bio-row">
            <p><span>CMND </span>: <b id="Email_Profile"><?= ($row["Cmnd"]=="")?'<span style="color:#e26b7f;">Chưa cập nhật</span >':$row["Cmnd"] ?></b> </p>
          </div>
        </div>
      </div>
    </section>
    
  </aside>
</div>
<script>
function dangtamtrang(){
	var tamtrang = $("#tamtrang").val();
	$.ajax({
		url: "dangtamtrang.ajax",
		type: "POST",
		data: "act=dangtamtrang"+"&tamtrang="+tamtrang,
		success: function(rs){
			toastr["success"]("Cám ơn bạn đã cập nhật cảm nghĩ của mình lên hệ thống!", "Đã cập nhật cảm nghĩ!");
			$("#htcamxuc").html(tamtrang);
			//Notification all
			update_notification('dangtamtrang'+'của mình');
		}
	})
}
</script>