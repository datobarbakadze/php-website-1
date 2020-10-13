<a href="/admin/item/add" class="high_font add_tour_main">ADD ITEM</a>
<?php foreach (get_items("item") as $info): ?>
	<div class="hello"><?php echo $info['title'] ?></div>
<?php endforeach ?>