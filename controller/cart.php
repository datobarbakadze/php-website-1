<?php 
/**
 * 
 */
class cart
{
	
	public function getSale($item_id){
        $sale_query = mysql_query("SELECT sale FROM item WHERE item_id='".mysql_real_escape_string($item_id)."'") or Helper::Error();
        $sale = mysql_fetch_array($sale_query)['sale'];
        return $sale;
    }
    public function get_cart_count($param=""){
        if (!isset($_POST['basket'])) {
            $basket = $param;
        }else
            $basket = (string) $_POST['basket'];
        return Helper::countCart($basket,$param);
        
    }

    public function cart_add(){ // add into the cart
        
        //setcookie("cart", "asffasf", time() + (86400 * 30), "/");
        if (!isset($_POST['basket'])) {
            die(json_encode(array("error"=>"Something went wrong")));
        }else
            $basket = (string) $_POST['basket'];

        $getcookie = json_decode($_COOKIE[$basket],true);
        $getvars = $_POST;
            $check_stock = mysql_query("SELECT in_stock FROM prices WHERE quantity=".mysql_real_escape_string($_POST['sub_quantity'])." AND item_id='".mysql_real_escape_string($getvars['item_id'])."'") or die("Can't connect");
            $fetch = mysql_fetch_array($check_stock);
            if (mysql_num_rows($check_stock)>0) {
                if ($fetch['in_stock']>=$getvars['quantity'] && ($getvars['quantity']*$getvars['sub_quantity'])>=1) {
                    if (Helper::logged()) {
                        mysql_query("DELETE FROM user_".$basket." WHERE user_id='".$_SESSION['userID']."' AND item_id='".Helper::Post('item_id')."'") or die(json_encode(array("error"=>"Can't connect")));
                        mysql_query("INSERT INTO user_".$basket." VALUES('','".$_SESSION['userID']."','".Helper::Post('item_id')."','".Helper::Post('sub_quantity')."','".Helper::Post('quantity')."')") or die(json_encode(array("error"=>"Can't connect")));
                        
                    }else{
                        if (!in_array($getvars['item_id'],array_column($getcookie, "item_id"))) {
                            array_push($getcookie, $getvars);
                            setcookie($basket, json_encode($getcookie), time() + (86400 * 30), "/");
                        }else
                            die(json_encode(array("error"=>"Already in ".$busket)));
                    }
                    
                    mysql_query("INSERT INTO cart_log VALUES('','".$_SERVER['REMOTE_ADDR']."','".$_SERVER['HTTP_USER_AGENT']."','".$getvars['item_id']."','".($getvars['quantity']*$getvars['sub_quantity'])."',NOW())") or die(json_encode(array("error"=>"Something went wrong try again later")));
                }else
                    die(json_encode(array("error"=>"Not enaugh product in stock")));
            }else
                die(json_encode(array("error"=>"There is no such quantity or such item in the stock")));
        
        echo json_encode(array("success"=>"added to cart"));
    }

    public function deleteCart(){
        if (!isset($_POST['basket'])) {
            die(json_encode(array("error"=>"Something went wrong")));
        }else
            $basket = (string) $_POST['basket'];

        $item_id = Helper::Post('item_id');
        if (Helper::logged()==false):
            $getcookie = json_decode($_COOKIE[$basket],true);
            foreach ($getcookie as $index => $value) {
                $field = array_search($item_id, $value);

                if($field == "item_id")
                {
                    unset($getcookie[$index]);
                }
            }
            setcookie($basket, json_encode($getcookie), time() + (86400 * 30), "/");
        else:
            mysql_query("DELETE FROM user_".$basket." WHERE user_id='".$_SESSION['userID']."' AND item_id='".$item_id."'") or die("can't connect");
        endif;
        
        
        echo json_encode(array("message"=>"success"));
    }
    public function getUserCart($basket){
        $cart_query = mysql_query("SELECT * FROM user_".$basket." WHERE user_id='".$_SESSION['userID']."'") or die(json_encode(array("error"=>mysql_error())));
        $cartArray = [];
        if (mysql_num_rows($cart_query)) {
           while ( $cart_item = mysql_fetch_assoc($cart_query)) {
                $query = mysql_query("SELECT i.title,i.item_id, i.sale, p.price FROM item i 
                    LEFT JOIN prices p ON p.item_id=i.item_id AND p.quantity='".$cart_item['sub_quantity']."'
                    WHERE i.item_id='".$cart_item['item_id']."'") or die(json_encode(array("error"=>mysql_error())));
                $fetch = mysql_fetch_array($query);
                if ($fetch['sale']>0) {
                    $price = $cart_item['quantity']*($fetch['price'] - ($fetch['price']*$fetch['sale']/100)); //sales
                }else
                    $price = $cart_item['quantity']*$fetch['price'];
                
                array_push($cartArray, ["title"=>$fetch['title'], "item_id"=>$fetch['item_id'] ,"price"=>(double) round($price)]);
           }
           echo json_encode($cartArray,true);
        }else
            echo json_encode(array("error"=>"You have no items in ".$basket));
    }

    public function get_cart($param=""){
        if (!isset($_POST['basket'])) {
            if (!empty($param)) {
                $basket = $param;
            }
        }else
            $basket = (string) $_POST['basket'];
        if (Helper::logged()==false):
            if (isset($_COOKIE[$basket]) && count(json_decode($_COOKIE[$basket],true))>0) {
                $cartArray = [];
                $cart = json_decode($_COOKIE[$basket],true);
                foreach ($cart as $cart_item) {
                    $query = mysql_query("SELECT i.title,i.item_id,i.sale, p.price FROM item i 
                        LEFT JOIN prices p ON p.item_id=i.item_id AND p.quantity='".$cart_item['sub_quantity']."'
                        WHERE i.item_id='".$cart_item['item_id']."'") or die(json_encode(array("error"=>mysql_error())));
                    $fetch = mysql_fetch_array($query);
                    if ($fetch['sale']>0) {
                        $price = $cart_item['quantity']*($fetch['price'] - ($fetch['price']*$fetch['sale']/100)); //sales
                    }else
                        $price = $cart_item['quantity']*$fetch['price'];
                    array_push($cartArray, ["title"=>$fetch['title'], "item_id"=>$fetch['item_id'] ,"price"=>(double) round($price)]);
                }   
            }
            echo json_encode($cartArray,true);
        else:
            $this->getUserCart($basket);
        endif;
    }

    public function updateCart(){
        if (!isset($_POST['basket'])) {
            die(json_encode(array("error"=>"Something went wrong")));
        }else
            $basket = (string) $_POST['basket'];

        $item_id = $_POST['item_id'];
        $getvars = $_POST;
        if(Helper::logged()==true):
            $getCartItems = array();
            $query = mysql_query("SELECT * FROM user_".$basket." WHERE user_id='".$_SESSION['userID']."'") or Helper::Error();
            while($rows =   mysql_fetch_array($query)){
                $getCartItems[] = $rows;
            }
            
        else:
            $getCartItems = json_decode($_COOKIE[$basket],true);
        endif;
        foreach ($getCartItems as $index => $value) {
            $field = array_search($item_id, $value);
            $check_stock = mysql_query("SELECT * FROM prices WHERE quantity=".mysql_real_escape_string($_POST['sub_quantity'])." AND item_id='".mysql_real_escape_string($getvars['item_id'])."'") or die(json_encode(array("error"=>"Something went wrong first time")));
            $fetch = mysql_fetch_array($check_stock);

            if(Helper::logged()==false){
                if($field == "item_id")
                {

                    unset($getCartItems[$index]);
                    
                    if ($fetch['in_stock']>=$getvars['quantity'] && ($getvars['quantity']*$getvars['sub_quantity'])>=1) {
                        array_push($getCartItems, $getvars);
                        setcookie($basket, json_encode($getCartItems), time() + (86400 * 30), "/");
                        
                        $sale = $this->getSale($getvars['item_id']);
                        if ($sale>0) {
                            $single_price = $fetch['price'] - ($fetch['price']*$sale/100); //sales
                        }else
                            $single_price = $fetch['price'];
                    }else
                        die(json_encode(array("error"=>"Not enaugh product in stock")));
                }
            }else{
                if ($fetch['in_stock']>=$getvars['quantity'] && ($getvars['quantity']*$getvars['sub_quantity'])>=1) {
                        
                        if ($basket=="cart") {
                            mysql_query("UPDATE user_cart SET quantity='".$getvars['quantity']."', sub_quantity='".$getvars['sub_quantity']."' WHERE user_id='".mysql_real_escape_string($_SESSION['userID'])."' AND item_id='".$getvars['item_id']."'") or die(json_encode(array("error"=>"Something went wrong")));
                        }elseif ($basket=="whishlist") {
                            mysql_query("UPDATE user_whishlist SET quantity='".$getvars['quantity']."', sub_quantity='".$getvars['sub_quantity']."' WHERE user_id='".mysql_real_escape_string($_SESSION['userID'])."' AND item_id='".$getvars['item_id']."'") or die(json_encode(array("error"=>"Something went wrong")));
                        }
                        $sale = $this->getSale($getvars['item_id']);
                        if ($sale>0) {
                            $single_price = $fetch['price'] - ($fetch['price']*$sale/100); //sales
                        }else
                            $single_price = $fetch['price'];
                    }else
                        die(json_encode(array("error"=>"Not enaugh product in stock")));
            }
        }
        die(json_encode(array("message"=>"success","items"=>$getCartItems,"single_price"=>round($single_price))));
    }

    public function updateMainCart($param=""){
        if (!isset($_POST['basket'])) {
            $basket = $param;
            $json = false;
        }else{
        	$json = true;
            $basket = (string) $_POST['basket'];
        }
        $total_cost =0;
        if(Helper::logged()):
            $getCartItems = array();
            $query = mysql_query("SELECT * FROM user_".$basket." WHERE user_id='".$_SESSION['userID']."'") or Helper::Error();
            while($rows =   mysql_fetch_array($query)){
                $getCartItems[] = $rows;
            }
            
        else:
            $getCartItems = json_decode($_COOKIE[$basket],true);
        endif;
        foreach ($getCartItems as $cart ) {
            $check_price = mysql_query("SELECT * FROM prices WHERE item_id='".$cart['item_id']."' AND quantity = '".mysql_real_escape_string($cart['sub_quantity'])."'") or die("Can't connect");
            $fetch = mysql_fetch_array($check_price);
            $sale = $this->getSale($cart['item_id']);
            if ($sale>0) {
                //sales
                $total_cost+= round(($fetch['price']-($fetch['price']*$sale/100)))*$cart['quantity'];
            }else
                $total_cost+= ($fetch['price']*$cart['quantity']);
        }
        if ($json==false) {
        	return array("message"=>"success","total_cost"=>round($total_cost));
        }else
			die(json_encode(array("message"=>"success","total_cost"=>round($total_cost))));
    }
    public function getMainCart($basket){
        if(Helper::logged()):
            $query = mysql_query("SELECT * FROM user_".$basket." WHERE user_id='".$_SESSION['userID']."'") or die("Can't connect");
            while ($fetch = mysql_fetch_assoc($query)) {
                $fetchAll[] = $fetch;
            }
            return $fetchAll;
        else:
            return json_decode($_COOKIE[$basket],true);
        endif;
    }

    public function moveItemCart(){
        echo "hello world";
    }
}

 ?>