<?php $data = $theClass->get_sliders()?>
<a href="/admin/slides/add" class="high_font add_tour_main">ADD SLIDER</a>
<table>
	<thead>
		<tr>
			<td>Image</td>
			<td>url</td>
			<td>ordering</td>
			<td>published</td>
			<td>action</td>
		</tr>

	</thead>

	<?php foreach ($data as $info) {?>
		<tr class="slide_<?php echo $info['id'] ?>">
			<td><img class="slider_image" height="100px" src="../slider/<?php echo $info['image'] ?>"></td>
			<td><?php echo $info['url'] ?></td>
			<td><?php echo $info['order_num'] ?></td>
			<td>
				<?php if ($info['published']==1) {?>
					<i class="fa fa-check" style="background:#3bd43b;color:white;"></i>
				<?php }elseif ($info['published']==0) {?>
					<i class="fa fa-check" style="background:#ccc;color:white;"></i>
				<?php } ?>
			</td>
			<td>
				<a href="/admin/slides/update/<?php echo $info['id'] ?>">
					<i class="fa fa-refresh" style="color:white;"></i>
				</a>
				<i class="fa fa-times deleteSlide" data-id="<?php echo $info['id'] ?>" style="color:white;"></i>
			</td>
		</tr>
	<?php } ?>
</table>