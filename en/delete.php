<?php
error_reporting(E_ALL);
require_once './class/Event.php';
require_once './class/sAccueil.php';
require_once './class/sActus.php';
require_once './class/sPresse.php';
require_once './class/sProgramme.php';
require_once './class/sHebergement.php';
require_once './class/sContact.php';
require_once './class/sInfoPrat.php';
require_once './class/Societe.php';

$evt = new Event();
$accueil = new sAccueil();
$presse = new sPresse();
$actu = new sActus();
$programme = new sProgramme();
$hebergement = new sHebergement();
$contact = new sContact();
$infos = new sInfoPrat();
$societe = new Societe();
$event = $_GET['event'];
$picture = $_GET["picture"];
$jour = $_GET["jour"];

if(($_GET["event"] != "") && ($_GET["picture"] == "") && ($_GET["jour"] == "") && ($_GET["url"] == "")){
    $evt->deleteFromId($event);
    $dossierimage = "images/".$event;
    array_map('unlink', glob("$dossierimage/*.*"));
    rmdir($dossierimage);
    header("Location: backoffice.php");
}

if($_GET["picture"] != "" && $_GET['table'] == 'actualite'){
	$url = $_GET["url"]."?event=".$event;
	unlink(dirname(__FILE__)."/images/".$event."/" . $picture);
	$actu->deletePicture($jour, $event);
	header("Location: $url");
}

if($_GET["picture"] != "" && $_GET['table'] == 'presse'){
	$url = $_GET["url"]."?event=".$event;
	unlink(dirname(__FILE__)."/images/".$event."/" . $picture);
	$presse->deletePicture($jour, $event);
	header("Location: $url");
}

if($_GET["picture"] != "" && $_GET['table'] == 'hebergement'){
	$url = $_GET["url"]."?event=".$event;
	unlink(dirname(__FILE__)."/images/".$event."/" . $picture);
	$hebergement->deletePicture($jour, $event);
	header("Location: $url");
}

if($_GET["picture"] != "" && $_GET['table'] == 'infos-pratiques'){
	$url = $_GET["url"]."?event=".$event;
	unlink(dirname(__FILE__)."/images/".$event."/" . $picture);
	$infos->deletePicture($jour, $event);
	header("Location: $url");
}

if($_GET["picture"] != "" && $_GET['table'] == 'contact'){
	$url = $_GET["url"]."?event=".$event;
	unlink(dirname(__FILE__)."/images/".$event."/" . $picture);
	$contact->deletePicture($jour, $event);
	header("Location: $url");
}

if($_GET["picture"] != "" && $_GET['table'] == 'programme'){
	$url = $_GET["url"]."?event=".$event;
	unlink(dirname(__FILE__)."/images/".$event."/" . $picture);
	$programme->deletePicture($jour, $event);
	header("Location: $url");
}

if($_GET["picture"] != "" && $_GET['table'] == 'accueil'){
    $url = $_GET["url"]."?event=".$event;
    unlink(dirname(__FILE__)."/images/".$event."/" . $picture);
    $accueil->deletePicture($jour, $event);
    header("Location: $url");
}

if($_GET["picture"] != "" && $_GET['jour'] == 'logo'){
    $url = $_GET["url"];
    unlink(dirname(__FILE__)."/images/logos/" . $picture);
    $societe->deletePicture($picture);
    header("Location: $url");
}