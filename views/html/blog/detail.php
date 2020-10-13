<?php $blog = Helper::getOne('blog','id',$obj->id(1))[0] ?>
<section class="ls section_padding_top_20 section_padding_bottom_130 columns_padding_30">
	<div class="container">
		<div class="row">
			<div class="col-sm-10 col-sm-push-1">
				<article class="single-post vertical-item content-padding big-padding with_background post rounded overflow_hidden">
					<div class="item-media-wrap">
						<div class="entry-thumbnail item-media"> <img style="width:100%;" src="./uploads/blog/<?php echo $blog['image'] ?>" alt=""> </div>
						<div class="entry-meta ds content-justify">
							<div class="inline-content big-spacing small-text darklinks"> <span>
						<i class="fa fa-calendar highlight rightpadding_5" aria-hidden="true"></i>
						<a href="blog-single-right.html">
							<time datetime="<?php $blog['update_date'] ?>">
							<?php echo $blog['update_date'] ?></time>
						</a>
					</span> <span class="categories-links">
						<i class="fa fa-tags highlight rightpadding_5" aria-hidden="true"></i>
						<a href="blog-right.html"><?php echo Helper::getOne('category','id',$blog['category'])[0]['cat_title'] ?></a>
						<!-- <a href="blog-right.html">Plantifixation</a> -->
					</span> </div>
							<div> <a href="blog-left.html" class="post-author">
						<img src="images/faces/03.jpg" alt="">
					</a> </div>
						</div>
					</div>
					<div class="item-content">
						<h3 class="entry-title"><?php echo $blog['title'] ?></h3>
						<div class="entry-content">
							<?php echo $blog['description'] ?>
						</div>
						<!-- .entry-content -->
					</div>
					<!-- .item-content -->
				</article>
			</div>
		</div>
	</div>
</section>