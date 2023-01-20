<?php

$treeId = $_POST['treeId'];
$treeType = $_POST['treeType'];
$numberOfFruits = $_POST['numberOfFruits'];


$db_host = 'localhost';
	$db_user = 'root';
	$db_password = '';
	$db_name = 'farm';
	$connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
$connection->set_charset("utf8");


$request = "UPDATE john_trees SET treeStatus='harvested' WHERE id='$treeId'";
mysqli_query($connection, $request) or die(mysqli_error($connection));


$fruitColumnName = strtolower($treeType) . 's';
$request = "UPDATE farmers SET $fruitColumnName='$numberOfFruits' WHERE name='John'";
mysqli_query($connection, $request) or die(mysqli_error($connection));
?>