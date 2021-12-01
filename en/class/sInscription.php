<?php

require_once './class/Sites.php';

class sInscription extends Sites {

    protected $table = "SITE_INSCRIPTION";
    protected $mysqli;

	public function updateBanniere($nomDestination, $event){
		$sql = "UPDATE SITE_INSCRIPTION SET BANNIERE='".mysqli_real_escape_string($this->mysqli, utf8_decode($nomDestination))."' WHERE ID = '".$event."'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($this->mysqli, $req);
	}

	public function updateInscriptionInfo($SOUS_TITRE, $TXT_ACCUEIL_T_EDITO, $TXT_ACCUEIL_EDITO, $event){
		$sql = "UPDATE `SITE_INSCRIPTION` 
				SET `SOUS_TITRE` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($SOUS_TITRE))."', 
					`TXT_ACCUEIL_T_EDITO` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($TXT_ACCUEIL_T_EDITO))."', 
					`TXT_ACCUEIL_EDITO` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($TXT_ACCUEIL_EDITO))."' 
				WHERE `ID` = '".$event."';";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($this->mysqli, $req);
	}
}