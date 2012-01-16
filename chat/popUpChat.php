<?php
require('../../config.php');
header('Content-type: text/xml');
if(isset($_COOKIE['session_id'])) {

        $session_id = $_COOKIE['session_id'];

        $sql = "SELECT username,enroll FROM online WHERE session_id='".$session_id."' LIMIT 1";
        $result = mysql_query($sql);
        $count = mysql_num_rows($result);

        if($count>0) {
                while($row = mysql_fetch_assoc($result)) {
                $username = $row['username'];
                $enroll = $row['enroll'];
        //        echo $username." ".$enroll;
                }
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
	
}
?>
