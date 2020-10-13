<a href="/admin/slides/" class="articlelistupdate back_btn"><< BACK TO SLIDES</a>
<form class="admin_form update_slide_form" enctype="multipart/form-data" method="POST" action="/admin/ajax.php/?func=updateSlide">
	<div class="field_title high_font">Url</div>
	<input type="text" name="url" value="<?php echo $theClass->get_fields('url'); ?>" class="input_texts low_font">
	<table>
		<thead>
			<tr>
				<td>ordering</td>
				<td>publish</td>
			</tr>
		</thead>
		<tr>
			<td><input type="number" name="order" value="<?php echo $theClass->get_fields('order_num'); ?>" ></td>
			<?php if( $theClass->get_fields('published') == 1){ ?>
				<td><input type="checkbox" name="publish" checked value="1"></td>
			<?php }else{ ?>
				<td><input type="checkbox" name="publish" value="1"></td>
			<?php } ?>
		</tr>
		<input type="hidden" name="id" value="<?php echo $theClass->get_fields('id'); ?>">
	</table><br>
	<b>Image</b> <br>
	<input type="file" name="file"> &nbsp;<b>SIZE = 1600PX / 897PX </b><br><br>
	<img src="../slider/<?php echo $theClass->get_fields('image'); ?>" height="150px"><br><br>

	<div class="field_title high_font">Main title</div>
	<input type="text" name="main_title" value="<?php echo $theClass->get_fields('main_title') ?>" class="input_texts low_font">

	<div class="field_title high_font">sub title 1</div>
	<input type="text" name="sub_title1" value="<?php echo $theClass->get_fields('sub_title1') ?>" class="input_texts low_font">
	
	<div class="field_title high_font">sub title 2</div>
	<input type="text" name="sub_title2" value="<?php echo $theClass->get_fields('sub_title2') ?>" class="input_texts low_font">

	
	<input type="submit" name="Add slide" value="Update slide" class="input_texts high_font">
</form>