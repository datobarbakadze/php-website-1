<?php 
$infoData = $theClass->get_info();
 ?>

<a href="/admin/fun_info/add" class="high_font add_tour_main">ADD FUN INFO</a>
<table>
	<thead>
		<td>Icon</td>
		<td>title</td>
		<td>Value</td>
		<td>Delete</td>
	</thead>
	<?php foreach ($infoData as $info) {?>
		<tr id="info_<?php echo $info['id'] ?>">
			<td>
				<img style="background:#ccc" src="../images_info/<?php echo $info['image'] ?>" height="auto" width="45px">
			</td>
			<td><?php echo $info['title'] ?></td>
			<td> <input type="number" name="number" class="fun_value input_number" data-id="<?php echo $info['id'] ?>" value="<?php echo $info['numbers'] ?>" class="input_number">
				 <?php echo $info['measure'] ?>
			</td>
			<td><i class="fa fa-times deleteFun" data-id="<?php echo $info['id'] ?>"></i></td>
		</tr>
	<?php } ?>
	
</table>