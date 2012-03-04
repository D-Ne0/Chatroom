<?php
require('../includes/init.php');
if(!check_login())
	header('location: ../index.php');
else {
	$username = get_username();
	$enroll = get_enroll();
	echo "Welcome ".$username.", <a href='../logout.php'>Logout</a>";
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="chat.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="chat.js"></script>
<title>Chatroom</title>
</head>
<body>
	<div id="online_box" class="online">
		<audio controls="controls" style="display:none;" id="soundHandle"></audio>  <!--this tag is for chat sound	-->
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
?>
