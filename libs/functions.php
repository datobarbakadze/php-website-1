<?php 
/**
 * 
 */
class Helper
{
	public static function ajax(){ // detect if the request was made from ajax
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest") {
			return true;
		}else
			return false;
	}
	public static function get_background($param='')
	{
		$query = mysql_query("SELECT * FROM backgrounds WHERE name='$param'") or die("Can't connect");
		$fetch = mysql_fetch_assoc($query);
		return $fetch;
	}
    public static function logged(){
        if (isset($_SESSION['userID']) && !empty($_SESSION['userID'])) {
            return true;
        }else
            return false;
    }

    public static function verfied(){
        if (self::logged()==true) {
            $query = mysql_query("SELECT id,verify FROM users WHERE id='".$_SESSION['userID']."' AND verify=1") or die("Can't connect");
            if (mysql_num_rows($query)==1) {
                return true;    
            }else
                return false;
        }else
            return true;
    }
    public static function countCart($basket="",$param=""){
        if (self::logged()):
            $query = mysql_query("SELECT * FROM user_".$basket." WHERE user_id='".$_SESSION['userID']."'") or die("Can't connect");
            if (empty($param)) {
                echo mysql_num_rows($query);
            }else{
                return mysql_num_rows($query);
            }
            
        else:
            if (isset($_COOKIE[$basket])) {
                $cart = json_decode($_COOKIE[$basket],true);
                 if (empty($param)) {
                    echo count($cart);
                }else{
                    return count($cart);
                }
            }else
                return 0;
            
        endif;
    }
    public static function Error(){
        die(header('Location: /'.constant('error')));
    }
    public static function ErrorIndex(){
        die(header('Location: /'));
    }
    public static function ErrorCart(){
        die(header('Location: /'.constant('cart')));
    }
    public static function ErrorLogin(){
        die(header('Location: /'.constant('user')));
    }
    public static function ErrorShop(){
        die(header('Location: /'.constant('shop')));
    }

    public static function User(){
        if (isset($_SESSION['userID']) && !empty($_SESSION['userID'])) {
            $query = mysql_query("SELECT * FROM users WHERE id='".$_SESSION['userID']."' AND level=0") or die("Can't connect");
            return mysql_fetch_assoc($query);
        }else
            return false;
    }
    public static function getAny($table, $order=false, $order_type=false, $limit=false){
        $orderString = "";
        if ($order) {
            $orderString .= " ORDER BY ".$order." ".$order_type."  ";
        }
        if ($limit) {
            $orderString .= " LIMIT ".$limit." ";
        }

        $any_arr = [];
        $any_query = mysql_query("SELECT * FROM ".$table."  $orderString  ") or die("Can't connect");
        while ($any_fetch = mysql_fetch_assoc($any_query)) {
            array_push($any_arr, $any_fetch);
        }
        return $any_arr;
    }

    public static function getOne($table, $column, $single_id, $order=false, $order_type=false,$limit=false){
        $orderString = "";
        if ($order) {
            $orderString .= " ORDER BY ".$order." ".$order_type."  ";
        }
        if ($limit) {
            $orderString .= " LIMIT ".$limit." ";
        }
        
        $get_any_single_arr = [];
        $get_any_single_query = mysql_query("SELECT * FROM ".$table." WHERE ".$column."='".$single_id."' $orderString  ") or die("Can't connect");
            while ($get_any_single_fetch = mysql_fetch_assoc($get_any_single_query)) {
                array_push($get_any_single_arr, $get_any_single_fetch);
            }

        return $get_any_single_arr;
    }

    public function Post($param=""){
        if (!empty($param)) {
            return mysql_real_escape_string(htmlentities($_POST[$param]));
        }else
            return $_POST;
    }
    public function Get($param=""){
        if (!empty($param)) {
            return mysql_real_escape_string(htmlentities($_GET[$param]));
        }else
            return $_GET;
    }

    public static function inCart($basket, $itemId){
        if(Helper::logged()):
            $query = mysql_query("SELECT * FROM user_".$basket." WHERE user_id='".$_SESSION['userID']."' AND item_id='".$itemId."'") or die("Can't connect");
            if (mysql_num_rows($query)>0) {
                return true;
            }else
                return false;
        else:
            if (isset($_COOKIE[$basket]) && in_array($itemId, array_column(json_decode($_COOKIE[$basket],true), "item_id"))) {
                return true;
            }else
                return false;
        endif;
    }




















/*
public static function TestSend()

	{

		require_once 'mail/class.phpmailer.php';
		$mail = new PHPMailer(true);


    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    $name = "hope";
    $email = "mdimitrieva269@gmail.com";
    $subject = "hello";
    $message = "hello world";

    $mail->IsSMTP();
    $mail->Host = "smtp.gmail.com"; // Your SMTP PArameter
    $mail->Port = 587; // Your Outgoing Port
    $mail->SMTPAuth = true; // This Must Be True
    $mail->Username = "barbaqadzedato3@gmail.com"; // Your Email Address
    $mail->Password = "ddtocen123"; // Your Password
    $mail->SMTPSecure = 'tls'; // Check Your Server's Connections for TLS or SSL

    $mail->From = $email;
    $mail->FromName = $name;
    $mail->AddAddress($email);
$mail->SMTPDebug = 1;
    $mail->IsHTML(false);

    $mail->Subject = "asfas";

    $mail->Body = "sfsf";
   

    if(!$mail->Send())
    {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    else
    {
        echo 'success';
    }

    

		return true;

	}*/



}


 ?>