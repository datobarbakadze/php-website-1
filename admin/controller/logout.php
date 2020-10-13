<?php 
/**
* 
*/
class logout
{
	
	public function __construct()
	{
		session_destroy();
		header('Location: /admin');
	}
}
 ?>