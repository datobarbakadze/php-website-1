<?php 
/**
* 
*/
class tour
{
	public function id(){
        $url = mysql_real_escape_string($_GET['url']);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $title = $url[1];
        $spaced_title = str_replace('-', ' ', $title);
        $query = mysql_query("SELECT * FROM tour where title='$spaced_title'") or die("Cna't connectsssss");
        $fetch = mysql_fetch_array($query);
        return $fetch['id'];
    }
    public function check_it()
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

    public function get_ribbon($tour_id){
        $query = mysql_query("SELECT ttr.*,tr.* FROM tour_to_ribons AS ttr LEFT JOIN tour_ribons AS tr ON tr.ribbon_id = ttr.ribbon_id  WHERE tour_id='$tour_id'") or die("Can't connect");
        if (mysql_num_rows($query)>0) {
            $fetch = mysql_fetch_array($query);
            return $fetch['ribbon_name'];
        }else
            return "none";
        
    }
    public function get_tour(){

        //pagees
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }else{
            $page = 1;
        }  
        $begin = ($page-1) * constant('per_page_tour');
        $query = mysql_query("SELECT * FROM tour WHERE type='tour' AND published=1 ORDER BY id DESC LIMIT ".constant('per_page_tour')." OFFSET $begin") or die(mysql_error());
        while ($fetch = mysql_fetch_array($query)) {
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
        }
        
    }
    public function buildQuery(){
        $queryString = ''; //defining query string
        if (isset($_GET['word'])) { //checking if serach has been initialized
            $queryString = 'WHERE '; 
        }else{
        	$queryString = 'WHERE 1 '; 
        }
        
        if (($_GET['type']=="tour" || !isset($_GET['type'])) && isset($_GET['word'])) { 

            $queryString .= "t.type='tour' "; //query to get specific type of product
        }elseif ($_GET['type']=="transfer" && isset($_GET['word'])) {
            $queryString .= "t.type='transfer' ";
        }
        if (isset($_GET['word'])) {
            $queryWord = mysql_real_escape_string($_GET['word']);
            $queryString .=" AND t.title LIKE '%$queryWord%' ";
        }
        if ($_GET['price']) {
            $price = mysql_real_escape_string($_GET['price']);
            $price_arr = explode(',', $price);
            list($low_price,$high_price) = $price_arr;
            $queryString .=" AND p.price BETWEEN $low_price AND $high_price ";
        }
        if ($_GET['facility']) {
            $facility_ids = mysql_real_escape_string($_GET['facility']);
            $facility_arr = explode(',', $facility_ids);
            //print_r($facility_arr);
            $queryString .= " AND t.id IN( SELECT t.id FROM tour AS t INNER JOIN tour_to_facility AS ttf ON t.id = ttf.tour_id WHERE ";
            foreach ($facility_arr as $key => $singleId) {
                if ($key==count($facility_arr)-1) {
                    $queryString .=" ttf.facility_id = '$singleId' ";
                }else{
                    $queryString .= " ttf.facility_id = '$singleId' OR ";
                }
               
            }
            $queryString .= " ) ";
        }

        if (!empty($_GET['cat'])) {
            $cat = (int) mysql_real_escape_string($_GET['cat']);
            $queryString .=" AND t.id IN( SELECT t.id FROM tour AS t INNER JOIN tour_to_cat AS ttc ON t.id = ttc.tour_id WHERE ttc.cat_id = '$cat') ";
        }

        $main_string = "SELECT t.*,
            p.quantity,
            p.price,
            p.tour_id
            FROM tour AS t 
            LEFT JOIN prices AS p ON t.id=p.tour_id 
            
            $queryString AND p.quantity=1 AND t.published=1  ORDER BY t.id DESC ";
        return $main_string;
    }
    public function getTours(){
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }else{
            $page = 1;
        }  
        $begin = ($page-1) * constant('per_page_tour');
        $queryString = $this->buildQuery()." LIMIT ".constant('per_page_tour')." OFFSET $begin";
            //echo $queryString;
        $query = mysql_query($queryString) or die(mysql_error());
        //echo "<pre>";print_r(mysql_fetch_array($query));echo "</pre>";
        $arr = [];
        while ($fetch = mysql_fetch_array($query)) {
            array_push($arr, $fetch);
        }
        return $arr;
    }
    public function buildPageString($page){
        $getquery = $_GET;
        unset($getquery['url']);
        $getquery['page'] = $page;
        $fullstring = http_build_query($getquery);
        return $fullstring;
    }
    public function pagination(){
        $url = mysql_real_escape_string($_GET['url']);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $queryString = $this->buildQuery();
        $query = mysql_query("$queryString") or die("can't connectsss");
        $num = mysql_num_rows($query);
        $page_quanitity = ceil( $num / constant('per_page_tour'));
        
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }else{
            $page = 1;
        }  

            //show left_arrow
            if ($page!=1) {
                    echo " <li class=\"page-item\"><a class=\"page-link\" aria-label=\"Previous\" href=\"/".$url[0]."/?".$this->buildPageString($page-1)."\">

                        <span aria-hidden=\"true\">&laquo;</span>
                        <span class=\"sr-only\">Previous</span>

                    </a></li>";
            }
                for ($i=1; $i <= $page_quanitity; $i++) {

                    if($page == $i){
                        echo  "<li class=\"page-item active\"><a class=\"page-link\">$i<span class=\"sr-only\">(current)</span></a></li>";
                    }else{

                        
                        echo "<li class=\"page-item\"><a class=\"page-link\" href=\"/".$url[0]."/?".$this->buildPageString($i)."\">$i</a></li>";
                    }
                        
                }


            //show right arrow
             if ($page!=$page_quanitity) {
                    $getquery['page'] = $getquery['page']+1;
                    $fullstring = http_build_query($getquery);
                    echo "<li class=\"page-item\"><a class=\"page-link\" aria-label=\"Next\" href=\"/".$url[0]."/?".$this->buildPageString($page+1)."\">
                        <span aria-hidden=\"true\">&raquo;</span>
                        <span class=\"sr-only\">Next</span>

                    </a></li>"; 
            }
    }


public function tour_exists(){

    $url = mysql_real_escape_string($_GET['url']);
    $url = rtrim($url, '/');
    $url = explode('/', $url);
    $title = $url[1];
    $spaced_title = str_replace('-', ' ', $title);
    $query = mysql_query("SELECT * FROM tour WHERE top_title = '$spaced_title' AND type='tour'") or die("Can't connsssect");
    $num = mysql_num_rows($query);
    if($num==0){
        echo "<script> window.location = '/'</script>";
    }
}

public function get_category($tourId=""){
    if (!empty($tourId)) {
        $cat_query = mysql_query("SELECT * FROM tour_to_cat WHERE tour_id='$tourId'") or die("Can't connect");
        $cat_fetch = mysql_fetch_array($cat_query);
        $cat_id = $cat_fetch['cat_id'];
        $query = mysql_query("SELECT * FROM category WHERE id='$cat_id'") OR die("Can't connect to categories ");
    }else{
        $query = mysql_query("SELECT * FROM category") OR die("Can't connect to categories ");
    }
    
    $arr = [];
    while ($fetch = mysql_fetch_assoc($query)) {
        if (!empty($tourId)) {
            $arr = $fetch;
        }else{
           array_push($arr, $fetch); 
        }
        
    }
    return $arr;
}

    public function get_tour_fields($param=""){
        /*$url = mysql_real_escape_string($_GET['url']);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        
        $title = $url[1];
        $spaced_title = str_replace('-', ' ', $title);*/
        $tour_id=$this->id();
        $query = mysql_query("SELECT * FROM tour WHERE id='$tour_id' ") or die("Can't ssss");
        
            $fetch = mysql_fetch_array($query);
            if ($param=="duration_day" || $param=="duration_hr") {
                return $fetch[$param];
            }else{
                 echo $fetch[$param];
            }
           
    }


    
    //get specific price = getsp
    public function getsp($tour_id){
        $query = mysql_query("SELECT MAX(price)  AS max_price, MAX(quantity) AS max_quantity FROM prices WHERE tour_id='$tour_id'") or die("Can't connect to prices");
        $fetch = mysql_fetch_array($query);
        $price = $fetch['max_price']/$fetch['max_quantity'];
        return round($price,0);
    }
    //get specific facilitieS = getsfs
    public function getsfs($tour_id){
        $query = mysql_query("SELECT * FROM tour_to_facility WHERE tour_id='$tour_id'") or die("Can't connect to prices");
        $arr = [];
        while ($fetch = mysql_fetch_assoc($query)) {
            array_push($arr, $fetch);
        }
        return $arr;
    }
    //get one facility =getonefac
    public function getonefac($facility_id){
        $query = mysql_query("SELECT * FROM tour_facility WHERE id='$facility_id'") or die("Can't connect to prices");
        $fetch = mysql_fetch_array($query);
        return $fetch;
    }

    public function getGallery(){
        $tour_id=$this->id();
        $query = mysql_query("SELECT * FROM tour_gallery WHERE tour_id='$tour_id'") or die("Can't connectsasf");
        $arr = [];
        while ($fetch = mysql_fetch_assoc($query)) {
            array_push($arr, $fetch);
        }
        return $arr;
    }

    public function getIncs(){
        $tour_id=$this->id();
        $query = mysql_query("SELECT * FROM inclusions WHERE tour_id='$tour_id'") or die("Can't connects");
        $arr = [];
        while ($fetch = mysql_fetch_assoc($query)) {
            array_push($arr, $fetch);
        }
        return $arr;
    }

    public function getSchedules(){
        $tour_id=$this->id();
        $query = mysql_query("SELECT * FROM tour_to_schedule WHERE tour_id='$tour_id'") or die("Can't connects");
        $arr = [];
        while ($fetch = mysql_fetch_assoc($query)) {
            array_push($arr, $fetch);
        }
        return $arr;
    }

    public function getServices(){
        $tour_id=$this->id();
        $query = mysql_query("SELECT * FROM tour_to_services WHERE tour_id='$tour_id'") or die(mysql_error());
        $arr = [];
        while ($fetch = mysql_fetch_assoc($query)) {
            $service_id =$fetch['service_id'];
           $service_query = mysql_query("SELECT * FROM tour_services WHERE id='$service_id'") or die(mysql_error());
           $sFetch = mysql_fetch_assoc($service_query);
           array_push($arr, $sFetch);

        }
        return $arr;
    }
    public function getFacility(){
        $tour_id=$this->id();
        $query = mysql_query("SELECT * FROM tour_to_facility WHERE tour_id='$tour_id'") or die(mysql_error());
        $arr = [];
        while ($fetch = mysql_fetch_assoc($query)) {
            $service_id =$fetch['facility_id'];
           $service_query = mysql_query("SELECT * FROM tour_facility WHERE id='$service_id'") or die(mysql_error());
           $sFetch = mysql_fetch_assoc($service_query);
           array_push($arr, $sFetch);

        }
        return $arr;
    }

    public function getAllFacility(){
        $query = mysql_query("SELECT * FROM tour_facility ORDER BY id ASC") or die("Can't connects");
        $arr = [];
        while ($fetch = mysql_fetch_assoc($query)) {
            array_push($arr, $fetch);
        }
        return $arr;
    }
    public function minMax(){
            $id = $this->id();
            $query = mysql_query("SELECT MAX(quantity) AS max_quantity, MIN(quantity) AS min_quanity, MIN(price) AS min_price FROM prices WHERE tour_id='$id'") or die(mysql_error());
            $fetch = mysql_fetch_array($query);
            return array('max'=>$fetch['max_quantity'], 'min'=>$fetch['min_quanity'], 'min_price'=>$fetch['min_price']);
    }



}

$tour = new tour();
 ?>

