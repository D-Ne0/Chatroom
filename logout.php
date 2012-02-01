<?php
include('includes/config.php');
if(isset($_COOKIE['session_id'])) {
	$session_id = $_COOKIE['session_id'];
	$sql = "DELETE FROM online WHERE session_id='".$session_id."'";
	mysql_query($sql);
	setcookie("session_id",$session_id,time());
	header('location:index.php');

} else
	header('location:index.php');
?>
