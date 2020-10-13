<?php 
/**
 * 
 */
class content
{
	
	public function id($param)
    {
        if(isset($_GET['url'])){
            $url = mysql_real_escape_string($_GET['url']);
            $url = trim($url, '/');
            $url = explode('/', $url);
            if(isset($url[1])){
                
                $pattern = '/.*~\d{0,10}[^!@#$%^&*(),.?":{}|<>]$/i';
                if (preg_match($pattern, $url[1])) {
                    return split('~', mysql_real_escape_string($url[1]))[$param];
                }else
                	header('Location: /'.constant('content'));
                
            }
        }
    }

    public function get($param=""){
    	$query =mysql_query("SELECT * FROM add_content WHERE id='".$this->id(1)."'") or die("Can't connect");
        if(mysql_num_rows($query)!=0):
        	$url_title = $this->id(0);
        	$item = mysql_fetch_assoc($query);
            if ($url_title!=$item['url']) {
                die(Header('Location: /'.constant('content').'/'.$item['url'].'~'.$item['id']));  
            }
            return $item[$param];
        else:
            die(Header('Location: /'.constant('content')));
        endif;
    }
}

 ?>