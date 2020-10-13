
<a href="/admin/item" class="articlelistupdate back_btn"><< BACK TO TOURS</a>
<ul class="nav nav-pills nav-justified red">
    <li class="active"><a data-toggle="pill" href="#info">Item info</a></li>
    <li><a data-toggle="pill" href="#gallery">Item gallery</a></li>
    <li><a data-toggle="pill" href="#question">Item questions</a></li>
    <li><a data-toggle="pill" href="#prices">Item prices</a></li>
    
  </ul>
  <br>
  <br>
  <div class="tab-content">
  		<div id="info" class="tab-pane fade in active">
			<form id="update_item_form" class="low_font form-group" action="/admin/ajax.php?func=updateTour" align="left"  enctype="multipart/form-data" method="post">
					<input type="hidden" name="item_id" value="<?php echo $obj->id() ?>">
					<div class="field_title high_font">Tour Title:</div>
					<input type="text"  name="item_title" value="<?php echo $obj->get()['title'] ?>" class="form-control input_texts low_font">

					<div class="field_title high_font">Url creator:</div>
					<input type="text" name="item_url" value="<?php echo $obj->get()['url'] ?>" class="form-control input_texts low_font">

					<div class="field_title high_font">Item Description</div>
					<div class="item_desc_margin">
						<textarea   class="  form-control item_desc low_font" name="item_description" id="item_description"><?php echo $obj->get()['description'] ?></textarea>
					</div>

					<div class="field_title high_font">Item More Inforamtion</div>
					<div class="item_desc_margin">
						<textarea  class="ckeditor more_info form-control input_texts item_desc low_font" name="more_info" id="more_info"><?php echo $obj->get()['more_info'] ?></textarea>
					</div>
					
					<!-- percentages of nuterients -->
					<div class="ganja-title high_font" onclick="hider('nutrient-table')"> Nutrient percentage section </div>
					<table id="nutrient-table" style="margin-bottom:50px;margin-top:20px;">
						<thead>
							<tr>
								<td><b>THC</b></td>
								<td><b>CBD</b></td>
								<td><b>SATIVA</b></td>
								<td><b>INDICA</b></td>
								<td><b>RUDERAILS</b></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<input min="0" class="input_number low_font" type="number" name="thc" value="<?php echo $obj->get()['thc'] ?>"><b> %</b>
								</td>
								<td>
									<input min="0" class="input_number low_font" type="number" name="cbd" value="<?php echo $obj->get()['cbd'] ?>"><b> %</b>
								</td>
								<td>
									<input min="0" class="input_number low_font" type="number" name="sativa" value="<?php echo $obj->get()['sativa'] ?>"><b> %</b>
								</td>
								<td>
									<input min="0" class="input_number low_font" type="number" name="indica" value="<?php echo $obj->get()['indica'] ?>"><b> %</b>
								</td>
								<td>
									<input min="0" class="input_number low_font" type="number" name="ruderails" value="<?php echo $obj->get()['ruderails'] ?>"><b> %</b>
								</td>
								<td></td>
							</tr>
						</tbody>
					</table>



					<!--expected Yeild -->
					<div class="ganja-title" onclick="hider('yield-table')"> Yield Section</div>
					<table id="yield-table" style="margin-bottom:50px;margin-top:20px;">

						
						<thead>
							<tr>
								<td><b>Yield in from</b></td>
								<td><b>Yield in to</b></td>
								<td><b>Yield out from</b></td>
								<td><b>Yield out to</b></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<input min="0" class="input_number low_font" type="number" name="yield_indoor_from" value="<?php echo $obj->get()['yield_indoor_from'] ?>"><b> g/m</b>
								</td>
								<td>
									<input min="0" class="input_number low_font" type="number" name="yield_indoor_to" value="<?php echo $obj->get()['yield_indoor_to'] ?>"><b>g/m<b>
								</td>
								<td>
									<input min="0" class="input_number low_font" type="number" name="yield_outdoor_from" value="<?php echo $obj->get()['yield_outdoor_from'] ?>"><b> g/plant</b>
								</td>
								<td>
									<input min="0" class="input_number low_font" type="number" name="yield_outdoor_to" value="<?php echo $obj->get()['yield_outdoor_to'] ?>"><b> g/plant</b>
								</td>
							</tr>
						</tbody>
					</table>

					<!-- expected height section -->
					<div class="ganja-title" onclick="hider('height-table')"> Height Section</div>
					<table id="height-table" style="margin-bottom:50px;margin-top:20px;">

						
						<thead>
							<tr>
								<td><b>Height in from</b></td>
								<td><b>Height in to</b></td>
								<td><b>Height out from</b></td>
								<td><b>Height out to</b></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<input min="0" class="input_number low_font" type="number" name="height_indoor_from" value="<?php echo $obj->get()['height_indoor_from'] ?>"><b> cm</b>
								</td>
								<td>
									<input min="0" class="input_number low_font" type="number" name="height_indoor_to" value="<?php echo $obj->get()['height_indoor_to'] ?>"><b> cm</b>
								</td>
								<td>
									<input min="0" class="input_number low_font" type="number" name="height_outdoor_from" value="<?php echo $obj->get()['height_outdoor_from'] ?>"><b> cm</b>
								</td>
								<td>
									<input min="0" class="input_number low_font" type="number" name="height_outdoor_to" value="<?php echo $obj->get()['height_outdoor_to'] ?>"><b> cm</b>
								</td>
							</tr>
						</tbody>
					</table>

					<!-- flowering and stuff -->
					<div class="ganja-title" onclick="hider('flower-table')"> FLOWERING AND OTHER</div>
					

					<table id="flower-table" style="margin-bottom:50px;margin-top:20px;">
						<thead>
							<tr>
								<td><b>flowering from</b></td>
								<td><b>flowering to</b></td>
								<td><b>Quantity</b></td>
								<td><b>Cup winner</b></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<input min="0" class="input_number low_font" type="number" name="flowering_time_from" value="<?php echo $obj->get()['flowering_time_from'] ?>"><b>week</b>
								</td>
								<td>
									<input min="0" class="input_number low_font" type="number" name="flowering_time_to" value="<?php echo $obj->get()['flowering_time_to'] ?>"><b> week</b>
								</td>
								<td>
									<input min="0" class="input_number low_font" type="number" name="in_stock" value="<?php echo $obj->get()['in_stock'] ?>"><b></b>
								</td>
								<td>
									<label style="display:inline-block;" class="container_check">
										  <input type="radio" value="0" <?php echo $obj->get()['cup_winner']==0 ? 'checked' : '' ?> name="cup_winer" class="cup_check" data-id="">
										  <span class="checkmark_check">N</span>

									</label>
									<label style="display:inline-block;" class="container_check">
										  <input type="radio" <?php echo $obj->get()['cup_winner']==1 ? 'checked' : '' ?> name="cup_winer" value="1" class="cup_check" data-id="">
										  <span class="checkmark_check">Y</span>
										  
									</label>
								</td>
							</tr>
						</tbody>
					</table>
					<br>
					<hr>
					<div class="admin_select_field_position">
						<b>Category</b>
						<select style="width:200px;" class="form-control input_texts" name="category" id="animtype">
							<?php foreach ($obj->getAny("category") as $category): ?>
									<option value="<?php echo $category['id'] ?>" <?php echo $category['id']==$obj->get()['category'] ? 'selected' : '' ?>><?php echo $category['cat_title'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="admin_select_field_position">
						<b>Availability</b>
						<select style="width:200px;" class="form-control input_texts" name="status" id="animtype">
							
								<option  <?php echo $obj->get()['status']==1 ? 'selected' : ''  ?> value="1">Published</option>
							
								<option  <?php echo $obj->get()['status']==0 ? 'selected' : ''  ?> value="0">Draft</option>

						</select>
					</div>
					<div class="admin_select_field_position">
						<b>Price</b><br>
						<input min="0" class="input_number low_font" type="number" name="price" value="<?php echo $obj->get()['price'] ?>"><b>$</b>
					</div>
					<div class="admin_select_field_position">
						<b>Sale</b><br>
						<input min="0" class="input_number low_font" type="number" name="sale" value="<?php echo $obj->get()['sale'] ?>"><b>$</b>
					</div>
					<br>

					

					<b>Tour categories:</b>
					<div style="color:white;" class="category_cont">
						<table>

						<?php foreach ($obj->getAny("attrs") as $attr): ?>
							<tr>
								<td><?php echo $attr['attr_title'] ?>: &nbsp;&nbsp;&nbsp;</td>
								<td>
									<?php foreach ($obj->getAnySingle("attrs_variants","attr_id",$attr['id']) as $variant): ?>
										<div class="attr <?php echo $obj->variant_active($variant['id']) ? 'attr_red' : ''?>" data-attr-id="<?php echo $attr['id'] ?>" data-variant-id="<?php echo $variant['id'] ?>"> <?php echo $variant['variant_title'] ?></div>
									<?php endforeach ?>
								</td>
							</tr>
						<?php endforeach ?>

						</table>
					</div>
						<input  class="input_texts low_font" type="hidden" value="<?php echo $obj->item_variant() ?>" name="variant_input"><br><br>
					
					Main image <br>
					
					<img width="200px" height="200px" style="border:2px solid grey; " src="../uploads/main/<?php echo $obj->get()['main_image'] ?>"><br><br>
					
					<input type="file" name="file" class="form-control-file">
					
					<input type="submit" name="add_tour" class="add_tour high_font" value="ADD TOUR">
			</form>
		</div>


<!-- gallery section begin -->
<div id="gallery" class="tab-pane fade">

	<main role="main" class="container">


      <div class="row">
        <div class="">
        	<input type="hidden" name="item_id" class="item_id" value="<?php echo $obj->id() ?>">
          <!-- Our markup, the important part here! -->
          <label for="file_u_p" id="drag-and-drop-zone" class="dm-uploader p-5">
            <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop files here</h3>

            <div class="btn btn-primary btn-block mb-5 btn_up">
                <span>Open the file Browser</span>
                <input style="display:none;"  type="file" id="file_u_p" title='Click to add Files' />
            </div>
          </label><!-- /uploader -->

        </div>
        
          <div class="card h-100">
            

            <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
              <li class="text-muted text-center empty">No files uploaded.</li>
            </ul>
          </div>
      </div><!-- /file list -->
			<!--<ul class="list-group list-group-flush" id="debug">
              <li class="list-group-item text-muted empty">Loading plugin....</li>
            </ul>-->
      

    </main> <!-- /container -->

    <!-- File item template -->
    <script type="text/html" id="files-template">
      <li class="media ">
        <div class="media-body mb-1" style="width:100%">
          <p class="uploadimagetitle">
            <strong>%%filename%%</strong> - Status: <span class="text-muted">Waiting</span>
          </p>
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
              role="progressbar"
              style="width: 0%" 
              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
          <hr class="mt-1 mb-1" />
        </div>
      </li>
    </script>

    <!-- Debug item template -->
    <!--<script type="text/html" id="debug-template">
      <li class="list-group-item text-%%color%%"><strong>%%date%%</strong>: %%message%%</li>
    </script>-->
   <div class="image_list">
   			<?php foreach ($obj->getGallery($obj->id()) as $gallery): ?>
	   			<div class="image" id="gallery_image_<?php echo $gallery['id'] ?>" style="max-width:200px;max-height:200px;display:inline-block;margin-bottom:30px;position:relative;">
	   				
	   					<img height="200px" src="../uploads/gallery/<?php echo $gallery['image_name'] ?>">
		   				<button class="del_image" style="color:white;background:#aa2e4d;position:absolute;bottom:0;left:0;border:none;" data-id="<?php echo $gallery['id'] ?>" >delete</button>
	   				
		   			
	   			</div>
   			<?php endforeach ?>
   		
   </div>
</div>
<!-- gallery section end -->

				
<!-- inclusions section beign -->
<div id="question" class="tab-pane fade">
	<div class="row">
		<div class="col-4" id="list-tab" role="tablist">
			<form id="add_question_form" class="low_font form-group" action="/admin/ajax.php?func=add_question" align="left"  enctype="multipart/form-data" method="post">
		        <input type="hidden" name="item_id" value="<?php echo $obj->id() ?>">

		        <!-- Here is a title for viant  -->
		        <div class="field_title high_font">Question:</div>
		        <input type="text"  name="item_question" value="" class="form-control input_texts low_font">
		        <div class="field_title high_font">Answer:</div>
		        <input type="text"  name="item_answer" value="" class="form-control input_texts low_font">
		        <div class="field_title high_font">Asker:</div>
		        <input class="form-control col-3 input-xs"  type="text" name="asker">
		        <div class="field_title high_font">Replier:</div>
		        <input class="form-control col-3 input-xs"  type="text" name="replier">
		        <div class="field_title high_font">Replier Url:</div>
		        <input class="form-control col-3 input-xs"  type="text" name="replier_url">
		        
		        
		        <input type="submit" name="add_question" class="add_question high_font" value="ADD TOUR">
		        
			</form>
		</div>
		<div class="col-8">
			<ul class="list-group borderless">
				<?php foreach ($obj->getAnySingle('item_question','item_id',$obj->id()) as $question ): ?>
					<li class="list-group-item row " id="single-question-<?php echo $question['id'] ?>">
						<div class="col-sm-9"><?php echo $question['question'] ?></div>
						<button class="btn btn-danger right col-sm-2 just-delete" data-object-class="single-question" data-object-table="item_question" data-object-id="<?php echo $question['id'] ?>">Delete</button>
					</li>
				<?php endforeach ?>
					
					
				
				
			</ul>
		</div>
	</div>
	
</div>
<!-- inclusions section end -->

<!-- schedule section begin -->


<!-- schedule section end -->

<!-- services section begin -->

<div id="prices" class="tab-pane fade">
	
	
		<table class="table">
			<thead>
				<tr>
					<td>#</td>
					<td>quantity</td>
					<td>price</td>
					<td>in stock</td>
					<td>Action</td>
				</tr>
				<tr style="height:20px;"></tr>
			</thead>
			<tbody>
				<form id="add_price_form" class="low_font form-group" action="/admin/ajax.php?func=add_price" method="POST">
					<input type="hidden" name="item_id" value="<?php echo $obj->id() ?>">
					<tr>
						<td>#</td>
						<td><input min="0" class="input_number low_font" type="number" name="quantity" value=""></td>
						<td><input min="0" class="input_number low_font" type="number" name="price" value=""><b>$</b></td>
						<td><input min="0" class="input_number low_font" type="number" name="in_stock" value="">x<b></b></td>
						<td><button style="width:100px;" class="btn btn-success right col-sm-2 just-delete" data-object-class="single-question" data-object-table="item_question" data-object-id="10">Add price</button></td>
					</tr>
				</form>
					<?php foreach ($obj->getAnySingle('prices','item_id',$obj->id()) as $key => $price): ?>
						<tr class="" id="single-price-<?php echo $price['id'] ?>">
							<td>#<?php echo $key+=1 ?></td>
							<td><?php echo $price['quantity'] ?></td>
							<td><?php echo $price['price'] ?></td>
							<td><?php echo $price['in_stock'] ?>x</td>
							<td>
								<button style="width:100px;" class="btn btn-danger right col-sm-2 just-delete" data-object-class="single-price" data-object-table="prices" data-object-id="<?php echo $price['id'] ?>">Delete</button>
							</td>
							
						</tr>
					<?php endforeach ?>
			</tbody>
		</table>
	   

	
</div>

	
</div>


<!-- service section end -->
<script >
	CKEDITOR.replace( 'more_info' );
	$( '.more_info' ).ckeditor();
</script>




