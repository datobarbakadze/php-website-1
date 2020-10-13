<a style="float:left" href="/admin/attr/" class="articlelistupdate back_btn"><< BACK TO LIST</a>
<a style="float:left;font-weight:bolder;width:300px;" href="/admin/attr/add/?thing=variant" class="articlelistupdate back_btn">ADD ANOTHER VARIANT</a>
<form id="update_variant_form" class="low_font form-group" action="/admin/ajax.php?func=update_variant" align="left"  enctype="multipart/form-data" method="post">
					<input type="hidden" name="item_id" value="<?php echo $obj->id() ?>">


					<!-- Here is a title for viant  -->
					<div class="field_title high_font">Tour Title:</div>
					<input type="text"  name="variant_title" value="<?php echo $obj->getAnySingle('attrs_variants', 'id', $obj->id())['variant_title'] ?>" class="form-control input_texts low_font">


					<!-- Description for variant -->
					<div class="field_title high_font">Variant Description</div>
					<div class="item_desc_margin">
						<textarea   class="  form-control item_desc low_font" name="varaint_description" id="item_description"><?php echo $obj->getAnySingle('attrs_variants', 'id', $obj->id())['variant_desc'] ?></textarea>
					</div>

					
					<!-- attribute  -->
					<div class="admin_select_field_position">
						<b>attributes: </b>
						<select style="width:200px;" class="form-control input_texts" name="attr_id" id="animtype">
							<?php foreach ($obj->getAny('attrs') as $attr): ?>
								<option <?php echo $attr['id']==$obj->getAnySingle('attrs_variants', 'id', $obj->id())['attr_id'] ? 'selected' : '' ?> value="<?php echo $attr['id'] ?>"><?php echo $attr['attr_title'] ?></option>
							<?php endforeach ?>

						</select>
					</div><br>


					
					<img width="200px" height="200px" style="border:2px solid grey; " src="../uploads/variants/<?php echo $obj->getAnySingle('attrs_variants', 'id', $obj->id())['image'] ?>"><br><br>
					
					<input type="file" name="file" class="form-control-file">
					
					<input type="submit" name="add_tour" class="add_tour high_font" value="ADD TOUR">
			</form>