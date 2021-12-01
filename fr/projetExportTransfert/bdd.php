<?php

	// ATTENTION : Le programme n'a été testé que pour les versions : 3.5.8.2 de PhpMyAdmin / 5.1.73 de MySQL
	// Il est possible que celui-ci ne soit pas compatible avec d'autres versions.

	/*
		{
		  "dsn": "mysql:host=localhost;dbname=RG2018",
		  "user_name": "root",
		  "user_password": "eq3Zd3CCC5jA"
		}
	*/

	MyController::$bdd = new PDO('mysql:host=localhost;', 'continental', 'Devc733?');
	// MyController::$bdd = new PDO('mysql:host=localhost;', 'root', 'eq3Zd3CCC5jA');
	MyController::$bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	MyController::$bdd->exec('set names utf8');

?>
