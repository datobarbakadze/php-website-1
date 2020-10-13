<?php 
/**
* 
*/
class about
{
	
	function get_team(){
    	$team_query = mysql_query("SELECT * FROM team") or die("Can't connect");
        $arr = [];
        while ($fetch = mysql_fetch_assoc($team_query)) {
           array_push($arr, $fetch);
        }
        return $arr;
    }

    function get_category(){
    	$team_query = mysql_query("SELECT * FROM category LIMIT 9") or die("Can't connect");
        $arr = [];
        while ($fetch = mysql_fetch_assoc($team_query)) {
           array_push($arr, $fetch);
        }
        return $arr;
    }

    function get_faq(){
        $query = mysql_query("SELECT * FROM faq") or die("Can't connect");
        $arr = [];
        while ($fetch = mysql_fetch_assoc($query)) {
           array_push($arr, $fetch);
        }
        return $arr;
    }
}
 ?>
