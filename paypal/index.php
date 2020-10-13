<!DOCTYPE html>
<html>
<head>
	<title>Pay for good</title>

	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
	<form action="checkout.php" method="POST" class="pay_form">
	<h3>pay for something</h3>
	<hr>	
	<label for="product">Product</label>
	<input type="text" class="pay_input" id="product" placeholder="Submit name" name="product">
	<label for="price">price</label>
	<input type="text" class="pay_input" id="price" placeholder="Submit pruce" name="price">
	<input type="submit" name="submit" class="pay_input">
</form>
</body>
</html>