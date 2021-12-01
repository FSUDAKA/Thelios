<?php  
	$security = (isset($_SESSION['CONNECTED'])) ? true : false;
	if(!$security) {
		header('Location: login.php');
	}

	$controller = MyController::getInstance();
    $admin = $controller->getAdmin($_SESSION['CONNECTED']);

    if(!$admin) {
        header('Location: ../index.php');
    }
?>