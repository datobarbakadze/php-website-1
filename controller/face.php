<?php 
/**
* 
*/
class face
{
	
	function get_num(){
		$query	= mysql_query("SELECT * FROM prices WHERE tour_id=3") or die("Can't connect");
		$nums = mysql_num_rows($query);
		echo $nums;
	}
}
$face = new face();

 ?>

 <div class="container" style="padding:200px 0px;">
 	<input type="number" name="q_man" value="1" min="1" max="<?php $face->get_num(); ?>">
 	<div class="calc_price"></div>
 </div>