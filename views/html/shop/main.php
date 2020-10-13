
<section class="ls section_padding_top_30 section_padding_bottom_100 columns_padding_30">
	<div class="container">
		<div class="row">
			<div class="col-sm-7 col-md-8 col-lg-9 col-sm-push-5 col-md-push-4 col-lg-push-3">
				<div class="shop-sorting">
					<form class="form-inline content-justify vertical-center content-margins">
						<div>Showing 1-6 of 36 results</div>
						<div class="form-group select-group">
							<select aria-required="true" id="date" name="date" class="custom_input 	choice empty form-control">
								<option value="" disabled selected data-default>Default Sorting</option>
								<option value="value">by Value</option>
								<option value="date">by Date</option>
								<option value="popular">by Popularity</option>
							</select> <i class="fa fa-angle-down theme_button color1 no_bg_button" style="line-height:40px;" aria-hidden="true"></i> 
						</div>
					</form>
				</div>
				<div class="columns-3">
					<ul id="products" class="products list-unstyled">
                        <?php foreach ($obj->getItem() as $item): ?>
                            <li class="product type-product ">
                                <article class="shop_item ls vertical-item  no_padding overflow_hidden ">
                                	
                                		<?php if ($item['sale']>0): ?>
                                			<div class="onsale"><?php echo $item['sale'] ?> % off</div>
                                		<?php endif ?>
                                	
                                    <div class="item-media no_padding">
                                        <span class="product_info">
                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
	                                            <div class="outter-description">
		                                		<p>
		                                			<?php echo $item['description'] ?>
		                                		</p>
	                                		</div>
                                        </span>
                                        <a target="_blank" href="/<?php echo constant('shop') ?>/<?php echo $item['url'] ?>~<?php echo $item['item_id'] ?>"><img src="/uploads/main/<?php echo $item['main_image'] ?>" alt="<?php echo $item['title'] ?>" title="<?php echo $item['title'] ?>" /> </a>
                                        <span class="price main_bg_color">
                                            <ins>
                                                <span class="amount">
                                                	<?php if ($item['sale']==0): ?>
                                                		<span class="live-price"><?php echo round($item['price']) ?>$</span>
                                                	<?php else: ?>
                                                		<span class="previous-price"><?php echo round($item['price']) ?>$</span> 
                                                		<span class="live-price"><?php echo round($item['price']-($item['price']*$item['sale']/100)) ?>$</span>
                                                	<?php endif ?>
                                                </span> 
                                            </ins>
                                        </span>
                                        <div class="product-buttons ">

                                        	<!-- whishlist button -->
                                        	<?php if (Helper::inCart('whishlist',$item['item_id'])): ?>
	                                            <a style="color:#ccc;" id="main-whishlist-<?php echo $item['item_id']  ?>" class="favorite_button">    
	                                            	<span class="sr-only">Add to favorite</span>
	                                            </a>
	                                        <?php else: ?>
	                                        	<a id="shop-whishlist-<?php echo $item['item_id']  ?>" class="favorite_button shop-to-cart" data-item-id="<?php echo $item['item_id'] ?>" data-quantity="1" data-sub-quantity="1" data-basket="whishlist">    <span class="sr-only">Add to favorite</span>
	                                            </a>
	                                        <?php endif ?>


	                                        <!-- cart button -->
                                            <?php if (Helper::inCart('cart',$item['item_id'])): ?>
                                            	<a id="shop-cart-<?php echo $item['item_id']  ?>" style="background:#ccc;" class="add_to_cart"  >    
	                                            	<span class="sr-only">Add to cart</span>
	                                            </a>
                                            <?php else: ?>
                                            	<a id="shop-cart-<?php echo $item['item_id']  ?>" class="add_to_cart shop-to-cart" data-item-id="<?php echo $item['item_id'] ?>" data-quantity="1" data-sub-quantity="1" data-basket="cart" >    
	                                            	<span class="sr-only">Add to cart</span>
	                                            </a>
                                            <?php endif ?>
                                        </div>
                                    </div>

                                    <div class="item-content">
                                        
                                        <h4 class="entry-title topmargin_5"> <a href="/<?php echo constant('shop') ?>/<?php echo $item['url'] ?>~<?php echo $item['item_id'] ?>"><?php echo $item['title'] ?></a> </h4>
                                        <a target="_blank" href="/<?php echo constant('shop') ?>/<?php echo $item['url'] ?>~<?php echo $item['item_id'] ?>#full-item-info"><div class="star_rating" > 
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                            <img src="/views/images/star.png" class="star-icon">
                                        </div></a>
                                        <hr>
                                        <div class="info_cont ">
                                            <div class="infos thc">THC: 
                                            	<div><?php echo $item['thc'] ?>%</div>
                                            </div>

                                            <div class="infos sativa">SAT: 
                                            	<div><?php echo $item['sativa'] ?>%</div>
                                            </div>
                                            <div class="infos indica">IND: 
                                            	<div><?php echo $item['indica'] ?>%</div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </li> 
                        <?php endforeach ?>
						

						<!-- <li class="product type-product loop-color">
						</li>
						<li class="product type-product loop-color">
						</li>
						<li class="product type-product loop-color">
						</li> -->
					</ul>
				</div>
				<!-- eof .columns-* -->
				<div class="row">
					<div class="col-sm-12 text-center">
						<ul class="pagination">
							<li class="disabled"><a href="#"><span class="sr-only">Prev</span><i class="fa fa-angle-left" aria-hidden="true"></i></a>
							</li>
							<li class="active"><a href="#">1</a>
							</li>
							<li><a href="#">2</a>
							</li>
							<li><a href="#">3</a>
							</li>
							<li><a href="#">4</a>
							</li>
							<li><a href="#"><span class="sr-only">Next</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<aside class="col-sm-5 col-md-4 col-lg-3 col-sm-pull-7 col-md-pull-8 col-lg-pull-9">
				<div class="widget widget_search">
					<h3 class="widget-title">Search Now</h3>
					<form method="get" class="searchform" action="http://webdesign-finder.com/html/canabia/">
						<div class="form-group margin_0">
							<label class="sr-only" for="widget-search">Search for:</label>
							<input id="widget-search" type="text" value="" name="search"  class="custom_input form-control" placeholder="Type keyword here...">
						</div>
						<button type="submit" style="line-height:32px;" class="custom_input theme_button color4 no_bg_button">Search</button>
					</form>
				</div>
				<div class="widget widget_categories">
					<h3 class="widget-title">All Categories</h3> 
					<select name="cat" class="custom_input wrap-select-group">
						<option value="1">All</option>
						<option value="2">Category 1</option>
						<option value="3">Category 2</option>
						<option value="4">Category 3</option>
						<option value="5">Category 4</option>
					</select>
				</div>
				<div class="widget widget_categories">
					<h3 class="widget-title">Flavor / Smell</h3> 
					<select name="cat" class="custom_input 	wrap-select-group">
						<option value="1">All</option>
						<option value="2">Type 1</option>
						<option value="3">Type 2</option>
						<option value="4">Type 3</option>
						<option value="5">Type 4</option>
					</select>
				</div>
				<div class="widget widget_categories">
					<h3 class="widget-title">Effect</h3> 
					<select name="cat" class="custom_input wrap-select-group">
						<option value="1">All</option>
						<option value="2">Effect 1</option>
						<option value="3">Effect 2</option>
						<option value="4">Effect 3</option>
						<option value="5">Effect 4</option>
					</select>
				</div>
				<div class="widget widget_price_filter">
					<h3 class="widget-title">Filter by Price</h3>
					<!-- price slider -->
					<form method="get" action="http://webdesign-finder.com/" class="form-inline">
						<div class="slider-range-price"></div>
						<div class="price_label" style="">Price: <span class="price_from">2</span> - <span class="price_to">35</span> 
							<input type="" class="price_from" name="">
						</div>
						<div class="topmargin_20">
							<button type="submit" style="width:100%;" class="theme_button color4 min_width_button">Filter</button>
						</div>
					</form>
				</div>
			</aside>
			<!-- eof aside sidebar -->
		</div>
	</div>
</section>