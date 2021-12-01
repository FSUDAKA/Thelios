<?php

session_start();

require_once './class/sHebergement.php';
require_once './class/Event.php';

$hebergement = new sHebergement();
$evt = new Event();

if($_GET["event"] == ""){
    $event = 1;
    if($_SESSION["droit"] == 1){
        header("Location: backoffice.php");
    }
}else{
    $event = $_GET["event"];
}

$dataEvt = $hebergement->findAllById($event);
$dataGeneral = $evt->findOneById($event);
