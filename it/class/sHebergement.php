<?php

require_once './class/Sites.php';


class sHebergement extends Sites {

	protected $table = "SITE_HEBERGEMENT";
	protected $mysqli;


    public function __construct(){
        parent::__construct();
        $translation = $_COOKIE['lang'] ?? 'fr';
        $this->table = strtoupper($translation) . '_' . $this->table;
    }

	public function updateHebergementPic($nomDestination, $idEvent){
		$sql = "UPDATE `SITE_HEBERGEMENT`
                SET PIC_HEBERGEMENT='" . mysqli_real_escape_string($this->mysqli, $nomDestination) . "'
                WHERE `EVENT_ID` = '" . $idEvent . "'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($this->mysqli, $req);
	}

	public function updateAllHebergementPic($nomDestination, $idEvent){
		$sql = "UPDATE `SITE_HEBERGEMENT`
                SET $TXT_HEBERGEMENT_TITRE='" . mysqli_real_escape_string($this->mysqli, $TXT_HEBERGEMENT_TITRE_CONTENT) . "',
                    $TXT_HEBERGEMENT='" . mysqli_real_escape_string($this->mysqli, $TXT_HEBERGEMENT_CONTENT) . "',
                    $MAP_HEBERGEMENT_H='" . mysqli_real_escape_string($this->mysqli, $MAP_HEBERGEMENT_CONTENT) . "'
                WHERE `EVENT_ID` = '" . $event . "'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($this->mysqli, $req);
	}

	public function updateHebergement($TXT_HEBERGEMENT_ST, $NB_HEBERGEMENT, $idEvent){
		$sql = "UPDATE `SITE_HEBERGEMENT`
                SET `TXT_HEBERGEMENT_ST` = '" . mysqli_real_escape_string($this->mysqli, $TXT_HEBERGEMENT_ST) . "',
                    `NB_HEBERGEMENT` = '" . mysqli_real_escape_string($this->mysqli, $NB_HEBERGEMENT) . "'
                WHERE `EVENT_ID` = '" . $idEvent . "'";

		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($this->mysqli, $req);
	}

	// utile dans le fichier settings hebergement dans le cas d'une boucle.

	public function updateHerbergementPcLoop($namePicture, $nomDestination, $idEvent){
		$sql = "UPDATE `SITE_HEBERGEMENT` SET $namePicture='" . mysqli_real_escape_string($this->mysqli, $nomDestination) . "' WHERE `EVENT_ID` = '" . $idEvent . "'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($req);
	}

	public function updateHebergementAllLoop($TXT_HEBERGEMENT_TITRE, $TXT_HEBERGEMENT, $MAP_HEBERGEMENT_H, $TXT_HEBERGEMENT_TITRE_CONTENT, $TXT_HEBERGEMENT_CONTENT, $MAP_HEBERGEMENT_CONTENT, $event){
		$sql = "UPDATE `SITE_HEBERGEMENT`
				SET $TXT_HEBERGEMENT_TITRE='".mysqli_real_escape_string($this->mysqli, $TXT_HEBERGEMENT_TITRE_CONTENT)."',
				    $TXT_HEBERGEMENT='".mysqli_real_escape_string($this->mysqli, $TXT_HEBERGEMENT_CONTENT)."',
				    $MAP_HEBERGEMENT_H='".mysqli_real_escape_string($this->mysqli, $MAP_HEBERGEMENT_CONTENT)."'
			    WHERE `EVENT_ID` = '".$event."'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_array($req);
	}
}