<a href="/admin/fun_info" class="articlelistupdate back_btn"><< FUN INFO LIST</a>
<form class="admin_form info_form" method="POST" action="/admin/ajax.php/?func=AddInfo">
	<div class="field_title high_font">Tour Title:</div>
	<input type="text" name="title" class="input_texts low_font">

	number: <br>
	<input type="number" name="number" class="input_number" min="0" value="0">

	<br>
	Measure: <br>
	<input type="type" name="measure" class="input_number">
	<br>
	<b>Icon</b><br>
	<input type="file" name="file"> <b>max width = 75px | max-height=57px</b>
	<br><br>
	<input type="submit" name="add_info" value="Add fun info" class="input_texts high_font">
</form>