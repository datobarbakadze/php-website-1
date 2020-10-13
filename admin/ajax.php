<?php 
session_start();
require "../libs/connect.php";
require "../libs/image.php";
header('Content-Type: text/html; charset=utf-8');
if(!isset($_SESSION['user_id']) or !isset($_GET['func'])){
	header('Location: /admin/');
}else{
$func = mysql_real_escape_string($_GET['func']);

		class ajax extends Image{
			// get categories
			
			function get_cats(){
				header('Content-Type: application/json');
				$query = mysql_query("SELECT * FROM category") OR die("Ca't connect");
				$arr = [];
				while ($fetch = mysql_fetch_assoc($query)) {
					array_push($arr, $fetch);
				}
				echo json_encode($arr);
			}

			//delete article
			function delete_blog(){
				if (isset($_POST['id'])) {
					$id = mysql_real_escape_string($_POST['id']);
					$query = mysql_query("SELECT image FROM blog_images WHERE blog_id='$id'") or die("Can't connect");
					$fetch = mysql_fetch_array($query);
					$imageName = $fetch['image'];
					//unlinking
					unlink("../blog_images/".$imageName);
					unlink("../blog_images/s_".$imageName);
					unlink("../blog_images/m_".$imageName);
					unlink("../blog_images/t_".$imageName);
					//deleting
					mysql_query("DELETE FROM blog_images WHERE blog_id='$id'") or die("Can't connect");
					mysql_query("DELETE FROM blog WHERE id='$id'") or die("Can't connect");
					echo "success";
				}
			}

			
			
			//delete price function
			function delete_price(){
				if($_POST['id']){
					$id = $_POST['id'];
					mysql_query("DELETE FROM prices WHERE id='$id'") or die("Can't connect");
					echo "success";
				}else{
					echo "fail";
				}
			}

			


			

				//delte tour
				function deleteTour(){
					//deleting image
					$id = (int) mysql_real_escape_string($_POST['id']);
					$image_query = mysql_query("SELECT * FROM tour WHERE id='$id'") or die("Can't connect");
					$image_fetch = mysql_fetch_array($image_query);
					$gallery_query = mysql_query("SELECT * FROM tour_gallery WHERE tour_id='$id'") or die(mysql_error());
					while ( $gallery_fetch = mysql_fetch_array($gallery_query)) {
						unlink("../gallery/".$gallery_fetch['tour_image']);
						mysql_query("DELETE FROM tour_gallery WHERE id='".$gallery_fetch['id']."'") or die(mysql_error());
					}
					
					unlink("../main_image/".$image_fetch['main_image']);

					//deleteing prices
					mysql_query("DELETE FROM prices WHERE tour_id='$id'") or die("Can't connects");
					//deleting activity and inclusions of tour
					//best tour
					$best_query = mysql_query("SELECT * FROM best_tour WHERE tour_id='$id'") or die("Can't connectf");
					if (mysql_num_rows($best_query)==1) {
						mysql_query("DELETE FROM best_tour WHERE tour_id='$id'") or die("Can't connectff");
					}
					mysql_query("DELETE FROM tour_to_cat WHERE tour_id='$id'") or die("Can't connectg");

					mysql_query("DELETE FROM tour WHERE id='$id'") or die("Can't connectgg");

					echo "success";
				}

			//updating lang variables
			function update_lang(){
				$id = mysql_real_escape_string($_POST['id']);
				$word = mysql_real_escape_string($_POST['word']);
				$query = mysql_query("UPDATE lang SET word='$word' WHERE id='$id'") or die("Cant connect");
				if($query){
					echo "success";
				}

			}
			
			//inserting lang variables
			function insert_lang(){
				$lang = mysql_real_escape_string($_POST['lang']);
				$word = mysql_real_escape_string($_POST['word']);
				$query = mysql_query("INSERT INTO lang VALUES(NULL, '$lang', '$word')") or die("Can't connect");
				if($query){
					echo "success";
				}

			}
			

			//updating page title and the description
			function submit_page(){
				if($_POST['id'] && !empty($_POST['title']) && !empty($_POST['desc'])){

					$id = (int) mysql_real_escape_string($_POST['id']);
					$title = mysql_real_escape_string($_POST['title']);
					$desc = mysql_real_escape_string($_POST['desc']);
					mysql_query("UPDATE pages SET page_title='$title',
						page_description='$desc'
						WHERE id='$id'
						") or die("Can't connect");
					echo "success";
				}
			}

			//update review
			function add_comment(){
				$file = $_FILES['file'];
				$desc = $_REQUEST['comm_desc'];
				$tmp = $file['tmp_name'];
				$name = $file['name'];
				$file_name = str_shuffle("qwertyuiopasdfghj123456");
				$type = substr($file['type'], 6);
				$rand_num = rand(1,50000);
				$path = "../images/".$file_name."_".$rand_num.".".$type;
				$full_file_name = $file_name."_".$rand_num.".".$type;
				$thumbpath = "../comment_image/";
				move_uploaded_file($tmp,$path);
				$this->createThumb($path, $thumbpath, FALSE, 400, 400, false, $quality = 72);
				unlink($path);
				$insert = mysql_query("INSERT INTO reviews VALUES(NULL,'$desc','$full_file_name')") or die("Can't connect");
				echo "success";
			}
			//add image
			function add_image(){
				$xhr = $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'; 
				$day = $_REQUEST['day'];
				$menu = $_REQUEST['menu'];
				$file = $_FILES['image'];
				$tmp = $file['tmp_name'];
				$name = $file['name'];
				$file_name = str_shuffle("qwertyuiopasdfghj123456");
				$type = substr($file['type'], 6);
				$rand_num = rand(1,50000);
				$full_file_name = $file_name."_".$rand_num.".".$type;
				$path = "../images/".$full_file_name;
				move_uploaded_file($tmp,$path);
				
				$thumbpath = "../day_thumbs/";
				$inner_thumb = "../day_images/";
				$this->createThumb($path, $thumbpath, FALSE, 400, 400, false, $quality = 72);
				$this->createThumb($path, $inner_thumb, FALSE, 1280, 720, false, $quality = 72);
				unlink($path);
				$insert = mysql_query("INSERT INTO images VALUES(NULL,'$full_file_name','$day','$menu')") or die("Can't connect");
				$query = mysql_query("SELECT * FROM images ORDER BY id DESC") or die("Can't connect");
				$fetch = mysql_fetch_array($query);
				$id=$fetch['id'];
				echo "success+".$full_file_name."+".$id;
			}
			function add_main(){
				if ($_POST['add_main']) {
					$menu = mysql_real_escape_string($_POST['menu']);
					$path = "../images/";
					$file_name = str_shuffle("qwertyuiopasdfghj123456");
					$inner_thumb = "../product_image/";
				    $path = $path . $file_name ."_".basename( $_FILES['file']['name']);
				    $full_name = $file_name ."_".basename( $_FILES['file']['name']);
				    if(move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
				      echo "The file ".  basename( $_FILES['file']['name']). 
				      " has been uploaded";
				      $this->createThumb($path, $inner_thumb, FALSE, 1280, 720, false, $quality = 72);
				      unlink($path);
				      mysql_query("UPDATE prduct SET main_image='$full_name' WHERE name='$menu'") or die("can't connect");
				      header("Location: /admin/product");
				    } else{
				        echo "There was an error uploading the file, please try again!";
				    }
				    
				}
				    
			}

			function bg_image(){
				if ($_POST['add_page']) {
					$page = mysql_real_escape_string($_POST['page']);
					$path = "../bg_image/";
					$file_name = str_shuffle("qwertyuiopasdfghj123456");
				    $path = $path . $file_name ."_".basename( $_FILES['file']['name']);
				    $full_name = $file_name ."_".basename( $_FILES['file']['name']);
				    if(move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
				      echo "The file ".  basename( $_FILES['file']['name']). 
				      " has been uploaded";
				      mysql_query("UPDATE pages SET image='$full_name' WHERE page_name='$page'") or die("can't connect");
				      header("Location: /admin/bg_img");
				    } else{
				        echo "There was an error uploading the file, please try again!";
				    }
				    
				}
			}
			function delete_image(){
				$id=(int) mysql_real_escape_string($_POST['id']);
				$query = mysql_query("SELECT * FROM images WHERE id='$id'") or die("cant connect");
				$fetch = mysql_fetch_array($query);
				$image = $fetch['image'];
				unlink("../day_thumbs/".$image);
				unlink("../day_images/".$image);
				mysql_query("DELETE FROM images WHERE id='$id'") or die("Can't connect");
				echo "success";
			}

			//update review
			function delete_coment(){
				if(isset($_REQUEST['id'])){

					$id = (int) mysql_real_escape_string($_REQUEST['id']);
					$query = mysql_query("SELECT * FROM reviews WHERE id='$id'") or die("Cant connect");
					$fetch = mysql_fetch_array($query);
					$image = $fetch['image'];
					if(unlink("../comment_image/".$image)){}
					mysql_query("DELETE FROM reviews WHERE id='$id' ") or die("Can't connect");
					echo "success";
				}
			}

			//change comment status
			function commentChange(){
				if (isset($_POST['id']) && isset($_POST['action']) && isset($_POST['table'])) {
							$id = (int) mysql_real_escape_string($_POST['id']);
							$table = mysql_real_escape_string(htmlentities($_POST['table']));
							$action = mysql_real_escape_string(htmlentities($_POST['action']));
							if ($table=="comment") {
								$q_string = "UPDATE comment";
							}elseif ($table == "comment_reply") {
								$q_string = "UPDATE comment_reply";
							}

							if ($action == "check") {
								$q_string .= " SET status = 1";
							}elseif ($action == "undo") {
								$q_string .= " SET status = 0";
							}elseif ($action=="delete") {
								$q_string .= " SET status = 2";
							}
							$q_string .= " WHERE id='$id'";
							mysql_query($q_string) or die("Can't connect");
							echo "success";

				}else
					echo "Error!";
			}


			//ADD SLIDER IMAGE
			function addSlide(){
				isset($_POST['publish']) ? 1 : $_POST['publish'] = 0;
				$published = (int) mysql_real_escape_string($_POST['publish']);
				$url = mysql_real_escape_string($_POST['url']);
				$ordering = mysql_real_escape_string($_POST['order']);
				$main_title = mysql_real_escape_string($_POST['main_title']); 
				$sub_title1 = mysql_real_escape_string($_POST['sub_title1']); 
				$sub_title2 = mysql_real_escape_string($_POST['sub_title2']); 
				$file = $_FILES['file'];
				//main image file
				$tmp = $file['tmp_name'];
				$name = $file['name'];
				$file_name = str_shuffle("qwertyuiopasdfghj123456");
				$type = substr($file['type'], 6);
				$rand_num = rand(1,50000);
				$path = "../slider/".$file_name."_".$rand_num.".".$type;
				if (move_uploaded_file($tmp,$path)) {
					# code...
					$fullname = $file_name."_".$rand_num.".".$type;
					mysql_query("INSERT INTO slides VALUES(NULL,'$fullname','$url','$published','$ordering','$main_title','$sub_title1','$sub_title2')") or die("Can't connect");
					echo "success";
				}else
					echo "Fail failed";
			}
			//UPDATE SLIDER
			function updateSlide(){
				if (isset($_POST['id'])) {
					$id = (int) mysql_real_escape_string($_POST['id']);
					isset($_POST['publish']) ? 1 : $_POST['publish'] = 0;
					$published = (int) mysql_real_escape_string($_POST['publish']);
					$url = mysql_real_escape_string($_POST['url']);
					$ordering = mysql_real_escape_string($_POST['order']);
					$main_title = mysql_real_escape_string($_POST['main_title']); 
					$sub_title1 = mysql_real_escape_string($_POST['sub_title1']); 
					$sub_title2 = mysql_real_escape_string($_POST['sub_title2']); 
					if (isset($_FILES['file'])) {
						$file = $_FILES['file'];
						//main image file
						$tmp = $file['tmp_name'];
						$name = $file['name'];
						$file_name = str_shuffle("qwertyuiopasdfghj123456");
						$type = substr($file['type'], 6);
						$rand_num = rand(1,50000);
						$path = "../slider/".$file_name."_".$rand_num.".".$type;
						if (move_uploaded_file($tmp,$path)) {
							# code...
							$fullname = $file_name."_".$rand_num.".".$type;
							$get_image_query = mysql_query("SELECT image FROM slides WHERE id='$id'") or die("Can't connect");
							$fetch = mysql_fetch_array($get_image_query);
							unlink("../slider/".$fetch['image']);
							mysql_query("UPDATE slides SET image='$fullname' WHERE id='$id'") or die("can't connect");
						}else
							echo "Fail failed";
					}
					mysql_query("UPDATE slides SET 
						url = '$url',
						order_num = '$ordering',
						published = '$published',
						main_title = '$main_title',
						sub_title1 = '$sub_title1',
						sub_title2 = '$sub_title2' WHERE id='$id'
					") or die("Can't connect");

					echo "success";
				}
			}

			//DELETE SLIDER IMAGE
			function deleteSlide(){
				if (isset($_POST['id'])) {
					$id = (int) mysql_real_escape_string($_POST['id']);
					$g_query = mysql_query("SELECT image FROM slides WHERE id='$id'") or die("Can't connect");
					$get_image = mysql_fetch_array($g_query);
					unlink("../slider/".$get_image['image']);
					mysql_query("DELETE FROM slides WHERE id='$id'") or die("Can't connessct");
					echo "success";
				}else
					echo "Error!";
			}

			function checkBest(){
				if (isset($_POST['id']) && isset($_POST['action'])) {
					$tour_id = (int) mysql_real_escape_string($_POST['id']);
					$action = mysql_real_escape_string($_POST['action']);
					if ($action == "mark") {
						mysql_query("INSERT INTO best_tour VALUES(NULL,'$tour_id')") or die("can't connect");
						echo "success";
					}elseif ($action == "unmark") {
						mysql_query("DELETE FROM best_tour WHERE tour_id = '$tour_id'") or die("Can't connect");
						echo "success";
					}else
					echo "error!";
				}else
					echo "error please contact developer";
			}

			function insertAction(){
				if (isset($_POST['tour_id']) && isset($_POST['option']) && isset($_POST['action'])) {
					$tour_id = $_POST['tour_id'];
					$option = $_POST['option'];
					$action = $_POST['action'];
					$query = mysql_query("SELECT * FROM activity_inclusion WHERE tour_id = '$tour_id' AND action_id='$option' AND type='$action'") or die("Can't connect");
					if (mysql_num_rows($query) == 0) {
						mysql_query("INSERT INTO activity_inclusion VALUES(NULL, '$option', '$action', $tour_id )") or die("Can't connect");
						echo "success";
					}else
						echo "failt";
					
				}else
					echo "Fail";
			}

			function deleteAction(){
				if (isset($_POST['id'])){
					$id = (int) $_POST['id'];
					$type= $_POST['type'];
					$tour_id = $_POST['tour_id'];
					$query = mysql_query("DELETE FROM activity_inclusion WHERE action_id = '$id' AND tour_id = '$tour_id' AND type='$type'") or die("Can't connect");
					echo "success";
				}else
					echo "fail";
			}

			function addincact(){
				$action_name = mysql_real_escape_string($_POST['name']);
				$value = mysql_real_escape_string($_POST['value']); 
				$table = mysql_real_escape_string($_POST['table']); 
				$file = $_FILES['file'];
				//main image file
				$tmp = $file['tmp_name'];
				$name = $file['name'];
				$file_name = str_shuffle("qwertyuiopasdfghj123456");
				$type = substr($file['type'], 6);
				$rand_num = rand(1,50000);
				$path = "../images_inclusion/".$file_name."_".$rand_num.".".$type;


				$file_white = $_FILES['file_white'];
				//main image file
				$tmp_white = $file_white['tmp_name'];
				$name_white = $file_white['name'];
				$file_name_white = str_shuffle("qwertyuiopasdfghj123456");
				$type_white = substr($file_white['type'], 6);
				$rand_num_white = rand(1,50000);
				$path_white = "../images_inclusion/white_".$file_name_white."_".$rand_num_white.".".$type_white;
				
				if (move_uploaded_file($tmp,$path) && move_uploaded_file($tmp_white,$path_white)) {
					# code...
					$fullname = $file_name."_".$rand_num.".".$type;
					$fullname_white = "white_".$file_name_white."_".$rand_num_white.".".$type_white;
					mysql_query("INSERT INTO $table VALUES(NULL,'$action_name','$value','$fullname','$fullname_white')") or die("Can't connect");
					echo "success";
				}else
					echo "Fail failed";
			}

			function delteteActorinc(){
				if (isset($_POST['id']) && isset($_POST['table'])) {
					$id = (int) mysql_real_escape_string($_POST['id']);
					$table = mysql_real_escape_string($_POST['table']);

					mysql_query("DELETE FROM $table WHERE id='$id'") or die("Can't connect");
					if ($table == "inclusions") {
						$type="i";
					}elseif ($table =="activities") {
						$type = "a";
					}
					mysql_query("DELETE FROM activity_inclusion WHERE action_id='$id' AND type='$type'") or die("Can't connect");
					echo "success";
				}else
					echo "fail";
			}

			//add team 
			function addTeam(){
				$f_name = mysql_real_escape_string($_POST['f_name']);
				$l_name = mysql_real_escape_string($_POST['l_name']); 
				$profesion = mysql_real_escape_string($_POST['profesion']); 
				$desc = mysql_real_escape_string($_POST['desc']); 
				$file = $_FILES['file'];
				//main image file
				$tmp = $file['tmp_name'];
				$name = $file['name'];
				$file_name = str_shuffle("qwertyuiopasdfghj123456");
				$type = substr($file['type'], 6);
				$rand_num = rand(1,50000);
				$path = "../images_team/".$file_name."_".$rand_num.".".$type;

				if (move_uploaded_file($tmp,$path)) {
					# code...
					$fullname = $file_name."_".$rand_num.".".$type;
					mysql_query("INSERT INTO team VALUES(NULL,'$f_name','$l_name','$profesion','$desc','$fullname')") or die("Can't connect");
					echo "success";
				}else
					echo "Fail failed";
			}

			//insert best team member
			function checkBestTeam(){
				if (isset($_POST['id']) && isset($_POST['action'])) {
					$team_id = (int) mysql_real_escape_string($_POST['id']);
					$action = mysql_real_escape_string($_POST['action']);
					$query = mysql_query("SELECT * FROM best_team") or die("Can't connect");
					if ($action == "mark") {
						if (mysql_num_rows($query)<3) {
							mysql_query("INSERT INTO best_team VALUES(NULL,'$team_id')") or die("can't connect");
							echo "success";
						}else
							echo "num fail";
					}elseif ($action == "unmark") {
						mysql_query("DELETE FROM best_team WHERE team_id = '$team_id'") or die("Can't connect");
						echo "success";
					}else
					echo "error!";
				}else
					echo "error please contact developer";
			}

			//delete team member
			function deleteTeam(){
				if (isset($_POST['id'])) {
					$team_id = (int) mysql_real_escape_string($_POST['id']);
					$check_best = mysql_query("SELECT * FROM best_team WHERE team_id = '$team_id'") or die("can't connect");
					if (mysql_num_rows($check_best)==1) {
						mysql_query("DELETE FROM best_team WHERE team_id = '$team_id'") or die("Can't connect");
					}
					$query = mysql_query("SELECT * FROM team WHERE id='$team_id'") or die("Can't connect");
					$fetch = mysql_fetch_array($query);
					unlink("../images_team/".$fetch['image']);
					mysql_query("DELETE FROM team WHERE id='$team_id'") or die("Can't connect");
					echo "success";
				}
			}

			//update team
			function updateTeam(){
				$id = mysql_real_escape_string($_POST['id']);
				$f_name = mysql_real_escape_string($_POST['f_name']);
				$l_name = mysql_real_escape_string($_POST['l_name']); 
				$profesion = mysql_real_escape_string($_POST['profesion']); 
				$desc = mysql_real_escape_string($_POST['desc']); 
				if (isset($_FILES['file'])) {
					$file = $_FILES['file'];
					//main image file
					$tmp = $file['tmp_name'];
					$name = $file['name'];
					$file_name = str_shuffle("qwertyuiopasdfghj123456");
					$type = substr($file['type'], 6);
					$rand_num = rand(1,50000);
					$path = "../images_team/".$file_name."_".$rand_num.".".$type;

					if (move_uploaded_file($tmp,$path)) {
						# code...
						$fullname = $file_name."_".$rand_num.".".$type;
						mysql_query("UPDATE team SET image='$fullname' WHERE id='$id'") or die("Can't connect");
					}else
						echo "Fail failed";
				}

				mysql_query("UPDATE team SET f_name = '$f_name',
					l_name='$l_name',
					profesion = '$profesion',
					description = '$desc' WHERE id='$id'
					") or die("Can't connect");
				echo "success";
				
			}

			//update fun info
			function AddInfo(){
				$title = mysql_real_escape_string($_POST['title']);
				$number = mysql_real_escape_string($_POST['number']);
				$measure = mysql_real_escape_string($_POST['measure']);
				$file = $_FILES['file'];
					//main image file
					$tmp = $file['tmp_name'];
					$name = $file['name'];
					$file_name = str_shuffle("qwertyuiopasdfghj123456");
					$type = substr($file['type'], 6);
					$rand_num = rand(1,50000);
					$path = "../images_info/".$file_name."_".$rand_num.".".$type;

					if (move_uploaded_file($tmp,$path)) {
						# code...
						$fullname = $file_name."_".$rand_num.".".$type;
						mysql_query("INSERT INTO fun_info VALUES(NULL, '$fullname','$number','$measure','$title')") or die("Can't connect");
						echo "success";
					}else
						echo "Fail failed";
				}

				//update fun info
				function updaateFun(){
					$id = mysql_real_escape_string($_POST['id']);
					$number = mysql_real_escape_string($_POST['number']);

					mysql_query("UPDATE fun_info SET numbers='$number' WHERE id='$id'") or die("Can't connect");
					echo "success";
				}

				//delete fun info
				function deleteFun(){
					$id = mysql_real_escape_string($_POST['id']);
					$query = mysql_query("SELECT * FROM fun_info WHERE id ='$id'") or die("Can;t connect");
					if (mysql_num_rows($query)==1) {
						$fetch = mysql_fetch_array($query);
						$image = $fetch['image'];
						unlink("../images_info/".$image);
						mysql_query("DELETE FROM fun_info WHERE id='$id'") or die("Can;t connect");
						echo  "success";
					}
				}

				//add category
				function add_cat(){
					$name_cat = mysql_real_escape_string($_POST['name']);
					$title = mysql_real_escape_string($_POST['title']);
					$type_cat = mysql_real_escape_string($_POST['type']);
					$description = mysql_real_escape_string($_POST['description']);

					$file = $_FILES['file'];
					//black icon
					$tmp = $file['tmp_name'];
					$name = $file['name'];
					$file_name = str_shuffle("qwertyuiopasdfghj123456");
					$type = substr($file['type'], 6);
					$rand_num = rand(1,50000);
					$path = "../images_category/".$file_name."_".$rand_num.".".$type;
					if (move_uploaded_file($tmp,$path)) {
						# code...
						$fullname = $file_name."_".$rand_num.".".$type;
						mysql_query("INSERT INTO category VALUES(NULL, '$name_cat','$title','$description','$fullname','$type_cat')") or die("Can't connect");
						echo "success";
					}else
						echo "Fail failed";

				}

				function add_review(){
					$name_review = mysql_real_escape_string($_POST['name']);
					$tripadvisor = mysql_real_escape_string($_POST['trivadvisor']);
					$review = mysql_real_escape_string($_POST['review']);

					$file = $_FILES['file'];
					//black icon
					$tmp = $file['tmp_name'];
					$name = $file['name'];
					$file_name = str_shuffle("qwertyuiopasdfghj123456");
					$type = substr($file['type'], 6);
					$rand_num = rand(1,50000);
					$path = "../images_reviews/".$file_name."_".$rand_num.".".$type;
					if (move_uploaded_file($tmp,$path)) {
						# code...
						$fullname = $file_name."_".$rand_num.".".$type;
						mysql_query("INSERT INTO reviews VALUES(NULL, '$name_review','$tripadvisor','$fullname','$review')") or die(mysql_error());
						echo "success";
						
					}else{
						mysql_query("INSERT INTO reviews VALUES(NULL, '$name_review','$tripadvisor','','$review')") or die(mysql_error());
						echo "success";
					}
					
				}

				//delte category

				function deleteCat(){
					$id = (int) mysql_real_escape_string($_POST['id']);
					$query = mysql_query("SELECT * FROM category WHERE id ='$id'") or die("Can;t connect");
					if (mysql_num_rows($query)==1) {
						$fetch = mysql_fetch_array($query);
						$icon = $fetch['icon'];
						$icon_white = $fetch['white_icon'];
						unlink("../images_category/".$icon);
						unlink("../images_category/".$icon_white);
						mysql_query("DELETE FROM category WHERE id='$id'") or die("Can;t connect");
						mysql_query("DELETE FROM tour_to_cat WHERE cat_id = '$id'") or die(mysql_error());
						echo  "success";
					}
				}

				//update Category
				function updateCat(){
					$id = (int) mysql_real_escape_string($_POST['id']);
					$name_cat = mysql_real_escape_string($_POST['name']);
					$title = mysql_real_escape_string($_POST['title']);
					$type_cat = mysql_real_escape_string($_POST['type']);
					$description = mysql_real_escape_string($_POST['description']);

					$query = mysql_query("SELECT * FROM category WHERE id ='$id'") or die("Can't connect");
					$fetch = mysql_fetch_array($query);

					if (isset($_FILES['file']) && !empty($_FILES['file'])) {
						unlink("../images_category/".$fetch['icon']);
						$file = $_FILES['file'];
						//black icon
						$tmp = $file['tmp_name'];
						$name = $file['name'];
						$file_name = str_shuffle("qwertyuiopasdfghj123456");
						$type = substr($file['type'], 6);
						$rand_num = rand(1,50000);
						$path = "../images_category/".$file_name."_".$rand_num.".".$type;
						if (move_uploaded_file($tmp,$path)){
							$fullname = $file_name."_".$rand_num.".".$type;
							mysql_query("UPDATE category SET icon = '$fullname' WHERE id='$id'") or die("Can't connects");
						}else
							echo "Fail failed";
					}

					if ($type_cat!=$fetch['type']) {
						mysql_query("DELETE FROM tour_to_cat WHERE cat_id='$id'") or die("Can't connectss");
					}

					
						# code...
						
						
						mysql_query("UPDATE category SET name='$name_cat',
							category_title = '$title',
							description = '$description',
							type = '$type_cat' WHERE id='$id'
							") or die("Can't connect");
						echo "success";
					

				}

				public function updatePage(){
					$id = (int) mysql_real_escape_string($_POST['id']);
					$link = mysql_real_escape_string($_POST['link']);
					$title = mysql_real_escape_string($_POST['title']);
					$description = mysql_real_escape_string($_POST['description']);
					$tags = mysql_real_escape_string($_POST['page_tags']);

					mysql_query("UPDATE pages SET link='$link',
						title='$title',
						description='$description',
						tags='$tags' WHERE id='$id'
					") or die("Can't connect");
					echo "success";
				}

				function addGallery(){
					$description = mysql_real_escape_string($_POST['description']);
					$file = $_FILES['file'];
					//black icon
					$tmp = $file['tmp_name'];
					$name = $file['name'];
					$file_name = str_shuffle("qwertyuiopasdfghj123456");
					$type = substr($file['type'], 6);
					$rand_num = rand(1,50000);
					$path = "../images_gallery/".$file_name."_".$rand_num.".".$type;
					if (move_uploaded_file($tmp,$path)) {
						$fullname = $file_name."_".$rand_num.".".$type;
						$this->createThumb($path, "../images_gallery/", "t_", 74, 74, true, $quality = 72);
					}else
						die("Error");
					mysql_query("INSERT INTO gallery VALUES(NULL,'$fullname','$description')") or die("Can't connect");
					echo "success";

				}

				//new design
				function deleteGallery(){
					$id = (int) mysql_real_escape_string($_POST['id']);
					$get = mysql_query("SELECT * FROM gallery WHERE id='$id'") or die("Can't connect");
					if (mysql_num_rows($get)>0) {
						$fetch = mysql_fetch_assoc($get);
						unlink('../images_gallery/'.$fetch['image']);
						unlink('../images_gallery/t_'.$fetch['image']);
					}
					mysql_query("DELETE FROM gallery WHERE id='$id'") or die("Can't connect");
					echo "success";
					
				}


				

				function add_inc(){
					$tour_id =(int) mysql_real_escape_string($_REQUEST['tour_id']);
					$text = mysql_real_escape_string($_REQUEST['text']);
					$check_query = mysql_query("SELECT * FROM inclusions WHERE inc_text='$text' AND tour_id='$tour_id'") or die("Can't connect");
					if (mysql_num_rows($check_query)==0) {
						mysql_query("INSERT INTO inclusions VALUES(NULL,'$tour_id','$text')") or die("Can't connect");
						echo "success";
					}else{
						echo "already";
					}
				}
				function add_disabled_date(){
					$tour_id =(int) mysql_real_escape_string($_REQUEST['tour_id']);
					$date = mysql_real_escape_string(htmlentities($_REQUEST['text']));
					$date = date('Y-m-d', strtotime($date));

					$check_query = mysql_query("SELECT * FROM tour_to_dates WHERE disabled_date='$date' AND tour_id='$tour_id'") or die("Can't connect");
					if (mysql_num_rows($check_query)==0) {
						mysql_query("INSERT INTO tour_to_dates VALUES(NULL,'$tour_id','$date')") or die("Can't connect");
						echo "success";
					}else{
						echo "already";
					}
				}
				

				function add_schedule(){
					$schedule_place = mysql_real_escape_string($_REQUEST['schedule_place']);
					$schedule_date = mysql_real_escape_string($_REQUEST['schedule_date']);
					$from_time = mysql_real_escape_string($_REQUEST['from_time']);
					$to_time = mysql_real_escape_string($_REQUEST['to_time']);
					$tour_id = (int) mysql_real_escape_string($_REQUEST['tour_id']);
					$query = mysql_query("SELECT * FROM tour_to_schedule WHERE tour_id='$tour_id' AND schedule_date='$schedule_date' AND schedule_place='$schedule_place' AND from_time='$from_time' AND to_time='$to_time'") or die("Can't connect");


					if (mysql_num_rows($query)==0) {
						mysql_query("INSERT INTO tour_to_schedule VALUES(NULL, '$tour_id','$schedule_date','$schedule_place','$from_time','$to_time')") or die(mysql_error());
						echo "success";
					}else{
						echo "fail";
					}
				}

				function add_faq(){
					$question = mysql_real_escape_string($_REQUEST['faq_question']);
					$answer = mysql_real_escape_string($_REQUEST['faq_answer']);
					$query = mysql_query("SELECT * FROM faq WHERE question='$question' OR answer='$answer'") or die(mysql_error());


					if (mysql_num_rows($query)==0) {
						mysql_query("INSERT INTO faq VALUES(NULL, '$question','$answer')") or die(mysql_error());
						echo "success";
					}else{
						echo "fail";
					}
				}

				function add_service(){
					$icon = mysql_real_escape_string($_REQUEST['service_icon']);
					$price = mysql_real_escape_string($_REQUEST['service_price']);
					$title = mysql_real_escape_string($_REQUEST['service_title']);
					
					$query = mysql_query("SELECT * FROM tour_services WHERE icon='$icon' AND price='$price' AND title='$title'") or die("Can't connect service database");


					if (mysql_num_rows($query)==0) {
						mysql_query("INSERT INTO tour_services VALUES(NULL, '$title','$icon','$price')") or die("Can't connect service database");
						echo "success";
					}else{
						echo "fail";
					}
				}

				//add facility into database
				function add_facility(){
					$icon = mysql_real_escape_string($_REQUEST['facility_icon']);
					$name = mysql_real_escape_string($_REQUEST['facility_title']);
					
					$query = mysql_query("SELECT * FROM tour_facility WHERE icon='$icon' AND name='$name'") or die("Can't connect facility database");


					if (mysql_num_rows($query)==0) {
						mysql_query("INSERT INTO tour_facility VALUES(NULL, '$name','$icon')") or die("Can't connect facility database");
						echo "success";
					}else{
						echo "fail";
					}
				}
				function serviceCheck(){
					if (isset($_POST['id']) && isset($_POST['action'])) {
					$id = (int) mysql_real_escape_string($_POST['id']);
					$tour_id = (int) mysql_real_escape_string($_POST['tour_id']);
					$action = mysql_real_escape_string($_POST['action']);
					if ($action == "mark") {
						mysql_query("INSERT INTO tour_to_services VALUES(NULL,'$tour_id','$id')") or die("can't connect");
						echo "success";
					}elseif ($action == "unmark") {
						mysql_query("DELETE FROM tour_to_services WHERE tour_id = '$tour_id' AND service_id='$id'") or die("Can't connect");
						echo "success";
					}else
					echo "error!";
				}else
					echo "error please contact developer";
				}

				function weekCheck(){
					if (isset($_POST['day_id']) && isset($_POST['action'])) {
					$day_id = (int) mysql_real_escape_string($_POST['day_id']);
					$tour_id = (int) mysql_real_escape_string($_POST['tour_id']);
					$action = mysql_real_escape_string($_POST['action']);
					if ($action == "mark") {
						mysql_query("INSERT INTO tour_to_disabled_days VALUES(NULL,'$tour_id','$day_id')") or die("can't connect");
						echo "success";
					}elseif ($action == "unmark") {
						mysql_query("DELETE FROM tour_to_disabled_days WHERE tour_id = '$tour_id' AND day_id='$day_id'") or die("Can't connect");
						echo "success";
					}else
					echo "error!";
				}else
					echo "error please contact developer";
				}

				function facilityCheck(){
					if (isset($_POST['id']) && isset($_POST['action'])) {
					$id = (int) mysql_real_escape_string($_POST['id']);
					$tour_id = (int) mysql_real_escape_string($_POST['tour_id']);
					$action = mysql_real_escape_string($_POST['action']);
					if ($action == "mark") {
						mysql_query("INSERT INTO tour_to_facility VALUES(NULL,'$tour_id','$id')") or die("can't connect");
						echo "success";
					}elseif ($action == "unmark") {
						mysql_query("DELETE FROM tour_to_facility WHERE tour_id = '$tour_id' AND facility_id='$id'") or die("Can't connect");
						echo "success";
					}else
					echo "error!";
				}else
					echo "error please contact developer";
				}
































































				/******************************** 

				this is a ganja website 

				*********************************/
				public function updateTour(){
				$id = (int) mysql_real_escape_string($_POST['item_id']);
				$item_query = mysql_query("SELECT * FROM item WHERE item_id='$id'") or die("Can't connect");
				$item_fetch = mysql_fetch_array($item_query);
					if (isset($_FILES['file'])) {
						if (file_exists("../uploads/main/".$item_fetch['main_image'])) {
							unlink("../uploads/main/".$item_fetch['main_image']);
						}
						if (file_exists("../uploads/main/s_".$item_fetch['main_image'])) {
							unlink("../uploads/main/s_".$item_fetch['main_image']);
						}
						$file = $_FILES['file'];
						//main image file
						$tmp = $file['tmp_name'];
						$name = $file['name'];
						$file_name = str_shuffle("qwertyuiopasdfghj123456");
						$type = substr($file['type'], 6);
						$rand_num = rand(1,50000);
						$path = "../uploads/main/".$file_name."_".$rand_num.".".$type;
						if (move_uploaded_file($tmp,$path)) {
							$fullname = $file_name."_".$rand_num.".".$type;
							$this::createThumb($path, '../uploads/main/', '', 1920, 1080, $crop = false, $quality = 90);
							$this::createThumb($path, '../uploads/main/', 's_', 500, 300, $crop = false, $quality = 50 );
							$this::watermark('../admin/views/watermark.png', '../main_image/'.$fullname, $quality = 90);
							mysql_query("UPDATE item SET main_image='$fullname' WHERE item_id='$id'") or die("Can't connect");
						};
					}
					/* defining a variables */
					
					$title = mysql_real_escape_string($_POST['item_title']);
					$description = mysql_real_escape_string(htmlentities($_POST['item_description']));
					$more_info = mysql_real_escape_string($_POST['more_info']);
					$thc = (int) mysql_real_escape_string($_POST['thc']);
					$cbd = (int) mysql_real_escape_string($_POST['cbd']);
					$yield_indoor_from = (int) mysql_real_escape_string($_POST['yield_indoor_from']);
					$yield_indoor_to = (int) mysql_real_escape_string($_POST['yield_indoor_to']);
					$yield_outdoor_from = (int) mysql_real_escape_string($_POST['yield_outdoor_from']);
					$yield_outdoor_to = (int) mysql_real_escape_string($_POST['yield_outdoor_to']);
					$height_indoor_from = (int) mysql_real_escape_string($_POST['height_indoor_from']);
					$height_indoor_to = (int) mysql_real_escape_string($_POST['height_indoor_to']);
					$height_outdoor_from = (int) mysql_real_escape_string($_POST['height_outdoor_from']);
					$height_outdoor_to = (int) mysql_real_escape_string($_POST['height_outdoor_to']);
					$flowering_time_from = (int) mysql_real_escape_string($_POST['flowering_time_from']);
					$flowering_time_to = (int) mysql_real_escape_string($_POST['flowering_time_to']);
					$sativa = (int) mysql_real_escape_string($_POST['sativa']);
					$indica = (int) mysql_real_escape_string($_POST['indica']);
					$ruderails = (int) mysql_real_escape_string($_POST['ruderails']);
					$in_stock = (int) mysql_real_escape_string($_POST['in_stock']);
					$cup_winer = (int) mysql_real_escape_string($_POST['cup_winer']);
					$price = (double) mysql_real_escape_string($_POST['price']);
					$sale = (double) mysql_real_escape_string($_POST['sale']);
					$url = mysql_real_escape_string($_POST['item_url']);
					/* variatns */$variant_input = split(',', mysql_real_escape_string($_POST['variant_input'])); //variant variable which is splited by ',' for future use down here
					$status = (int) mysql_real_escape_string($_POST['status']);
					$category = (int) mysql_real_escape_string($_POST['category']);


					/* updating query for item trable in the database */
					mysql_query("UPDATE item 
						SET title = '$title',
						description = '$description',
						more_info = '$more_info',
						category = '$category',
						thc = '$thc',
						cbd = '$cbd',
						yield_indoor_from = '$yield_indoor_from',
						yield_indoor_to = '$yield_indoor_to',
						yield_outdoor_from = '$yield_outdoor_from',
						yield_outdoor_to = '$yield_outdoor_to',
						height_indoor_from = '$height_indoor_from',
						height_indoor_to = '$height_indoor_to',
						height_outdoor_from = '$height_outdoor_from',
						height_outdoor_to = '$height_outdoor_to',
						flowering_time_from = '$flowering_time_from',
						flowering_time_to = '$flowering_time_to',
						sativa = '$sativa',
						indica = '$indica',
						ruderails = '$ruderails',
						in_stock = '$in_stock',
						cup_winner = '$cup_winer',
						url = '$url',
						price='$price',
						sale='$sale',
						status = '$status',
						create_date = NOW()
						WHERE item_id='$id'
					") OR die("CANT' CONNECT");
					mysql_query("DELETE FROM item_variants WHERE item_id='$id'") or die(mysql_error());
					if (!empty($variant_input[0])) {
						foreach ($variant_input as $attr_var ) {
							// our data looks like this [attr_id-variant_id] so we need to split on dash
							$attr_id = split('-', $attr_var)[0];
							$variant_id = split('-', $attr_var)[1];
							
							mysql_query("INSERT INTO item_variants VALUES('','$id','$variant_id','$attr_id')") or die(mysql_error());
						}
					}

					echo "success";

				}

				function update_attr(){
					$id = (int) mysql_real_escape_string($_POST['item_id']);
					$title = mysql_real_escape_string($_POST['attr_title']);
					$description = mysql_real_escape_string(htmlentities($_POST['attr_description']));
					/* updating query for item trable in the database */
					
					mysql_query("UPDATE attrs 
					SET attr_title = '$title',
					attr_desc = '$description'
					WHERE id='$id'
					") OR die("can't connect");
					echo "success";
					
					
				}


				function update_variant(){
					$id = (int) mysql_real_escape_string($_POST['item_id']);

					$attr_id = (int) mysql_real_escape_string($_POST['attr_id']);
					$title = mysql_real_escape_string($_POST['variant_title']);
					$description = mysql_real_escape_string(htmlentities($_POST['varaint_description']));
					/* updating query for item trable in the database */
					$item_query = mysql_query("SELECT * FROM attrs_variants WHERE id='$id'") or die(mysql_error());
					$item_fetch = mysql_fetch_array($item_query);
					if (isset($_FILES['file'])) {
						if (file_exists("../uploads/variants/".$item_fetch['image'])) {
							unlink("../uploads/variants/".$item_fetch['image']);
						}
						$file = $_FILES['file'];
						//main image file
						$tmp = $file['tmp_name'];
						$name = $file['name'];
						$file_name = str_shuffle("qwertyuiopasdfghj123456");
						$type = substr($file['type'], 6);
						$rand_num = rand(1,50000);
						$path = "../uploads/variants/".$file_name."_".$rand_num.".".$type;
						if (move_uploaded_file($tmp,$path)) {
							$fullname = $file_name."_".$rand_num.".".$type;
							mysql_query("UPDATE attrs_variants SET image='$fullname' WHERE id='$id'") or die(mysql_error());
						};
					}

					mysql_query("UPDATE attrs_variants 
					SET attr_id = '$attr_id',
					variant_title = '$title',
					variant_desc = '$description'
					WHERE id='$id'
					") OR die(mysql_error());
					echo "success";
				}

				function update_category(){
					$id = (int) mysql_real_escape_string($_POST['item_id']);

					$title = mysql_real_escape_string($_POST['cat_title']);
					$description = mysql_real_escape_string(htmlentities($_POST['cat_description']));
					$cat_type = (int) mysql_real_escape_string($_POST['cat_type']);
					/* updating query for item trable in the database */
					$item_query = mysql_query("SELECT * FROM category WHERE id='$id'") or die(mysql_error());
					$item_fetch = mysql_fetch_array($item_query);
					if (isset($_FILES['file'])) {
						if (file_exists("../uploads/category/".$item_fetch['icon'])) {
							unlink("../uploads/category/".$item_fetch['icon']);
						}
						$file = $_FILES['file'];
						//main image file
						$tmp = $file['tmp_name'];
						$name = $file['name'];
						$file_name = str_shuffle("qwertyuiopasdfghj123456");
						$type = substr($file['type'], 6);
						$rand_num = rand(1,50000);
						$path = "../uploads/category/".$file_name."_".$rand_num.".".$type;
						if (move_uploaded_file($tmp,$path)) {
							$fullname = $file_name."_".$rand_num.".".$type;
							mysql_query("UPDATE category SET icon='$fullname' WHERE id='$id'") or die(mysql_error());
						};
					}

					mysql_query("UPDATE category 
					SET cat_title = '$title',
					cat_description = '$description',
					type = '$cat_type'
					WHERE id='$id'
					") OR die(mysql_error());
					echo "success";
				}

				function just_delete(){
					$table = mysql_real_escape_string($_REQUEST['table']);
					$id = (int) mysql_real_escape_string($_REQUEST['id']);
					if (isset($_POST['imageCol'])) {
						$image_col = mysql_real_escape_string($_POST['imageCol']);
						$query = mysql_query("SELECT * FROM blog WHERE id='$id'") or die("Can't connect");
						$fetch = mysql_fetch_array($query);
						$image = $fetch[$image_col];
						if (file_exists("../uploads/$table/$image")) {
							unlink("../uploads/$table/$image");
							if (file_exists("../uploads/$table/s_".$image."")) {
								unlink("../uploads/$table/s_".$image."");
							}
							if (file_exists("../uploads/$table/m_".$image."")) {
								unlink("../uploads/$table/m_".$image."");
							}
							if (file_exists("../uploads/$table/t_".$image."")) {
								unlink("../uploads/$table/t_".$image."");
							}
						}
					}
					mysql_query("DELETE FROM $table WHERE id='$id' ") or die(mysql_error());
					echo "success";
				}


				function update_blog(){



					$id = (int) mysql_real_escape_string($_POST['item_id']);
					//iamge realted staff down here 
					$item_query = mysql_query("SELECT * FROM blog WHERE id='$id'") or die(mysql_error());
					$item_fetch = mysql_fetch_array($item_query);
					if (isset($_FILES['file'])) {
						if (file_exists("../uploads/blog/".$item_fetch['image'])) {
							unlink("../uploads/blog/".$item_fetch['image']);
						}
						$file = $_FILES['file'];
						//main image file
						$tmp = $file['tmp_name'];
						$name = $file['name'];
						$file_name = str_shuffle("qwertyuiopasdfghj123456");
						$type = substr($file['type'], 6);
						$rand_num = rand(1,50000);
						$path = "../uploads/blog/".$file_name."_".$rand_num.".".$type;
						if (move_uploaded_file($tmp,$path)) {
							$fullname = $file_name."_".$rand_num.".".$type;
							$this::createThumb($path, '../uploads/blog/', '', 1920, 1080, $crop = false, $quality = 90);
							$this::createThumb($path, '../uploads/blog/', 's_', 500, 300, $crop = false, $quality = 90 );
							mysql_query("UPDATE blog SET image='$fullname' WHERE id='$id'") or die(mysql_error());
						};
					}
					//end of iamge related staff 
					$title = mysql_real_escape_string($_POST['item_title']);
					$url = mysql_real_escape_string($_POST['item_url']);
					$description = mysql_real_escape_string($_POST['blog_description']);
					$category = (int) mysql_real_escape_string($_POST['category']);
					$status = (int) mysql_real_escape_string($_POST['status']);
					$tags = mysql_real_escape_string($_POST['blog_tags']);
					
					/* updating query for item trable in the database */
					mysql_query("UPDATE blog 
						SET title = '$title',
						url = '$url',
						description = '$description',
						category = '$category',
						status = '$status',
						update_date = NOW()
						WHERE id='$id'
					") OR die(mysql_error());
					mysql_query("DELETE FROM blog_tags WHERE item_id='$id'") or die(mysql_error());
					if (!empty($tags)) {
						$tags = split(',', $tags);
						foreach ($tags as $tag) {
							mysql_query("INSERT INTO blog_tags VALUES('','$tag','$id')") or die(mysql_error());
						}
					}

					echo "success";
				}	
				function review_status(){
					if (isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['status']) && !empty($_POST['status'])) {
						$id =(int) mysql_real_escape_string($_POST['id']);
						$status =(int) mysql_real_escape_string($_POST['status']);
						mysql_query("UPDATE item_reviews SET status='$status' WHERE id='$id'") or die(mysql_error());
						echo "success";
					}
				}

				function image_upload(){

					$item_id = (int) mysql_real_escape_string($_REQUEST['item_id']);
					$image_name = uniqid().$_FILES['file']['name'];
					$filepath = "../uploads/gallery/".$image_name;
				    move_uploaded_file(
				        $_FILES['file']['tmp_name'],
				        $filepath);
				   		mysql_query("INSERT INTO item_gallery VALUES('','$item_id','$image_name')") or die(mysql_error());
				   	    // All good, send the response
				    echo json_encode([
				        'status' => 'ok',
				        'file' => $filepath,
				        'var'=>$tour_id
				    ]);
				
				}
				function delete_gallery_image(){
					$id =(int) mysql_real_escape_string($_REQUEST['id']);
					$query = mysql_query("SELECT * FROM item_gallery WHERE id='$id'") or die("Can't conenct");
					$fetch = mysql_fetch_array($query);
					$image = $fetch['image_name'];
					echo $image;
					if (file_exists("../uploads/gallery/$image")) {
						unlink("../uploads/gallery/".$image);
					}
					mysql_query("DELETE FROM item_gallery WHERE id='$id'") or die("Can't connect");
					echo "success";
				}
				function add_question(){
					$question = mysql_real_escape_string($_POST['item_question']);
					$answer = mysql_real_escape_string($_POST['item_answer']);
					$replier = mysql_real_escape_string($_POST['replier']);
					$asker = mysql_real_escape_string($_POST['asker']);
					$replier_url = mysql_real_escape_string($_POST['replier_url']);
					$item_id = (int) mysql_real_escape_string($_POST['item_id']);
					$check_question_query = mysql_query("SELECT * FROM item_question WHERE (question='$question' OR answer='$answer') AND item_id='$item_id'") or die("Can't connect");
					if (mysql_num_rows($check_question_query)==0) {
						mysql_query("INSERT INTO item_question VALUES('','$item_id','$question','$answer','$asker','$replier','$replier_url',NOW())") OR die(mysql_error());
						echo "success";
					}
				}

				function add_price(){
					$quantity = (int) mysql_real_escape_string($_POST['quantity']);
					$price = (double) mysql_real_escape_string($_POST['price']);
					$item_id = (int) mysql_real_escape_string($_POST['item_id']);
					$in_stock = (int) mysql_real_escape_string($_POST['in_stock']);
					$check_price_query = mysql_query("SELECT * FROM prices WHERE (quantity='$quantity' OR price='$price') AND item_id='$item_id'") or die("Can't connect");
					if (mysql_num_rows($check_price_query)==0) {
						mysql_query("INSERT INTO prices VALUES('','$item_id','$quantity','$price','$in_stock')") OR die(mysql_error());
						echo "success";
					}
				}

		}

		$ajaxclass = new ajax();
		$ajaxclass->$func();
}
 ?>