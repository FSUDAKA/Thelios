<?php
session_start();

require_once './class/User.php';
require_once './class/Event.php';

$evt = new Event();
$usr = new User();

$event = $_GET["event"];

$data = $usr->findOneById($_SESSION['id']);


if ($event != ''){

	$data = $evt->findOneById($event);

 if (isset($EventAdupliquer)){
     
        $nomadupliquer = $data['NOM'];
		$par = $data1["PRENOM"]." ".$data1["NOM"];

        $data = $evt->newEvent($data['NOM'], $par, $data['DESCRIPTION'], $data['DATE_IN'], $data['DATE_OUT'], $data['OPT_ACCUEIL'], $data['OPT_PROGRAMME'], $data['OPT_HEBERGEMENT'], $data['OPT_INFOSPRATIQUES'], $data['OPT_CONTACT'], $data['OPT_INSCRIPTION'], $data['OPT_ATELIERS'], $data['OPT_HEBERGEMENT2'], $data['OPT_TRANSPORT']);

        $data = $evt->findByNom($nomadupliquer);


     
     
     
     
     
     $src = "images/".$event;
    $dst = "images/".$data["ID"];
     
     
     
        $dir = opendir($src); 
        @mkdir($dst); 
        while(false !== ( $file = readdir($dir)) ) { 
            if (( $file != '.' ) && ( $file != '..' )) { 
                if ( is_dir($src . '/' . $file) ) { 
                    recurse_copy($src . '/' . $file,$dst . '/' . $file); 
                } 
                else { 
                    copy($src . '/' . $file,$dst . '/' . $file); 
                } 
            } 
        } 
        closedir($dir); 
       
     header("Location: backoffice.php");    

 } 
  else
    {
	 header("Location: backoffice.php");    
     }  

 }
?>