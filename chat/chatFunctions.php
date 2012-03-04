<?php
function startChatSession($to_roll,$enroll) {
	
	$sql = "INSERT INTO chat_session (to_enroll,from_enroll) VALUES (".$to_roll.", ".$enroll.")";
	mysql_query($sql);
}

function checkMyOnlineStatus($enroll) {
	$sql = "SELECT online FROM stud_data WHERE usr_roll=".$enroll." LIMIT 1";
	$result = mysql_query($sql);
	while($row = mysql_fetch_assoc($result)) {
		echo "<root online='".$row['online']."'><roll>".$enroll."</roll></root>";
	}
}

function setOnlineStatus($enroll,$status) {
	$sql = "UPDATE stud_data SET online='".$status."' WHERE usr_roll=".$enroll;
	mysql_query($sql);
}

function sendChat($to_enroll,$to_user,$msg,$enroll,$username) {

	$t=time()-180;   // time to be used to check if the message can be concatinated.
	$i=0;
	$msg = htmlentities($msg);
	$msg = mysql_real_escape_string($msg); 	
	
	$sql = "SELECT null FROM stud_data WHERE usr_roll=".$enroll." AND online='yes' LIMIT 1";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	if($count==0)
		return;
	
	$sql = "SELECT from_enroll,msg_id  FROM chat_messages WHERE ((to_enroll='".$to_enroll."' AND from_enroll='".$enroll."') OR (to_enroll='".$enroll."' AND from_enroll='".$to_enroll."')) AND time>=".$t." ORDER BY msg_id DESC LIMIT 1";
        $result = mysql_query($sql);
        $count = 1; 
        while($row = mysql_fetch_assoc($result)) {
                if($row['from_enroll']==$enroll) {
                	$msg_id = $row['msg_id'];
                	$newmsg = "<br>".$msg;
	                $sql = "UPDATE chat_messages SET msg=concat(msg,'".$newmsg."') ,time=".time()." WHERE msg_id=".$msg_id."";
        	        mysql_query($sql);
		}
       		else { 
   		$chat_id = getLastChatId($to_enroll);
		$newsql = "INSERT INTO chat_messages (chat_id,to_enroll,to_user,from_enroll,from_user,msg,time) VALUES (".$chat_id.", ".$to_enroll.", '".$to_user."', ".$enroll.", '".$username."', '".$msg."', ".time().")";
		mysql_query($newsql);
		}
	$count=0;
	}
	if($count) {
		$chat_id = getLastChatId($to_enroll);
                $newsql = "INSERT INTO chat_messages (chat_id,to_enroll,to_user,from_enroll,from_user,msg,time) VALUES (".$chat_id.", ".$to_enroll.", '".$to_user."', ".$enroll.", '".$username."', '".$msg."', ".time().")";
                mysql_query($newsql);

	}

	setWritingStatus($enroll,"no");
	echo "<root success='yes'><user>".$to_user."</user></root>";	
}

function getChat($to_enroll,$enroll) {
	
	$index = 0;
	$t = time()-5;
	$sql = "SELECT writing FROM user_status WHERE enroll=".$to_enroll." AND time>=".$t;
	$result = mysql_query($sql);
	while($r = mysql_fetch_assoc($result)) {
		if($r['writing']=="yes")
			$status = "yes";
		else
			$status = "no";
	}
	
	$sql = "SELECT from_user,from_enroll,msg FROM chat_messages WHERE ((to_enroll='".$to_enroll."' AND from_enroll='".$enroll."') OR (to_enroll='".$enroll."' AND from_enroll='".$to_enroll."')) ORDER BY msg_id DESC LIMIT 20";
        $result = mysql_query($sql);
        $count = mysql_num_rows($result);
	echo "<root count='".$count."' status='".$status."'>";
        while($row = mysql_fetch_assoc($result)) {
		if($row['from_enroll']==$enroll)
		$row['from_user']="You";               
        	
		$msg = $row['msg'];
		$i=0;
		$msg = htmlentities($msg);
	        $smileys = array(":)",":-)",":p",":D",":O",":(","&lt;/3","&lt;3",";)","rofl");
        	$smileys_path = array("smile.png","regular_smile.gif","tongue_smile.gif","laugh.jpg","omg_smile.gif","sad.gif","broken_heart.gif","heart.gif","wink.png","rofl.gif");
        	$const_path = "../images/smileys/";
        	foreach($smileys as $val) {
                	$msg = str_ireplace($val,"&lt;img src='".$const_path.$smileys_path[$i]."' width='17' height='17' /&gt;",$msg);
                	$i++;
        	}

		echo "<messages><user>".$row['from_user']."</user><msg>".$msg."</msg></messages>";
	}
	echo "</root>";
}

function getLastChatId($to_enroll) {
	$sql = "SELECT chat_id FROM chat_session WHERE to_enroll=".$to_enroll." ORDER BY chat_id DESC LIMIT 1";
        $result = mysql_query($sql);
        while($row = mysql_fetch_assoc($result)) {
                $chat_id = $row['chat_id']; 
        }	
	
	return $chat_id;
}

function setWritingStatus($enroll,$s) {
	$sql = "SELECT NULL FROM user_status WHERE enroll='".$enroll."' LIMIT 1";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	if($count==1) {
		$sql = "UPDATE user_status SET writing='".$s."', time=".time()." WHERE enroll=".$enroll;
		mysql_query($sql);
	}
	else {
		$sql = "INSERT INTO user_status (enroll,writing,time) VALUES (".$enroll.", '".$s."', ".time().")";
		mysql_query($sql);
	}
}

function popUpChat($enroll) {
	$t = time()-3;
        $sql = "SELECT from_enroll,from_user,msg FROM chat_messages WHERE to_enroll=".$enroll." AND time>=".$t." ORDER BY msg_id DESC";
        $res = mysql_query($sql);
        $c = mysql_num_rows($res);
        echo "<root count='".$c."'>";
        while($r = mysql_fetch_assoc($res)) {
                echo "<users><name>".$r['from_user']."</name><roll>".$r['from_enroll']."</roll></users>";
        }
        echo "</root>";
}
?>
