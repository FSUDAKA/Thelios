<?php

session_start();

require_once './class/sContact.php';
require_once './class/Event.php';

$contact = new sContact();
$evt = new Event();


if($_GET["event"] == ""){
    $event = 1;
    if($_SESSION["droit"] == 1){
        header("Location: backoffice.php");
    }
}else{
    $event = $_GET["event"];
}

$dataEvt = $contact->findAllById($event);
$dataGeneral = $evt->findOneById($event);