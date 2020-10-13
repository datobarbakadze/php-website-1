
<section class="ls section_padding_top_20 section_padding_bottom_130 columns_padding_30">
	<div class="container">
		<div class="row">
				<div class="col-sm-6 col-md-7 col-lg-7 blog-title">
					<h5>Our Cannabis Blog</h5>
				</div>
			<div class="col-sm-7 col-md-8 col-lg-8">

				<?php foreach ($obj->getBlog() as $blog): ?>
					<article class="post blog-post format-small-image">
						<div class="side-item side-md content-padding big-padding with_background rounded overflow_hidden">
							<div class="row">
								<div class="col-md-4">
									<div class="item-media entry-thumbnail" style="height:100%;">
										<img style="height:100%;object-fit:cover;" src="./uploads/blog/s_<?php echo $blog['image'] ?>	" alt="">
									</div>
								</div>
								<div class="col-md-8" >
									<div class="entry-meta ds content-justify">
										<div class="inline-content big-spacing small-text darklinks"> <span>
													<i class="fa fa-calendar highlight rightpadding_5" aria-hidden="true"></i>
													<a target="_blank" href="/<?php echo constant('blog') ?>/<?php echo $blog['url'] ?>~<?php echo $blog['id'] ?>">
														<time datetime="<?php echo $blog['update_date'] ?>">
														<?php echo $blog['update_date'] ?></time>
													</a>
												</span>  <span class="categories-links">
													<i class="fa fa-tags highlight rightpadding_5" aria-hidden="true"></i>
													<a href="/<?php echo constant('blog') ?>/?category=<?php echo $blog['category'] ?>"><?php echo $blog['cat_title'] ?></a>
												</span> 
										</div>
									</div>
									<div class="item-content">
										<header class="entry-header">
											<h4 > <a target="_blank" href="/<?php echo constant('blog') ?>/<?php echo $blog['url'] ?>~<?php echo $blog['id'] ?>" rel="bookmark"><?php echo $blog['title'] ?></a> </h4>
										</header>
										<div class="entry-content">
											<p><?php echo $blog['description'] ?></p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</article>
				<?php endforeach ?>
				<div class="text-center topmargin_60">
					<ul class="pagination">
						<li><a href="#"><span class="sr-only">Prev</span><i class="fa fa-angle-left" aria-hidden="true"></i></a>
						</li>
						<li class="active"><a href="#">1</a>
						</li>
						<li><a href="#">2</a>
						</li>
						<li><a href="#">3</a>
						</li>
						<li><a href="#">4</a>
						</li>
						<li><a href="#">5</a>
						</li>
						<li><a href="#"><span class="sr-only">Next</span><i class="fa fa-angle-right" aria-hidden="true"></i></a>
						</li>
					</ul>
				</div>
			</div>
			<!--eof .col-sm-8 (main content)-->
			<!-- sidebar -->
			<aside class="col-sm-5 col-md-4 col-lg-4 blog-aside">
				<div class="with_padding cs main_bg_color2 rounded">
					<div class="widget widget_search">
						<h3 class="widget-title">Search On Website</h3>
						<form method="get" action="/<?php echo constant('blog') ?>/">
							<div class="form-group margin_0">
								<label class="sr-only" for="widget-search">Search for:</label>
								<input id="widget-search" type="text" value="" name="word" class="form-control" placeholder="Type keyword here...">
							</div>
							<button type="submit" class="theme_button color4 no_bg_button">Search</button>
						</form>
					</div>
				</div>
				<div class="widget widget_recent_posts">
					<h4 class="widget-title">Recent Posts</h4>
					<ul>
						<?php foreach (Helper::getAny('blog','create_date', 'DESC',3) as $recent ): ?>
							<li class="media">
								<div class="media-left media-middle">
									<img src="./uploads/blog/<?php echo $recent['image'] ?>" alt="">
								</div>
								<div class="media-body media-middle">
									<p class="darklinks"> <a href="blog-single-left.html"><?php echo $recent['title'] ?></a> 
									</p> <span class="small-text highlightlinks">
									<a href="blog-single-left.html">
										<time datetime="2017-10-03T08:50:40+00:00">
										<?php echo $recent['create_date'] ?></time>
									</a>
								</span> 
								</div>
							</li>
						<?php endforeach ?>
					</ul>
				</div>
				<div class="widget widget_categories">
					<h3 class="widget-title">Categories</h3>
					<ul class="greylinks">
						<?php foreach (Helper::getOne('category','type',2) as $category): ?>
							<li> <a href="/<?php echo constant('blog') ?>/?category=<?php echo $category['id'] ?>" ><?php echo $category['cat_title'] ?></a> 
							</li>
						<?php endforeach ?>
					</ul>
				</div>
				<div class="widget widget_tag_cloud">
					<h3 class="widget-title">Tags</h3>
					<div class="tagcloud">
						<?php //print_r($obj->getTags()) ?>
						<?php foreach ($obj->getTags() as $tags ): ?>
							<a href="/<?php echo constant('blog') ?>/?tag=<?php echo $tags['id'] ?> "><?php echo $tags['tag_title'] ?></a> 
						<?php endforeach ?>
					 	
					</div>
				</div>
				
			</aside>
			<!-- eof aside sidebar -->
		</div>
	</div>
</section>

