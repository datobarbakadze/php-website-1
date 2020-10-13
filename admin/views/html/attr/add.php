<?php 
if (isset($_GET['thing']) && !empty($_GET['thing'])) {
	$empty = "";
	$thing = mysql_real_escape_string($_GET['thing']);
	if ($thing=="attr") {
			mysql_query("INSERT INTO attrs VALUES(
			'".$empty/* item_id */."',
			'".$empty/* title */."',
			'".$empty/* description */."'
			)") or die(mysql_error());
			header('Location: /admin/attr/update_attr/'.mysql_insert_id());
	}else if ($thing=="variant") {
		if ($_GET['attr_id']) {
			$attr_id = (int) mysql_real_escape_string($_GET['attr_id']);
		}else
			$attr_id = 1;
			
		mysql_query("INSERT INTO attrs_variants VALUES(
			'".$empty/* item_id */."',
			'$attr_id',
			'".$empty/* description */."',
			'".$empty/* description */."',
			'".$empty/* description */."'
			)") or die(mysql_error());
		header('Location: /admin/attr/update_variant/'.mysql_insert_id());
	}
}

 ?>