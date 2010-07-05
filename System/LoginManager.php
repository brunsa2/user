<?php

require_once('Database.php');

$operation = $_GET['operation'];

$database = new Database('localhost', 'default', 'default', 'user');

session_start();

if($operation == 'login') {
	$username = $_GET['username'];
	$password = $_GET['password'];

	$database->select('users', 'name', 'username=\'' . $username . '\' and password=sha1(\'' . $password . '\')');
	
	if(!$database->hasRow()) {
		echo 'No user';
	} else {
		$userInformation = $database->getRow();
		echo $userInformation['name'];
		
		$_SESSION['logged-in'] = true;
		$_SESSION['name'] = $userInformation['name'];
	}
} else if($operation == 'logout') {
	unset($_SESSION['logged-in']);
	unset($_SESSION['name']);
	session_destroy();
}

?>