<?php

require_once './class/Room.php';

$room = new Room();

if($_GET["item"] != ""){
	$item = $_GET["item"];
	$event = $_GET["event"];
	$table = $_GET["table"];
	$data = $room->deleteItem($table, $item);
	if($table == "HOTELS"){

		$data = $room->deleteByHotelId($item);
		if($table == "HOTELS"){
			header("Location: settings-hebergement2.php?event=" . $event);
		}
		if($table == "ACTIVITES"){
			header("Location: settings-activites.php?event=" . $event);
		}
		if($table == "TRANSPORTS"){
			header("Location: settings-transport.php?event=" . $event);
		}
	}
}