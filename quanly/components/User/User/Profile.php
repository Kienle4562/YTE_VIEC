<div id="Load_Profile"></div>
<script>
$.ajax({
	url: "LoadUserProfile.ajax",
	beforeSend: function () {
		$("#Load_Profile").html('<img src="dist/img/input-spinner.gif">');
	},
	success: function(rs) {
		$("#Load_Profile").html(rs);
	}
})
</script>