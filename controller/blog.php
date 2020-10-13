<?php 
/**
* 
*/
class blog
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
                    die(Header('Location: /'.constant('blog')));
            }
        }
    }

    public function getTags($itemId=""){
        $blog_tags = [];
        $additionalString = "";
        if (!empty($itemId)) {
            $additionalString =  "WHERE item_id='".$itemId."'";
        }
        $query = mysql_query("SELECT id, tag_title FROM blog_tags GROUP BY tag_title $additionalString ") or die("Can't connect");
        while ($blog_tags_fetch = mysql_fetch_assoc($query)) {
            array_push($blog_tags, $blog_tags_fetch);
        }

        return $blog_tags;
    }
    public function queryString(){
        $queryString = ' WHERE b.status=1 ';
        if ( strpos($_SERVER['REQUEST_URI'], '?') ) {
            if (isset($_GET['category']) && !empty($_GET['category'])) {
                $category = (int) Helper::Get('category');
                $queryString .= " AND b.category='".$category."' ";
            }

            if (isset($_GET['tag']) && !empty($_GET['tag'])) {
                $tag = (int) Helper::Get('tag');
                $tagQuery = mysql_query("SELECT tag_title FROM blog_tags WHERE id='".$tag."'") or die(mysql_error());
                $tag_title = mysql_fetch_assoc($tagQuery)['tag_title'];
                $queryString .= " AND b.id IN (SELECT item_id FROM blog_tags WHERE tag_title LIkE '%".$tag_title."%') ";
            }

            if (isset($_GET['word']) && !empty($_GET['word'])) {
                $word = Helper::Get('word');
                $queryString .= " AND (b.title LIKE '%".$word."%' OR b.description LIKE '%".$word."%')";
            }
        }

        return $queryString;
    }
    public function getBlog(){
        
        $blog =[];
        $query = mysql_query("SELECT b.*, c.cat_title FROM blog b
            LEFT JOIN category c ON c.id = b.category
            ".$this->queryString()."");
        while ($fetch = mysql_fetch_assoc($query)) {

            $fetch['description'] = substr(strip_tags($fetch['description']), 0,180);
            $fetch['title'] = substr(strip_tags($fetch['title']), 0,30);
            if (isset($_GET['word']) && !empty($_GET['word'])) {
                $newDescription = str_replace($_GET['word'], "<span class='search-highlight'>".$_GET['word']."</span>", $fetch['description']);
                $newTitle = str_replace($_GET['word'], "<span class='search-highlight'>".$_GET['word']."</span>", $fetch['title']);
                $fetch['description'] = $newDescription;
                $fetch['title'] = $newTitle;
            }
            array_push($blog, $fetch);

        }
        return $blog;
    }


    public function pagination(){
        $url = mysql_real_escape_string($_GET['url']);
        $url = rtrim($url, '/');
        $url = explode('/', $url);
        $query = mysql_query("SELECT * FROM blog ORDER BY id DESC") or die("can't connect");
        $num = mysql_num_rows($query);
        $page_quanitity = ceil( $num / constant('per_page_blog'));

        if (isset($_GET['page'])) {
            $page = $_GET['page'];
        }else{
            $page = 1;
        }  

            //show left_arrow
            if ($page!=1) {
                    echo " <li><a href=\"/".$url[0]."/?page=".($page-1)."\"><i class=\"fa fa-angle-left\"></i></a></li>";
            }
                for ($i=1; $i <= $page_quanitity; $i++) {

                    if($page == $i){
                        echo  "<li class=\"current\"><a >$i</a></li>";
                    }else{
                        echo "<li><a href=\"/".$url[0]."/?page=".$i."\">$i</a></li>";
                    }
                        
                }


            //show right arrow
             if ($page!=$page_quanitity) {
                    echo "<li><a href=\"/".$url[0]."/?page=".($page+1)."\"><i class=\"fa fa-angle-right\"></i></a></li>"; 
            }
    }

    

    


    

    
    

    
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

}
 ?>











