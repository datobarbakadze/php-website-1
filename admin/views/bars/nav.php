<?php if(isset($_SESSION['user_id'])){ ?>
<nav>
	<div class="navcont">
		<a href="/admin/item" class="newlist high_font">Item manager</a>
		<!--<a href="/admin/blog" class="newlist high_font">Blog Manager
			<a class="sub_list" href="/admin/blog/comment">Comments</a>
			<a class="sub_list" href="/admin/blog/reply">Replies</a>
		</a>-->
		<a href="/admin/attr" class="newlist high_font">Attribute & Variant</a>
		<a href="/admin/blog" class="newlist high_font">Blog Manager</a>
		<a href="/admin/background" class="newlist high_font">Backgrounds Manager</a>
		<a href="/admin/slides" class="newlist high_font">Main slider manager</a>
		<a href="/admin/reviews" class="newlist high_font"> Reviews</a>
		<a href="/admin/category" class="newlist high_font">Category Manager</a>
		<a href="/admin/pages" class="newlist high_font">Pages Manager</a>
		<a href="/admin/about" class="newlist high_font">About / FAQ Manager</a>
		<a href="/admin/lang" class="newlist">LANG Manager</a>
		<a href="/admin/logout" class="newlist high_font">Log Out</a>
		
	</div>
</nav>
<?php } ?>