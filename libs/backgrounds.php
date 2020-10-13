<?php 
/**
 * 
 */
class background
{
	
	public function bg($param=""){
		$query = mysql_query("SELECT * FROM background_images WHERE name='$param'") or die("Can't connect");
		$fetch = mysql_fetch_array($query);
		echo $fetch['image'];
	}
}

$bg = new background();
 ?>