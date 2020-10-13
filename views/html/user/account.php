<section class="ls  section_padding_bottom_50 columns_padding_0" >
	<div class="container topmargin_50">
		<div class="row">
			<h3 class="text-center " style="color:#777;">MY ACCOUNT</h3>
			<hr>
			
			<div class="col-sm-12 content-justify">
				<?php if (Helper::verfied()==false): ?>
					<div class="alert alert-warning" style="width:100%;">Your account is not verified. Please visit your email or <a href='#'>send verfication link again</a>. Don't forget to check your <span style="color:#ff0046;">spams</span></div>
				<?php endif ?>
				<form class="shop-register col-sm-5" method="POST" id="user-account" role="form">
					<h5 style="color:#777;">Personal Information</h5>
					<div class=" bottompadding_60" id="user-register-design" >
						<div class="form-group validate-required" id="billing_first_name_field">
							<input type="email" class="form-control" disabled value="<?php echo Helper::User()['email'] ?>">
						</div>
						<div class="form-group validate-required" id="billing_first_name_field">
							<input type="text" class="form-control " name="account_first_name" id="account_first_name" placeholder="What is your First name? " value="<?php echo Helper::User()['name'] ?>">
						</div>
						<div class="form-group validate-required" id="billing_first_name_field">
							<input type="text" class="form-control " name="account_last_name" id="account_last_name" placeholder="What is your Last name? " value="<?php echo Helper::User()['last_name'] ?>">
						</div>
						<div class="form-group validate-required" id="billing_first_name_field">
							<input type="date" class="form-control " name="account_birth_date" id="account_birth_date" placeholder="What is your Birth date? " value="<?php echo Helper::User()['birth_date'] ?>">
						</div>
						<div class="form-group validate-required" id="billing_first_name_field">
							<input type="text" class="form-control " name="account_phone" id="account_phone" placeholder="What is your Phone number? " value="<?php echo Helper::User()['phone_number'] ?>">
						</div>
						<div class="form-group validate-required" id="billing_first_name_field">
							<input type="text" class="form-control " name="account_street" id="account_street" placeholder="What is your Street address? " value="<?php echo Helper::User()['street'] ?>">
						</div>
						<div class="alert" id="account-alert"></div>
					</div>
				</form>
				<form class="shop-register col-sm-5" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST" id="account-password" role="form">
					<h5 class="text-right" style="color:#777;">Change Password</h5>
					<div class=" bottompadding_60" id="user-login-design">
						<div class="form-group validate-required validate-email" id="recover_passsword">
							<input type="password" class="form-control " name="account_password" id="billing_password" placeholder="Please type your E-mail" value="">
							<div class="password_rule_container">
								Recomended:
								<div class="password-rule rule-length"><i class="fa fa-check"></i> <span>more than 6 characters </span></div>
								<div class="password-rule rule-capital"><i class="fa fa-check"></i> <span>Must include capital letter </span></div>
								<div class="password-rule rule-special"><i class="fa fa-check"></i> <span>Must include special character </span></div>
								<div class="password-rule rule-number"><i class="fa fa-check"></i> <span>Must include number </span></div>
							</div>
						</div>
						<div class="form-group" id="billing_password_field">
							<input type="password" class="form-control " name="account_password2" id="billing_password" placeholder="Please type your password" value="">
						</div>
						<button type="submit" name="account_password_button" class="theme_button wide_button color1 topmargin_10" style="width:100%;">Change Password</button>
						<div class="alert" id="change-password-alert"></div>
					</div>
				</form>

			
			</div>

		</div>
		<hr>
		<!-- orders begin -->
		<div class="row" id="orders-scroll" >
			
		   <div class="col-sm-12" style="margin-top:-80px;">
		      <h3 class="text-center" style="color:#777;">MY ORDERS</h3>
		      <div class="custom-divider"></div>
				<div class="panel-group " id="orders_accardion">
					<?php foreach (Helper::getOne('user_order','user_id',$_SESSION['userID']) as $key => $order): ?>
						
						   <div class="panel panel-default">
						      <div class="panel-heading">
						         <div class="panel-title "> 
						         	<a data-toggle="collapse" class="collapse collapsed" style="background:#1f232b;display: inline-block;width:100%;border-radius: 3px;" data-parent="#orders_accardion" href="#order-<?php echo $key ?>" aria-expanded="true" >	
						            	<div class="col-sm-2 accordion-inside" >#<?php echo $order['id'] ?></div>
						            	<div class="col-sm-2 accordion-inside" ><?php echo $order['pay_amount'] ?>$</div>
						            	<div class="col-sm-2 accordion-inside" >
						            		<?php if ($order['pay_method']==1): ?>
						            			<i style="color:#fff;" class="fa fa-credit-card-alt"></i>
						            		<?php else: ?>
						            			<i style="color:#fff;" class="fa fa-money"></i>
						            		<?php endif ?>
						            	</div>
						            	<div class="col-sm-2 accordion-inside" >
						            		<?php if ($order['pay_status']==1): ?>
						            			<i style="color:#669543;" class="fa fa-check-square"></i>
						            		<?php else: ?>
						            			<i style="color:#ff0046;" class="fa fa-exclamation-circle"></i>
						            		<?php endif ?>
						            	</div>
						            	<div class="col-sm-2 accordion-inside" >
						            		<?php if ($order['coupon']==1): ?>
						            			<span style="color:#669543;">Coupon Used</span>
						            		<?php elseif($order['coupon']==0): ?>
						            			<span style="color:#ff0046;">No Coupon</span>
						            		<?php endif ?>
						            	</div>
						            	
						            </a> 
						            
						         </div>
						      </div>
						      <div id="order-<?php echo $key ?>" class="panel-collapse collapse" aria-expanded="false" >      		
							         <div class="panel-body" style="padding-top:0;padding-left:20px;padding-bottom:0;">
							         	<?php foreach ($obj->getOrderItems($order['id']) as $items): ?>
								            <div class="media custom-media">
								                <div class="media-left">
								                    <a href="#">
								                    <img width="40px" height="40px" src="/uploads/main/<?php echo $items['main_image'] ?>" alt="">
								                    </a>
								                </div>
								               <div class="media-body vertical-center"><?php echo $items['title'] ?></div>
								               <div class="media-body vertical-center"><?php echo $items['sub_quantity'] ?>x seeds in package</div>
								               <div class="media-body"><?php echo $items['quantity'] ?>x</div>
								               <div class="media-body"><?php echo $items['paid'] ?>$</div>
								               <div class="media-body"><?php echo $items['sale'] ?>%</div>
								            </div>
								            <div class="custom-divider"></div>
							            <?php endforeach ?>
							         </div>
						      </div>
						   </div>
						
					<?php endforeach ?>
				</div>
			</div>
		</div>
		<!-- orders end -->
	</div>
</section>