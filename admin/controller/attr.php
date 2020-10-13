<?php 

/**
 * 
 */
class attr{
	public function id(){
        $url = mysql_real_escape_string($_GET['aurl']);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $id = $url[2];
        return $id;
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
	    			$get_any_single_arr = $get_any_single_fetch;
	    		}

    		return $get_any_single_arr;
    }

}
 ?>