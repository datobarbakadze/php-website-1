<a href="/admin/blog/add" class="high_font add_tour_main">ADD BLOG</a>

<table class="table">
	<thead>
		<tr>
			<td>title</td>
			<td>action</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($obj->getAny('blog') as $blog): ?>
			<tr id="single-blog-<?php echo $blog['id'] ?>">
				<td><?php echo $blog['title'] ?></td>
				<td>
					<a class="delete just-delete lifelistdelete" data-object-table="blog" data-object-class="single-blog" data-image-col="image" data-object-id="<?php echo $blog['id'] ?>">Delete</a>

					<a href="/admin/blog/update/<?php echo $blog['id'] ?>" class="lifelistupdate" >Update</a>
				</td>
			</tr>
		<?php endforeach ?>
		<tr>
		</tr>
	</tbody>
</table>

