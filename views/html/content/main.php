<section class="ls section_padding_top_75 section_padding_bottom_130 ">
<div class="container">
	<h4>Crucially important information about cannabis an it's seeds care</h4>
	<p>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
	</p>
	<div class="row">
		<?php foreach (Helper::getAny('add_content') as $key => $content): ?>
			<a class="content-list to_animate" target="_blank" href="/<?php echo constant('content') ?>/<?php echo $content['url'] ?>~<?php echo $content['id'] ?>"  data-animation="fadeInDown" data-delay="<?php echo $key ?>00" ><?php echo $content['title'] ?></a>
		<?php endforeach ?>
		
	</div>
</div>
</section>