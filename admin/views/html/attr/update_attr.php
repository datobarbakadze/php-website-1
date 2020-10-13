<a href="/admin/attr/" class="articlelistupdate back_btn"><< BACK TO LIST</a>
<form id="update_attr_form" class="low_font form-group" action="/admin/ajax.php?func=update_attr" align="left"  enctype="multipart/form-data" method="post">
        <input type="hidden" name="item_id" value="<?php echo $obj->id() ?>">

        <!-- Here is a title for viant  -->
        <div class="field_title high_font">Tour Title:</div>
        <input type="text"  name="attr_title" value="<?php echo $obj->getAnySingle('attrs', 'id', $obj->id())['attr_title'] ?>" class="form-control input_texts low_font">

        <!-- Description for variant -->
        <div class="field_title high_font">attr Description</div>
        <div class="item_desc_margin">
            <textarea   class="  form-control item_desc low_font" name="attr_description" id="item_description"><?php echo $obj->getAnySingle('attrs', 'id', $obj->id())['attr_desc'] ?></textarea>
        </div>
        
        
        <input type="submit" name="add_attr" class="add_attr high_font" value="ADD TOUR">
        <a href="/admin/attr/add/?thing=variant&attr_id=<?php echo $obj->id() ?>" >Add variant for this attribute</a>
</form>