<?php 

session_start();
error_reporting(E_ALL ^ E_DEPRECATED);
require "../libs/connect.php";
require "../libs/functions.php";
$getPrices = Helper::Getallprices();
use \PayPal\Api\Payer;
use \PayPal\Api\Item;
use \PayPal\Api\ItemList;
use \PayPal\Api\Details;
use \PayPal\Api\Amount;
use \PayPal\Api\Transaction;
use \PayPal\Api\RedirectUrls;
use \PayPal\Api\Payment;
use \PayPal\Api\InputFields ;
 if (isset($_COOKIE['visitor_info'])) {
	$visitorInfo = json_decode($_COOKIE['visitor_info'],true);

}else{
	echo "You did not filled all of the personal information gaps. please go back and fill it.";
	exit;
}
/*if (!isset($visitorInfo['policy_terms']) ||  $visitorInfo['policy_terms']!="on") {
	echo "You did not agreed to our policy terms";
	exit;
}*/
 if (isset($_COOKIE['cart'])) {
	$cart = json_decode($_COOKIE['cart'],true);
}else{
	echo "You don't have any tours in the cart. Please go back add tour in the cart and try payment again.";
	exit;
}


require "app/start.php";

/*if (!isset($_POST['p_num']) || !isset($_POST['first_name']) || !isset($_POST['last_name']) || !isset($_POST['email']) || !isset($_POST['phone_num']) || !isset($_POST['arrival_date']) || !isset($_POST['id'])) {
	echo "Something went worng! <a href=\"/\">Go back to the Home page</a>";
}*/
$product_id = (int) mysql_real_escape_string('68');
$p_num = (int) mysql_real_escape_string('1');
$query = mysql_query("SELECT t.*, p.* FROM tour t LEFT JOIN prices p ON t.id = p.tour_id WHERE p.quantity='1' AND t.id='68'") or die("Can't connect");
$fetch = mysql_fetch_array($query);
$product = $fetch['title'];
$realprice =(int) $fetch['price'];
$price = round($getPrices['total_price']);
$aditional = 0;
if (isset($_GET['way']) && !empty($_GET['way'])) {
	if ($_GET['way']=="pre") {
		$total = ($price+$aditional)*20/100;
	}else if ($_GET['way']=="full") {
		$total = $price+$aditional;
	}else{
		die("Something went wrong!");
	}
}



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
mysql_query("INSERT INTO orders VALUES (NULL,'$fname','$lname','$email','$phone','$country','$street','$city_booking','$state_booking','$postal_code','$price','$total',0,NOW())") or die(mysql_error());

$order_id = mysql_insert_id();
foreach ($cart as $info) {
	//cart information
	$tour_id = (int) mysql_real_escape_string($info['tour_id']);
	$children_quantity = (int) mysql_real_escape_string($info['children_quantity']);
	$adult_quantity = (int) mysql_real_escape_string($info['adult_quantity']);
	$start_date = (string) " ".$info['book_date']." ";

	if (isset($info['options']) && $info['options']!="") {
		$options = $info['options'];
	}else
		$options = NULL;
	$tour_full_price =  (int) Helper::getCart($tour_id,$children_quantity,$adult_quantity,$options)['total'];
	$tour_title = Helper::getCart($tour_id,$children_quantity,$adult_quantity,$options)['tour']['title'];
	mysql_query("INSERT INTO order_products VALUES (NULL,'$tour_id','$order_id','$adult_quantity','$children_quantity','$start_date','$options','$tour_full_price')") or die(mysql_error());

	
	


}
	




$payer = new Payer();
$payer->setPaymentMethod('paypal');
$InputFields = new InputFields();
$InputFields->setNoShipping('1');
$InputFields->setAddressOverride('0');
$item = new Item();
$item->setName($product)
->setCurrency('USD')
->setQuantity(1)
->setPrice($price);

$itemList = new ItemList();
$itemList->setItems([$item]);

$details = new Details();
$details->setSubtotal($price);
$paypal->setConfig(
      array(
                'mode' => 'LIVE',

      )
);
$amount = new Amount();
$amount->setCurrency('USD')
->setTotal($total)
->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
->setItemList($itemList)
->setDescription('pay forsotheing payment')
->setInvoiceNumber(uniqid());

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl(SITE_URL . '/pay.php?success=true')
->setCancelUrl(SITE_URL . '/pay.php?success=false');

$payment = new Payment();
$payment->setIntent('sale')
->setPayer($payer)
->setRedirectUrls($redirectUrls)
->setTransactions(array($transaction));

try {
	$payment->create($paypal);
} catch (Exception $e) {
	die(
		"<div class=\"fail_trans\" style=\"width:100%;padding:30px 20px;box-sizing:border-box;font-size:18px;color:white;background:#c9302c;\">Couldn't manage to establish connection to paypal
				<a href=\"/\" style=\"color:#999;\"> Home page</a>.
			</div>");
}
if ($payment->GetApprovalLink()) {
	$approvalUrl = $payment->GetApprovalLink();
	$_SESSION['order_id'] = $order_id;
	$_SESSION['way'] = $_GET['way'];
	header('Location: '.$approvalUrl);
}else
	echo "Something went worng! <a href=\"/\">Go back to the Home page</a>";










