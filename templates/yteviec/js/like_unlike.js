$(document).ready(function(){
	$('#like').on('click', function () {
		var $like = $(this).data('id');
		var $id_company = $(this).data('company');
		 $.ajax({
			url: "vote",
			type: "POST",
			dataType: "JSON",
	   		async: true,
			data: {	
				act : "like_vote",
				id_company:$id_company,
			    value_vote:1
			},
			success: function(jsonRS){
				if(jsonRS['IsError'] == 1)
				{
					swal({
						title:"",
						text: jsonRS['msg'],
						type: "info"
					})
					$('.totalLike').text(jsonRS['like']);
					$('.totalUnLike').text(jsonRS['unlike']);					
				}else if(jsonRS['IsError'] == 2)
				{
					// Login OverView
					swal({
						title:"",
						text: jsonRS['msg'],
						type: "info"
				}, function(){
				  //window.location.href = "//yteviec.com";
				  $('#Login_modal').modal('show');
				   $('.close').on('click', function () {
						$('#Login_modal').modal('hide');
				})
				$(".career_login").click(function(){
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
						url: "login",
						type: "POST",
						data: {do: "login", email: email, password: password},
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
					});
				} 
				else
				{
					swal({
						title:"",
						text: jsonRS['msg'],
						type: "info"
					})
				}
			}
		})
	});
	$('#unlike').on('click', function () {
		var $unlike = $(this).data('id');
		var $id_company = $(this).data('company');
		$.ajax({
			url: "vote",
			type: "POST",
			dataType: "JSON",
	   		async: true,
			data: {	
				act : "like_vote",
				id_company:$id_company,
			    value_vote:0
			},
			success: function(jsonRS){
				if(jsonRS['IsError'] == 1)
				{
					swal({
						title:"",
						text: jsonRS['msg'],
						type: "info"
					})
					$('.totalUnLike').text(jsonRS['unlike']);  
				}else if(jsonRS['IsError'] == 2)
				{
					// Login OverView
					swal({
						title:"",
						text: jsonRS['msg'],
						type: "info"
				}, function(){
				  //window.location.href = "//yteviec.com";
				  $('#Login_modal').modal('show');
				   $('.close').on('click', function () {
						$('#Login_modal').modal('hide');
				})
				$(".career_login").click(function(){
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
						url: "login",
						type: "POST",
						data: {do: "login", email: email, password: password},
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
					});
				}else
				{
					swal({
						title:"",
						text: jsonRS['msg'],
						type: "info"
					})
				}
			}
		})
	});
});