<?php
require('../includes/init.php');
include('chatFunctions.php');
if(check_login()==true) {
	
	$username = get_username();
	$enroll = get_enroll();
	$action = $_POST['action'];
		
	if(isset($_POST['roll']))
		$to_roll = mysql_real_escape_string($_POST['roll']);	

	if($action=="startChatSession") {
		startChatSession($to_roll,$enroll);
	}
	else
	if($action=="sendChat") {
		$msg = $_POST['msg'];
		$to_user = mysql_real_escape_string($_POST['name']);
		$t = time()-3;
		$sql = "SELECT NULL FROM stud_data WHERE usr_roll=".$to_roll." AND time>=".$t;
		$result = mysql_query($sql);
		$count = mysql_num_rows($result);
		if($count==1)
			sendChat($to_roll,$to_user,$msg,$enroll,$username);
		else 
		echo "<root success='no'><user>".$to_user."</user></root>";
	}
	else
	if($action=="getChat") {
		getChat($to_roll,$enroll);
	}
	else
	if($action=="setWritingStatus") 
		setWritingStatus($enroll,"yes");
	else
	if($action=="checkMyOnlineStatus")
		checkMyOnlineStatus($enroll);
	else
	if($action=="setOnlineStatus") {
		$status=mysql_real_escape_string($_POST['status']);
		setOnlineStatus($enroll,$status);
	}
	else
	if($action=="popUpChat") {
		popUpChat($enroll);
	}	
}	
?>
