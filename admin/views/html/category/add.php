<?php 
$empty = "";
mysql_query("INSERT INTO category VALUES(
	'".$empty/* item_id */."',
	'".$empty/* description */."',
	'".$empty/* description */."',
	'".$empty/* description */."'
	)") or die("Can't connect");
header('Location: /admin/category/update/'.mysql_insert_id());
 ?>