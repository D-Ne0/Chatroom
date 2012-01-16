<?php
require('../../config.php');
if(isset($_COOKIE['session_id'])) {
	
	$session_id = $_COOKIE['session_id'];
	
	$sql = "SELECT username,enroll FROM online WHERE session_id='".$session_id."' LIMIT 1";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	if($count>0) {
		while($row = mysql_fetch_assoc($result)) {
		$username = $row['username'];
		$enroll = $row['enroll'];
		echo "Welcome ".$username.", <a href='../logout.php'>Logout</a>";
		}
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="chat.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="chat.js"></script>
<title>Chatroom</title>
</head>
<body>
	<div id="online_box" class="online">
		
		<div id="online_title_box" class="online" >
			<div id="online_title" onClick="goOnline()">Who's Online</div>
			<div id="min" class="opt" onClick="goOffline()" title="Go offline">-</div>
		</div>
		
		<div id="online_users_box" class="online">
		</div>
 			
		<div id="online_search_box" class="online" >
			<input type="text" name="user_search" value="Search" onKeyDown="searchUsersOnline()"/>
		</div>
	</div>
	
	<div id='chatbox'>
	</div>
</body>
</html>
<?php

	}

	else
	header('Location: ../index.php');
}
else
header('Location: ../index.php');
?>
