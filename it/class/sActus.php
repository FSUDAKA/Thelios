<?php

require_once './class/Sites.php';

class sActus extends Sites {
	protected $table = "SITE_ACTUS";
	protected $mysqli;

	public function setPicActualite($nomDestination, $idEvent){

		$sql = "UPDATE `SITE_ACTUS` SET `PIC_ACTUALITE` = '$nomDestination' WHERE `EVENT_ID` = '$idEvent'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_assoc($req);
	}

	public function setFileBloc($i, $nomDestination, $idEvent){
		$sql = "UPDATE `SITE_ACTUS` SET `PIC_" . $i . "` = '$nomDestination' WHERE `EVENT_ID` = '$idEvent'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
	}

	public function setTxtBloc($i, $titre, $text, $NB_BLOC, $idEvent){
		$text = mysqli_real_escape_string($this->mysqli, $text);
		$sql = "UPDATE `SITE_ACTUS` 
				SET `TITRE_" . $i . "` = '$titre',
				    `TXT_" . $i . "` = '$text',
				    `NB_ACTUS` = '$NB_BLOC'
				WHERE `EVENT_ID` = '$idEvent'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
	}

	public function updateTXT ($TXT_ACTUALITE, $idEvent) {

		$txt   = mysqli_real_escape_string($this->mysqli, $TXT_ACTUALITE);

		$sql = "UPDATE `SITE_ACTUS` SET `TXT_ACTUALITE` = '$txt'
                                  	WHERE `EVENT_ID` =$idEvent;";
		$req = mysqli_query($this->mysqli, $sql) or die(mysqli_error($this->mysqli));
	}
}