<?php 
/**
* 
*/
class transfer
{
    function check_it()
    {
        if(isset($_GET['url'])){
        $url = mysql_real_escape_string($_GET['url']);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
            if(isset($url[0]) && !isset($url[1])){
                $checker=0;
            }elseif (isset($url[1])) {
                $checker = 1;
            }

            return $checker;
        }
    }

    public function get_transfer(){
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }else{
            $page = 1;
        }  
        $begin = ($page-1) * constant('per_page_tour');
        $query = mysql_query("SELECT * FROM tour WHERE type='transfer' ORDER BY id DESC LIMIT ".constant('per_page_tour')." OFFSET $begin") or die(mysql_error());
        while ($fetch = mysql_fetch_array($query)) {
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
        $query = mysql_query("SELECT * FROM tour WHERE type='transfer' ORDER BY id DESC") or die("can't connect");
        $num = mysql_num_rows($query);
        $page_quanitity = ceil( $num / constant('per_page_tour'));

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }else{
            $page = 1;
        }  

            //show left_arrow
            if ($page!=1) {
                    echo " <li><a href=\"/".$url[0]."/?page=".($page-1)."\"><i class=\"fa fa-angle-left\"></i></a></li>";
            }
                for ($i=1; $i <= $page_quanitity; $i++) {

                    if($page == $i){
                        echo  "<li class=\"current\"><a >$i</a></li>";
                    }else{
                        echo "<li><a href=\"/".$url[0]."/?page=".$i."\">$i</a></li>";
                    }
                        
                }


            //show right arrow
             if ($page!=$page_quanitity) {
                    echo "<li><a href=\"/".$url[0]."/?page=".($page+1)."\"><i class=\"fa fa-angle-right\"></i></a></li>"; 
            }
    }
    public function transfer_exists(){

        $url = mysql_real_escape_string($_GET['url']);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $title = $url[1];
        $spaced_title = str_replace('-', ' ', $title);
        $query = mysql_query("SELECT * FROM tour WHERE top_title = '$spaced_title' AND type='transfer'") or die("Can't connsssect");
        $num = mysql_num_rows($query);
        if($num==0){
            echo "<script> window.location = '/'</script>";
        }
    }
        public function get_tour_fields($param=""){
        $url = mysql_real_escape_string($_GET['url']);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        
        $title = $url[1];
        $spaced_title = str_replace('-', ' ', $title);
        $query = mysql_query("SELECT * FROM tour WHERE top_title = '$spaced_title'") or die("Can't ssss");
        
            $fetch = mysql_fetch_array($query);
            if ($param=="duration_day" || $param=="duration_hr") {
                return $fetch[$param];
            }else{
                 echo $fetch[$param];
            }
           
    }

    public function get_activities(){
        $url = mysql_real_escape_string($_GET['url']);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $title = $url[1];
        $spaced_title = str_replace('-', ' ', $title);
        $query = mysql_query("SELECT * FROM tour WHERE top_title = '$spaced_title'") or die("Can't conwwnect");
        $fetch = mysql_fetch_array($query);
        $id = $fetch['id'];
        echo $id;
        $activity_query = mysql_query("SELECT * FROM activity_inclusion WHERE tour_id='$id' AND type='a'") or die("Can't connect");
        if (mysql_num_rows($activity_query)==0) {
            echo "<i style='font-size:70px;color:#91837e;' class=\"fa fa-times-circle\"></i>";
        }else{
            while ($activity_fetch = mysql_fetch_array($activity_query)) {
               $action_id = $activity_fetch['action_id'];
               $ac_query = mysql_query("SELECT * FROM activities WHERE id='$action_id'") or die("Can't connect");
               $ac_fetch  = mysql_fetch_array($ac_query);
               $name = $ac_fetch['name'];
               $icon = $ac_fetch['icon'];
               echo "
                    <div class=\"single-trip-content\">
                        <div class=\"trip-icon\">
                            <img src=\"/images_inclusion/$icon\" alt=\"$name\">
                        </div>
                        <h4>$name</h4>
                    </div> 
                ";
            }
        }
    }

    public function get_inclusions(){
        $url = mysql_real_escape_string($_GET['url']);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $title = $url[1];
        $spaced_title = str_replace('-', ' ', $title);
        $query = mysql_query("SELECT * FROM tour WHERE top_title = '$spaced_title'") or die("Can't conwwnect");
        $fetch = mysql_fetch_array($query);
        $id = $fetch['id'];
        $activity_query = mysql_query("SELECT * FROM activity_inclusion WHERE tour_id='$id' AND type='i'") or die("Can't connect");
        if (mysql_num_rows($activity_query)==0) {
            echo "There are no activities added";
        }else{
            while ($activity_fetch = mysql_fetch_array($activity_query)) {
               $action_id = $activity_fetch['action_id'];
               $ac_query = mysql_query("SELECT * FROM inclusions WHERE id='$action_id'") or die("Can't connect");
               $ac_fetch  = mysql_fetch_array($ac_query);
               $name = $ac_fetch['name'];
               $value= $ac_fetch['value'];
               $icon = $ac_fetch['icon'];
               $white_icon = $ac_fetch['icon_white'];
               echo "
                    <div class=\"col-md-4 col-sm-6\">
                        <div class=\"include-item\">
                            <div class=\"include-icon\">
                                <img src=\"/images_inclusion/$icon\" class=\"normal_image\" width=\"35px\" class=\"\" height=\"auto\">
                                
                                <img src=\"/images_inclusion/$white_icon\" class=\"white_image\" width=\"35px\" class=\"\" height=\"auto\">
                            </div>
                            <div class=\"include-text\">
                                <h4>$name</h4>
                                <p>$value</p>
                            </div>
                        </div>
                    </div> 
                ";
            }
        }
       
    }

    public function get_level(){
        $url = mysql_real_escape_string($_GET['url']);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $title = $url[1];
        $spaced_title = str_replace('-', ' ', $title);
        $query = mysql_query("SELECT * FROM tour WHERE top_title = '$spaced_title'") or die("Can't connect");
        $fetch = mysql_fetch_array($query);
        $level = $fetch['level'];


        $level_query = mysql_query("SELECT * FROM level order by id asc") or die("Can't connect");
        while ($level_fetch = mysql_fetch_array($level_query)) {
            $name = $level_fetch['name'];
            $id = $level_fetch['id'];
            $active_image = $level_fetch['active_image'];
            $image = $level_fetch['image'];

            if ($id==$level) {
               echo "
                    <div class=\"trip-level-content\">
                        <img src=\"/views/img/icon/$active_image\" alt=\"$name\">
                        <h4 style='color:#ffb400;'>$name</h4>
                    </div>
                ";
            }else{
                echo "
                    <div class=\"trip-level-content\">
                        <img src=\"/views/img/icon/$image\" alt=\"$name\">
                        <h4>$name</h4>
                    </div>
                ";
            }
            
        }
        
    }

}
 ?>
