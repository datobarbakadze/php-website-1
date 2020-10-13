<?php 
/**
* 
*/
$sec->ses();
class index
{
	
	public function loginto(){
		if(isset($_POST['login'])){
			$username = mysql_real_escape_string($_POST['username']);
			$password = mysql_real_escape_string($_POST['password']);
			if(!empty($username) && !empty($password)){
				$password = md5($password);
				$query = mysql_query("SELECT * FROM users WHERE email='$username' AND password='$password' AND level=1") or die("cant connect");
				$numrows = mysql_num_rows($query);
				if($numrows==1){
					$fetch = mysql_fetch_array($query);
					$_SESSION['user_id'] = $fetch['id'];
					$_SESSION['password'] = $password;

					echo "you have been logged in";
					header('Location: /admin/product');
				}else
					echo "username or password is incorrect";
			}else
				echo "Please fill every gap";
		}
	}
}
$login = new index();
 ?>

 	<form action="" method="POST" class="login_form">
 		<img src="https://www.iconshock.com/image/SuperVista/General/user/" alt="" class="admin_image" width="160px" height="160px">
 		<input type="text" name="username" class="admin_inputs" placeholder="Username">
 		<input type="password" name="password" class="admin_inputs" placeholder="Username">
 		<input type="submit" name="login" class="login" value="LOG IN">
 		<br>
 		<?php $login->loginto(); ?>
 	</form>


