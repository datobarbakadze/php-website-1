<!DOCTYPE html>
<html>
<head>
	<title>universal comments</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script
	  src="https://code.jquery.com/jquery-3.4.1.min.js"
	  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
	  crossorigin="anonymous">
	</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="./function.js"></script>
</head>
<body>
	<form action="function.php" method="POST" id="form" 	>
		<table>
			<tr>
				<td>Item ID:</td>
				<td><input type="text" name="item_id" placeholder="id"> </td>
			</tr>
			<tr>
				<td>Name:</td>
				<td><input type="text" name="name" placeholder="Your name" value="dato"> </td>
			</tr>
			<tr>
				<td>E-mail:</td>
				<td><input type="email" name="email" placeholder="your e-mail" value="edato"> </td>
			</tr>
			<tr>
				<td>Your comment:</td>
				<td><input type="comment" name="comment" placeholder="Say something" value="cdato"> </td>
			</tr>
			<tr>
				<td class="before_comment"><input type="submit" name="submit" style="width:100%;" class="comment_btn" value="Comment"></td>
			</tr>
		</table>
		<div class="msg_div alert"></div>
	</form>
</body>
</html>