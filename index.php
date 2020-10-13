<?php ob_start(); ?>
<?php session_start(); 
?>
<?php //include "./libs/lang.php" ?>
<?php 
include "./libs/connect.php";

include "./libs/functions.php";
include "./libs/conf.php";
//include "./libs/lang.php";


if (helper::ajax()==true): 

	include "./libs/bootstrap.php";

elseif (helper::ajax()==false): 

	include "./libs/backgrounds.php";
 	include "./views/bars/head.php";

 	include "./views/bars/header.php";
    include "./libs/bootstrap.php";
 	//include "./views/bars/nav.php";

 	include "./views/bars/footer.php";

endif;
?>