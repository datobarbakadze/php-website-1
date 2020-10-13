<?php 
/**
 * 
 */
class search
{
	 public function get_max_dur(){
    	$rowSQL = mysql_query( "SELECT MAX( duration_day ) AS max FROM tour ");
		$row = mysql_fetch_array( $rowSQL );
		$largestNumber = $row['max'];
		return $largestNumber;
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

	
	public function get_search()
	{
		if (isset($_GET['type']) || $_GET['type']=="tour" || $_GET['type']=="transfer") {
			$type=mysql_real_escape_string($_GET['type']);
			$dur = mysql_real_escape_string($_GET['duration']);
			$cat = (int) mysql_real_escape_string($_GET['category']);

			if (empty($cat)) {
				die("Nothing was found");
			}else
				$cat_string = "WHERE cat_id='$cat'";

			$cat_query = mysql_query("SELECT * FROM tour_category $cat_string") or die(mysql_error());
			while ($cat_fetch = mysql_fetch_array($cat_query)) {
				$tour_id = $cat_fetch['tour_id'];
				$query = mysql_query("SELECT * FROM tour WHERE id='$tour_id'") or die(mysql_error());
				$fetch = mysql_fetch_array($query);
				if($fetch['duration_day']==$dur):
				if ($type=="tour") {
					$title = substr($fetch['top_title'],0,15);
	             $price = $fetch['cost'];
	            $description = substr($fetch['description'],0,188)."...";
	            $day = $fetch['duration_day'];
	            $hour = $fetch['duration_hr'];
	            $level = $fetch['level'];
	            $image = $fetch['thumb'];

	            $dashed_title = str_replace(' ', '-', $fetch['top_title']);
	            if ($day == 0) {
	               $duration = $hour." hour";
	            }elseif ($day!=0) {
	                $duration = $day." day ".$hour." hour";
	            }
	           
	                $lvl_query = mysql_query("SELECT * FROM level WHERE id='$level' order by id asc") or die(mysql_error());
	                $lvl_fetch = mysql_fetch_array($lvl_query);
	                $lvl = $lvl_fetch['name'];
	            echo "
	       			 <div class=\"col-md-4 col-sm-6 col-xs-12\">
	                        <div class=\"single-adventure\">
	                            <a href=\"#\"><img src=\"/tour_thumbs/$image\" alt=\"$title\"></a>
	                            <div class=\"adventure-text effect-bottom\">
	                                <div class=\"transparent-overlay\">
	                                    
	                                    <h4><a href=\"/".constant('tour')."/$dashed_title\">$title</a></h4>
	                                    <span class=\"trip-time\"><i class=\"fa fa-clock-o\"></i>$duration Trip</span>
	                                    <span class=\"trip-level\"><i class=\"fa fa-send-o\"></i>Level: $lvl</span>
	                                    <p>$description</p>
	                                </div>
	                                <div class=\"adventure-price-link\">
	                                    <span class=\"trip-price\">$price$</span>
	                                    <span class=\"trip-person\">Per Person</span>
	                                    <div class=\"adventure-link\">
	                                        <a href=\"#\"><i class=\"fa fa-facebook\"></i></a>
	                                        <a href=\"#\"><i class=\"fa fa-twitter\"></i></a>
	                                        <a href=\"#\"><i class=\"fa fa-google-plus\"></i></a>
	                                        <a href=\"#\"><i class=\"fa fa-linkedin\"></i></a>
	                                        <a href=\"#\"><i class=\"fa fa-rss\"></i></a>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>    
	        	";
				}elseif ($type=="transfer") {
					$title = substr($fetch['top_title'],0,15);
		            $big_title = $fetch['top_title'];
		             $price = $fetch['cost'];
		            $description = substr($fetch['description'],0,215)."...";
		            $day = $fetch['duration_day'];
		            $hour = $fetch['duration_hr'];
		            $level = $fetch['level'];
		            $image = $fetch['thumb'];
		            $id = $fetch['id'];
		            $dashed_title = str_replace(' ', '-', $fetch['top_title']);
		            if ($day == 0) {
		               $duration = $hour." hour";
		            }elseif ($day!=0) {
		                $duration = $day." day ".$hour." hour";
		            }
		           
		                $lvl_query = mysql_query("SELECT * FROM level WHERE id='$level' order by id asc") or die(mysql_error());
		                $lvl_fetch = mysql_fetch_array($lvl_query);
		                $lvl = $lvl_fetch['name'];
		                echo "
		                    <div class=\"col-md-12\">
		                        <div class=\"single-list-item\">
		                            <div class=\"row\">
		                                <div class=\"col-md-4 col-sm-5\">
		                                    <div class=\"adventure-img\">
		                                        <a href=\"/".constant('transfer')."/$dashed_title\"><img width=\"364px\" height=\"294px\" src=\"/tour_thumbs/$image\" alt=\"$big_title\"></a>
		                                    </div>
		                                </div>
		                                <div class=\"col-md-8 col-sm-7 margin-left-list\">
		                                    <div class=\"adventure-list-container\">
		                                        <div class=\"adventure-list-text\">
		                                            <h1><a href=\"/".constant('transfer')."/$dashed_title\">$title  <span class='light'>/ $duration Trip</span></a></h1>
		                                            <h2>From: <span style=\"color:#ffb400\">$$price</span></h2>
		                                            <p>$description </p>
		                                            <div class=\"list-buttons\">
		                                                <a href=\"/".constant('transfer')."/$dashed_title\" class=\"button-one button-blue\">Learn More</a>
		                                                <div class=\"adventure-list-link\">
		                                                    <a href=\"#\"><i class=\"fa fa-facebook\"></i></a>
		                                                    <a href=\"#\"><i class=\"fa fa-twitter\"></i></a>
		                                                    <a href=\"#\"><i class=\"fa fa-google-plus\"></i></a>
		                                                    <a href=\"#\"><i class=\"fa fa-linkedin\"></i></a>
		                                                    <a href=\"#\"><i class=\"fa fa-rss\"></i></a>
		                                                </div>
		                                            </div>
		                                        </div>
		                                        <div class=\"adventure-list-image\">
		                                            <div class=\"image-top\">
		                                                <img src=\"/views/img/icon/level.png\" alt=\"\">
		                                            </div>
		                                            <h2>Easy level</h2>
		                                            <ul class=\"image-bottom\">";
		                                                $ac_query = mysql_query("SELECT * FROM activity_inclusion WHERE type='a' AND tour_id='$id' LIMIT 6") or die("Can;t connect");
		                                                while ($ac_fetch = mysql_fetch_array($ac_query)) {
		                                                    $ac_id = $ac_fetch['action_id'];
		                                                    $grab_query = mysql_query("SELECT * FROM activities WHERE id='$ac_id'") or die("Can't connect");
		                                                    $grab_fetch = mysql_fetch_array($grab_query);
		                                                    $image = $grab_fetch['icon'];
		                                                    $name = $grab_fetch['value'];
		                                                    echo "<li><img src=\"/images_inclusion/$image\" alt=\"$name\"></li>";
		                                                }
		                                            echo "</ul>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                ";
				}
				endif;
			}

		}else
			echo "Nothing was found";
	}
}
 ?>