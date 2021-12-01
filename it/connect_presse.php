<?php

session_start();

require_once './class/sPresse.php';
require_once './class/Event.php';

$presse = new sPresse();
$evt = new Event();

if($_GET["event"] == ""){
	$event = 1;
	if($_SESSION["droit"] == 1){
		header("Location: backoffice.php");
	}
}else{
	$event = $_GET["event"];
}

$dataEvt = $presse->findAllById($event);
$dataGeneral = $evt->findOneById($event);
