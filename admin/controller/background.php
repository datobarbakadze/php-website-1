<?php 
/**
* 
*/
class background
{
	
	function add_background()
	{
		if (isset($_POST['add_background'])) {
				$background = mysql_real_escape_string($_POST['background']);
				$file = $_FILES['file'];
				$back_check = mysql_query("SELECT * FROM background_images WHERE name='$background'") or die("Can't connect");
				if (mysql_num_rows($back_check)>0) {
					$fetch = mysql_fetch_array($back_check);
					$image = $fetch['image'];
					unlink("../images_background/".$image);
					mysql_query("DELETE FROM background_images WHERE name='$background'") or die("Can't connect");
				}

				//main image file
				$tmp = $file['tmp_name'];
				$name = $file['name'];
				$file_name = str_shuffle("qwertyuiopasdfghj123456");
				$type = substr($file['type'], 6);
				$rand_num = rand(1,50000);
				$path = "../images_background/".$file_name."_".$rand_num.".".$type;

				if (move_uploaded_file($tmp,$path)) {
					# code...
					$fullname = $file_name."_".$rand_num.".".$type;
					mysql_query("INSERT INTO background_images VALUES(NULL,'$fullname','$background')") or die("Can't connect");
					echo "success";
					header('Refresh: 0');
				}else
					echo "Can't upload file";
		}
		
	}

	function get_background(){
		$query = mysql_query("SELECT * FROM backgrounds") or die("Can't connect");
		$arr = [];
		while ($fetch = mysql_fetch_assoc($query)) {
			array_push($arr, $fetch);
		}
		return $arr;
	}

	function get_images(){
		$query = mysql_query("SELECT bi.*, b.* FROM background_images bi LEFT JOIN backgrounds b ON bi.name = b.name") or die("Can't connect");
		$arr = [];
		while ($fetch = mysql_fetch_assoc($query)) {
			array_push($arr, $fetch);
		}
		return $arr;
	}
}
 ?>

