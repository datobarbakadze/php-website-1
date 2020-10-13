<ul class="nav nav-pills nav-justified red">
    <li class="active"><a data-toggle="pill" href="#faq">Frequently Asked Questions</a></li>
    <li><a data-toggle="pill" href="#about">About Us</a></li>
    
  </ul>

    <br>
  <br>
  <div class="tab-content">
  		<div id="faq" class="tab-pane fade in active">
  			<table>
  				
  			</table>
  			<form class="form-horizontal" id="add_faq" method="POST" action="/admin/ajax.php?func=add_faq">
			    <div class="form-group">
			        
			        <div class="col-xs-5">
			        	<label>Question</label>
			            <input class="form-control col-sm-7 input-xs" type="text" name="faq_question"> 
			        </div>
			        <div class="col-xs-5">
			        	<label>Answer</label>
			            <input class="form-control col-sm-7 input-xs" type="text" name="faq_answer">
			        </div>
			        <div class="col-xs-2">
			        	<label>Action</label>
			            <input value="Insert" type="submit" class="form-control btn btn-success input-xs">
			        </div>
			    </div>
			</form>
			<div class="row">
				<?php foreach ($theClass->get_faq() as $info): ?>
					<div id="faq-object-<?php echo $info['id']; ?>">
						<div class="col-xs-5">
							<?php echo $info['question'] ?>
						</div>
						<div class="col-xs-5">
							<?php echo $info['answer'] ?>
						</div>
						
						<div class="col-xs-2">
							<button class="btn btn-danger right just-delete" data-object-class="faq-object" data-object-table="faq" data-object-id="<?php echo $info['id']; ?>">Delete</button>
						</div>
					</div><br><br><br>
				<?php endforeach ?>
			</div>
  		</div>
  		<div id="about" class="tab-pane fade in active">
  			
  		</div>
  </div>