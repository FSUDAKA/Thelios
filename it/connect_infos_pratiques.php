<?php

session_start();

require_once './class/sInfoPrat.php';
require_once './class/Event.php';

$evt = new Event();
$infosPrat = new sInfoPrat();

if($_GET["event"] == ""){
    $event = 1;
    if($_SESSION["droit"] == 1){
        header("Location: backoffice.php");
    }
}else{
    $event = $_GET["event"];
}

$dataEvt = $infosPrat->findAllById($event);
$dataGeneral = $evt->findOneById($event);