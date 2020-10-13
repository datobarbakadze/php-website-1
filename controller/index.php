<?php 
/**
 * 
 */
class index
{
    
    function get_slider(){
        $query = mysql_query("SELECT * FROM slides WHERE published = 1 ORDER BY order_num ASC") OR die("Can't connect");
        $arr = [];
        while ($fetch = mysql_fetch_assoc($query)) {
            array_push($arr, $fetch);
        }
        return $arr;
    }

    function get_best_trips(){
        $best_query = mysql_query("SELECT * FROM best_tour") or die("Can't connect");
        $arr = [];
        while ($best_fetch = mysql_fetch_array($best_query)) {
            $id = $best_fetch['tour_id'];
            $query = mysql_query("SELECT * FROM tour WHERE id='$id' ORDER BY id DESC") or die("Can't connect");
            $fetch = mysql_fetch_assoc($query);
            array_push($arr, $fetch);
        }
        return $arr;
    }
    function cat_for_tour($tour_id){
        $tour_id = mysql_real_escape_string((int) $tour_id);
        $query = mysql_query("SELECT * FROM tour_to_cat WHERE tour_id='$tour_id'") or die("Can't connect");
        $fetch = mysql_fetch_array($query);
        $cat_id = $fetch['cat_id'];
        $catquery = mysql_query("SELECT * FROM category WHERE id='$cat_id' ") or die("Can't connect");
        $catfetch = mysql_fetch_assoc($catquery);
        return $catfetch;
    }
    function price_for_tour($tour_id){
        $query = mysql_query("SELECT MAX(price)  AS max_price, MAX(quantity) AS max_quantity FROM prices WHERE tour_id='$tour_id'") or die("Can't connect to prices");
        $fetch = mysql_fetch_array($query);
        $price = $fetch['max_price']/$fetch['max_quantity'];
        return round($price,0);
    }
    public function get_ribbon($tour_id){
        $query = mysql_query("SELECT ttr.*,tr.* FROM tour_to_ribons AS ttr LEFT JOIN tour_ribons AS tr ON tr.ribbon_id = ttr.ribbon_id  WHERE tour_id='$tour_id'") or die("Can't connect");
        if (mysql_num_rows($query)>0) {
            $fetch = mysql_fetch_array($query);
            return $fetch['ribbon_name'];
        }else
            return "none";
        
    }
    function get_latest_blogs(){
        $query = mysql_query("SELECT b.*, bi.image  FROM blog b LEFT JOIN blog_images bi ON b.id = bi.blog_id  ORDER BY create_date DESC LIMIT 2") or die("Can't connect");
        $arr = [];
        while ($fetch = mysql_fetch_assoc($query)) {
            array_push($arr, $fetch);
        }
        return $arr;
    }

    function get_team(){
    	$query = mysql_query("SELECT * FROM best_team") or die("Cna't connect");
        $arr = [];
        while ($fetch = mysql_fetch_array($query)) {
           $id = $fetch['team_id'];
           $team_query = mysql_query("SELECT * FROM team WHERE id='$id'") or die("Can't connect");
           $team_fetch = mysql_fetch_assoc($team_query);
           array_push($arr, $team_fetch);
        }
        return $arr;
    }

    public function get_info(){
        $query = mysql_query("SELECT * FROM fun_info") or die("Can't connect");
        $arr = [];
        while ($fetch = mysql_fetch_assoc($query)) {
            array_push($arr, $fetch);
        }
        return $arr;
    }

    public function get_category($string = false,$type=""){
        if ($string===true) {
            $type = mysql_real_escape_string($type);
           $where = "WHERE type='$type'";
        }elseif ($string===false) {
            $where = "";
        }
        $query = mysql_query("SELECT * FROM category $where LIMIT 6") or die("Can't connect");
        $arr = [];
        while ($fetch = mysql_fetch_assoc($query)) {
            array_push($arr, $fetch);
        }
        return $arr;
    }

    public function get_random_tours(){
        $query = mysql_query("SELECT * FROM tour WHERE type='tour' ORDER BY RAND() LIMIT 8") or die("Can't connect");
        $arr = [];
        while ($fetch = mysql_fetch_assoc($query)) {
            array_push($arr, $fetch);
        }
        return $arr;
    }
    public function get_reviews(){
        $query = mysql_query("SELECT * FROM reviews LIMIT 3") or die("Can't connect");
        $arr = [];
        while ($fetch = mysql_fetch_assoc($query)) {
            array_push($arr, $fetch);
        }
        return $arr;
    }
    public function get_level($Id){
        $query = mysql_query("SELECT * FROM level WHERE id='$Id'") or die("Can't connect");
        $fetch = mysql_fetch_array($query);
        echo $fetch['name'];
    }
    public function get_max_dur(){
    	$rowSQL = mysql_query( "SELECT MAX( duration_day ) AS max FROM tour ");
		$row = mysql_fetch_array( $rowSQL );
		$largestNumber = $row['max'];
		return $largestNumber;
    }

}
 ?>
 