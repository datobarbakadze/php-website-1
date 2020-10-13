<?php 
/**
 * 
 */
class category
{
	public function checker(){
		if(isset($_GET['url'])){
	        $url = mysql_real_escape_string($_GET['url']);
	        $url = rtrim($url, '/');
	        $url = explode('/', $url);
	            if(!isset($url[1])){
	                header('Location: /'.constant('error'));
	            }
        }
	}
	public function get_tour_by_category(){

		$url = mysql_real_escape_string($_GET['url']);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $cat = $url[1];
        $arr = [];
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }else{
            $page = 1;
        }  
        $begin = ($page-1) * constant('per_page_tour');
		$query = mysql_query("SELECT * FROM category WHERE name='$cat'") or die("Can't connect");
		$fetch = mysql_fetch_array($query);
		$type = $fetch['type'];
		$id = $fetch['id'];
			$cat_tour = mysql_query("SELECT * FROM tour_category WHERE cat_id='$id' ORDER BY tour_id DESC LIMIT ".constant('per_page_tour')." OFFSET $begin") or die("Can't connect");
		
		while ($cat_fetch = mysql_fetch_array($cat_tour)) {
			$tour_id = $cat_fetch['tour_id'];
			$tour_query	= mysql_query("SELECT * FROM tour WHERE id='$tour_id'") or die("Can't connect");
			$tour_fetch = mysql_fetch_assoc($tour_query);
			 $title = substr($tour_fetch['top_title'],0,15);
             $price = $tour_fetch['cost'];
            $description = substr($tour_fetch['description'],0,188)."...";
            $day = $tour_fetch['duration_day'];
            $hour = $tour_fetch['duration_hr'];
            $level = $tour_fetch['level'];
            $image = $tour_fetch['thumb'];
            $dashed_title = str_replace(' ', '-', $tour_fetch['top_title']);
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
                                
                                <h4><a href=\"/tours-in-georgia/$dashed_title\">$title</a></h4>
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
		}
	}
    public function category_exists(){
        $url = mysql_real_escape_string($_GET['url']);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $cat = $url[1];
        $query = mysql_query("SELECT * FROM category WHERE name='$cat'") or die("Can't connect");
        if (mysql_num_rows($query)==0) {
            header('Location: /'.constant('error'));
        }
    }
    public function get_cat_type(){
        $url = mysql_real_escape_string($_GET['url']);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $cat = $url[1];
        $query = mysql_query("SELECT * FROM category WHERE name='$cat'") or die("Can't connect");
        $fetch = mysql_fetch_array($query);
        if ($fetch['type']=="tour") {
            return 0;
        }elseif ($fetch['type']=="transfer") {
            return 1;
        }

    }
    public function get_transfer(){
        $url = mysql_real_escape_string($_GET['url']);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $cat = $url[1];
        $arr = [];
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }else{
            $page = 1;
        }  
        $begin = ($page-1) * constant('per_page_tour');
        $query = mysql_query("SELECT * FROM category WHERE name='$cat'") or die("Can't connect");
        $fetch = mysql_fetch_array($query);
        $type = $fetch['type'];
        $id = $fetch['id'];
            $cat_tour = mysql_query("SELECT * FROM tour_category WHERE cat_id='$id' ORDER BY tour_id DESC LIMIT ".constant('per_page_tour')." OFFSET $begin") or die("Can't connect");
        
        while ($cat_fetch = mysql_fetch_array($cat_tour)) {

            $tour_id = $cat_fetch['tour_id'];
            $query = mysql_query("SELECT * FROM tour WHERE id='$tour_id'") or die("Can't connect");
            $fetch = mysql_fetch_assoc($query);
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
    }
    public function pagination(){
        $url = mysql_real_escape_string($_GET['url']);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $cat = $url[1];
        $arr = [];
        $query = mysql_query("SELECT * FROM category WHERE name='$cat'") or die("Can't connect");
        $fetch = mysql_fetch_array($query);
        $type = $fetch['type'];
        $id = $fetch['id'];
            $cat_tour = mysql_query("SELECT * FROM tour_category WHERE cat_id='$id'") or die("Can't connect");
        $num = mysql_num_rows($cat_tour);
        $page_quanitity = ceil( $num / constant('per_page_tour'));

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }else{
            $page = 1;
        }  

            //show left_arrow
            if ($page!=1) {
                    echo " <li><a href=\"/".$url[0]."/".$url[1]."/?page=".($page-1)."\"><i class=\"fa fa-angle-left\"></i></a></li>";
            }
                for ($i=1; $i <= $page_quanitity; $i++) {

                    if($page == $i){
                        echo  "<li class=\"current\"><a >$i</a></li>";
                    }else{
                        echo "<li><a href=\"/".$url[0]."/".$url[1]."/?page=".$i."\">$i</a></li>";
                    }
                        
                }


            //show right arrow
             if ($page!=$page_quanitity) {
                    echo "<li><a href=\"/".$url[0]."/".$url[1]."/?page=".($page+1)."\"><i class=\"fa fa-angle-right\"></i></a></li>"; 
            }
    }
}
 ?>