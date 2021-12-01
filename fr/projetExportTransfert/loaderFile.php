<?php
	//Nécéssaire au niveau du serveur AREP
	date_default_timezone_set('Europe/Paris');

	// Controller
	require 'Controller/MyController.class.php';
	require 'Controller/LoginController.class.php';

	// Model
	require 'Model/MyModel.class.php';
	require 'Model/LoginModel.class.php';

	// DataBase
	require 'bdd.php';

	//PHPExcel
	require 'PHPExcel.php';
	require 'PHPExcel/IOFactory.php'
?>