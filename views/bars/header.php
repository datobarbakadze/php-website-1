
   
    <div class="modal" tabindex="-1" role="dialog" aria-labelledby="search_modal" id="search_modal">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">    <span aria-hidden="true">
            <i class="rt-icon2-cross2"></i>
        </span>
        </button>
    </div>
    <!-- Unyson messages modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="messages_modal">
        <div class="fw-messages-wrap ls with_padding">
            <!-- Uncomment this UL with LI to show messages in modal popup to your user: -->
            <!--
        <ul class="list-unstyled">
            <li>Message To User</li>
        </ul>
        -->
        </div>
    </div>
    <!-- eof .modal -->
    <!-- wrappers for visual page editor and boxed version of template -->
    <div id="canvas">
        <div id="box_wrapper">
			<!-- template sections -->
			<section class="page_topline ls table_section table_section_sm section_padding_top_5 section_padding_bottom_5">
				<div class="container">
					<div class="row">
						<div class="col-sm-6 text-center text-sm-left">
							<div> <i class="fa fa-clock-o rightpadding_5" aria-hidden="true"></i> Opening Hours: Mon - Sat 8.00 - 18.00 </div>
						</div>
						<div class="col-sm-6 text-center text-sm-right greylinks">
						    <?php if (Helper::logged()): ?>
						    	<span ><i class="fa fa-user-secret login_name"></i> <a class="login_name" href="/<?php echo constant('user') ?>/<?php echo constant('account') ?>"><?php echo Helper::User()['name'] ?></a></span> | 
						    	<span><i class="fa fa-sign-out"></i>  <a href="/<?php echo constant('user') ?>/<?php echo constant('logout') ?>">Sign Out</a></span>
						    <?php else: ?>
						    	<span><i class="fa fa-sign-in"></i> <a href="/<?php echo constant('user') ?>">Log In</a></span> | 
						    	<span><i class="fa fa-user-plus"></i> <a href="/<?php echo constant('user') ?>">Register</a></span>
							<?php endif ?>
						</div>
					</div>
				</div>
			</section>
            			<header class="page_header header_darkgrey dark header_logo_center">
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-12 text-md-center">
							<div class="logo_wrapper"> <a href="index.html" class="logo logo_with_text">
                        <img src="./views/images/logo.png" alt="">
                        <!-- <span class="logo_text">
                            Canabia
                            <small>Colorado dispensary</small>
                        </span> -->
                    </a> 
                    <div class="header_cart phone_cart">
						<div class="cart-count"><a href="/<?php constant('cart') ?>"><?php echo isset($_COOKIE['cart']) ? count(json_decode($_COOKIE['cart'],true)) : 0 ?></a></div>
					</div>
					<div class="header_heart phone_heart">
						<div class="whishlist-count"><a href="/<?php constant('cart') ?>/<?php constant('whishlist') ?>"><?php echo isset($_COOKIE['whishlist']) ? count(json_decode($_COOKIE['whishlist'],true)) : 0 ?></a></div>
					</div>
                </div>
							<!-- header toggler --><span class="toggle_menu"><span></span></span>
							<!-- main nav start -->
							<nav class="mainmenu_wrapper" style="left:0;">
								<ul class="mainmenu nav sf-menu">
									<li class="active"> <a href="/">Home</a></li>
									<li> <a href="/<?php echo constant('shop') ?>">Categories</a> 
										<ul>
											<?php foreach (Helper::getAny('category') as $category): ?>
												<li>
													<a href="/<?php constant('shop') ?>/?category=<?php echo $category['id'] ?>">
														<?php echo $category['cat_title'] ?>
													</a>
												</li>
											<?php endforeach ?>
										</ul>
									</li>
									<!-- eof pages -->
									<li> <a href="/<?php echo constant('shop') ?>">Shop</a></li>
									<li> <a href="/<?php echo constant('blog') ?>">Blog</a></li>
									<!-- eof features -->
									<!-- gallery -->
									<li> <a href="/<?php echo constant('content') ?>">Important</a></li>
									<!-- eof Gallery -->
									<!-- blog -->
									<li> <a href="/<?php echo constant('about') ?>">About us</a></li>
									<!-- eof blog -->
									<!-- shop -->
									<li> <a href="/<?php echo constant('contact') ?>">Contact</a></li>
									<!-- eof shop -->
									<!-- contacts -->
									
									<!-- eof contacts -->
									<div class=" doropdown custom_dropdown">
										<div class="header_heart desktop_heart dropdown-toggle" id="dropdownWhishlist" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<div class="whishlist-count">
												<?php echo Helper::countCart('whishlist','whishlist') ?>
											</div>
										</div>
										

										<div class="dropdown-menu dropdown-whishlist" aria-labelledby="dropdownWhishlist">
										    <div class="whishlist-scroll">
											    
											</div>
											<a href="/<?php echo constant('cart') ?>/<?php echo constant('whishlist') ?>" class="btn btn-success header-cart-btn">View your whishlist</a>
										</div>
										
									</div>
									<div class="dropdown custom_dropdown" >
										<div class="header_cart dektop_cart dropdown-toggle" id="dropdownCart" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<div class="cart-count" >
												<?php echo Helper::countCart('cart','cart') ?>
											</div>
										</div>
										<div class="cart dropdown-menu dropdown-cart " aria-labelledby="dropdownCart">
										    <div class="cart-scroll">
											    
											</div>
										    <div class="total-cost">Total Cost: <b><span>0</span>$</b></div>
										    <a href="/<?php echo constant('cart') ?>" class="btn btn-warning header-cart-btn">Go to cart</a>
										    <a href="/<?php echo constant('cart') ?>#checkout" class="btn btn-success header-cart-btn">Checkout</a>
										</div>
									</div>
									
								</ul>
							</nav>
							<!-- eof main nav -->

						</div>
					</div>
				</div>
			</header>