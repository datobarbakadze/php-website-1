<a href="/admin/team/" class="articlelistupdate back_btn"><< BACK TO TEAM LIST</a>
<form class="admin_form add_team_form" method="POST" enctype="multipart/form-data" action="/admin/ajax.php?func=addTeam">
	<div class="field_title high_font">Firstname</div>
	<input type="text" name="f_name" class="input_texts low_font">

	<div class="field_title high_font">Last name</div>
	<input type="text" name="l_name" class="input_texts low_font" >

	<div class="field_title high_font">Profession</div>
	<input type="text" name="profesion" class="input_texts low_font">

	Team Image <br>
	<input type="file" name="file"> <b>380px / 568px</b> <br><br> 

	<div class="field_title high_font">Description</div>
	<textarea type="text" name="desc" maxlength="130" class="admin_text_area team_desc" low_font" > </textarea>
	<b><span class="count_update">0</span></b>/130 letters
	<br><br>
	<input type="submit" value="Add blog" class="input_texts low_font">
</form>