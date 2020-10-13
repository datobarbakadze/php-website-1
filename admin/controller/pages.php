<?php 
/**
* 
*/
class pages
{
	
	function get_pages()
	{
		$query = mysql_query("SELECT * FROM pages") or die("Can't connect");
		$arr = [];
		while($fetch = mysql_fetch_array($query)){
			array_push($arr, $fetch);
		}
		return $arr;
	}

}
 ?>