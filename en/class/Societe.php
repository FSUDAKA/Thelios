<?php

require_once './class/Model.php';

class Societe extends Model {
	protected $mysqli;
	protected $table = "SOCIETE";



	public function checkEmail($email){
		$sql = 'SELECT COUNT(ID) as total FROM USERS WHERE EMAIL="'.$email.'"';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_assoc($req);
	}

	public function isValidById($id){
		$sql = 'SELECT VALIDE FROM SOCIETE WHERE ID="'.$id.'"';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_row($req);
		}

	public function setlogo($logo, $idSociete){
		$logo = mysqli_real_escape_string($this->mysqli, $logo);
		$sql = "UPDATE `SOCIETE` SET
                     `LOGO` = '$logo'
				 WHERE `ID` = '$idSociete'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));

	}

	public function updateRefusById($idSociete, $refus){
		$refus = mysqli_real_escape_string($this->mysqli, $refus);
		$sql = "UPDATE `SOCIETE` SET
                     `REFUS` = '$refus',
                     `VALIDE` = '2'
				 WHERE `ID` = '$idSociete'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));

	}

	public function updateSocieteById($idSociete, $societe_nom, $societe_adresse1, $societe_adresse2, $societe_adresse3, $cp, $ville, $pays, $societe_mail, $societe_tel, $metier, $sous_metier, $agences, $tva, $ca, $valide, $SITE_INTERNET){
		$societe_nom = mysqli_real_escape_string($this->mysqli, $societe_nom);
		$societe_adresse1 = mysqli_real_escape_string($this->mysqli, $societe_adresse1);
		$societe_adresse2 = mysqli_real_escape_string($this->mysqli, $societe_adresse2);
		$societe_adresse3 = mysqli_real_escape_string($this->mysqli, $societe_adresse3);
		$cp = mysqli_real_escape_string($this->mysqli, $cp);
		$ville = mysqli_real_escape_string($this->mysqli, $ville);
		$pays = mysqli_real_escape_string($this->mysqli, $pays);
		$societe_mail = mysqli_real_escape_string($this->mysqli, $societe_mail);
		$societe_tel = mysqli_real_escape_string($this->mysqli, $societe_tel);
		$metier = mysqli_real_escape_string($this->mysqli, $metier);
		$sous_metier = mysqli_real_escape_string($this->mysqli, $sous_metier);
		$agences = mysqli_real_escape_string($this->mysqli, $agences);
		$site = mysqli_real_escape_string($this->mysqli, $SITE_INTERNET);
		//$cgv = $this->checkBoxTraitement($cgv);
		$sql = "UPDATE `SOCIETE` SET
					`NOM` = '$societe_nom', 
					`ADRESSE1` = '$societe_adresse1', 
					`ADRESSE2` = '$societe_adresse2', 
					`ADRESSE3` = '$societe_adresse3',
                     `CP` = '$cp',
                     `VILLE` = '$ville',
                     `PAYS` = '$pays',
                     `EMAIL` = '$societe_mail',
                     `TEL` = '$societe_tel',
                     `METIER` = '$metier',
                     `SOUS_METIER` = '$sous_metier',
                     `AGENCES` = '$agences',
                     `TVA` = '$tva',
                     `CA` = '$ca',
                     `VALIDE` = '$valide',
                     `SITE_INTERNET` = '$site'
				 WHERE `ID` = '$idSociete'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));

	}
	private function checkBoxTraitement($checkbox){
		if($checkbox == null){
			$result = 0;
		}else{
			$result = 1;
		}
		return $result;
	}
}