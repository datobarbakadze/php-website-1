<?php $background = $theClass->get_background(); ?>
<?php $b_images = $theClass->get_images(); ?>
<form action="" class="admin_form" method="POST" enctype="multipart/form-data">
	Select background <br>
	<select name="background" class="background_select">
		<?php foreach ($background as $info) { ?>
			<option value="<?php echo $info['name'] ?>"><?php echo $info['value'] ?> | <?php echo $info['size'] ?></option>
		<?php } ?>
		
	</select><br><br>

	select background image <br>
	<input type="file" name="file"><br><br>
	<input type="submit" name="add_background" value="Add background" class="background_submit"><br><br>
	<!--<div class="background_message">-->
		<?php $theClass->add_background() ?>
		<!--</div>-->
	<table>
		<thead>
			<td>name</td>
			<td>image</td>
		</thead>
	
	<?php foreach ($b_images as $info) { ?>
		<tr>
			<td><?php echo $info['value'] ?></td>
			<td><img src="../images_background/<?php echo $info['image'] ?>" height="50px" width="200px" style="object-fit: cover;"></td>
		</tr><br>
	<?php } ?>
	</table>
	
</form>
