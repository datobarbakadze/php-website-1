<a href="/admin/slides/" class="articlelistupdate back_btn"><< BACK TO SLIDES</a>
<form class="admin_form add_slide_form" enctype="multipart/form-data" method="POST" action="/admin/ajax.php/?func=addSlide">
	<div class="field_title high_font">Url</div>
	<input type="text" name="url" class="input_texts low_font">
	<table>
		<thead>
			<tr>
				<td>ordering</td>
				<td>publish</td>
			</tr>
		</thead>
		<tr>
			<td><input type="number" name="order"></td>
			<td><input type="checkbox" name="publish" value="1"></td>
		</tr>
	</table><br>
	<b>Image</b> <br>
	<input type="file" name="file"> &nbsp;<b>SIZE = 1600PX / 897PX </b><br><br>
	<div class="field_title high_font">Main title</div>
	<input type="text" name="main_title" class="input_texts low_font">

	<div class="field_title high_font">sub title 1</div>
	<input type="text" name="sub_title1" class="input_texts low_font">
	
	<div class="field_title high_font">sub title 2</div>
	<input type="text" name="sub_title2" class="input_texts low_font">
	<input type="submit" name="Add slide" value="Add Slide" class="input_texts high_font">
</form>