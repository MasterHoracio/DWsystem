<?php 
	if (!$_SESSION || !isset($_SESSION)){
		  	echo "<script> alert (\"Debe logearse\"); </script>";
	    	echo "<script language=Javascript> location.href=\"index.php\"; </script>";
		die();
	}
?>