<?php include "../connect.php" ?>

<?php 

if (!empty($_POST['name']) && !empty($_POST['rating']) && !empty($_POST['review']) && !empty($_POST['item_id'])) {
	$item_id = (int) mysql_real_escape_string($_POST['item_id']); 
	$name = mysql_real_escape_string($_POST['name']); 
	$rating = (int) mysql_real_escape_string($_POST['rating']); 
	$review = mysql_real_escape_string(strip_tags($_POST['review']));
	$ip = mysql_real_escape_string($_SERVER['REMOTE_ADDR']); 
	$check = mysql_query("SELECT * FROM review WHERE item_id='$item_id' AND visitor_ip='$ip'") or die(mysql_error());
	if (mysql_num_rows($check)==0) {
		mysql_query("INSERT INTO review VALUES('','$item_id','$name', '$rating','$review', NOW(), '$ip',0)") or die(mysql_error());
		echo "success! Your review is held on review";
	}else{
		echo "fail! you have already written a review";
	}
}else{
	echo "fail! you did not filled all the fields";
}

?>