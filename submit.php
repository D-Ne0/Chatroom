<?php
require('includes/config.php');

$user = $_POST['user'];
$enroll = $_POST['enroll'];
$pass = $_POST['pass'];
$re_pass = $_POST['re-pass'];

if($user=="" || $pass=="" || $re_pass == "" || $enroll == "" )
	header('location:reg.php?err=0');
//	echo $user." ".$pass." ".$re_pass
else
if($pass!=$re_pass)
	header('location:reg.php?err=1');
else {
	$sql = "SELECT null FROM stud_data WHERE usr_name='".$user."' OR usr_roll='".$enroll."'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	if($count>0)
		header('location:reg.php?err=2');
	else {
		$pass = md5("5".$pass."@"); 
		$sql = "INSERT INTO stud_data (usr_name,usr_roll,usr_pass) VALUES('".$user."','".$enroll."','".$pass."')";
		mysql_query($sql);
		echo "Registered Successfully, <a href='index.php'>Login</a>";
	}		
}
?>

