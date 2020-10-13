<a href="/admin/gallery/add" class="high_font add_tour_main">ADD IMAGE TO GALLERY</a>
<?php $images = $theClass->getImages() ?>
<?php $counter = 0; ?>
<table>
	<thead>
		<tr>
			<td>#</td>
			<td>image</td>
			<td>description</td>
			<td>delete</td>
		</tr>
	</thead>

<?php foreach ($images as $info): ?>
	<?php $counter++; ?>
	<tr id="gal_<?php echo $info['id'] ?>">
		<td><?php echo $counter ?></td>
		<td><img src="../images_gallery/t_<?php echo $info['image'] ?>"></td>
		<td><?php echo substr($info['description'], 0,25) ?></td>
		<td><i class="fa fa-times delete_gal"  data-id="<?php echo $info['id'] ?>"></i></td>
	</tr>
<?php endforeach ?>
</table>