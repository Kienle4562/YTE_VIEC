<div id="Load_ProfileEdit"></div>
<script>
	$.ajax({
		url: "LoadProfileUserEdit.ajax",
		beforeSend: function () {
			$("#Load_ProfileEdit").html('<img src="dist/img/input-spinner.gif">');
		},
		success: function(rs) {
			$("#Load_ProfileEdit").html(rs);
		}
	})
</script>