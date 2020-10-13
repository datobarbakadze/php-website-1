<a href="/admin/category/" class="articlelistupdate back_btn"><< BACK TO LIST</a>
<form id="update_category_form" class="low_font form-group" action="/admin/ajax.php?func=update_category" align="left"  enctype="multipart/form-data" method="post">
		<input type="hidden" name="item_id" value="<?php echo $obj->id() ?>">


		<!-- Here is a title for viant  -->
		<div class="field_title high_font">Tour Title:</div>
		<input type="text"  name="cat_title" value="<?php echo $obj->getAnySingle('category', 'id', $obj->id())['cat_title'] ?>" class="form-control input_texts low_font">


		<!-- Description for variant -->
		<div class="field_title high_font">Variant Description</div>
		<div class="item_desc_margin">
			<textarea   class="  form-control item_desc low_font" name="cat_description" id="item_description"><?php echo $obj->getAnySingle('category', 'id', $obj->id())['cat_description'] ?></textarea>
		</div>

		<div class="admin_select_field_position">
			<b>attributes: </b>
			<select style="width:200px;" class="form-control input_texts" name="cat_type" id="animtype">
				<option value="0">Choose category</option>
				<option value="1" <?php echo $obj->getAnySingle('category', 'id', $obj->id())['type']==1 ? 'selected' : '' ?>>Item</option>
				<option value="2" <?php echo $obj->getAnySingle('category', 'id', $obj->id())['type']==2 ? 'selected' : '' ?>>blog</option>

			</select>
		</div><br>
		<img width="200px" height="200px" style="border:2px solid grey; " src="../uploads/category/<?php echo $obj->getAnySingle('category', 'id', $obj->id())['icon'] ?>"><br><br>
		
		<input type="file" name="file" class="form-control-file">
		
		<input type="submit" name="add_tour" class="add_tour high_font" value="ADD TOUR">
</form>