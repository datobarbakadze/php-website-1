<?php 
/**
 * 
 */
class user
{

    public function cookieToBasket($param=""){
        if ($param=="") {
            Helper::Error();
        }
        if (isset($_SESSION['userID'])) {
            $getcookie = json_decode($_COOKIE[$param], true);
            $user_id = $_SESSION['userID'];
               foreach ($getcookie as $cart) {
                    $item_id = (int) mysql_real_escape_string($cart['item_id']);
                    $sub_quantity = (int) mysql_real_escape_string($cart['sub_quantity']);
                    $quantity = (int) mysql_real_escape_string($cart['quantity']);
                    $basket = mysql_real_escape_string($cart['basket']);
                    $query = mysql_query("SELECT * FROM user_".$basket." WHERE user_id='".$user_id."' AND item_id='".$item_id."'") or Helper::Error();
                    if (mysql_num_rows($query)==0) {
                        mysql_query("INSERT INTO user_".$basket." VALUES ('','".$user_id."','".$item_id."','".$sub_quantity."','".$quantity."')") or Helper::Error();
                    }else{
                        mysql_query("UPDATE user_".$basket." 
                            SET quantity='".$quantity."', 
                            sub_quantity='".$sub_quantity."' 
                            WHERE user_id='".$user_id."' AND item_id='".$item_id."'") or Helper::Error();
                    }
                    
                }
            setcookie($basket, "",time() + (86400 * 30), "/");
        }
    }
    public function login(){
            if (!isset($_SESSION['userID']) &&
                isset($_POST['login_billing_email']) &&
                !empty($_POST['login_billing_email']) &&
                isset($_POST['login_billing_password']) &&
                !empty($_POST['login_billing_password'])){
                
                //creating variables
                $email = mysql_real_escape_string(htmlentities($_POST['login_billing_email']));
                $password = md5(mysql_real_escape_string(htmlentities($_POST['login_billing_password'])));
                $query = mysql_query("SELECT * FROM users WHERE email='".$email."' AND password='".$password."' AND level=0") or die(mysql_error());
                if (mysql_num_rows($query)==1) {
                    $fetch = mysql_fetch_assoc($query);
                        $_SESSION['userID'] = $fetch['id'];
                        $this->cookieToBasket('cart');
                        $this->cookieToBasket('whishlist');
                        echo json_encode(['success_url'=>"/".constant('cart')]);
                }else{
                    echo json_encode(["error"=>"Email or password is incorrect"]);
                }
            }else
                echo json_encode(["error"=>"Please fill every gap"]);
    }

    public function register(){
            if (!isset($_SESSION['userID']) &&
            isset($_POST['billing_email']) &&
            !empty($_POST['billing_email']) &&
            filter_var($_POST['billing_email'], FILTER_VALIDATE_EMAIL) &&
            isset($_POST['rules_input']) &&
            !empty($_POST['rules_input']) &&
            isset($_POST['billing_first_name']) &&
            !empty($_POST['billing_first_name']) &&
            isset($_POST['billing_password']) &&
            !empty($_POST['billing_password']) &&
            isset($_POST['billing_password2']) &&
            !empty($_POST['billing_password2'])){

                $email = mysql_real_escape_string(htmlentities($_POST['billing_email']));
                $name = mysql_real_escape_string(htmlentities($_POST['billing_first_name']));
                $password = mysql_real_escape_string(htmlentities($_POST['billing_password']));
                $confirm_password = mysql_real_escape_string(htmlentities($_POST['billing_password2']));
                $rules = mysql_real_escape_string(htmlentities($_POST['rules_input']));
                if ($password==$confirm_password && $rules==1) {
                    $query= mysql_query("SELECT * FROM users WHERE email='".$email."' AND level=0") or die("Can't connect");
                    if (mysql_num_rows($query)==0) {
                        mysql_query("INSERT INTO users VALUES('','$email','".md5($password)."','$name','','','','',0,0,NOW())") or die("Can't connect");
                        $_SESSION['userID'] = mysql_insert_id();
                        $this->cookieToBasket('cart');
                        $this->cookieToBasket('whishlist');
                        //sending the verification email
                        echo json_encode(['success_url'=>"/".constant('cart')]);

                    }else
                       echo json_encode(["error"=>"User already exists"]); 
                }else
                    echo json_encode(["error"=>"Passwords don't match or you did not agreed to rules"]);


            }else
                echo json_encode(["error"=>"please fill every gap"]);
    }

    public function forget(){

            if (!isset($_SESSION['userID']) &&
            isset($_POST['forget_billing_email']) &&
            !empty($_POST['forget_billing_email'])){
                $email = mysql_real_escape_string(htmlentities($_POST['forget_billing_email']));
                $query = mysql_query("SELECT * FROM users WHERE email='$email'") or die("can't connect");
                if (mysql_num_rows($query)==1) {
                    $fetch = mysql_fetch_array($query);
                    $user_id = $fetch['id'];

                    $forget_query = mysql_query("SELECT * FROM user_forget WHERE user_id='$user_id'") or die("Can't connect");
                    if (mysql_num_rows($forget_query)>0) {
                        mysql_query("DELETE FROM user_forget WHERE user_id='$user_id'") or die("Can't connect");
                    }
                    $forget_link = str_shuffle("12345qwert");
                    mysql_query("INSERT INTO user_forget VALUES('','$user_id','$forget_link')") or die("can't connect");
                    //mail($to,$subject,"To recover your password go to this link http://$_SERVER['HTTP_HOST']/constant('user')/constant('recover')?crypt=$forget_link");
                    echo json_encode(["success"=>"Email was sent to your specified address please check <span style='color:blue;'>inbox</span> or <span style='color:red'>spam</a>"]);

                }else
                    echo json_encode(["error"=>"User does not exists"]);
            }else
                echo json_encode(["error"=>"Please fill every gap"]);
    }
    public function passwordChange(){
        if(Helper::logged()==true){
            if (isset($_SESSION['userID']) &&
                isset($_POST['account_password']) &&
                !empty($_POST['account_password']) &&
                isset($_POST['account_password2']) &&
                !empty($_POST['account_password2'])){
                
                //creating variables
                
                $password = md5(mysql_real_escape_string(htmlentities($_POST['account_password'])));
                $confirm_password = md5(mysql_real_escape_string(htmlentities($_POST['account_password2'])));

                if ($password!=$confirm_password) {
                    die(json_encode(['error'=>"Passwords does not match"]));
                }
                $user_id = $_SESSION['userID'];
                mysql_query("UPDATE users SET password='$password' WHERE id='$user_id' AND level=0") or die(json_encode(['error'=>mysql_error()]));

                echo json_encode(['success'=>"You have susccessfully changed the password"]);
            }else
                echo json_encode(['error'=>"You are not logged in or did not filled every gap"]);
        }else
            echo json_encode(['error_url'=>"/".constant('error')]);
    }
    public function recoverPass(){

        if (!isset($_GET['crypt']) || empty($_GET['crypt'])) {
            Helper::Error();
        }else{
            $crypt = mysql_real_escape_string(htmlentities($_GET['crypt']));
            $query = mysql_query("SELECT * FROM user_forget WHERE forget_link='$crypt'") or die("Can't conenct");
            if (mysql_num_rows($query)==0) {
                Helper::Error();
            }
        }

        if (isset($_POST['recover_button'])):
            if (!isset($_SESSION['userID']) &&
                isset($_POST['billing_password']) &&
                !empty($_POST['billing_password']) &&
                isset($_POST['billing_password2']) &&
                !empty($_POST['billing_password2'])){
                
                //creating variables
                
                $password = md5(mysql_real_escape_string(htmlentities($_POST['billing_password'])));
                $confirm_password = md5(mysql_real_escape_string(htmlentities($_POST['billing_password2'])));

                if ($password!=$confirm_password) {
                    die("Password does not match");
                }
                if (mysql_num_rows($query)==1) {
                        $fetch = mysql_fetch_assoc($query);
                        $user_id = $fetch['user_id'];
                        mysql_query("UPDATE users SET password='$password', verify=1 WHERE id='$user_id' AND level=0") or die("Can't connect");
                        mysql_query("DELETE FROM user_forget WHERE user_id='$user_id'") or die("can't connect");
                        echo "Your password has been changed please go to the <a href='/".constant('user')."'> login page </a>";
                        
                }else{
                    echo "You are typing something worng";
                }
            }else
                echo "Please fill every gap";
        endif;
    }
    public function accountUpdate(){
        if(Helper::logged()==true){
            $first_name = Helper::Post('account_first_name');
            $last_name = Helper::Post('account_last_name');
            $birth_date = Helper::Post('account_birth_date');
            $phone = Helper::Post('account_phone');
            $street = Helper::Post('account_street');
            mysql_query("UPDATE users SET 
            name='$first_name',
            last_name='$last_name',
            birth_date='$birth_date',
            phone_number='$phone',
            street='$street'
            WHERE id='".$_SESSION['userID']."' AND level=0") or die(json_encode(["error"=>"Can't connect"]));
            die(json_encode(["success"=>"Update successfully"]));
        }else
            echo json_encode(['error_url'=>"/".constant('error')]);
        
    }
    public function logout(){
        session_destroy();
        Helper::ErrorLogin();
    }

    function getOrderItems($orderId){
        $query = mysql_query("SELECT 
            uoi.*, 
            i.main_image,
            i.title
            FROM  user_order_item uoi
            LEFT JOIN item i ON uoi.item_id=i.item_id 
            WHERE uoi.order_id='".$orderId."' ORDER BY uoi.create_date
 DESC         ") or die("Can't connect");
        while ($fetch = mysql_fetch_assoc($query)) {
            $rows[] = $fetch;
        }

        return $rows;
    }

}
 ?>