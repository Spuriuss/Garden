<?php

$money = $_POST['money'];


$db_host = 'localhost';
	$db_user = 'root';
	$db_password = '';
	$db_name = 'farm';
	$connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
$connection->set_charset("utf8");



$request = "UPDATE farmers SET pears='0', apples='0', money='$money' WHERE name='John'";
mysqli_query($connection, $request) or die(mysqli_error($connection));






















?>