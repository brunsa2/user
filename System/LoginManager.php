<?php

require_once('Database.php');

$operation = $_GET['operation'];
$username = $_GET['username'];
$password = $_GET['password'];

$database = new Database('localhost', 'default', 'default', 'user');

session_start();

if($operation == 'login') {

	$database->select('users', 'name', 'username=\'' . $username . '\' and password=sha1(\'' . $password . '\')');
	
	if(!$database->hasRow()) {
		echo 'No user';
	} else {
		$userInformation = $database->getRow();
		echo $userInformation['name'];
		
		$_SESSION['logged-in'] = true;
		$_SESSION['name'] = $userInformation['name'];
	}
}

?>