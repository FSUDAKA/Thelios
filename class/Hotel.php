<?php

require_once "./Model.php";

class Hotel extends Model{

	public function new($event, $NOM, $ADRESSE1, $ADRESSE2, $CP, $VILLE, $TEL, $STOCK_SGL, $STOCK_DBL, $STOCK_TWIN){
		$sql = 'INSERT INTO `HOTELS` (`EVENT_ID`, `NOM`, `ADRESSE1`, `ADRESSE2`, `CP`, `VILLE`, `TEL`, `STOCK_SGL`, `STOCK_DBL`, `STOCK_TWIN`) 
				VALUES("'.mysqli_real_escape_string($this->mysqli, utf8_decode($event)).'",
				       "'.mysqli_real_escape_string($this->mysqli, utf8_decode($NOM)).' - Copie",
				       "'.mysqli_real_escape_string($this->mysqli, utf8_decode($ADRESSE1)).'", 
				       "'.mysqli_real_escape_string($this->mysqli, utf8_decode($ADRESSE2)).'",
				       "'.mysqli_real_escape_string($this->mysqli, utf8_decode($CP)).'", 
				       "'.mysqli_real_escape_string($this->mysqli, utf8_decode($VILLE)).'", 
				       "'.mysqli_real_escape_string($this->mysqli, utf8_decode($TEL)).'", 
				       "'.mysqli_real_escape_string($this->mysqli, utf8_decode($STOCK_SGL)).'", 
				       "'.mysqli_real_escape_string($this->mysqli, utf8_decode($STOCK_DBL)).'", 
				       "'.mysqli_real_escape_string($this->mysqli, utf8_decode($STOCK_TWIN)).'")';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($req);
	}

	public function findOneByName($nom){
		$sql = "SELECT * FROM HOTELS WHERE NOM= $nom";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($req);
	}

	public function selectOneByName($nom){
		$sql = "SELECT 1 FROM HOTELS WHERE NOM='$nom' LIMIT 1";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($req);
	}

	public function updateAll($NOM, $ADRESSE1, $ADRESSE2, $CP, $VILLE, $TEL, $STOCK_SGL, $STOCK_DBL, $STOCK_TWIN, $item){
		$sql = "UPDATE `HOTELS` 
				SET `NOM` = '".mysqli_real_escape_string(utf8_decode($this->mysqli, $NOM))."', 
					`ADRESSE1` = '".mysqli_real_escape_string(utf8_decode($this->mysqli, $ADRESSE1))."', 
					`ADRESSE2` = '".mysqli_real_escape_string(utf8_decode($this->mysqli, $ADRESSE2))."', 
					`CP` = '".mysqli_real_escape_string(utf8_decode($this->mysqli, $CP))."', 
					`VILLE` = '".mysqli_real_escape_string(utf8_decode($this->mysqli, $VILLE))."', 
					`TEL` = '".mysqli_real_escape_string(utf8_decode($this->mysqli, $TEL))."', 
					`STOCK_SGL` = '".mysqli_real_escape_string(utf8_decode($this->mysqli, $STOCK_SGL))."', 
					`STOCK_DBL` = '".mysqli_real_escape_string(utf8_decode($this->mysqli, $STOCK_DBL))."', 
					`STOCK_TWIN` = '".mysqli_real_escape_string(utf8_decode($this->mysqli, $STOCK_TWIN))."' 
				WHERE `ID` = '".$item."';";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($req);
	}
}