<?php

session_start();

require_once './class/sActus.php';
require_once './class/Event.php';

$actus = new sActus();
$evt = new Event();

if($_GET["event"] == ""){
	$event = 1;
	if($_SESSION["droit"] == 1){
		header("Location: backoffice.php");
	}
}else{
	$event = $_GET["event"];
}

$dataEvt = $actus->findAllById($event);
$dataGeneral = $evt->findOneById($event);
