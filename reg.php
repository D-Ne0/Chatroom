<?php
$err = $_GET['err'];
$err_msg = "";
if($err!="") {
	switch($err) {
		case 0: $err_msg = "Incomplete form";
			break;
		case 1: $err_msg = "Passwords donot match";
			break;
		case 2: $err_msg = "Already registered or try different username";
			break;
		default:$err_msg = "";
			break;
	}
}
?>
<html>
<body>
	<table>
		<form action='submit.php' method="POST" >
		<tr>
			<td>Username: </td><td><input type='text' name='user' /></td>
		</tr>
		<tr>
			<td>Enrollment no: </td><td><input type='text' name='enroll' /></td>	
		</tr>
		<tr>
			<td>Password: </td><td><input type='password' name='pass' /></td>
		</tr>
		<tr>
			<td>Re-Password: </td><td><input type='password' name='re-pass' /></td>
		</tr>
		<tr>
			<td></td><td><input type='submit' value='Register' /> or  <a href = 'index.php' >Login</a></td>
		</tr>
		<tr>
			<td></td><td><span id='err_submit' style='color:red; font-size:12px;'><?php echo $err_msg; ?></span></td>
		</tr>
		</form>
	</table>
</body>
</html>
