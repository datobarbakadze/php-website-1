
<?php
error_reporting(E_ALL);
 session_start(); 
ob_start();
$_SESSION['KCFINDER'] = array(
    'disabled' => false
);
?>
<?php include "../libs/connect.php";?>
 	<?php include "../libs/createsitemap.php"; ?>
<?php include "./security.php";
	$sec->not_logged_in();
?>


<?php require "../libs/conf.php"; ?>
<?php 
header('Content-Type: text/html; charset=utf-8');
 ?>
<?php include "../libs/image.php";?>
<?php include "./libs/functions.php" ?>
	<?php include "./views/bars/head.php"; ?>
	<div class="search_image"></div>
</div>

	<?php include "./views/bars/nav.php"; ?>
	<div class="error_bar white_it"></div>

	<?php include "./libs/bootstrap.php"; ?>
</body>
</html>