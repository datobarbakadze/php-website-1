
<?php include "../connect.php" ?>
<?php 
	if (!empty($_POST['item_id']) && ($_POST['type']==0 || $_POST['type']==1)) {
		$type = (int) mysql_real_escape_string($_POST['type']);
		$item_id = (int) mysql_real_escape_string($_POST['item_id']);
		$ip = mysql_real_escape_string($_SERVER['REMOTE_ADDR']); 

		$check = mysql_query("SELECT * FROM like_dislike WHERE item_id='$item_id' AND visitor_ip='$ip'") or die(mysql_error());
		if (mysql_num_rows($check)>0) {
			$check_fetch = mysql_fetch_array($check);
			$existed_type = $check_fetch['type'];
			if ($type==$existed_type) {
				mysql_query("DELETE FROM like_dislike WHERE item_id='$item_id' AND visitor_ip='$ip'") or die(mysql_error());
			}elseif ($type!=$existed_type) {
				mysql_query("DELETE FROM like_dislike WHERE item_id='$item_id' AND visitor_ip='$ip' AND type='$existed_type'") or die(mysql_error());
				mysql_query("INSERT INTO like_dislike VALUES(NULL,'$type','$item_id',NOW(),'$ip')") or die(mysql_error());
			}
		}else{
			mysql_query("INSERT INTO like_dislike VALUES(NULL,'$type','$item_id',NOW(),'$ip')") or die(mysql_error());
		}
		
		$count_likes = mysql_query("SELECT * FROM like_dislike WHERE item_id='$item_id' AND type=1") or die(mysql_error());
		$count_dislikes = mysql_query("SELECT * FROM like_dislike WHERE item_id='$item_id' AND type=0") or die(mysql_error());
		echo json_encode(array("like"=>mysql_num_rows($count_likes),"dislike"=>mysql_num_rows($count_dislikes))) ;
	}else{
		echo "YOUR ARE DOING SOMETHING WORNG";
	}

?>