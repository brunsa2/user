<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8' />
		<script type='text/javascript' src='../admin/repository/jquery/jquery-1.3.2.dev.js'></script>
		<script type='text/javascript' src='scripts/login.js'></script>
		<title>Login</title>
	</head>
	<body>
		<form onsubmit='javascript: return 0;' name='loginForm'>
			<input name='username' placeholder='Username' />
			<br />
			<input type='password' name='password' placeholder='Password' />
			<br />
			<input type='button' onclick='javascript: login();' value='Login' />
		</form>
		<div id='userInformation'>
			<p>
<?php

if(isset($_SESSION['logged-in']) && $_SESSION['logged-in'] == true) {
	echo $_SESSION['name'];
} else {
	echo 'You are not logged in';
}

?>
			</p>
		</div>
	</body>
</html>