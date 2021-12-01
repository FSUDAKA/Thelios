<?php

require_once './Model.php';

class Transport extends Model{

	public function new($event, $TYPE, $MOYEN, $NOM, $DESCRIPTION, $NUMERO, $DE, $A, $DATE_DEPART, $HEURE_DEPART, $DATE_ARRIVEE ,$HEURE_ARRIVEE){
		$sql = 'INSERT INTO `TRANSPORTS` (`EVENT_ID`, `TYPE`, `MOYEN`, `NOM`, `DESCRIPTION`, `NUMERO`, `DE`, `A`, `DATE_DEPART`, `HEURE_DEPART`, `DATE_ARRIVEE`, `HEURE_ARRIVEE`)
				VALUES ("'.mysqli_real_escape_string($this->mysqli, utf8_decode($event)).'",
				"'.mysqli_real_escape_string($this->mysqli, utf8_decode($TYPE)).'", 
				"'.mysqli_real_escape_string($this->mysqli, utf8_decode($MOYEN)).'", 
				"'.mysqli_real_escape_string($this->mysqli, utf8_decode($NOM)).' - Copie", 
				"'.mysqli_real_escape_string($this->mysqli, utf8_decode($DESCRIPTION)).'", 
				"'.mysqli_real_escape_string($this->mysqli, utf8_decode($NUMERO)).'", 
				"'.mysqli_real_escape_string($this->mysqli, utf8_decode($DE)).'", 
				"'.mysqli_real_escape_string($this->mysqli, utf8_decode($A)).'", 
				"'.mysqli_real_escape_string($this->mysqli, utf8_decode($DATE_DEPART)).'", 
				"'.mysqli_real_escape_string($this->mysqli, utf8_decode($HEURE_DEPART)).'", 
				"'.mysqli_real_escape_string($this->mysqli, utf8_decode($DATE_ARRIVEE)).'", 
				"'.mysqli_real_escape_string($this->mysqli, utf8_decode($HEURE_ARRIVEE)).'")';
	}
	public function selectOne ($nom){
		$result = mysqli_query($this->mysqli, "SELECT 1 FROM TRANSPORT WHERE NOM='$nom' LIMIT 1");
		return mysqli_fetch_row($result);
	}

	public function update($TYPE, $MOYEN, $NOM, $DESCRIPTION, $NUMERO, $DE, $A, $DATE_DEPART, $HEURE_DEPART, $DATE_ARRIVEE, $HEURE_ARRIVEE, $event){
		$sql = "UPDATE `TRANSPORTS` 
				SET `TYPE` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($TYPE))."', 
					`MOYEN` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($MOYEN))."', 
					`NOM` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($NOM))."', 
					`DESCRIPTION` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($DESCRIPTION))."', 
					`NUMERO` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($NUMERO))."', 
					`DE` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($DE))."', 
					`A` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($A))."', 
					`DATE_DEPART` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($DATE_DEPART))."', 
					`HEURE_DEPART` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($HEURE_DEPART))."', 
					`DATE_ARRIVEE` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($DATE_ARRIVEE))."', 
					`HEURE_ARRIVEE` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($HEURE_ARRIVEE))."'
				 WHERE `ID` = '".$event."';";
	}
}