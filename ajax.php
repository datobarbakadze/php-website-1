<?php 
require "./libs/connect.php";

header('Content-Type: text/html; charset=utf-8');
if(!isset($_GET['func'])){
	header('Location: /');
}else{
	$func = mysql_real_escape_string($_GET['func']);
}
class ajax{
			function test(){
				echo json_encode($_SERVER);
			}
			

			
			
			function updatebook(){
				$tour_id = $_POST['tour_id'];
				$services_sum = 0;
				$children_quantity = (int) $_POST['children_quantity'];
				$adult_quantity = (int) $_POST['adult_quantity'];
				$quantity = $children_quantity + $adult_quantity;

				//services update and price grabbing for services
				if(!empty($_POST['options'])){
					$services = array_unique($_POST['options']);
					foreach ($services as $service_id) {
						$service_query = mysql_query("SELECT * FROM tour_services WHERE id='$service_id'") or die(mysql_error());
						$service_row = mysql_fetch_array($service_query);
						$services_sum += (int) $service_row['price'];
					}
				}
				$service_merged_price = $services_sum*$adult_quantity+($services_sum/2)*$children_quantity;
				// END services

				//tour update depending on quantity and price grabbing for tour itself
				$adult_price = $this->tourPriceGraber($tour_id,$adult_quantity);
				$children_price = $this->tourPriceGraber($tour_id,$children_quantity);
				$total_cost = $adult_price+($children_price/2)+$service_merged_price;
				echo json_encode(array("service_price"=>$service_merged_price,"quantity"=>$quantity,"adult"=>$adult_quantity,"children"=>$children_quantity,"total_cost"=>$total_cost));
			}
			function send_mail(){
				if($_POST['name'] && $_POST['email'] && $_POST['message']){
					$string = str_shuffle("123456789");
					$name = $_POST['name'];
					$email = $_POST['email'];
					$message = $_POST['message'];
					$header = array(
					'Content-type: text/html'
					);
					$msg = "<b>Client name: </b>".$name."<br><br><b>Client email: </b>".$email."<br><br><br><b>Client message:<br></b>".$message;
					$sentto = "firstfood01@gmail.com";
					$msg = wordwrap($msg,70);
					$subject = "MESSAGE #".$string;
					if(mail($sentto,$subject,$msg,implode("\r\n",$header))){
					     echo "Sent!";
					}else
					    echo "ERROR!";
					}else
					   echo "ERROR!";
			}

			function prod_email(){
				if($_POST['name'] && $_POST['privatenumber'] && $_POST['address'] && $_POST['last_name'] && $_POST['phone']){
					$string = str_shuffle("123456789");
					$name = $_POST['name'];
					$phone = $_POST['phone'];
					$privatenumber = $_POST['privatenumber'];
					$address = $_POST['address'];
					$menu = $_POST['menu'];
					$last_name = $_POST['last_name'];
					$header = array(
					'Content-type: text/html'
					);
					$msg = "<b style='font-size:30px;'>Menu - </b> <b style='font-size:30px;color:#b1c848;'>".$menu."</b><br><br><b>Client name: </b>".$name." ".$last_name."<br><br><b>Client private number: </b>".$privatenumber."<br><br><b>Client address: </b>".$address."<br><br><b>Client phone:<br></b>".$phone;
					$sentto = "firstfood01@gmail.com";
					$msg = wordwrap($msg,70);
					$subject = "ORDER #".$string;
					if(mail($sentto,$subject,$msg,implode("\r\n",$header))){
					     echo "Sent!";
					}else
					    echo "ERROR!";
					}else
					   echo "ERROR!";
			}

			function get_images(){
				if(isset($_POST['day'])){
					header('Content-Type: application/json');
					$day =(int) mysql_real_escape_string(htmlentities($_POST['day']));
					$menu = mysql_real_escape_string(htmlentities($_POST['menu']));

					$image_query = mysql_query("SELECT * FROM images WHERE day='$day' AND menu='$menu' ORDER BY id DESC") or die("Error!");
					$arr = [];
					while($image_fetch = mysql_fetch_assoc($image_query)){
						$name = $image_fetch['image'];
						array_push($arr, $name);
					}
					header('Content-Type: application/json');
					echo json_encode(array("images" => $arr));
				}else
					echo "Error!";
			}
			function max_number(){
					$id = (int) $_POST['tour_id'];
					$query = mysql_query("SELECT MAX(quantity) AS max_quantity, MIN(quantity) AS min_quanity FROM prices WHERE tour_id='$id'") or die(mysql_error());
					$fetch = mysql_fetch_array($query);
					echo json_encode(array('max'=>$fetch['max_quantity'], 'min'=>$fetch['min_quanity']));
			}
			/*function calculate(){
				if(isset($_POST['tour_id'])){

					$q = (int) $_POST['q'];
					$id = (int) $_POST['tour_id'];


					$query = mysql_query("SELECT * FROM prices WHERE tour_id='$id' AND quantity='$q'") or die(mysql_error());
					$fetch = mysql_fetch_array($query);
					$price = $fetch['price'];
					echo $price;
				}else 
					echo "wrong";
			}*/

			function comment(){
				if (!empty($_POST['id']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['enquiry'])) {
					$id = (int) mysql_real_escape_string($_POST['id']);
					$name = mysql_real_escape_string($_POST['name']);
					$text = mysql_real_escape_string($_POST['enquiry']);
					$email = mysql_real_escape_string($_POST['email']);
					mysql_query("INSERT INTO comment VALUES(NULL,'$id','$name','$email','$text',NOW(),0)") or die("Can't connect");
					echo "success";
				}else
					echo "Error! Please fill every gap!";
			}
			function buildQuery(){

				$queryString = ''; //defining query string
		        if (isset($_GET['word'])) { //checking if serach has been initialized
		            $queryString = '
		            WHERE '; 
		        }
		        
		        if (($_GET['type']=="tour" || !isset($_GET['type'])) && isset($_GET['word'])) { 

		            $queryString .= "t.type='tour' "; //query to get specific type of product
		        }elseif ($_GET['type']=="transfer" && isset($_GET['word'])) {
		            $queryString .= "t.type='transfer' ";
		        }
		        if (!empty($_GET['word'])) {
		            $queryWord = mysql_real_escape_string($_GET['word']);
		            $queryString .="
		            AND t.title LIKE '%$queryWord%' ";
		        }
		        if ($_GET['price']) {
		            $price = mysql_real_escape_string($_GET['price']);

		            $price_arr = explode(',', $price);
		            list($low_price,$high_price) = $price_arr;
		            $queryString .="
		             AND p.price BETWEEN $low_price AND $high_price ";
		        }
		        if ($_GET['facility']) {
		            $facility_ids = mysql_real_escape_string($_GET['facility']);
		            $facility_arr = explode(',', $facility_ids);
		            //print_r($facility_arr);
		            $queryString .= "
		             AND t.id IN( SELECT t.id FROM tour AS t INNER JOIN tour_to_facility AS ttf ON t.id = ttf.tour_id WHERE ";
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
		            $queryString .=" 
		            AND t.id IN( SELECT t.id FROM tour AS t INNER JOIN tour_to_cat AS ttc ON t.id = ttc.tour_id WHERE ttc.cat_id = '$cat') ";
		            $main_string = "SELECT t.*,
		            p.quantity,
		            p.price,
		            p.tour_id,
		            c.icon,
		            c.category_title,
		            ttr.tour_id,
		            ttr.ribbon_id,
		            tr.ribbon_id,
		            tr.ribbon_name
		            FROM tour AS t 
		            LEFT JOIN prices AS p ON t.id=p.tour_id 
		            LEFT JOIN category AS c ON c.id='$cat'
		            LEFT JOIN tour_to_ribons AS ttr ON ttr.tour_id = t.id
		            LEFT JOIN tour_ribons AS tr ON tr.ribbon_id = ttr.ribbon_id
		            $queryString  AND p.quantity=1 AND t.published=1 ORDER BY t.id DESC";
		        }else{
		        	$main_string = "SELECT t.*,
		            p.quantity,
		            p.price,
		            p.tour_id,
		            c.icon,
		            c.category_title,
		            ttc.cat_id,
		            ttr.tour_id,
		            ttr.ribbon_id,
		            tr.ribbon_id,
		            tr.ribbon_name
		            FROM tour AS t 
		            LEFT JOIN prices AS p ON t.id=p.tour_id 
		            LEFT JOIN tour_to_cat AS ttc  ON ttc.tour_id=t.id
		            LEFT JOIN category AS c ON c.id=ttc.cat_id
		            LEFT JOIN tour_to_ribons AS ttr ON ttr.tour_id = t.id
		            LEFT JOIN tour_ribons AS tr ON tr.ribbon_id = ttr.ribbon_id
		            $queryString  AND p.quantity=1 AND t.published=1 ORDER BY t.id DESC";
		        }

		        
		        return $main_string;

			}
			function update_search(){
				$per_page = 3;
				$queryString = $this->buildQuery()." LIMIT $per_page OFFSET 0";
		            //echo $queryString;
		        $query = mysql_query("$queryString") or die(mysql_error());
		        //echo "<pre>";print_r(mysql_fetch_array($query));echo "</pre>";
		        $arr = [];
		        $json_price_arr = [];
		        $json_facility_arr = [];
		        //pages
		        $num = mysql_num_rows(mysql_query($this->buildQuery()));
        		$page_quanitity = ceil( $num / $per_page);
        		
        		$geturl = $_GET['url'];
        		$getquery = array(
        			"word"=>$_GET['word'],
        			"facility"=>$_GET['facility'],
        			"price"=>$_GET['price'],
        			"cat"=>$_GET['cat'],
        			"type"=>$_GET['type']
        		);
        		//end pages
		        while ($fetch = mysql_fetch_array($query)) {
		        	$tour_id = $fetch['id'];
		        	$pricequery = mysql_query("SELECT MAX(price)  AS max_price, MAX(quantity) AS max_quantity FROM prices WHERE tour_id='$tour_id'") or die("Can't connect to prices");
        			$pricefetch = mysql_fetch_assoc($pricequery);
        			$facilityquery = mysql_query("SELECT * FROM tour_to_facility WHERE tour_id='$tour_id'") or die(mysql_error());
        			$json_facility_cont = [];
        			while ($facilityfetch = mysql_fetch_assoc($facilityquery)) {
        				$facility_id = $facilityfetch['facility_id'];
        				$getfacilityquery = mysql_query("SELECT * FROM tour_facility WHERE id='$facility_id'") or die(mysql_error());
        				$getfacilityfetch = mysql_fetch_assoc($getfacilityquery);
        				array_push($json_facility_cont, $getfacilityfetch);
        			}
        			$json_facility_arr[$tour_id]=$json_facility_cont;
		            array_push($arr, $fetch);
		            $json_price_arr[$tour_id] = round($pricefetch['max_price']/$pricefetch['max_quantity'],0); 
		            unset($json_facility_cont);

		        }
		        echo json_encode(array("tours"=>$arr,"price"=>$json_price_arr, "facility"=>$json_facility_arr,"page_quantity"=>$page_quanitity,"getquery"=>$getquery,"url"=>$geturl));
		        
			}
			function book_info(){
				if (isset($_POST)) {
					$variables = setcookie('visitor_info',json_encode($_POST),time() + (86400 * 30),'/');
				}
			}

			function get_enabled_days(){
				$tour_id = (int) mysql_real_escape_string($_REQUEST['tour_id']);
				$query = mysql_query("SELECT day_id FROM tour_to_disabled_days WHERE tour_id='$tour_id'") or die("Can't connect");
				$arr = [];
				$dis_arr= [];
				while ($fetch = mysql_fetch_assoc($query)) {
					array_push($arr, $fetch['day_id']);
				}
				$dis_query = mysql_query("SELECT disabled_date FROM tour_to_dates WHERE tour_id='$tour_id'") or die("Can't connect");
				while ($dis_fetch = mysql_fetch_assoc($dis_query)) {
					array_push($dis_arr, date("d-m-Y", strtotime($dis_fetch['disabled_date'])));
				}
				echo json_encode(array("week_days"=>$arr,"disabled_date"=>$dis_arr));
			}

			function add_review(){
				if (!empty($_POST['name']) && !empty($_POST['rating']) && !empty($_POST['review']) && !empty($_POST['item_id'])) {
					$item_id = (int) mysql_real_escape_string($_POST['item_id']); 
					$name = mysql_real_escape_string($_POST['name']); 
					$rating = (int) mysql_real_escape_string($_POST['rating']); 
					$review = mysql_real_escape_string(strip_tags($_POST['review']));
					$ip = mysql_real_escape_string($_SERVER['REMOTE_ADDR']); 
					$check = mysql_query("SELECT * FROM item_reviews WHERE item_id='$item_id' AND visitor_ip='$ip'") or die(mysql_error());
					if (mysql_num_rows($check)==0) {
						mysql_query("INSERT INTO item_reviews VALUES('','$item_id','$name', '$rating','$review', NOW(), '$ip',0,0,0)") or die(mysql_error());
						echo "success! Your review is held on review";
					}else{
						echo "fail! you have already written a review";
					}
				}else{
					echo "fail! you did not filled all the fields";
				}
			}
}

$ajaxclass = new ajax();
$ajaxclass->$func();
?>