<a href="/admin/attr/add/?thing=attr" class="high_font add_tour_main">ADD ATTRIBUTE</a>
<a href="/admin/attr/add/?thing=variant" class="high_font add_tour_main">ADD VARIANT</a>
<ul class="nav nav-pills nav-justified red">
    <li class="active"><a data-toggle="pill" href="#attr">Attributes</a></li>
    <li><a data-toggle="pill" href="#variant">Variants</a></li>
    
</ul>

<div class="tab-content">
	<div id="attr" class="tab-pane fade in active">
		<table class="table">
			<thead>
				<tr>
					<td>Title</td>
					<td>action</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($obj->getAny("attrs") as $attr): ?>
					<tr id="single-attr-<?php echo $attr['id'] ?>">
						<td><?php echo $attr['attr_title'] ?></td>
						<td>
							<div class="delete just-delete lifelistdelete" data-object-table="attrs" data-object-class="single-attr" data-object-id="<?php echo $attr['id'] ?>">Delete</div>
							<a href="/admin/attr/update_attr/<?php echo $attr['id'] ?>" class="update lifelistupdate" >Update</a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
	<div id="variant" class="tab-pane fade">
		<table class="table">
			<thead>
				<tr>
					<td>Title</td>
					<td>Attribute</td>
					<td>action</td>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($obj->getAny("attrs_variants") as $variant): ?>
					<tr id="single-variant-<?php echo $variant['id'] ?>">
						<td><?php echo $variant['variant_title'] ?></td>
						<td style="color:magenta;"> <?php echo $obj->getAnySingle('attrs','id', $variant['attr_id'])['attr_title'] ?></td>
						<td>
							<div class="delete just-delete lifelistdelete" data-object-table="attrs_variants" data-object-class="single-variant" data-object-id="<?php echo $variant['id'] ?>">Delete</div>
							<a href="/admin/attr/update_variant/<?php echo $variant['id'] ?>" class="update lifelistupdate" >Update</a></td>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>



<!-- fuking variant lists -->

