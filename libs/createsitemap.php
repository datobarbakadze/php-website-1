<?php 
/**
* 
*/

  
  function create()
  {
    $file = fopen("../sitemap.xml", "w");
    $map = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
    <urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"> 
      <url>
          <loc>http://testtech.tk</loc> 
          <priority>1</priority>
      </url>
      <url>
          <loc>http://testtech.tk/video</loc> 
          <priority>0.8</priority>
      </url>

      <url>
          <loc>http://testtech.tk/article</loc> 
          <priority>0.7</priority>
      </url>
";

$query = mysql_query("SELECT * FROM bio") or die("Can't connect");
$fetch= mysql_fetch_array($query);
$date = $fetch['date'];
$map.= "
      <url>
          <loc>http://testtech.tk/biography</loc> 
          <priority>0.6</priority>
          <lastmod>$date</lastmod>
      </url>


      <url>
          <loc>http://testtech.tk/prose</loc> 
          <priority>0.5</priority>
      </url>
      <url>
          <loc>http://testtech.tk/prose/?cat=event</loc> 
          <priority>0.4</priority>
      </url>
      <url>
          <loc>http://testtech.tk/prose/?cat=achive</loc> 
          <priority>0.4</priority>
      </url>
       <url>
          <loc>http://testtech.tk/contact</loc> 
          <priority>0.4</priority>
      </url>
      ";






//videoebi
$query = mysql_query("SELECT * FROM video") or die("Can't connect");
while($fetch = mysql_fetch_array($query)){
  $id = $fetch['id'];
  $map.= "
    <url>
        <loc>http://testtech.tk/video#$id</loc> 
      </url>
  ";
}

$query_2 = mysql_query("SELECT * FROM blog") or die("Can't connect");
while ($fetch = mysql_fetch_array($query_2)) {
  $id = $fetch['id'];
  $date = $fetch['date'];
  $map.="
    <url>
        <loc>http://testtech.tk/single/$id</loc> 
        <lastmod>$date</lastmod>
      </url>
  ";
}

$query_1= mysql_query("SELECT * FROM life") or die("Can't connect");
while ($fetch = mysql_fetch_array($query_1)) {
  $id = $fetch['id'];
  $cat = $fetch['cat_name'];
  $map.="
    <url>
        <loc>http://testtech.tk/?cat=$cat&id=$id</loc> 
      </url>
  ";
}

$query_3= mysql_query("SELECT * FROM pdf") or die("Can't connect");
while ($fetch = mysql_fetch_array($query_3)) {
  $id = $fetch['id'];
  $cat = $fetch['cat_name'];
  $map.="
    <url>
        <loc>http://testtech.tk/pdf/7af$k49w!j2ug53aiu1sb5v_Nr.2.2005.pdf</loc> 
        <priority>0.2</priority>
      </url>
  ";
}


  $map.= "</urlset>";
 fwrite($file, $map);

 fclose($file);
  }



 ?>