
<section class="ls section_padding_top_65 section_padding_bottom_75 columns_padding_25">
	<div class="container">
		<div class="row">
			<!-- <div class="col-sm-7 col-md-8 col-lg-8 col-sm-push-5 col-md-push-4 col-lg-push-4"> -->
			<div class="col-sm-12">
				
				<div class="table-responsive">
					<?php $obj->get_cart_count('whishlist') ?>
					<?php if ($obj->get_cart_count('whishlist')>0): ?>
						<h4 class="cart_title"><span>Whishlist </span> <summary>summary (<span class="main-cart-count" style="position:relative;"><?php echo $obj->get_cart_count('whishlist') ?></span> product)</summary></h4>
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
								
								<?php foreach ($obj->getMainCart('whishlist') as $key => $cart_item): ?>
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
											<select id="cart-sub-quantity-<?php echo $key ?>" class="seed-select cart-sub-quantity" name="cart-sub-quantity" data-key="<?php echo $key ?>" data-item-id="<?php echo $cart_item['item_id'] ?>" data-basket="whishlist">
												<?php foreach (Helper::getOne('prices','item_id',$cart_item['item_id']) as $price): ?>
													<?php if ($price['in_stock']>0): ?>
														<option data-stock="<?php echo $price['in_stock'] ?>" data-cart-sub-price="<?php echo $price['price'] ?>" value="<?php echo $price['quantity'] ?>"<?php echo ($cart_item['sub_quantity']==$price['quantity']) ? 'selected' : '' ?>><?php echo $price['quantity'] ?>x</option>
														<?php $price['quantity']==$cart_item['sub_quantity'] ? $single_price=$price['price'] : ''  ?>
													<?php endif ?>
												<?php endforeach ?>	
											</select>
										</td>
										<td class="product-price" style="line-height:60px;" > <span class="currencies">$</span><span class="amount" id="single-cart-amount-<?php echo $key ?>"><?php echo $single_price ?></span> 
										</td>
										<td class="product-quantity" >
											<div class="quantity" style="margin-top:10px;">
												<input type="button" value="-"  class="minus"> <i class="fa fa-angle-down" aria-hidden="true"></i> 
												<input type="number" id="cart-quantity-<?php echo $key ?>" step="1" data-key="<?php echo $key ?>" data-item-id="<?php echo $cart_item['item_id'] ?>" data-basket="whishlist" min="0" name="cart-quantity" value="<?php echo $cart_item['quantity'] ?>" title="Qty" class="form-control cart-quantity">
												<input type="button" value="+" class="plus">	<i class="fa fa-angle-up" aria-hidden="true"></i> 
											</div>
										</td>
										<input type="hidden" name="in_stock_<?php echo $key ?>" value="<?php echo $item['in_stock'] ?>">
										<td  style="line-height:60px;" class="product-subtotal"> <span class="currencies">$</span><span class="amount" id="single-full-amount-<?php echo $key ?>"><?php echo ($cart_item['quantity']*$single_price) ?></span> 
										</td>
										<td  style="line-height:60px;" class="product-remove">
											<a href="#" class="remove fontsize_20 ajax-delete-busket" data-key="key" data-item-id="<?php echo $cart_item['item_id'] ?>" data-basket="whishlist" title="Remove this item">	<i class="fa fa-trash-o"></i>
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
					<!-- <table class="table " style="text-align: right;">

						<thead>
							<tr>
								<td class="product-info">Subtotal</td>
								<td class="product-price-td">Shipping and Handling</td>
								<td class="product-quantity">Order Total</td>
							</tr>
						</thead>
						<tbody>
							<tr class="cart-subtotal">
								<td style="color:#ea8825;"><span class="cart-sub-total" ><?php echo $obj->updateMainCart('whishlist')['total_cost'] ?></span>$</td>
								<td style="color:#669543;"><span >0</span>$</td>
								<td style="color:#ff0046;"><span  class="cart-total" ><?php echo $obj->updateMainCart('whishlist')['total_cost'] ?></span>$</td>
							</tr>
						</tbody>
					</table> -->
				</div>
				
				
			</div>
			<!--eof .col-sm-8 (main content)-->
		</div>
	</div>
</section>