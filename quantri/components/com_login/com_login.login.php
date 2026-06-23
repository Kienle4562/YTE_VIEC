<SCRIPT language=javascript type=text/javascript>
	function setFocus() {
		document.phpForm.uid.select();
		document.phpForm.uid.focus();
	}
	setFocus();
</SCRIPT>

<center>
	<div>
		<form name="phpForm" method="post">
		<div style="height:340px;">&nbsp;</div>
			<table style="text-align:left;height:80px;">
				<tr>
					<td style="color:#fff;font-weight:bold;">Tên đăng nhập: </td>
					<td><INPUT size=18 name="uid"></td>
				</tr>
				<tr>
					<td style="color:#fff;font-weight:bold;">Mật khẩu: </td>
					<td><INPUT type=password size=18 name="pass"><input type="hidden" name="hidden" value="login"></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:center"><INPUT type=submit value="Đăng nhập" name="submit"></td>
				</tr>
			</table>
		</form>
	</div>
</center>