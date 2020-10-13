<?php 
/**
 * 
 */
class payment
{
	
	function getCountries()
	{
		$query = mysql_query("SELECT * FROM apps_countries") or die("can't connect");
		$arr =[];
		while ($fetch = mysql_fetch_assoc($query)) {
			array_push($arr,$fetch);
		}
		return $arr;
	}
	function no_pay_book(){
	if(isset($_POST['no_pay_book'])):
		 if (isset($_COOKIE['visitor_info'])) {
			$visitorInfo = json_decode($_COOKIE['visitor_info'],true);

			}else{
				echo "You did not filled all of the personal information gaps. please go back and fill it.";
				exit;
			}
			 if (isset($_COOKIE['cart'])) {
				$cart = json_decode($_COOKIE['cart'],true);
			}else{
				echo "You don't have any tours in the cart. Please go back add tour in the cart and try payment again.";
				exit;
			}
		$realprice =(int) $fetch['price'];
		$price = round($getPrices['total_price']);
		$aditional = 0;
		$total = $price+$aditional;


		//personal information

		$fname =  mysql_real_escape_string($visitorInfo['firstname_booking']);
		$lname =  mysql_real_escape_string($visitorInfo['lastname_booking']);
		$email = mysql_real_escape_string($visitorInfo['email_booking']);
		$phone  = mysql_real_escape_string($visitorInfo['telephone_booking']);
		$country =mysql_real_escape_string($visitorInfo['country']);
		$street =mysql_real_escape_string($visitorInfo['street_1'])." ".mysql_real_escape_string($visitorInfo['street_2']);
		$city_booking =mysql_real_escape_string($visitorInfo['city_booking']);
		$state_booking =mysql_real_escape_string($visitorInfo['state_booking']);
		$postal_code =mysql_real_escape_string($visitorInfo['postal_code']);





		$arr_date = mysql_real_escape_string('');
		$price = mysql_real_escape_string($total);
		mysql_query("INSERT INTO orders VALUES (NULL,'$fname','$lname','$email','$phone','$country','$street','$city_booking','$state_booking','$postal_code','$price','$total',2,NOW())") or die(mysql_error());

		$order_id = mysql_insert_id();
		$email_body = "";
		$email_service_body = "";
		foreach ($cart as $info) {
			//cart information
			$tour_id = (int) mysql_real_escape_string($info['tour_id']);
			$children_quantity = (int) mysql_real_escape_string($info['children_quantity']);
			$adult_quantity = (int) mysql_real_escape_string($info['adult_quantity']);
			$start_date = (string) " ".$info['book_date']." ";
			echo $start_date;

			if (isset($info['options']) && $info['options']!="") {
				$options = $info['options'];
				$arr_options = explode(',', $options);
				for ($i=0; $i < count($arr_options); $i++){
					$op_query = mysql_query("SELECT * FROM tour_services WHERE id='".$arr_options[$i]."'") or die(mysql_error());
					$op_fetch = mysql_fetch_array($op_query);
					$op_title = $op_fetch['title'];
					$op_price = $op_fetch['price'];
					$email_service_body .= "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$op_title  ".$op_price."$";
				}
				
				
			}else
				$options = NULL;
			$tour_full_price =  (int) Helper::getCart($tour_id,$children_quantity,$adult_quantity,$options)['total'];
			$tour_title = Helper::getCart($tour_id,$children_quantity,$adult_quantity,$options)['tour']['title'];
			mysql_query("INSERT INTO order_products VALUES (NULL,'$tour_id','$order_id','$adult_quantity','$children_quantity','$start_date','$option','$tour_full_price')") or die(mysql_error());
			$email_body .= "realgeorgiatours.com new order. #".$order_id.".<br><br>";
			$email_body .="<h2>Tour Info--></h2>";
			$email_body .= "<h3>Title: $tour_title </h3>";
			$email_body .= $email_service_body;
			$email_body .= "<br>Adult quantity: $adult_quantity";
			$email_body .= "<br>Children quantity: $children_quantity";
			$email_body .= "<br>start date: $start_date";
			$email_body .= "<br>tour price : $tour_full_price";
	}
	$email_body .="<br><br><br><h2>Tourist Info</h2>: ";
	$email_body .= "<br>First name: $fname";
	$email_body .= "<br>Last name: $lname";
	$email_body .= "<br>E-mail: $email";
	$email_body .= "<br>Phone: $phone";
	$email_body .= "<br>Country: $country";
	$email_body .= "<br>Street: $street";
	$email_body .= "<br>City: $city_booking";
	$email_body .= "<br>State: $state_booking";
	$email_body .= "<br>postal code: $postal_code";
	$email_body .= "<hr><hr>";
	$email_body .="<br><br><br>Summarry: ";
	$email_body .="<br><h2>Full price: $total</h2> ";
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers .= 'From: '.$email."\r\n";
	mail("real.georgia.tours@gmail.com","Tour order: $order_id",$email_body,$headers);
	unset($_COOKIE['cart']);
    setcookie('cart', null, -1, '/');
endif;
}

	
}
 ?>