<?php 

require "../paypal/vendor/autoload.php";
define('SITE_URL','http://realgeorgiatours.com');
$paypal = new \PayPal\Rest\ApiContext(
	 new \PayPal\Auth\OAuthTokenCredential('AV53khjf4dj4LxcoVnMZAJ-ANeg0-tCLywsCZ-2YIR0KLHVPOQ0H-mVXznLtUX9tc0oTCycUq8IoNv8b','EDOiHbmXzgFNoGg8cioQvlC-9H_5UmaRJpDnDYuKHEV3PrtZkTiDBM46iZlU6Pvl-kz6yZ27PeX_SCB_')
);