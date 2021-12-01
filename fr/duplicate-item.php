<?php

require_once './class/Hotel.php';
require_once './class/Room.php';
require_once './class/Activity.php';
require_once './class/Transport.php';

$hotel     = new Hotel();
$room      = new Room();
$activity  = new Activity();
$transport = new Transport();

if($_GET["item"] != ""){
    $item = $_GET["item"];
    $event = $_GET["event"];
    $table = $_GET["table"];

    $data = $room->selectItem($table, $item);

    if($table == "HOTELS"){
    
        $nom = $data['NOM']." - Copie";
		$data = $hotel->new($event, $data['NOM'], $data['ADRESSE1'], $data['ADRESSE2'], $data['CP'], $data['VILLE'], $data['TEL'], $data['STOCK_SGL'], $data['STOCK_DBL'], $data['STOCK_TWIN']);
        $data = $hotel->findOneByName($nom);
        
        $EVENT_ID = $data['EVENT_ID'];
        $ID = $data['ID'];

        $data = $room->new($EVENT_ID, $ID, "Single");
        $data = $room->new($EVENT_ID, $ID, "Double");
        $data = $room->new($EVENT_ID, $ID, "Twin");

        header("Location: settings-hebergement2.php?event=".$event);
        
    }
    
    if($table == "ACTIVITES"){

    	$data = $activity->add($data['THEME'], $data['DESCRIPTION'], $data['DATE'], $data['HEURE'], $data['SALLE'], $event);

        header("Location: settings-activites.php?event=".$event);
        
    }
    
    if($table == "TRANSPORTS"){

    	$data = $transport->new($event, $data['TYPE'], $data['MOYEN'], $data['NOM'], $data['DESCRIPTION'], $data['NUMERO'], $data['DE'], $data['A'], $data['DATE_DEPART'], $data['HEURE_DEPART'], $data['DATE_ARRIVEE'], $data['HEURE_ARRIVEE']);
    
        header("Location: settings-transport.php?event=".$event);
        
    }
}
?>