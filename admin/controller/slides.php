<?php 
/**
 * 
 */
class slides
{
	
	public function get_sliders()
	{
		$query = mysql_query("SELECT * FROM slides ORDER BY order_num ASC") or die("Can't connect");
		$arr = [];
		while ($fetch = mysql_fetch_assoc($query)) {
			array_push($arr, $fetch);
		}
		return $arr;
	}

	public function get_fields($param = ""){
		$url = mysql_real_escape_string($_GET['aurl']);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $id = (int) $url[2];
		$query = mysql_query("SELECT * FROM slides WHERE id='$id'") or die("Can't connect");
		return mysql_fetch_array($query)[$param];
	}
}

 ?>