<?php
require('../config.php');

if(isset($_COOKIE['session_id'])) {
	$session_id = $_COOKIE['session_id'];
	$sql = "SELECT null from online WHERE session_id='".$session_id."' LIMIT 1";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	if($count==1)
	header('location:chat/chat.php');
}
?>

<html>
<body>
<table>
<tr>
<form action="login.php" method="POST" >
<td>Enrollment:</td> <td><input type="text" name="user"></td>
</tr>
<tr>
<td>Password:</td> <td><input type="password" name="pass"></td>
</tr>
<tr>
<td></td><td><input type="submit" name="login" value="login"></td>
</tr>
</form>
</table>
</body>
</html>
