<?php

error_reporting(E_ALL ^ E_DEPRECATED ^ E_NOTICE);
function fireError($add){
	if (helper::ajax()==false) {
		header('Location: /');
	}else if (helper::ajax()==true) {
		$type = explode(',', $_SERVER['HTTP_ACCEPT'])[0];
		if ( $type=="application/json" ) {
			echo json_encode(["error"=>"$add You are doing something wrong"]);
		}else
			echo "You are doing something";
	}
}

function checker()
{
    if(isset($_GET['url'])){
    $url = mysql_real_escape_string($_GET['url']);
    $url = trim($url, '/');
    $url = explode('/', $url);
        if(isset($url[0]) && !isset($url[1])){
            $checker=0;
            $url_string = 0;
        }elseif (isset($url[1])) {
            $checker = 1;
            $pageCheckQuery = mysql_query("SELECT * FROM pages WHERE link='".mysql_real_escape_string($url[1])."' AND type=0 ") or die("Can't connect");
            if (mysql_num_rows($pageCheckQuery)==1) {
            	$pageFetch = mysql_fetch_array($pageCheckQuery);
            	if ($pageFetch['session']==1 && !isset($_SESSION['userID'])) {
            		$checker=2; //for redirecting because of not logging in
            	}else
            		$url_string = $pageFetch['name'];
            }elseif (mysql_num_rows($pageCheckQuery)==0) {
            	$url_string = "detail";
            }else{
            	echo "You are doing something wrong";
            }
        }

        return array('checker' => $checker, 'url' => $url_string );
    }
}
if(isset($_GET['url'])){

	$url = mysql_real_escape_string($_GET['url']);
	$url = rtrim($url, '/');
	$url = explode('/', $url);
	if(isset($url[0])){
		if($url[0] == "ajax"){
		}else{
			if (helper::ajax()==false) {
				$file = "./controller/" . constant($url[0]) . ".php";
				$class = constant($url[0]);
			}else if (helper::ajax()==true) {
				$file = "./controller/" . $url[0] . ".php";
				$class = $url[0];
			}
			
			if(file_exists($file)){
				require $file;
				if(class_exists($class)){
					$obj = new $class;
					if (helper::ajax()==false) { // checking that it is not the ajax quary
						echo "<div class='main'>";
							if (checker()['checker']==0) {
								$templateFile = constant('TEMPLATE').constant($url[0])."/main.php";
								if (file_exists($templateFile)) {
									require $templateFile;
								}else
									header('Location: /'.constant('error'));
							}elseif (checker()['checker']==1) {
								$templateFile = constant('TEMPLATE').constant($url[0])."/".checker()['url'].".php";
								if (file_exists($templateFile)) {
									require $templateFile;
								}else
									header('Location: /'.constant('error'));
								 
							}elseif (checker()['checker']==2) {
								header('Location: /'.constant('user'));
							}
						echo "</div>";
					}elseif (helper::ajax()==true) { // checking that it is ajax query
						if (method_exists($obj, $url[1])) {
							$obj->$url[1]();
						}else{
							fireError("METHOD_ERROR");
						}

					}
				}else{
					fireError("CLASS_ERROR");
				}
			}else{
				fireError("FILE_ERROR");
			}
			
		}
		
	}
}else{
	require "./controller/index.php";
	$obj = new index();
	require constant('TEMPLATE')."main/index.php";
}

