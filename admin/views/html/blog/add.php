<?php 
$empty = "";
mysql_query("INSERT INTO blog VALUES(
	'".$empty/* item_id */."',
	'".$empty/* description */."',
	'".$empty/* description */."',
	'".$empty/* description */."',
	'".$empty/* description */."',
	'".$empty/* item_id */."',
	'".$empty/* description */."',
	NOW(),
	NOW(),
	'1'
	)") or die(mysql_error());
header('Location: /admin/blog/update/'.mysql_insert_id());
 ?>