<html>
<head>
<link rel='icon' type='image/x-icon' href='images/favicon.ico'>
<title>Оборотный сад</title>

<script type='text/javascript' src='js/extensions/jquery-3.4.1.js'></script>
<script type='text/javascript' src='js/extensions/jquery.cookie.js'></script>

<link rel=stylesheet type=text/css href=<?php echo "'css/main.css?version=", rand(), "'"; ?> />

<?php
$db_host = 'localhost';
	$db_user = 'root';
	$db_password = '';
	$db_name = 'farm';
	$connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
$connection->set_charset("utf8");

$request = "SELECT * FROM farmers WHERE name='John'";
$response = mysqli_query($connection, $request) or die(mysqli_error($connection));
$farmer = mysqli_fetch_assoc($response);

$request = "SELECT * FROM john_trees";
$response = mysqli_query($connection, $request) or die(mysqli_error($connection));
$treesCounter = 0;
while ($b = mysqli_fetch_assoc($response)) {$allTrees[] = $b; $treesCounter++;}
?>
</head>



<body>

<div id=top>
	<div id=left>
		<div id=fertilizerAmount style='padding-left: 7px';>
			Удобрения: 
			<div class=value>
				<?php echo $farmer['fertilizer']; ?>
			</div>
		</div>
		
		<br>
		
		<div id=numberOfPearTrees style='border: 3px solid rgb(227,208,119); border-radius: 15px; padding: 5px; margin-top: 5px;'>
			Грушевые деревья: 
			<div class=value>
				<?php echo $farmer['pearTrees']; ?>
			</div>
		</div>
		<div id=numberOfAppleTrees style='border: 3px solid rgb(176,56,54); border-radius: 15px; padding: 5px;'>
			Яблоневые деревья: 
			<div class=value>
				<?php echo $farmer['appleTrees']; ?>
			</div>
		</div>
		
		<br>
		
		<div class=plantButton data-treeType=Pear style='background: rgb(227,208,119)'>
			<div class=center>Посадить грушу</div>
		</div>

		<div class=plantButton data-treeType=Apple style='background: rgb(176,56,54)'>
			<div class=center>Посадить яблоко</div>
		</div>
	</div>
	
	
	<div id=right>
		<div id=money>
			Деньги: 
			<div class=value>
				<?php echo $farmer['money']; ?>
			</div>
		</div>
		
		<br>
		
		<div id=numberOfPears style='border: 3px solid rgb(227,208,119); border-radius: 15px; padding: 5px; margin-top: 5px;'>
			Груши: 
			<div class=value>
				<?php echo $farmer['pears']; ?>
			</div>
		</div>

		<div id=numberOfApples style='border: 3px solid rgb(176,56,54); border-radius: 15px; padding: 5px; margin-top: 5px;'>
			Яблоки:
			<div class=value>
				<?php echo $farmer['apples']; ?>
			</div>
		</div>
		
		<br>
		
		<div id=sellFruitsButton>
			<div class=center>Взвесить и продать</div>
		</div>
		
		<br>
		
		<div id=sellInfo>
		</div>
	</div>
</div>



<div id=garden>
<?php
	for ($i = 0; $i < $treesCounter; $i++) {
		echo "
		<div class=tree data-treeType=", $allTrees[$i]['treeType'], " data-state=", $allTrees[$i]['treeStatus'], " data-id=", $allTrees[$i]['id'], ">",
			"<div class=treeImage></div>",
			"<div class='", $allTrees[$i]['treeType'], "sImage fruits'"; if ($allTrees[$i]['treeStatus'] == 'harvested') {echo " style='display: none;'";} echo "></div>",
		"</div>";
	}

?>	
</div>
</body>


<script type='text/javascript' src=<?php echo "'js/main.js?version=", rand(), "'"; ?>></script>
</html>