
<a href="/admin/category/add/" class="high_font add_tour_main">ADD Category</a>
<h2>Categories</h2>
<table class="table">
	
	<thead>
		<tr>
			<td>Title</td>
			<td>type</td>
			<td>Action</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($obj->getAny('category') as $category): ?>
			<tr id="single-category-<?php echo $category['id'] ?>">
				<td><?php echo $category['cat_title'] ?></td>
				<td>
					<?php if ($category['type']==1): ?>
						<strong style="color:lightgreen;">Item</strong>
					<?php elseif($category['type']==2): ?>
						<strong style="color:skyblue;">Blog</strong>
					<?php else: ?>
						<strong style="color:darkred;">NONE</strong>
					<?php endif ?>
				</td>
				<td >
					<a class="delete just-delete lifelistdelete" data-object-table="category" data-object-class="single-category" data-object-id="<?php echo $category['id'] ?>">Delete</a>

					<a href="/admin/category/update/<?php echo $category['id'] ?>" class="lifelistupdate" >Update</a>
				</td>
			</tr>
		<?php endforeach ?>
		
	</tbody>
</table>