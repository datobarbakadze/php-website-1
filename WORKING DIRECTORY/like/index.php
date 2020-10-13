
<!DOCTYPE html>
<html>
<head>
	<title>Like page</title>
	<script
	  src="https://code.jquery.com/jquery-3.4.1.min.js"
	  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
	  crossorigin="anonymous">
	</script>
	<script src="./function.js"></script>
</head>
<body>
	<form action="function.php" method="POST">
		<input type="number" name="item_id">
		<input type="submit" name="type" value="1">
		<input type="submit" name="type" value="0">
	</form>

	<span class="like_dislike" data-type="1" data-item-id="2">like</span>: <span class="like_num">5234</span> <br>
	<span class="like_dislike" data-type="0" data-item-id="2">dislike</span>: <span class="dislike_num">2331</span>
</body>
</html>


