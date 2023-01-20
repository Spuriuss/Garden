<?php

$treeType = $_POST['treeType'];
$currentTreeAmount = $_POST['currentTreeAmount'];
$currentFertilizerAmount = $_POST['currentFertilizerAmount'];

$db_host = 'localhost';
	$db_user = 'root';
	$db_password = '';
	$db_name = 'farm';
	$connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
$connection->set_charset("utf8");


$request = "INSERT INTO john_trees (treeType, treeStatus) VALUES ('$treeType', 'harvested')";
mysqli_query($connection, $request) or die(mysqli_error($connection));

$treeColumnName = strtolower($treeType) . 'Trees';
$request = "UPDATE farmers SET $treeColumnName='$currentTreeAmount', fertilizer='$currentFertilizerAmount' WHERE name='John'";
mysqli_query($connection, $request) or die(mysqli_error($connection));


$request = "SELECT id FROM john_trees";
$response = mysqli_query($connection, $request) or die(mysqli_error($connection));
$treesCounter = 0;
while ($b = mysqli_fetch_assoc($response)) {$allTrees[] = $b; $treesCounter++;}
echo $allTrees[$treesCounter-1]['id'];
?>