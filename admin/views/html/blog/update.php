<a href="/admin/blog/" class="articlelistupdate back_btn"><< BACK TO LIST</a>

<form id="udpate_blog_form" class="low_font form-group" action="/admin/ajax.php?func=update_blog" align="left"  enctype="multipart/form-data" method="post">
		<input type="hidden" name="item_id" value="<?php echo $obj->id() ?>">
		<div class="field_title high_font">Blog Title:</div>
		<input type="text"  name="item_title" value="<?php echo $obj->getAnySingle('blog','id',$obj->id())['title'] ?>" class="form-control input_texts low_font">

		<div class="field_title high_font">Url creator:</div>
		<input type="text" name="item_url" value="<?php echo $obj->getAnySingle('blog','id',$obj->id())['url'] ?>" class="form-control input_texts low_font">

		<div class="field_title high_font">Blog Description</div>
		<div class="item_desc_margin">
			<textarea  class="ckeditor blog_description form-control input_texts item_desc low_font" name="blog_description" id="blog_description"><?php echo $obj->getAnySingle('blog','id',$obj->id())['description'] ?></textarea>
		</div>
		<hr>
		<div class="admin_select_field_position">
			<b>Category</b>
			<select style="width:200px;" class="form-control input_texts" name="category" id="animtype">
				<?php foreach ($obj->category() as $category): ?>
					<option <?php echo $category['id']==$obj->getAnySingle('blog','id',$obj->id())['category'] ? 'selected' :'' ?>  value="<?php echo $category['id'] ?>"><?php echo $category['cat_title'] ?></option>
				<?php endforeach ?>
			</select>
		</div>
		<div class="admin_select_field_position">
			<b>Availability</b>
			<select style="width:200px;" class="form-control input_texts" name="status" id="animtype">
				
					<option <?php echo $obj->getAnySingle('blog','id',$obj->id())['status']==1 ? 'selected' : '' ?>  value="1">Published</option>
				
					<option  <?php echo $obj->getAnySingle('blog','id',$obj->id())['status']==0 ? 'selected' : '' ?>  value="0">Draft</option>

			</select>
		</div>

		<input  class="input_texts low_font" type="text" value="<?php echo $obj->blog_tags() ?>" name="blog_tags"><br><br>
		
		Main image <br>
		
		<img width="200px" height="200px" style="border:2px solid grey; " src="../uploads/blog/<?php echo $obj->getAnySingle('blog','id',$obj->id())['image'] ?>"><br><br>
		
		<input type="file" name="file" class="form-control-file">
		
		<input type="submit" name="add_tour" class="add_tour high_font" value="ADD TOUR">
		<script >
			KEDITOR.replace( 'blog_description' );
			$( '.blog_description' ).ckeditor();
		</script>
</form>
