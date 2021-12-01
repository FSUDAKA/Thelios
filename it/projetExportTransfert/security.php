<?php  
	$security = (isset($_SESSION['CONNECTED'])) ? true : false;
	if(!$security) {
		header('Location: login.php');
	}
?>