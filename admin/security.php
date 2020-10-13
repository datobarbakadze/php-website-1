<?php 
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
class secure{
	public function ses(){

		$aurl = mysql_real_escape_string($_GET['aurl']);
		$aurl = rtrim($aurl, '/');
		$aurl = explode('/', $aurl);
		if(!isset($_SESSION['user_id']) && isset($aurl[1])){
			header('Location: /admin/');
		}else if(isset($_SESSION['user_id']) && !isset($aurl[1])){
			header('Location: /admin/product');
		}

	}
	public function not_logged_in(){
		$aurl = mysql_real_escape_string($_GET['aurl']);
		$aurl = rtrim($aurl, '/');
		$aurl = explode('/', $aurl);
		if(!isset($_SESSION['user_id']) && $aurl[0] or $aurl[0]=="ajax.php"){
			header('Location: /admin/');
		}
	}
}
$sec = new secure();
 ?>
