<?php
	
	function redirect($new)
	{
		header("Location: " . $new);
		exit;
	}
	
?>