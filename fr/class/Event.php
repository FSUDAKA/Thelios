<?php

require_once './config/Database.php';
require_once './class/Model.php';

class Event extends Model{

    protected $table = "EVENTS";

    public function getNameById($event){
        $sql = 'SELECT `NOM` FROM EVENTS WHERE `ID` = "'.$event.'"';
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
        return mysqli_fetch_assoc($req);
    }

    public function selectEvents(){
        $sql = 'SELECT * FROM EVENTS ORDER BY ID DESC';
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
        return mysqli_fetch_all($req);
    }

    public function updateOptions ($OPT_ACCUEIL, $OPT_ACTUALITES, $OPT_PROGRAMME, $OPT_HEBERGEMENT, $OPT_INFOSPRATIQUES, $OPT_PRESSE, $OPT_CONTACT, $OPT_INSCRIPTION, $OPT_ACTIVITES, $OPT_HEBERGEMENT2, $OPT_TRANSPORT, $event){
	    $sql = "UPDATE `EVENTS` 
				SET `OPT_ACCUEIL` = '".$OPT_ACCUEIL."',
                    `OPT_ACTUALITES` = '".$OPT_ACTUALITES."', 
                    `OPT_PROGRAMME` = '".$OPT_PROGRAMME."',
                    `OPT_HEBERGEMENT` = '".$OPT_HEBERGEMENT."', 
                    `OPT_INFOSPRATIQUES` = '".$OPT_INFOSPRATIQUES."',
                    `OPT_PRESSE` = '".$OPT_PRESSE."',
                    `OPT_CONTACT` = '".$OPT_CONTACT."', 
                    `OPT_INSCRIPTION` = '".$OPT_INSCRIPTION."',
                    `OPT_ACTIVITES` = '".$OPT_ACTIVITES."', 
                    `OPT_HEBERGEMENT2` = '".$OPT_HEBERGEMENT2."',
                    `OPT_TRANSPORT` = '".$OPT_TRANSPORT."'
                WHERE `ID` = '".$event."';";
	    $req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
	    return mysqli_fetch_array($req);
    }

	public function updateEvent($nom, $description, $date_in, $date_out, $event){
		$sql = "UPDATE `EVENTS` 
				SET `NOM` = '".mysqli_real_escape_string($this->mysqli, $nom)."',
					`DESCRIPTION` = '".mysqli_real_escape_string($this->mysqli, $description)."',
					`DATE_IN` = '".mysqli_real_escape_string($this->mysqli, $date_in)."',
					`DATE_OUT` = '".mysqli_real_escape_string($this->mysqli, $date_out)."' 
			   WHERE `ID` = '".$event."';";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		$data = mysqli_fetch_array($req);
	}

	public function add($nom, $par){
		$sql = 'INSERT INTO `EVENTS` (`NOM`, `CREATION`, `PAR`) 
				VALUES ("'.mysqli_real_escape_string($this->mysqli, $nom).'",
				        "'.date("d/m/Y").' - '.date("H").'h'.date("i").'",
				        "'.mysqli_real_escape_string($this->mysqli, $par).'")';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_array($req);
	}

	public function newEvent($nom, $par, $description, $dateIn, $dateOut, $OPT_ACCUEIL, $OPT_ACTUALITES, $OPT_PROGRAMME, $OPT_HEBERGEMENT, $OPT_INFOSPRATIQUES, $OPT_PRESSE, $OPT_CONTACT, $OPT_INSCRIPTION, $OPT_ATELIERS, $OPT_HEBERGEMENT2, $OPT_TRANSPORT){
		$sql = "INSERT INTO `EVENTS` (`NOM`, `CREATION`, `PAR`, `DESCRIPTION`, `DATE_IN`, `DATE_OUT`, `OPT_ACCUEIL`, `OPT_PROGRAMME`, `OPT_HEBERGEMENT`, `OPT_INFOSPRATIQUES`, `OPT_CONTACT`, `OPT_INSCRIPTION`, `OPT_ATELIERS`, `OPT_HEBERGEMENT2`, `OPT_TRANSPORT`)
				VALUES ('".mysqli_real_escape_string($this->mysqli, $nom)." - Copie',
				        '".date("d/m/Y").' - '.date("H").'h'.date("i")."',
				        '".mysqli_real_escape_string($this->mysqli, $par)."',
				        '".mysqli_real_escape_string($this->mysqli, $description)."',
				        '".mysqli_real_escape_string($this->mysqli, $dateIn)."', 
				        '".mysqli_real_escape_string($this->mysqli, $dateOut)."', 
				        '".mysqli_real_escape_string($this->mysqli, $OPT_ACCUEIL)."',
				        '".mysqli_real_escape_string($this->mysqli, $OPT_ACTUALITES)."', 
				        '".mysqli_real_escape_string($this->mysqli, $OPT_PROGRAMME)."', 
				        '".mysqli_real_escape_string($this->mysqli, $OPT_HEBERGEMENT)."', 
				        '".mysqli_real_escape_string($this->mysqli, $OPT_INFOSPRATIQUES)."', 
				        '".mysqli_real_escape_string($this->mysqli, $OPT_PRESSE)."',
				        '".mysqli_real_escape_string($this->mysqli, $OPT_CONTACT)."', 
				        '".mysqli_real_escape_string($this->mysqli, $OPT_INSCRIPTION)."',
				        '".mysqli_real_escape_string($this->mysqli, $OPT_ATELIERS)."', 
				        '".mysqli_real_escape_string($this->mysqli, $OPT_HEBERGEMENT2)."', 
				        '".mysqli_real_escape_string($this->mysqli, $OPT_TRANSPORT)."', 
				        '".mysqli_real_escape_string($this->mysqli, $PIC_ACCUEIL)."', 
				        '".mysqli_real_escape_string($this->mysqli, $TXT_ACCUEIL_ST)."', 
				        '".mysqli_real_escape_string($this->mysqli, $TXT_ACCUEIL_T_EDITO)."', 
				        '".mysqli_real_escape_string($this->mysqli, $TXT_ACCUEIL_EDITO)."')";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_array($req);
	}

	public function findByNom($nom){
		$sql = 'SELECT * FROM EVENTS WHERE NOM="'.$nom.' - Copie"';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_array($req);
	}

	public function getDateById($event){
		$sql = 'SELECT `DATE_IN`, DATE_OUT FROM EVENTS WHERE `ID` = "'.$event.'"';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_assoc($req);
	}

	private function getEventDate($id) {
    	$dateEvent = $this->getDateById($id);
		$return = array($dateEvent['DATE_IN']);
		$start = $dateEvent['DATE_IN'];
		$i = 1;
		if (strtotime($dateEvent['DATE_IN']) < strtotime($dateEvent['DATE_OUT'])) {
			while (strtotime($start) < strtotime($dateEvent['DATE_OUT'])) {
				$start = date('Y-m-d', strtotime($dateEvent['DATE_IN'] . '+' . $i . ' days'));
				$return[] = $start;
				$i++;
			}
		}
		return $return;
	}
}