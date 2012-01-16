<?php
require('../../config.php');
include('chatFunctions.php');
if(isset($_COOKIE['session_id'])) {

        $session_id = $_COOKIE['session_id'];

        $sql = "SELECT username,enroll FROM online WHERE session_id='".$session_id."' LIMIT 1";
        $result = mysql_query($sql);
        $count = mysql_num_rows($result);

        if($count>0) {
                while($row = mysql_fetch_assoc($result)) {
                $username = $row['username'];
                $enroll = $row['enroll'];
                //echo $username." ".$enroll;
                }

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
			$sql = "SELECT NULL FROM online WHERE enroll=".$to_roll." AND time>=".$t;
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
	}
}	
?>
