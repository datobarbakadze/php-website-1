<?php 
/**
 * 
 */
class shop
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
                    die(Header('Location: /'.constant('shop')));
            }
        }
    }

    public function get(){
        $query = mysql_query("
        SELECT  
        i.*, 
        iv.variant_id,
        iv.attr_id,
        av.variant_title
        FROM item i 
        LEFT JOIN item_variants iv ON i.item_id=iv.item_id 
        LEFT JOIN attrs_variants av ON iv.variant_id=av.id
        WHERE i.item_id='".$this->id(1)."' AND i.status='1'") or die("can't conenct");
        $url_title = $this->id(0);
        $joined_arr['item'] = mysql_fetch_assoc($query);
        $joined_arr['variants'] = [];
        if(mysql_num_rows($query)!=0):
            if ($url_title==$joined_arr['item']['url']) {
                while($item = mysql_fetch_assoc($query)){
                    array_push($joined_arr['variants'], ["variant_id"=>$item['variant_id'],"variant_title"=>$item['variant_title'],"attr_id"=>$item['attr_id']]);
                }
            }else
                die(Header('Location: /'.constant('shop').'/'.$joined_arr['item']['url'].'~'.$joined_arr['item']['item_id']));  
            return $joined_arr;
            

        else:
            die(Header('Location: /'.constant('shop')));
        endif;
    }

    public function getAny($table){
        $any_arr = [];
        $any_query = mysql_query("SELECT * FROM ".$table."") or die("Can't connect");
        while ($any_fetch = mysql_fetch_assoc($any_query)) {
            array_push($any_arr, $any_fetch);
        }
        return $any_arr;
    }

    public function getAnySingle($table, $column, $single_id){
                $get_any_single_arr = [];
                $get_any_single_query = mysql_query("SELECT * FROM ".$table." WHERE ".$column."='".$single_id."'") or die("Can't connect");
                while ($get_any_single_fetch = mysql_fetch_assoc($get_any_single_query)) {
                    array_push($get_any_single_arr, $get_any_single_fetch);
                }

            return $get_any_single_arr;
    }

    
    public function queryStr(){
        $queryStr = " WHERE i.status=1 ";
        if ( strpos($_SERVER['REQUEST_URI'], '?') ):
            $getvar = array_filter(Helper::Get());
            
            //thc filter
            if ($getvar['min_thc']) {
                $filter = $getvar['min_thc'];
                $queryStr .= " AND i.thc >= ".$filter." ";
            }
            if ($getvar['max_thc']) {
                $filter = $getvar['max_thc'];
                $queryStr .= " AND i.thc <= ".$filter." ";
            }

            //sativa filter
            if ($getvar['min_sativa']) {
                $filter = $getvar['min_sativa'];
                $queryStr .= " AND i.sativa >= ".$filter." ";
            }
            if ($getvar['max_sativa']) {
                $filter = $getvar['max_sativa'];
                $queryStr .= " AND i.sativa <= ".$filter." ";
            }

            //indica filter
            if ($getvar['min_indica']) {
                $filter = $getvar['min_indica'];
                $queryStr .= " AND i.indica >= ".$filter." ";
            }
            if ($getvar['max_indica']) {
                $filter = $getvar['max_indica'];
                $queryStr .= " AND i.indica <= ".$filter." ";
            }

            //ruderails filter
            if ($getvar['min_ruderails']) {
                $filter = $getvar['min_ruderails'];
                $queryStr .= " AND i.ruderails >= ".$filter." ";
            }
            if ($getvar['max_ruderails']) {
                $filter = $getvar['max_indica'];
                $queryStr .= " AND i.ruderails <= ".$filter." ";
            }

            /***********************
            ******* yield  ********
            ************************/
            //Yield indoor filter
            if ($getvar['yield_indoor_from']) {
                $filter = $getvar['yield_indoor_from'];
                $queryStr .= " AND i.yield_indoor_from >= ".$filter." ";
            }
            if ($getvar['yield_indoor_to']) {
                $filter = $getvar['yield_indoor_to'];
                $queryStr .= " AND i.yield_indoor_to <= ".$filter." ";
            }


            //Yield outdoor filter
            if ($getvar['yield_outdoor_from']) {
                $filter = $getvar['yield_outdoor_from'];
                $queryStr .= " AND i.yield_outdoor_from >= ".$filter." ";
            }
            if ($getvar['yield_outdoor_to']) {
                $filter = $getvar['yield_outdoor_to'];
                $queryStr .= " AND i.yield_outdoor_to <= ".$filter." ";
            }

            /***********************
            ******* height  ********
            ************************/
            //height indoor filter
            if ($getvar['height_indoor_from']) {
                $filter = $getvar['height_indoor_from'];
                $queryStr .= " AND i.height_indoor_from >= ".$filter." ";
            }
            if ($getvar['height_indoor_to']) {
                $filter = $getvar['height_indoor_to'];
                $queryStr .= " AND i.height_indoor_to <= ".$filter." ";
            }
            //height outdoor filter
            if ($getvar['height_outdoor_from']) {
                $filter = $getvar['height_outdoor_from'];
                $queryStr .= " AND i.height_outdoor_from >= ".$filter." ";
            }
            if ($getvar['height_outdoor_to']) {
                $filter = $getvar['height_outdoor_to'];
                $queryStr .= " AND i.height_outdoor_to <= ".$filter." ";
            }

            /***********************
            ******* flowering  ********
            ************************/
            //height indoor filter
            if ($getvar['flowering_time_from']) {
                $filter = $getvar['flowering_time_from'];
                $queryStr .= " AND i.flowering_time_from >= ".$filter." ";
            }
            if ($getvar['flowering_time_to']) {
                $filter = $getvar['flowering_time_to'];
                $queryStr .= " AND i.flowering_time_to <= ".$filter." ";
            }

        endif;


        return $queryStr;
    }

    public function getItem(){
        $i = 0;
        $query = mysql_query("SELECT i.* FROM item i  
           /* LEFT JOIN item_variants iv ON iv.item_id=i.item_id*/
            ".$this->queryStr()."
            ") or die(mysql_error());
        while($fetch = mysql_fetch_assoc($query)){
            $rows[] = $fetch;
        }   
        
        return $rows;
        return $this->queryStr();
    }

    
	
}

 ?>