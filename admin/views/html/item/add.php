<?php 
$empty = "";
mysql_query("INSERT INTO item VALUES(
'".$empty/* item_id */."',
'".$empty/* title */."',
'".$empty/* description */."',
'".$empty/* more_info */."',
'".$empty/* more_info */."',
'".$empty/* thc */."',
'".$empty/* cbd */."',
'".$empty/* yield_indoor_from */."',
'".$empty/* yield_indoor_to */."',
'".$empty/* yield_outdoor_from */."',
'".$empty/* yield_outdoor_to */."',
'".$empty/* height_indoor_from */."',
'".$empty/* height_indoor_to */."',
'".$empty/* height_outdoor_from */."',
'".$empty/* height_outdoor_to */."',
'".$empty/* flowering_time_from */."',
'".$empty/* flowering_time_to */."',
'".$empty/* sativa */."',
'".$empty/* indica */."',
'".$empty/* ruderails */."',
'".$empty/* in_stock */."',
'".$empty/* main_image */."',
'".$empty/* icon */."',
'".$empty/* cup_winner */."',
'".$empty/* cup_winner */."',
'".$empty/* cup_winner */."',
'".$empty/* url */."',
'0',
NOW()
)") or die("CAB'T CONNECT");
header('Location: /admin/item/update/'.mysql_insert_id());
 ?>