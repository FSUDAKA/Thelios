<?php

session_start();

require_once './class/Event.php';
$evt = new Event();

if($_SESSION["droit"] != "1"){
	header("Location: index.php");
}

if($_GET["event"] == "") {
    $event = 1;
}else{
    $event = $_GET["event"];
}

$dataGeneral = $evt->findOneById($event);
?>