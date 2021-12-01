<?php 
	session_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	// Loader des fichiers essentiels /!\ TWIG doit être chargé après la génération du fichier Excel !
	require 'loaderFile.php';
	require 'loaderTwig.php';

	MyController::loadTemplate('login.tpl', array());

	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$loginController = LoginController::getInstance();
		$loginController->login($_POST['username'], $_POST['password']);
	}
?>