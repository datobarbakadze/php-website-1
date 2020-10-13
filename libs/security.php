<?php
	function is_logged_in(){
		if(isset($_SESSION['id'])){
			header('Location: /');
		}
	}
	
	function not_logged_in(){
		if(!isset($_SESSION['id'])){
			header('Location: /');
		}
	}
?>