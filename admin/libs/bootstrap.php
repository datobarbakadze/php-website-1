
<?php
error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);

	if(isset($_GET['aurl'])){
		$aurl = mysql_real_escape_string($_GET['aurl']);
		$aurl = rtrim($aurl, '/');
		$aurl = explode('/', $aurl);

		if(isset($aurl[0]) && !isset($aurl[1])){
			$file = "./controller/" . $aurl[0] . ".php";
			if(file_exists($file)){
				require $file;
				if(class_exists($aurl[0])){
					echo "<div class=\"container_main\">";
						$obj = new $aurl[0];
						require constant('ADMIN_TEMPLATE').$aurl[0]."/index.php";
					echo "</div>";
				}else{
					echo "<span style='color:red'>Error with Class bootstraping</span><br><span style='color:#0ff'>Please try again later!</span>";	
				}
			}else{
				echo "<span style='color:red'>Error with File bootstraping.</span><br>
				<span style='color:#0ff'>Please try again later!</span>";
			}
		}else if(isset($aurl[1]) && isset($aurl[0])){
			$file = "./controller/" . $aurl[0] . ".php";
			echo "<div class=\"container_main\">";
				require $file;
				$obj = new $aurl[0];
				require constant('ADMIN_TEMPLATE').$aurl[0]."/".$aurl[1].".php";
			echo "</div>";
		}
	}else if(!isset($aurl[1])){
		include "./controller/index.php";
	}