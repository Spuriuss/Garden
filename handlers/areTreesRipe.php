<?php
date_default_timezone_set("Europe/Moscow");

$db_host = 'localhost';
	$db_user = 'root';
	$db_password = '';
	$db_name = 'farm';
	$connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
$connection->set_charset("utf8");	


$request = "SELECT * FROM john_trees";
$response = mysqli_query($connection, $request) or die(mysqli_error($connection));

$treesCounter = 0;
while ($b = mysqli_fetch_assoc($response)) {$allTrees[] = $b; $treesCounter++;}


for ($i = 0; $i < $treesCounter; $i++) {
	if ((time() - strtotime($allTrees[$i]['lastHarvested'])) > 30 && $allTrees[$i]['treeStatus'] == 'harvested') {
		$thisTreeid = $allTrees[$i]['id'];
		$request = "UPDATE john_trees SET treeStatus='ripe' WHERE id='$thisTreeid'";
		mysqli_query($connection, $request) or die(mysqli_error($connection));
		
		echo $thisTreeid, '_';
	}
}
?>