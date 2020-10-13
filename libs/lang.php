<?php 

	/**
	* 
	*/
	class lang
	{
		
		function lang_word($logos)
		{
			
				$logos = mysql_real_escape_string($logos);
				$query = mysql_query("SELECT * FROM lang WHERE lang_name='$logos'") or die("Cant connect");
				$fetch = mysql_fetch_array($query);
				echo $fetch['word'];
			

		}
	}
	$lang = new lang();
?>