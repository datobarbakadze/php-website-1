<?php $pages =  $theClass->get_pages(); ?>

<table>
			<thead>
				<td>link</td>
				<td>title</td>
				<td>description</td>
				<td>tags</td>
				<td>submit</td>
			</thead>
<?php foreach ($pages as $info): ?>
	<form class="admin_form updatePage_<?php echo $info['id'] ?>" action="/admin/ajax.php?func=updatePage" method="POST">

			<tr>
				<td><input type="text" class="input_text_pages" value="<?php echo $info['link'] ?>" name="link"></td>
				<td><input type="text" class="input_text_pages" value="<?php echo $info['title'] ?>" name="title"></td>
				<td><textarea class="input_page_textarea" name="description"><?php echo $info['description'] ?></textarea></td>
				<td><input  type="text" class="input_text_pages" value="<?php echo $info['tags'] ?>" name="page_tags"></td>
				<input type="hidden" name="id" value="<?php echo $info['id'] ?>">
				<td><input type="submit" value="Update" class="input_update_page" name="updatePage" data-id="<?php echo $info['id'] ?>"></td>
			</tr>

	</form>
<?php endforeach ?>

</table>