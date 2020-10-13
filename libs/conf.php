<?php 

			/**
			* 
			*/	

			//html lang	

			//pages
			// function loadHtml($loadfile){
			// 	libxml_use_internal_errors(true);
			// 	$doc = new DOMDocument();
			// 	$doc->loadHTMLFile($loadfile);
			// 	echo $doc->saveHtml() ;
			// }

			if (!isset($_COOKIE['cart'])) {
				setcookie("cart", json_encode(array()), time() + (86400 * 30), "/");
			}
			if (!isset($_COOKIE['whishlist'])) {
				setcookie("whishlist", json_encode(array()), time() + (86400 * 30), "/");
			}
			$page_query = mysql_query("SELECT * FROM pages") or die("Can't connectsf");
			while ($page_fetch = mysql_fetch_array($page_query)) {
				define("".$page_fetch['link']."","".$page_fetch['name']."");
				define("".$page_fetch['name']."","".$page_fetch['link']."");
			}
			

			//define roots\
			define("ADMIN_TEMPLATE", "../admin/views/html/");
			define("TEMPLATE", "./views/html/");

			//PAGES AGAINST

			//pegignation
			define("per_page_tour",3);
			define("per_page_blog", 5);

			//DEALING WITH PAGES
			if (isset($_GET['url'])) {
				$url = mysql_real_escape_string($_GET['url']);
				$url = rtrim($url, '/');
				$url = explode('/', $url);
			}
			if(!isset($_GET['url'])) {
				$page = "index-page";
			}elseif (isset($url[0])) {
				$page = mysql_real_escape_string($url[0]);
			}
			$grab_page = mysql_query("SELECT * FROM pages WHERE link='$page'") or die("Can't connect");
			if (mysql_num_rows($grab_page)!=1 && Helper::ajax()==false) {
				header('Location: /'.constant('error'));
			}
			$grab_fetch = mysql_fetch_array($grab_page);
			if (isset($url[0]) && !isset($url[1])) {
				
				define('PAGE_TITLE', $grab_fetch['title']);
				define('PAGE_DESCRIPTION', $grab_fetch['description']);
				define('PAGE_TAG', $grab_fetch['tags']);
			}elseif (isset($url[1]) && $url[0]==constant('blog')) {
				$title = $url[1];
				$spaced_title = str_replace('-', ' ', $title);
		        $query = mysql_query("SELECT * FROM blog  WHERE title = '$spaced_title'") or die("Can't connectsd");
		        $fetch = mysql_fetch_assoc($query);
				define('PAGE_TITLE', $fetch['title']);
				define('PAGE_DESCRIPTION', strip_tags($fetch['description']) . " | ".$fetch['tags']);
				define('PAGE_TAG', $fetch['tags']);
			}elseif (isset($url[1]) && $url[0]==constant('category')) {
				define('PAGE_TITLE', $grab_fetch['title']." Selected category:".$url[1]);
				define('PAGE_DESCRIPTION', $grab_fetch['description']);
				define('PAGE_TAG', $grab_fetch['tags']);
			}

			if (!isset($_GET['url'])) {
				define('PAGE_TITLE', $grab_fetch['title']);
				define('PAGE_DESCRIPTION', $grab_fetch['description']);
				define('PAGE_TAG', $grab_fetch['tags']);
			}

			//robots
			if ($page!=constant('error')) {
				define('PAGE_ROBOTS', 'index,follow');
			}else
				define('PAGE_ROBOTS', 'noindex,nofollow');
 ?>
