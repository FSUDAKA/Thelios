<?php

require_once './class/Model.php';

$error="";

class Profil extends Model {

	public function updateProfil($civilite, $nom, $prenom, $participe, $isvalid, $isprivilegie, $societe, $typesoc, $secteur, $fonction, $adresse, $adresse2, $cp, $ville, $email, $tel, $mobile, $date_in, $date_out, $user){
		$sql = "UPDATE `PROFILS` 
				SET `CIVILITE` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($civilite))."', 
					`NOM` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($nom))."', 
					`PRENOM` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($prenom))."', 
					`PARTICIPATION` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($participe))."', 
					`ISVALID` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($isvalid))."', 
					`ISPRIVILEGIE` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($isprivilegie))."', 
					`SOCIETE` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($societe))."', 
					`TYPE_SOC` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($typesoc))."', 
					`SECTEUR` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($secteur))."', 
					`FONCTION` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($fonction))."', 
					`ADRESSE` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($adresse))."', 
					`ADRESSE2` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($adresse2))."', 
					`CP` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($cp))."', 
					`VILLE` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($ville))."', 
					`EMAIL` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($email))."', 
					`TEL` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($tel))."', 
					`MOBILE` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($mobile))."', 
					`DATE_IN` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($date_in))."', 
					`DATE_OUT` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($date_out))."' 
				WHERE `ID` = '".$user."';";
		$req = mysqli_query($this->mysqli, $sql) or die(mysqli_error($this->mysqli));
		return mysqli_fetch_array($req);
	}

	public function addCadeau($cadeau, $remarques, $user){
		$sql = "UPDATE `PROFILS` 
				SET `CADEAU` = " . $cadeau . ", 
					`REMARQUES` = " . $remarques . " 
				WHERE `ID` = '".$user."';";
		$req = mysqli_query($this->mysqli, $sql) or die(mysqli_error($this->mysqli));
		return mysqli_fetch_array($req);
	}
}