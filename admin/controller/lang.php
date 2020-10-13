<?php 
/**
* 
*/
class lang 
{
	
	public function list_langs()
	{
		$query = mysql_query("SELECT * FROM lang order by id ASC") or die("Cant connect");
		$a = 0;
		while($fetch = mysql_fetch_array($query)){
			$id = $fetch['id'];
			$var_name = $fetch['lang_name'];
			$var_word = $fetch['word'];
			$a++;
			echo "
				<div class=\"count\">$a.</div>
			 	<form id=\"langform\">
			 		<div class=\"lang_name\">$var_name</div>

			 		<textarea class=\"lang_text\" name=\"word\" id=\"word_$id\">$var_word</textarea>
			 		<div class=\"save_btn\" id=\"$id\">განახლება</div>
			 	</form>
			";
		}
	}
}
$lang = new lang();
 ?>

 <div class="container" align="center" style="width:670px;">
 	<div class="topbar" align="center">
 		<div class="topbar_memb high_font">ცვლადის სახელი</div>
 		<div class="topbar_memb high_font">ქართული</div>
 		<div class="topbar_memb high_font">განახლება</div>
 	</div>
 	<form id="langform">
			<input type="text" placeholder="ცვლადის სახელი" class="lang_name insert add">
			<textarea class="lang_text add" name="word" id="word" placeholder="ქართული"></textarea>
			<div class="add_btn">დამატება</div>
	</form><br><br><br>
 	<?php $lang->list_langs(); ?>
 </div>