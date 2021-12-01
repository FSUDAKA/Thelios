<?php

session_start();

require_once './class/sAccueil.php';
require_once './class/Event.php';

$accueil = new sAccueil();
$evt     = new Event();

if($_GET["event"] == ""){
    $event = 1;
    if($_SESSION["droit"] == 1){
        header("Location: backoffice.php");
    }
}else{
    $event = $_GET["event"];
}

$dataEvt = $accueil->findAllById($event);
$dataGeneral = $evt->findOneById($event);