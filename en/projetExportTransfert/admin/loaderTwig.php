<?php
	include_once('../twig/lib/Twig/Autoloader.php');
    Twig_Autoloader::register();
    $loader = new Twig_Loader_Filesystem('View'); // Dossier contenant les templates
    MyController::$twig = new Twig_Environment($loader, array(
      'cache' => false,
      'debug' => true
    ));
    MyController::$twig->addExtension(new Twig_Extension_Debug());
?>	    