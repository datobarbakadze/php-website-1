

            <section class="intro_section page_mainslider ds light_md_bg_color all-scr-cover">
                <div class="flexslider" data-dots="true" data-nav="true">
                    <ul class="slides">
                        
                        
                        <li>
                            <div class="slide-image-wrap">
                                <div class="rounded-container">
                                    <img src="./views/images/slide03.jpg" alt="">
                                </div>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <div class="slide_description_wrapper">
                                            <div class="slide_description">
                                                <div class="intro-layer" data-animation="fadeInUp">
                                                    <p class="semibold text-uppercase grey">Our Product</p>
                                                </div>
                                                <div class="intro-layer" data-animation="fadeInUp">
                                                    <h2>Recreational &amp; Medical Marijuana...</h2>
                                                </div>
                                                <div class="intro-layer" data-animation="fadeInUp">
                                                    <div class="slide_buttons"> <a href="contact.html" class="theme_button color4 min_width_button">Buy now</a> 
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- eof .slide_description -->
                                        </div>
                                        <!-- eof .slide_description_wrapper -->
                                    </div>
                                    <!-- eof .col-* -->
                                </div>
                                <!-- eof .row -->
                            </div>
                            <!-- eof .container -->
                        </li>
                    </ul>
                </div>
                <!-- eof flexslider -->
            </section>
            <section class="ls section_offset_teasers section_padding_top_10 section_padding_bottom_10">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6 to_animate no_appear_delay" data-animation="fadeInDown" data-delay="600">
                            <div class="teaser top_offset_icon main_bg_color rounded text-center">
                                <div class="teaser_icon size_small round main_bg_color"> <i class="fa fa-globe" aria-hidden="true"></i> 
                                </div>
                                <h4 class="topmargin_0"> <a href="#">Green House</a> </h4>
                                <p class="content-3lines-ellipsis">««Lorem ipsum dolor sit amet, consectetur adipisicing elit, »</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 to_animate no_appear_delay" data-animation="fadeInDown" data-delay="300">
                            <div class="teaser top_offset_icon main_bg_color2 rounded text-center">
                                <div class="teaser_icon size_small round main_bg_color2"> <i class="fa fa-plug" aria-hidden="true"></i> 
                                </div>
                                <h4 class="topmargin_0"> <a href="#">Solar Energy</a> </h4>
                                <p class="content-3lines-ellipsis">««Lorem ipsum dolor sit amet, consectetur adipisicing elit, .»</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 to_animate no_appear_delay" data-animation="fadeInDown" data-delay="300">
                            <div class="teaser top_offset_icon main_bg_color3 rounded text-center">
                                <div class="teaser_icon size_small round main_bg_color3"> <i class="fa fa-leaf" aria-hidden="true"></i> 
                                </div>
                                <h4 class="topmargin_0"> <a href="#">Sustainable</a> </h4>
                                <p class="content-3lines-ellipsis">««Lorem ipsum dolor sit amet, consectetur adipisicing elit, .»</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 to_animate no_appear_delay" data-animation="fadeInDown" data-delay="600">
                            <div class="teaser top_offset_icon main_bg_color4 rounded text-center">
                                <div class="teaser_icon size_small round main_bg_color4"> <i class="fa fa-users" aria-hidden="true"></i> 
                                </div>
                                <h4 class="topmargin_0"> <a href="#">Connoisseurs</a> </h4>
                                <p class="content-3lines-ellipsis">«Lorem ipsum dolor sit amet, consectetur adipisicing elit, »</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="about" class="ls section_padding_top_100 section_padding_bottom_130 columns_margin_bottom_20">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-12"> <span class="small-text big highlight4">
                    Who is marijuana factory?
                </span>
                            <h2 class="section_header">History About Factory</h2>
                        </div>
                        <div class="col-md-6 col-sm-8">
                            <p class="bold grey">«Lorem ipsum dolor sit amet, consectetur adipisicing elit, </p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                        </div>
                        <div class="col-md-3 col-sm-4">
                            <div class="person_bio">
                                <div class="avatar">
                                    <img src="./views/images/faces/01.jpg" alt="">
                                </div>
                                <div class="person_name grey">Persons name</div> <span class="small-text highlight4">
                    </span> 
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section id="products" class="ds parallax page_shop section_padding_top_150 section_padding_bottom_150">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-sm-8 to_animate" data-animation="hatch">
                            <h2 style="text-align: center;">Our products</h2>
                            <div class="owl-carousel" data-nav="true" data-responsive-lg="4">
                                <?php foreach (Helper::getOne('item','status',1) as $item): ?>
                                        <article class="product shop-item ls vertical-item  no_padding no_margin overflow_hidden">
                                               
                                            
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
                                <?php endforeach ?>
                            </div>
                        </div>
                        <p class="topmargin_40 " data-animation="pulse" data-delay="4000" style="text-align: center; "> 
                            <a href="shop-left.html" class="theme_button color4" style="padding:17px 29px !important">
                                 Go to shop
                            </a> 
                        </p>
                    </div>
                </div>
            </section>
            <section id="technologies" class="ls section_padding_top_150 section_padding_bottom_150 columns_margin_bottom_40">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4"> <span class="small-text big highlight2">
                    Six steps for growing
                </span>
                            <h2 class="section_header">Royal queen seeds  Technologies</h2>
                            <p class="topmargin_50">
                                <a href="#" class="theme_button inverse color2 complex_button"> <span class="left-icon">
                            <img src="./views/images/bbb.png" alt="" draggable="false">
                        </span>
                                    Accredited
                                    <br>bussiness   <span class="right-icon">A+</span>
                                </a>
                            </p>
                        </div>
                        <div class="col-md-8 col-lg-9">
                            <div class="row row-flex">
                                <div class="col-lg-4 col-sm-6 to_animate" data-animation="expandOpen" data-delay="100">
                                    <div class="media bottommargin_25">
                                        <div class="media-left media-middle">
                                            <img src="./views/images/icons/01.png" alt="">
                                        </div>
                                        <div class="media-body media-middle">
                                            <h4 class="entry-title hover-color2"> <a href="#">Germinate New Seeds</a> </h4>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.</p>
                                </div>
                                <div class="col-lg-4 col-sm-6 to_animate" data-animation="expandOpen" data-delay="100">
                                    <div class="media bottommargin_25">
                                        <div class="media-left media-middle">
                                            <img src="./views/images/icons/02.png" alt="">
                                        </div>
                                        <div class="media-body media-middle">
                                            <h4 class="entry-title hover-color2"> <a href="#">Start Our Clones Indoors</a> </h4>
                                        </div>
                                    </div>
                                    <p>JLorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                                </div>
                                <div class="col-lg-4 col-sm-6 to_animate" data-animation="expandOpen" data-delay="100">
                                    <div class="media bottommargin_25">
                                        <div class="media-left media-middle">
                                            <img src="./views/images/icons/03.png" alt="">
                                        </div>
                                        <div class="media-body media-middle">
                                            <h4 class="entry-title hover-color2"> <a href="#">Vegetative - Stems and Leaves</a> </h4>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                                </div>
                                <div class="col-lg-4 col-sm-6 to_animate" data-animation="expandOpen" data-delay="200">
                                    <div class="media bottommargin_25">
                                        <div class="media-left media-middle">
                                            <img src="./views/images/icons/04.png" alt="">
                                        </div>
                                        <div class="media-body media-middle">
                                            <h4 class="entry-title hover-color2"> <a href="#">Flowering - Buds Start Growing!</a> </h4>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                                </div>
                                <div class="col-lg-4 col-sm-6 to_animate" data-animation="expandOpen" data-delay="200">
                                    <div class="media bottommargin_25">
                                        <div class="media-left media-middle">
                                            <img src="./views/images/icons/05.png" alt="">
                                        </div>
                                        <div class="media-body media-middle">
                                            <h4 class="entry-title hover-color2"> <a href="#">Getting Friendly Nutrients</a> </h4>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                                </div>
                                <div class="col-lg-4 col-sm-6 to_animate" data-animation="expandOpen" data-delay="200">
                                    <div class="media bottommargin_25">
                                        <div class="media-left media-middle">
                                            <img src="./views/images/icons/06.png" alt="">
                                        </div>
                                        <div class="media-body media-middle">
                                            <h4 class="entry-title hover-color2"> <a href="#">Harvest Our Cannabis</a> </h4>
                                        </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- <section id="blog" class="ds parallax page_blog section_padding_top_150 section_padding_bottom_130 columns_margin_bottom_30 columns_padding_25">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-3"> <span class="small-text big highlight">
                    Our blog
                </span>
                            <h2 class="section_header">Latest Plant News</h2>
                            <div class="widget widget_categories topmargin_50">
                                <ul class="greylinks">
                                    <li class=""> <a href="blog-left.html">Products</a> 
                                    </li>
                                    <li class=""> <a href="blog-left.html">Plant</a> 
                                    </li>
                                    <li class=""> <a href="blog-left.html">News</a> 
                                    </li>
                                    <li class=""> <a href="blog-left.html">Dispensary</a> 
                                    </li>
                                </ul>
                            </div>
                            <p class="topmargin_40"> <a href="blog-left.html" class="theme_button color3">
                        Go to Blog
                    </a> 
                            </p>
                        </div>
                        <div class="col-sm-9">
                            <div class="owl-carousel to_animate" data-animation="fadeInUp" data-nav="true" data-dots="false" data-responsive-lg="3" data-responsive-md="2" data-responsive-sm="2" >
                                <article class="post vertical-item content-padding rounded overflow_hidden loop-color">
                                    <div class="item-media entry-thumbnail">
                                        <img src="./views/images/events/08.jpg" alt="">
                                    </div>
                                    <div class="item-content ls">
                                        <header class="entry-header">
                                            <div class="entry-meta content-justify small-text"> <span class="greylinks">
                                        <a href="blog-single-left.html">
                                            <time datetime="2017-10-03T08:50:40+00:00">
                                            15 jan, 2018</time>
                                        </a>
                                    </span>  <span class="categories-links highlightlinks">
                                        <a href="blog-left.html">Products</a>
                                    </span> 
                                            </div>
                                            <h4 class="entry-title"> <a href="blog-single-left.html">We Launches New CBD Product</a> </h4>
                                        </header>
                                        <div class="entry-content content-3lines-ellipsis">
                                            <p>Tenderloin pork loin leberkas buffalo, sirloin landjaeger short...</p>
                                        </div>
                                    </div>
                                </article>
                                <article class="post vertical-item content-padding rounded overflow_hidden loop-color">
                                    <div class="item-media entry-thumbnail">
                                        <img src="./views/images/events/03.jpg" alt="">
                                    </div>
                                    <div class="item-content ls">
                                        <header class="entry-header">
                                            <div class="entry-meta content-justify small-text"> <span class="greylinks">
                                        <a href="blog-single-left.html">
                                            <time datetime="2017-10-03T08:50:40+00:00">
                                            23 jan, 2018</time>
                                        </a>
                                    </span>  <span class="categories-links highlightlinks">
                                        <a href="blog-left.html">Plant</a>
                                    </span> 
                                            </div>
                                            <h4 class="entry-title"> <a href="blog-single-left.html">Provides Update on 30,000 Sq.</a> </h4>
                                        </header>
                                        <div class="entry-content content-3lines-ellipsis">
                                            <p>Jerky rump venison turk tenderloin beef turduck. Pork loin picanha...</p>
                                        </div>
                                    </div>
                                </article>
                                <article class="post vertical-item content-padding rounded overflow_hidden loop-color">
                                    <div class="item-media entry-thumbnail">
                                        <img src="./views/images/events/10.jpg" alt="">
                                    </div>
                                    <div class="item-content ls">
                                        <header class="entry-header">
                                            <div class="entry-meta content-justify small-text"> <span class="greylinks">
                                        <a href="blog-single-left.html">
                                            <time datetime="2017-10-03T08:50:40+00:00">
                                            31 jan, 2018</time>
                                        </a>
                                    </span>  <span class="categories-links highlightlinks">
                                        <a href="blog-left.html">News</a>
                                    </span> 
                                            </div>
                                            <h4 class="entry-title"> <a href="blog-single-left.html">Overview of 2017 Highlights</a> </h4>
                                        </header>
                                        <div class="entry-content content-3lines-ellipsis">
                                            <p>Pork loin picanha hambu prosciutto buffalo, chick kielbasa strip...</p>
                                        </div>
                                    </div>
                                </article>
                                <article class="post vertical-item content-padding rounded overflow_hidden loop-color">
                                    <div class="item-media entry-thumbnail">
                                        <img src="./views/images/events/04.jpg" alt="">
                                    </div>
                                    <div class="item-content ls">
                                        <header class="entry-header">
                                            <div class="entry-meta content-justify small-text"> <span class="greylinks">
                                        <a href="blog-single-left.html">
                                            <time datetime="2017-10-03T08:50:40+00:00">
                                            15 jan, 2018</time>
                                        </a>
                                    </span>  <span class="categories-links highlightlinks">
                                        <a href="blog-left.html">Products</a>
                                    </span> 
                                            </div>
                                            <h4 class="entry-title"> <a href="blog-single-left.html">We Launches New CBD Product</a> </h4>
                                        </header>
                                        <div class="entry-content content-3lines-ellipsis">
                                            <p>Tenderloin pork loin leberkas buffalo, sirloin landjaeger short...</p>
                                        </div>
                                    </div>
                                </article>
                                <article class="post vertical-item content-padding rounded overflow_hidden loop-color">
                                    <div class="item-media entry-thumbnail">
                                        <img src="./views/images/events/06.jpg" alt="">
                                    </div>
                                    <div class="item-content ls">
                                        <header class="entry-header">
                                            <div class="entry-meta content-justify small-text"> <span class="greylinks">
                                        <a href="blog-single-left.html">
                                            <time datetime="2017-10-03T08:50:40+00:00">
                                            23 jan, 2018</time>
                                        </a>
                                    </span>  <span class="categories-links highlightlinks">
                                        <a href="blog-left.html">Plant</a>
                                    </span> 
                                            </div>
                                            <h4 class="entry-title"> <a href="blog-single-left.html">Provides Update on 30,000 Sq.</a> </h4>
                                        </header>
                                        <div class="entry-content content-3lines-ellipsis">
                                            <p>Jerky rump venison turk tenderloin beef turduck. Pork loin picanha...</p>
                                        </div>
                                    </div>
                                </article>
                                <article class="post vertical-item content-padding rounded overflow_hidden loop-color">
                                    <div class="item-media entry-thumbnail">
                                        <img src="./views/images/events/11.jpg" alt="">
                                    </div>
                                    <div class="item-content ls">
                                        <header class="entry-header">
                                            <div class="entry-meta content-justify small-text"> <span class="greylinks">
                                        <a href="blog-single-left.html">
                                            <time datetime="2017-10-03T08:50:40+00:00">
                                            31 jan, 2018</time>
                                        </a>
                                    </span>  <span class="categories-links highlightlinks">
                                        <a href="blog-left.html">News</a>
                                    </span> 
                                            </div>
                                            <h4 class="entry-title"> <a href="blog-single-left.html">Overview of 2017 Highlights</a> </h4>
                                        </header>
                                        <div class="entry-content content-3lines-ellipsis">
                                            <p>Pork loin picanha hambu prosciutto buffalo, chick kielbasa strip...</p>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
            </section> -->
            
        </div>
        <!-- eof #box_wrapper -->
    </div>
