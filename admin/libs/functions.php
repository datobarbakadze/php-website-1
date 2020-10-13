<?php 

	function get_items($table){
		$query = mysql_query("SELECT * FROM ".$table."") or die("Can't connect");
		$arr = [];
		while($fetch = mysql_fetch_array($query)){
			array_push($arr, $fetch);
		}
		return $arr;
	}

 ?>
