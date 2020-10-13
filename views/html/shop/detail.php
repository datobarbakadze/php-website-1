

<section class="ls  section_padding_bottom_130 columns_padding_25" >
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div itemscope="" itemtype="http://schema.org/Product" class="type-product row">
					<div class="col-sm-6">
						<div class="images text-center rounded">
							<a href="./uploads/main/<?php echo $obj->get()['item']['main_image'] ?>" itemprop="image" class="woocommerce-main-image zoom prettyPhoto" data-gal="prettyPhoto[product-gallery]">
								<img src="./uploads/main/<?php echo $obj->get()['item']['main_image'] ?>" class="attachment-shop_single wp-post-image"  alt="<?php echo $obj->get()['item']['title'] ?>" title="$obj->get()['item']['title']">
							</a>
						</div>
						<!--eof .images -->
						<div class="thumbnails-wrap">
							<div id="product-thumbnails" class="owl-carousel thumbnails product-thumbnails" data-margin="10" data-nav="false" data-dots="true" data-responsive-lg="4" data-responsive-md="4" data-responsive-sm="3" data-responsive-xs="2">
								<?php foreach (Helper::getOne('item_gallery','item_id',$obj->id(1)) as $gallery): ?>
									<a href="./uploads/gallery/<?php echo $gallery['image_name'] ?>" class="zoom first rounded" title="" data-gal="prettyPhoto[product-gallery]">
										<img src="./uploads/gallery/<?php echo $gallery['image_name'] ?>" class="attachment-shop_thumbnail" alt="">
									</a>
								<?php endforeach ?>
							</div>
						</div>
						<!-- eof .images -->
					</div>
					<div class="summary entry-summary col-sm-6">
						<div class="leftmargin_10">
							<h1 itemprop="name" class="product_title high_font"><?php echo $obj->get()['item']['title'] ?></h1>
							<div>
								<p><?php echo $obj->get()['item']['description'] ?></p>
								
							</div>
							
							<div id="indicascroll" class="col-sm-3 detail_level" >
								<div class="indica_level" data-percent="<?php echo $obj->get()['item']['indica'] ?>" ></div>
								<div class="lvl_text">Indica</div>
							</div>
							<div id="sativascroll" class="col-sm-3 col-sm-offset-1 detail_level" >
								
								<div class="sativa_level" data-percent="<?php echo $obj->get()['item']['sativa'] ?>" ></div>
								<div class="lvl_text">Sativa</div>
							</div>
							<div id="ruderailsscroll" class="col-sm-3 col-sm-offset-1 detail_level" >
								<div class="lvl_text">Ruderails</div>
								<div class="ruderails_level" data-percent="<?php echo $obj->get()['item']['ruderails'] ?>" ></div>
							</div>
						</div>
						<div class="col-sm-12 content-justify vertical-center content-margins" >
							<div class="star_rating">
								<img src="/views/images/star.png" class="star-icon-detail">
								<img src="/views/images/star.png" class="star-icon-detail">
								<img src="/views/images/star.png" class="star-icon-detail">
								<img src="/views/images/star.png" class="star-icon-detail">
								<img src="/views/images/star.png" class="star-icon-detail">
							</div> 
							<?php if (Helper::inCart('whishlist',$obj->id(0))): ?>
							<span href="#0" class="add_to_whishlist " id="ajax-to-cart"  data-item-id="<?php echo $obj->id(1) ?>" data-basket="whishlist">	
								<i style="color:#54be73;" class="fa fa-heartbeat  rightpadding_10" aria-hidden="true"></i>
								<div class="whishlist-plus" style="background:#ccc;">-</div>
							</span>
							<?php else: ?>
							<span href="#0" class="add_to_whishlist" id="ajax-to-cart"  data-item-id="<?php echo $obj->id(1) ?>" data-basket="whishlist">	
								<i class="fa fa-heartbeat  rightpadding_10" aria-hidden="true"></i>
								<div class="whishlist-plus">+</div>
							</span>
							<?php endif ?>	
							
						</div>
						
						<div class="col-sm-12  vertical-left content-margins" >
							<?php foreach (Helper::getOne('prices','item_id',$obj->id(1)) as $k => $price): ?>
								<?php if ($price['in_stock']>0): ?>
									
								
									<input form="add_cart_form" type="radio" data-sub-price="<?php echo $price['price'] ?>" value="<?php echo $price['quantity'] ?>" data-stock="<?php echo $price['in_stock'] ?>" <?php echo $price['quantity']==1 ? 'checked' : '' ?> name="sub_quantity" id="sub-quantity-<?php echo $k ?>" class="sub-quantity">
									<label class="sub-quantity-label" for="sub-quantity-<?php echo $k ?>">
										<div class="select-quantity high_font">Stock: <?php echo $price['in_stock'] ?></div>
										<i style="color:white" class="fa fa-check"></i>	
										<div class="sub-quantity-position">
											<div class="sub-quantity-radio"><?php echo $price['quantity'] ?>x seeds</div>
											<div class="sub-price-radio"> <span>$<?php echo $price['price'] ?></span> <p>Price</p></div>
										</div>
									</label>

								<?php endif ?>
							<?php endforeach ?>
							
						</div>
						<div class="row product_meta small-text greylinks  columns_padding_0">
							<div class="col-sm-12 leftmargin_10"> <span class="posted_in">
									<span>Categories:</span>  <span class="categories-links">
										<a rel="category" href="shop-right.html">cannabis</a>, <a rel="category" href="shop-right.html">flowers</a>
									</span> </span>
							</div>
							<div class="col-sm-12 leftmargin_10"> <span class="posted_in">
									<span>Tags:</span>  <span class="categories-links">
										<a rel="category" href="shop-right.html">flowers</a>
									</span> </span>
							</div>
						</div>
						<form class="cart " id="add_cart_form" method="post" enctype="multipart/form-data">
							<div class="row content-justify">
								<div class="col-sm-1 greylinks inline-content">
									<span class="price main_bg_color3"  id="main-amount">
										<span class="amount" ><?php echo $obj->get()['item']['price'] ?></span>&euro; 
									</span>
								</div>
								<input type="hidden" name="in_stock" value="<?php echo $obj->get()['item']['in_stock'] ?>">
								<div class="col-sm-10 ">
									<div class="inline-content" style="margin:0px 0px 0px 20px;"> 
										<span class="quantity form-group">
											<input type="button" value="+" class="plus">
											<i class="fa fa-angle-up" aria-hidden="true"></i>
											<input type="number" step="1" name="quantity" min="1" max="" value="1" title="Qty" id="product_quantity" class="form-control ">
											<input type="button" value="-" class="minus">
											<i class="fa fa-angle-down" aria-hidden="true"></i>
										</span>  
																		
											<?php if (Helper::inCart('cart', $obj->id(1))): ?>
												<a  rel="nofollow" style="background:#ccc;cursor:not-allowed;" class="theme_button color4 min_width_button add_to_cart" data-basket="cart">ALREADY IN CART</a> 
											<?php else: ?>
												<a rel="nofollow" data-item-id="<?php echo $obj->id(1) ?>" class="theme_button color4 min_width_button add_to_cart" data-basket="cart" id="ajax-to-cart">ADD TO CART</a> 
											<?php endif ?>	
									</div>
								</div>
							</div>
							
							
							<div style="display:none;" class="product-id"><?php echo $obj->id(1) ?></div>
						</form>
						<div class="col-sm-12 content-justify small-icons social-icon-links"> 
							<span class="small-text rightpadding_10">Share:
							<a class="social-icon socicon-facebook" href="#" title="Facebook"></a>
							</span> 
						</div>
					</div>
					<!-- .summary.col- -->
				</div>
				<!-- .product.row -->
				<div class="woocommerce-tabs" id="full-item-info-scroll">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs color2 wc-tabs" role="tablist">
						<li class="active"><a href="#details_tab" role="tab" data-toggle="tab">Description</a>
						</li>
						<li><a href="#additional_tab" role="tab" data-toggle="tab">Additional</a>
						</li>
						<li><a href="#reviews_tab" role="tab" data-toggle="tab">Reviews</a>
						</li>
					</ul>
					<!-- Tab panes -->
					<div  class="tab-content big-padding top-color-border color2">
						<div class="tab-pane fade in active" id="details_tab">
							<?php echo $obj->get()['item']['more_info'] ?>
						</div>
						<div class="tab-pane fade" id="additional_tab">
							<table class="table table-striped topmargin_30 data-sheet-table">
								<tr>
									<th class="grey">THC:</th>
									<td><?php echo $obj->get()['item']['thc'] ?>%</td>
								</tr>
								<tr>
									<th class="grey">CBD:</th>
									<td><?php echo $obj->get()['item']['cbd'] ?>%</td>
								</tr>
								<tr>
									<th class="grey">Sativa:</th>
									<td><?php echo $obj->get()['item']['sativa'] ?>%</td>
								</tr>
								<tr>
									<th class="grey">Indica:</th>
									<td><?php echo $obj->get()['item']['indica'] ?>%</td>
								</tr>
								<tr>
									<th class="grey">Ruderails:</th>
									<td><?php echo $obj->get()['item']['ruderails'] ?>%</td>
								</tr>
								<tr>
									<th class="grey">Yield Indoor:</th>
									<td><?php echo $obj->get()['item']['yield_indoor_from'] ?> - <?php echo $obj->get()['item']['yield_indoor_to'] ?> gr/m2</td>
								</tr>
								<tr>
									<th class="grey">Yield Outdoor:</th>
									<td><?php echo $obj->get()['item']['yield_outdoor_from'] ?> - <?php echo $obj->get()['item']['yield_outdoor_to'] ?> gr/plant</td>
								</tr>
								<tr>
									<th class="grey">Height Indoor:</th>
									<td><?php echo $obj->get()['item']['height_indoor_from'] ?> - <?php echo $obj->get()['item']['height_indoor_to']?> cm</td>
								</tr>
								<tr>
									<th class="grey">Height Outdoor:</th>
									<td><?php echo $obj->get()['item']['height_outdoor_from'] ?> - <?php echo $obj->get()['item']['height_outdoor_to'] ?> cm</td>
								</tr>
								<tr>
									<th class="grey">Flowering Time:</th>
									<td><?php echo $obj->get()['item']['flowering_time_from'] ?> - <?php echo $obj->get()['item']['flowering_time_to'] ?> weeks</td>
								</tr>
								<?php foreach (Helper::getAny('attrs') as $attr): ?>
									<tr>
										<th><?php echo $attr['attr_title'] ?></th>
										<td>
											<?php 
												$counter=0;
												foreach ($obj->get()['variants'] as $variant): 
											?>

												
												<?php if ($attr['id']==$variant['attr_id']): ?>
													<?php if ($counter==0): ?>
														<?php echo "<b>".$variant['variant_title']."</b>"?>
													<?php else: ?>
														<?php echo " x <b>".$variant['variant_title']."</b>"?>
													<?php 
														endif;
														$counter+=1;
													?>

												<?php endif ?> 
												
											<?php endforeach ?>
										</td>
									</tr>
								<?php endforeach ?>
								
							</table>
						</div>
						<div class="tab-pane fade" id="reviews_tab">
							<div class="comments-area" id="comments">
								<ol class="comment-list">
									<?php foreach (Helper::getOne('item_reviews','item_id',$obj->id(1)) as $review ): ?>
										
									
										<li class="comment even thread-even depth-1 parent">
										<article class="comment">
											<div class="comment-author">
												<img class="media-object" alt="" src="./views/images/faces/05.jpg">
											</div>
											<div class="comment-body"> 
												<div class="comment-meta darklinks"> <a class="author_url" rel="external nofollow" href="#"><?php echo  urldecode($review['name']) ?></a>  <span class="comment-date small-text highlight no-spacing">
											<time datetime="2017-11-08T15:05:23+00:00" class="entry-date"><?php echo $review['create_date'] ?></time>
										</span> 
												</div>
												<div class="comment-rating"> <span class="grey">Customer Rating: </span>
													<div class="star-rating" title="Rated 4.00 out of 5"> <span style="width:80%">
												<strong class="rating"><?php echo $review['rating'] ?></strong> out of 5
											</span> 
													</div>
												</div>
												<p><?php echo urldecode($review['review']) ?></p>
											</div>
										</article>
										</li>
									<?php endforeach ?>
									<!-- #comment-## -->
								</ol>
								<!-- .comment-list -->
							</div>
							<!-- #comments -->
							<div class="comment-respond" id="respond">
								
								<h3>Write Your Own Review</h3>
								
								<form class="comment-form" id="review-form" method="post" >
									<div class="row columns_padding_10">
										<div class="col-md-6">
											<p class="comment-form-author">
												<label for="author">Name <span class="required">*</span>
												</label>
												<!-- <i class="rt-icon2-user-outline"></i> -->
												<input type="text" aria-required="true" size="30" value="" name="name" id="author" class="form-control" placeholder="Full Name">
											</p>
										</div>
										<div class="col-md-6">
											<div> <span class="grey">Your rating:</span><br>
													<span class="stars"> <a class="star-1" href="#">1</a><a class="star-2" href="#">2</a><a class="star-3" href="#">3</a><a class="star-4" href="#">4</a><a class="star-5" href="#">5</a> 
													</span>
												</div>
										</div>
										<div class="col-md-12">
											<p class="comment-form-chat">
												<label for="comment">Comment</label>
												<!-- <i class="rt-icon2-pencil3"></i> -->
												<textarea aria-required="true" rows="8" cols="45" name="review" id="comment" class="form-control" placeholder="Review"></textarea>
											</p>
										</div>
									</div>
									<div class="alert alert-warning review_msg">Your review is being on hold</div>
									<p class="form-submit topmargin_30">
										<button type="submit" id="submit" data-item-id="<?php echo $obj->id(1) ?>" name="submit"  class="theme_button color1 review_btn">Submit Review</button>
										<button type="reset" id="reset" class="theme_button">Clear Form</button>
									</p>
								</form>
							</div>
							<!-- #respond -->
						</div>
						
					</div>
					<!-- eof .tab-content -->
				</div>
				<!-- .woocommerce-tabs -->
				<div class="row topmargin_60">
					<div class="col-sm-12">
						<h3 class="text-center bottommargin_40">Related products</h3>
						<div class="owl-carousel" data-nav="true" data-responsive-lg="4">
							<article class="product shop-item ls vertical-item  no_padding no_margin overflow_hidden">
                                    <div class="item-media no_padding">
                                        <span class="product_info">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        </span>
                                        
                                        <img src="./views/images/shop/01.jpg" alt="" /> 
                                        <span class="price main_bg_color">
                                            <ins>
                                                <span class="amount">$50.00</span> 
                                            </ins>
                                        </span>
                                        <div class="product-buttons">
                                            <a href="#" class="favorite_button">    <span class="sr-only">Add to favorite</span>
                                            </a>
                                            <a href="#" class="add_to_cart">    <span class="sr-only">Add to favorite</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        
                                        <h4 class="entry-title topmargin_5"> <a href="shop-product-right.html">Cannabis Flowers</a> </h4>
                                        <div class="star_rating" > 
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                        </div>
                                        <div class="info_cont ">
                                            <div class="infos thc">THC: 20%</div>
                                            <div class="infos sativa">SAT: 20%</div>
                                            <div class="infos indica">IND: 30%</div>
                                        </div>
                                    </div>
                            </article>
							<article class="product shop-item ls vertical-item  no_padding no_margin overflow_hidden">
                                    <div class="item-media no_padding">
                                        <span class="product_info">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        </span>
                                        
                                        <img src="./views/images/shop/01.jpg" alt="" /> 
                                        <span class="price main_bg_color">
                                            <ins>
                                                <span class="amount">$50.00</span> 
                                            </ins>
                                        </span>
                                        <div class="product-buttons">
                                            <a href="#" class="favorite_button">    <span class="sr-only">Add to favorite</span>
                                            </a>
                                            <a href="#" class="add_to_cart">    <span class="sr-only">Add to favorite</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        
                                        <h4 class="entry-title topmargin_5"> <a href="shop-product-right.html">Cannabis Flowers</a> </h4>
                                        <div class="star_rating" > 
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                        </div>
                                        <div class="info_cont ">
                                            <div class="infos thc">THC: 20%</div>
                                            <div class="infos sativa">SAT: 20%</div>
                                            <div class="infos indica">IND: 30%</div>
                                        </div>
                                    </div>
                            </article>
                            <article class="product shop-item ls vertical-item  no_padding no_margin overflow_hidden">
                                    <div class="item-media no_padding">
                                        <span class="product_info">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        </span>
                                        
                                        <img src="./views/images/shop/01.jpg" alt="" /> 
                                        <span class="price main_bg_color">
                                            <ins>
                                                <span class="amount">$50.00</span> 
                                            </ins>
                                        </span>
                                        <div class="product-buttons">
                                            <a href="#" class="favorite_button">    <span class="sr-only">Add to favorite</span>
                                            </a>
                                            <a href="#" class="add_to_cart">    <span class="sr-only">Add to favorite</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        
                                        <h4 class="entry-title topmargin_5"> <a href="shop-product-right.html">Cannabis Flowers</a> </h4>
                                        <div class="star_rating" > 
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                        </div>
                                        <div class="info_cont ">
                                            <div class="infos thc">THC: 20%</div>
                                            <div class="infos sativa">SAT: 20%</div>
                                            <div class="infos indica">IND: 30%</div>
                                        </div>
                                    </div>
                            </article>
                            <article class="product shop-item ls vertical-item  no_padding no_margin overflow_hidden">
                                    <div class="item-media no_padding">
                                        <span class="product_info">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        </span>
                                        
                                        <img src="./views/images/shop/01.jpg" alt="" /> 
                                        <span class="price main_bg_color">
                                            <ins>
                                                <span class="amount">$50.00</span> 
                                            </ins>
                                        </span>
                                        <div class="product-buttons">
                                            <a href="#" class="favorite_button">    <span class="sr-only">Add to favorite</span>
                                            </a>
                                            <a href="#" class="add_to_cart">    <span class="sr-only">Add to favorite</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        
                                        <h4 class="entry-title topmargin_5"> <a href="shop-product-right.html">Cannabis Flowers</a> </h4>
                                        <div class="star_rating" > 
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                        </div>
                                        <div class="info_cont ">
                                            <div class="infos thc">THC: 20%</div>
                                            <div class="infos sativa">SAT: 20%</div>
                                            <div class="infos indica">IND: 30%</div>
                                        </div>
                                    </div>
                            </article>
                            <article class="product shop-item ls vertical-item  no_padding no_margin overflow_hidden">
                                    <div class="item-media no_padding">
                                        <span class="product_info">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                        </span>
                                        
                                        <img src="./views/images/shop/01.jpg" alt="" /> 
                                        <span class="price main_bg_color">
                                            <ins>
                                                <span class="amount">$50.00</span> 
                                            </ins>
                                        </span>
                                        <div class="product-buttons">
                                            <a href="#" class="favorite_button">    <span class="sr-only">Add to favorite</span>
                                            </a>
                                            <a href="#" class="add_to_cart">    <span class="sr-only">Add to favorite</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="item-content">
                                        
                                        <h4 class="entry-title topmargin_5"> <a href="shop-product-right.html">Cannabis Flowers</a> </h4>
                                        <div class="star_rating" > 
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                        </div>
                                        <div class="info_cont ">
                                            <div class="infos thc">THC: 20%</div>
                                            <div class="infos sativa">SAT: 20%</div>
                                            <div class="infos indica">IND: 30%</div>
                                        </div>
                                    </div>
                            </article>
						</div>
					</div>
				</div>
			</div>
			<!--eof .col-sm-8 (main content)-->
		</div>
	</div>
</section>