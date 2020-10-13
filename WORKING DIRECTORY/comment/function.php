<?php include "../connect.php" ?>

<?php 

if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['comment']) && !empty($_POST['item_id'])) {
	$name = mysql_real_escape_string($_POST['name']);
	$email = mysql_real_escape_string($_POST['email']);
	$comment = mysql_real_escape_string($_POST['comment']);
	$item_id = (int) mysql_real_escape_string($_POST['item_id']);
	$ip = mysql_real_escape_string($_SERVER['REMOTE_ADDR']); 
	$check = mysql_query("SELECT * FROM comment WHERE comment='$comment' AND item_id='$item_id'") or die(mysql_error());
	if (mysql_num_rows($check)>0) {
		echo "failed! Sorry comment already exists!";
	}else{
		mysql_query("INSERT INTO comment VALUES('','$item_id','$name','$email','$comment',NOW(),'$ip',0)") or die(mysql_error());
		echo "success! Your comment will be hold on review for next 6 hours!";	
	}
	
	

}else{
	echo "You did not fill all of the fields";
}
	
?>