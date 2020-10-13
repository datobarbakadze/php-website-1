<?php 
include '../connect.php';
function get_reviews($item_id=1){
	$query = mysql_query("SELECT * FROM review WHERE item_id='$item_id'") or die(mysql_error());
	$sum_stars = 0;
	$reviews = [];
	while ($fetch_review = mysql_fetch_assoc($query)) {
		$single_review_star = $fetch_review['rating'];
		$sum_stars+=$single_review_star;
		array_push($reviews, $fetch_review); 
	}

	return ["total_rating"=>$sum_stars,"reviews"=>$reviews];
}
 ?>
<!DOCTYPE html>
<html>
<head>
	<title>review</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script
	  src="https://code.jquery.com/jquery-3.4.1.min.js"
	  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
	  crossorigin="anonymous">
	</script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="../main.js"></script>
	<script src="./function.js"></script>
	<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
	<form id="form" action="./function.php" method="POST">
		<table>
			<tr>
				<td>Item id:</td>
				<td><input type="text" name="item_id" placeholder="item_id"></td>
			</tr>
			<tr>
				<td>Full name:</td>
				<td><input type="text" name="name" placeholder="full name"></td>
			</tr>
			<tr>
				<td>Choose rating: </td>
				<td>
					<input type="radio" name="rating" value="1">
					<input type="radio" name="rating" value="2">
					<input type="radio" name="rating" value="3">
					<input type="radio" name="rating" value="4">
					<input type="radio" name="rating" value="5">
				</td>
			</tr>
			<tr>
				<td>Your review:</td>
				<td><textarea minlength="10" cols="30" rows="6" name="review" placeholder="Say something"></textarea></td>
			</tr>
			<tr>
				<td class="before_comment"><input type="submit" name="submit" value="Review" class="review_btn"></td>
			</tr>
			<tr>
				<td>
					<div class="review_msg alert"></div></td>
				</tr>
		</table>
		<div class="review_cont">
			<?php foreach (get_reviews()['reviews'] as $info): ?>
				<!-- review CONTAINER div goes here -->
					<?php echo $info['name'] //reviewer name?>
					<?php for ($i=1; $i < $info['rating']; $i++) { ?>
						<!-- review stars go here -->
					<?php } ?>
					
					<?php $info['review'] //review bbody text?>
				<!-- end of review CONTAINER DIV -->
			<?php endforeach ?>
			
		</div>
	</form>
</body>
</html>
