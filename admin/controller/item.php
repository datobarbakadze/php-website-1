<?php 
/**
 * 
 */
class item
{
	
	public function id(){
        $url = mysql_real_escape_string($_GET['aurl']);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $id = $url[2];
        return $id;
    }

    public function get(){
    	$query = mysql_query("SELECT * FROM item WHERE item_id = ".$this->id()."") or die("Can't connect");
		$arr = [];
		while($fetch = mysql_fetch_assoc($query)){
			$arr = $fetch;
		}
		return $arr;
    }

    public function getAny($table){
    	$any_arr = [];
    	$any_query = mysql_query("SELECT * FROM ".$table."") or die("Can't connect");
    	while ($any_fetch = mysql_fetch_assoc($any_query)) {
    		array_push($any_arr, $any_fetch);
    	}
    	return $any_arr;
    }


    public function getAnySingle($table, $column, $single_id){
    			$get_any_single_arr = [];
	    		$get_any_single_query = mysql_query("SELECT * FROM ".$table." WHERE ".$column."='".$single_id."'") or die("Can't connect");
	    		while ($get_any_single_fetch = mysql_fetch_assoc($get_any_single_query)) {
	    			array_push($get_any_single_arr, $get_any_single_fetch);
	    		}

    		return $get_any_single_arr;
    }

   public function getGallery($item_id){
        $any_arr = [];
        $any_query = mysql_query("SELECT * FROM item_gallery WHERE item_id='$item_id'") or die("Can't connect");
        while ($any_fetch = mysql_fetch_assoc($any_query)) {
            array_push($any_arr, $any_fetch);
        }
        return $any_arr;
   }

    public function item_variant(){
    	$iVariant_query = mysql_query("SELECT * FROM item_variants WHERE item_id='".$this->id()."'") or die("Can't connect");
    	$string = "";
    	while ($iVariant_fetch = mysql_fetch_array($iVariant_query)) {
    		$attr_id = $iVariant_fetch['attr_id'];
    		$variant_id = $iVariant_fetch['variant_id'];
    		$string.=$attr_id."-".$variant_id.",";
    	}
    	return preg_replace('/,$|^,/i', '', $string);
    }

    public function variant_active($variant_id){
    	$active_attr_query = mysql_query("SELECT * FROM item_variants WHERE item_id='".$this->id()."' AND variant_id='$variant_id'") or die("Can't connect");
    	return mysql_num_rows($active_attr_query);
    }
}
 ?>