<?php var_dump($_COOKIE) ?>
<section class="ls section_padding_top_65 section_padding_bottom_75 columns_padding_25">
	<div class="container">
		<div class="row">
			<!-- <div class="col-sm-7 col-md-8 col-lg-8 col-sm-push-5 col-md-push-4 col-lg-push-4"> -->
			<div class="col-sm-12">
				
				<div class="table-responsive">
					<?php $obj->get_cart_count('cart') ?>
					<?php if ($obj->get_cart_count('cart')>0): ?>
						<h4 class="cart_title"><span>Shopping cart </span> <summary>summary (<span class="main-cart-count" style="position:relative;"><?php echo $obj->get_cart_count('cart') ?></span> product)</summary></h4>
						<table class="table shop_table cart cart-table">
							<thead>
								<tr>
									<td class="product-info">Product</td>
									<td class="product-quantity">&nbsp;</td>
									<td class="product-price-td">Price</td>
									<td class="product-quantity">Quantity</td>
									<td class="product-subtotal">Subtotal</td>
									<td class="product-remove">&nbsp;</td>
								</tr>
							</thead>
							
							<tbody>
								
								<?php foreach ($obj->getMainCart('cart') as $key => $cart_item): ?>
									<?php 
										$item = Helper::getOne('item','item_id',$cart_item['item_id'])[0]; 
									?>
									<tr id="main-cart-item-<?php echo $key ?>" style="" class="cart_item">
										<td class="product-info">
											<div class="media">
												<div class="media-left">
													<a href="shop-product-right.html">
														<img class="media-object cart-product-image" src="./uploads/main/<?php echo $item['main_image'] ?>" alt="">
													</a>
												</div>
												<div  class="media-body">
													<h4  style="line-height:60px;" class="media-heading"> <a  href="shop-product-right.html"><?php echo $item['title'] ?></a> </h4> 
												</div>
										</td>
										<td class="seed-quantity text-center">
											Number of seeds 
											<select id="cart-sub-quantity-<?php echo $key ?>" class="seed-select cart-sub-quantity" name="cart-sub-quantity" data-key="<?php echo $key ?>" data-item-id="<?php echo $cart_item['item_id'] ?>" data-basket="cart">
												<?php foreach (Helper::getOne('prices','item_id',$cart_item['item_id']) as $price): ?>
													<?php if ($price['in_stock']>0): ?>
														<option data-stock="<?php echo $price['in_stock'] ?>" data-cart-sub-price="<?php echo $price['price'] ?>" value="<?php echo $price['quantity'] ?>"<?php echo ($cart_item['sub_quantity']==$price['quantity']) ? 'selected' : '' ?>><?php echo $price['quantity'] ?>x</option>
														<?php $price['quantity']==$cart_item['sub_quantity'] ? $single_price=$price['price'] : ''  ?>
													<?php endif ?>
												<?php endforeach ?>	
											</select>
										</td>
										<td class="product-price" style="line-height:60px;" > <span class="currencies">$</span><span class="amount" id="single-cart-amount-<?php echo $key ?>">
											<?php 
												if ($item['sale']>0) {
													echo round($single_price - ($single_price*$item['sale']/100));
												}else
													echo round($single_price) 
											?>
												

											</span> 
										</td>
										<td class="product-quantity" >
											<div class="quantity" style="margin-top:10px;">
												<input type="button" value="-"  class="minus"> <i class="fa fa-angle-down" aria-hidden="true"></i> 
												<input type="number" id="cart-quantity-<?php echo $key ?>" step="1" data-key="<?php echo $key ?>" data-item-id="<?php echo $cart_item['item_id'] ?>" data-basket="cart" min="0" name="cart-quantity" value="<?php echo $cart_item['quantity'] ?>" title="Qty" class="form-control cart-quantity">
												<input type="button" value="+" class="plus">	<i class="fa fa-angle-up" aria-hidden="true"></i> 
											</div>
										</td>
										<input type="hidden" name="in_stock_<?php echo $key ?>" value="<?php echo $item['in_stock'] ?>">
										<td  style="line-height:60px;" class="product-subtotal"> <span class="currencies">$</span><span class="amount" id="single-full-amount-<?php echo $key ?>">
											<?php 
												if ($item['sale']>0) {
													;
													echo $cart_item['quantity']*round($single_price - ($single_price*$item['sale']/100));
												}else
													echo round($cart_item['quantity']*$single_price) ;
											?>
										</span> 
										</td>
										<td  style="line-height:60px;" class="product-remove">
											<a href="#" class="remove fontsize_20 ajax-delete-busket" data-key="key" data-item-id="<?php echo $cart_item['item_id'] ?>" data-basket="cart" title="Remove this item">	<i class="fa fa-trash-o"></i>
											</a>
										</td>
									</tr>
									<tr class="custom-divider"></tr>
								<?php endforeach ?>
								
								<tr class="custom-divider"></tr>
								<tr class="custom-divider"></tr>
								<tr class="custom-divider"></tr>
							</tbody>
						</table>
					<?php else: ?>
						<hr>
						<h4  class="text-center toppadding_20 bottompadding_20">You have not added anything to cart</h4>
					<?php endif ?>
					<table class="table " style="text-align: right;">

						<thead>
							<tr>
								<td class="product-info">Subtotal</td>
								<td class="product-price-td">Shipping and Handling</td>
								<td class="product-quantity">Order Total</td>
							</tr>
						</thead>
						<tbody>
							<tr class="cart-subtotal">
								<td style="color:#ea8825;"><span class="cart-sub-total" ><?php echo $obj->updateMainCart('cart')['total_cost'] ?></span>$</td>
								<td style="color:#669543;"><span >0</span>$</td>
								<td style="color:#ff0046;"><span  class="cart-total" ><?php echo $obj->updateMainCart('cart')['total_cost'] ?></span>$</td>
							</tr>
						</tbody>
					</table>
				</div>
				<?php if (Helper::logged()==false): ?>
					<div class="alert alert-warning">Please login to your account to buy the product</div>
				<?php endif ?>
				<?php if (Helper::verfied()==false): ?>
					<div class="alert alert-warning">Your account is not verified. Please visit your email or <a href='#'>send verfication link again</a>. Don't forget to check your <span style="color:#ff0046;">spams</span></div>
				<?php endif ?>
				<div class="cart-buttons pull-right"> 
					<input type="text" name="coupon" placeholder="your coupon code" class="" style="margin-bottom:20px;">
					<a class="continue_shopping" href="#">Continue Shopping</a> 
					<!-- <input type="submit" class="theme_button color4" name="update_cart" value="Update Cart"> -->

					<button type="submit" class="theme_button inverse">Proceed to Checkout</button>
					
				</div>
			</div>
			<!--eof .col-sm-8 (main content)-->


			<div id="checkout-scroll" class="col-md-12"></div>
			<div class="row">
				<div class="col-md-12 ">
					<?php if (Helper::logged()==false): ?>
						<div class="row vertical-tabs color3">
							<div class="col-sm-4">
								<!-- Nav tabs -->
								<ul class="nav" role="tablist">
									<li class="active"> 
										<a href="#login-tab" role="tab" data-toggle="tab">
											<i class="fa fa-sign-in"></i> LOGIN TO BUY
										</a> 
									</li>
									<li class="register-tab-li"> 
										<a href="#register-tab" role="tab" data-toggle="tab">
											<i class="fa fa-user-plus"></i> REGISTER TO BUY
										</a> 
									</li>
									
								</ul>
							</div>
							<div class="col-sm-8">
								<!-- Tab panes -->
								<div class="tab-content">
									<div class="tab-pane fade in active" id="login-tab">
										<form  method="POST" class="shop-register " id="user-login" role="form">
											<h5 class="text-center" style="color:#669543;">Login in your account to buy product</h5>
											<div class=" content-justify " id="user-login-design">
												<div class="form-group validate-required validate-email" id="billing_email_field">
													<label for="billing_email" class="control-label">	<span class="grey">Email Address:</span>
														<span class="required">*</span>
													</label>
													<input type="text" class="form-control " name="login_billing_email" id="billing_email" placeholder="Please type your E-mail" value="">
												</div>
												<div class="form-group" id="billing_password_field">
													<label for="billing_password" class="control-label">	<span class="grey">Password:</span>
														<span class="required">*</span>
													</label>
													<input type="password" class="form-control " name="login_billing_password" id="billing_password" placeholder="Please type your password" value="">
												</div>
												<div class="form-group col-md-12">	<a href="/forgot-password">Did you forgot your password ?</a>
												</div>
												<button type="submit" class="theme_button wide_button color1 topmargin_10" style="width:100%;background:#669543;">Login</button>
												<div class="alert col-sm-12" id="login-alert"></div>
											</div>
										</form>
										
									</div>
									<div class="tab-pane fade" id="register-tab">
										<form class="shop-register " method="POST" id="user-register" role="form">
											<h5 class="text-center " style="color:#ea8825;">Create an account to buy product</h5>
											<div class="content-justify" id="user-register-design" >
												<div class="form-group validate-required" id="billing_first_name_field">
													<input type="text" class="form-control " name="billing_first_name" id="billing_first_name" placeholder="What is your First name? " value="">
												</div>
												<div class="form-group validate-required validate-email" id="billing_email_field">
													<input type="text" class="form-control " name="billing_email" id="billing_email" placeholder="What is your E-mail?" value="">
												</div>
												<div class="form-group" id="billing_password_field">
													<input type="text" class="form-control " name="billing_password" id="billing_password" placeholder="Please type a password" value="">
													<div class="password_rule_container">
														<div class="password-rule rule-length"><i class="fa fa-check"></i> <span>more than 6 characters </span></div>
														<div class="password-rule rule-capital"><i class="fa fa-check"></i> <span>Must include capital letter </span></div>
														<div class="password-rule rule-special"><i class="fa fa-check"></i> <span>Must include special character </span></div>
														<div class="password-rule rule-number"><i class="fa fa-check"></i> <span>Must include number </span></div>
													</div>
												</div>
												<div class="form-group" id="billing_password2_field">
													<input type="text" class="form-control " name="billing_password2" id="billing_password2" placeholder="Please confirm the password" value="">
												</div>
												<div class="col-md-12 form-group checkbox">
													<div class="checkbox checkbox-slider--b-flat">
														<label>
															<input value="1" type="checkbox" id="rules_input" name="rules_input"> <span style="color: #ea8825;">I agree with the rules</span>
														</label>
													</div>
												</div>
												<button type="submit" class="theme_button wide_button color1 topmargin_10" style="width:100%;background: #ea8825;">Register Now</button>
												<div class="alert col-sm-12" id="register-alert"></div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					<?php else: ?>
						<form class="shop-register col-sm-12 " method="POST" id="user-account" role="form">
							<div class=" bottompadding_60" style="margin-left:-10px;" id="user-register-design" >
								<div class="col-sm-4 form-group validate-required cart-finish-input" id="billing_first_name_field">
									<input type="text" class="form-control cart-finish-input" disabled value="<?php echo Helper::User()['email'] ?>">
								</div>
								<div class="col-sm-4 form-group validate-required cart-finish-input" id="billing_first_name_field">
									<input type="text" class="form-control cart-finish-input" name="account_first_name" id="account_first_name" placeholder="What is your First name? " value="<?php echo Helper::User()['name'] ?>">
								</div>
								<div class="col-sm-4 form-group validate-required cart-finish-input" id="billing_first_name_field">
									<input type="text" class="form-control cart-finish-input" name="account_last_name" id="account_last_name" placeholder="What is your Last name? " value="<?php echo Helper::User()['last_name'] ?>">
								</div>
								<div class="col-sm-4 form-group validate-required cart-finish-input" id="billing_first_name_field">
									<input type="date" class="form-control cart-finish-input" name="account_birth_date" id="account_birth_date" placeholder="What is your Birth date? " value="<?php echo Helper::User()['birth_date'] ?>">
								</div>
								<div class="col-sm-4 form-group validate-required cart-finish-input" id="billing_first_name_field">
									<input type="text" class="form-control cart-finish-input" name="account_phone" id="account_phone" placeholder="What is your Phone number? " value="<?php echo Helper::User()['phone_number'] ?>">
								</div>
								<div class="col-sm-4 form-group validate-required cart-finish-input" id="billing_first_name_field">
									<input type="text" class="form-control cart-finish-input" name="account_street" id="account_street" placeholder="What is your Street address? " value="<?php echo Helper::User()['street'] ?>">
								</div>
								<div class="alert col-sm-12 " id="account-alert"></div>
							</div>
						</form>
					<?php endif ?>
					
				</div>
			</div>
		</div>
	</div>
</section>