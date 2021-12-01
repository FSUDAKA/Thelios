<?php

session_start();

require_once './class/sAccueil.php';
require_once './class/Event.php';
require_once './class/Societe.php';

// todo recuperer le status de l'utilisateur qui se connect

$accueil = new sAccueil();
$evt = new Event();
$societe = new Societe();

if($_SESSION["id"] == ""){
	header("Location: login.php");
}
if($_GET["event"] == ""){
    $event = $_SESSION["event"];
    if($_SESSION["droit"] == 1){
        header("Location: backoffice.php");
    }
}else{
    $event = $_GET["event"];
}

$dataEvt = $accueil->findAllById($event);