<a href="/admin/gallery" class="articlelistupdate back_btn"><< BACK TO GALLERY</a>
<form id="gallery_form" class="admin_form"  action="/admin/ajax.php?func=addGallery"  enctype="multipart/form-data" method="post">
	<div class="field_title high_font">Image Text:</div>
	<textarea class="tour_desc input_texts"  class="input_texts tour_desc low_font" name="description"></textarea>
	Upload Image<br><br>
	<input type="file" name="file">
	<input type="submit" value="Add IMAGE" id="add_gallery" class="input_texts low_font">
</form>