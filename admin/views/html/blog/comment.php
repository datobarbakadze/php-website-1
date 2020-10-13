<?php $comment_held_data = $theClass->list_comment('comment',0) ?>
<?php $comment_data = $theClass->list_comment('comment',1) ?>

<h1 style="color:skyblue;"> You are now in Comments section</h1>
<h3> Held Comments </h3>
<table>
	<thead>
		<tr>
			<td>ID</td>
			<td>Blog_ID</td>
			<td>Name</td>
			<td>text</td>
			<td>Action</td>
		</tr>
	</thead>
<?php foreach ($comment_held_data as $info) { ?>
	<tr class="comment_tr" id="comment_<?php echo $info['id'] ?>">
		<td><?php echo $info['id'] ?></td>
		<td><?php echo $info['blog_id'] ?></td>
		<td><?php echo $info['name'] ?></td>
		<td style="display:block;width:500px !important;"><p><?php echo $info['comment'] ?></p></td>
		<td class="action_accept">
		<i class="fa fa-check edit" data-table="comment" data-id="<?php echo $info['id'] ?>" data-action="check"></i>
		<i class="fa fa-times edit" data-table="comment" data-id="<?php echo $info['id'] ?>" data-action="delete"></i></td>
	</tr>
<?php } ?>
</table>

<h3>Active comments</h3>
<table>
	<thead>
		<tr>
			<td>ID</td>
			<td>Blog_ID</td>
			<td>Name</td>
			<td>text</td>
			<td>Action</td>
		</tr>
	</thead>
<?php foreach ($comment_data as $info) { ?>
	<tr class="comment_tr" id="comment_<?php echo $info['id'] ?>">
		<td><?php echo $info['id'] ?></td>
		<td><?php echo $info['blog_id'] ?></td>
		<td><?php echo $info['name'] ?></td>
		<td style="display:block;width:500px !important;"><p><?php echo $info['comment'] ?></p></td>
		<td class="action_accept">
		<i class="fa fa-undo edit" data-table="comment" data-id="<?php echo $info['id'] ?>" data-action="undo"></i>
		<i class="fa fa-times edit" data-table="comment" data-id="<?php echo $info['id'] ?>" data-action="delete"></i></td>
	</tr>
<?php } ?>
</table>