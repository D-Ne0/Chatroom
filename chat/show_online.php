<?php
require('../includes/config.php');
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
	$search = $_POST['search'];
	$sql = "UPDATE online SET time=".time()." WHERE session_id='".$session_id."' AND enroll=".$enroll;
	mysql_query($sql);
	
	$time = time()-3;
	if($search=="")
	$sql = "SELECT username, enroll FROM online WHERE time>=".$time." AND enroll<>".$enroll." AND online='yes'";
	else
	$sql = "SELECT username, enroll FROM online WHERE time>=".$time." AND enroll<>".$enroll." AND online='yes' AND UCASE(username) LIKE'%".strtoupper($search)."%'";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
		if($count>0) {
			while($row = mysql_fetch_assoc($result)) {
			echo "<div id='user' onclick='javascript:chatWith(&#39;".$row['username']."&#39;,".$row['enroll'].")'>".$row['username']."</div>";
			}
		}
	}
	else
		echo "<div class='err_msg'>Invalid Username/Password</div>";
}
else
echo "<div class='err_msg'>Session expired, please <a href='../'>login </a>again</div>";
?>
