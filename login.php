<?php
require('../config.php');

function back_to_login() {
	header('Location: index.php');
}

function generate_session_id() {

	$session_id="";
	$char = array ("a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z",
			"A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z",
			"0","1","2","3","4","5","6","7","8","9");
	for($i=0;$i<20;$i++)
	$session_id.=$char[mt_rand(0,61)];
	
	$sql = "SELECT null FROM online WHERE session_id='".$session_id."'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	if($count>0) 
		generate_session_id();
	else
	return $session_id;	
	
}

function send_to_chat() {
	header('Location: chat/chat.php');
}

if(isset($_POST['user']) && $_POST['user']!="" && isset($_POST['pass'])&& $_POST['pass']!="") {
	
	$enroll = $_POST['user'];
	$password = $_POST['pass'];
	$password = md5("5".$password."@");

	$sql = "SELECT usr_name FROM stud_data WHERE usr_roll='".$enroll."' AND usr_pass='".$password."' LIMIT 1";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
//	echo $count;
	if($count==0) 
	back_to_login();
	while($row = mysql_fetch_assoc($result)) {
	
//	echo "helli";	
		$newsql = "SELECT session_id FROM online WHERE enroll=".$enroll;
		$newresult = mysql_query($newsql);
		$newcount = mysql_num_rows($newresult);
		if($newcount>0) {
			while($newrow = mysql_fetch_assoc($newresult)) {
			$sql = "DELETE FROM online WHERE session_id='".$newrow['session_id']."'";
			mysql_query($sql); 
//			echo "hello";	
			}	
		} 
	
		$session_id = generate_session_id();
		$username = $row['usr_name'];
		$curr_time = time();
		$sql = "INSERT INTO online (session_id, username, enroll, time) VALUES ('".$session_id."', '".$username."', ".$enroll.", ".$curr_time.")";
		mysql_query($sql);
		setcookie("session_id",$session_id,$curr_time+60*60*24*3);
		send_to_chat();
	}

}
else
back_to_login();
?>
