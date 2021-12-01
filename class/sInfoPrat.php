<?php

require_once './class/Sites.php';

class sInfoPrat extends Sites {

    protected $table = "SITE_INFOS_PRAT";
    protected $mysqli;

	public function updateInfosPic($nomDestination, $idEvent){
		$sql = "UPDATE `SITE_INFOS_PRAT` 
                SET PIC_INFOS='" . mysqli_real_escape_string($this->mysqli, $nomDestination) . "' 
                WHERE `EVENT_ID` = '" . $idEvent . "'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($this->mysqli, $req);
	}

	public function updateInfos($TXT_INFOS_ST, $NB_INFOS, $event){
		$sql = "UPDATE `SITE_INFOS_PRAT` 
				SET `TXT_INFOS_ST` = '".mysqli_real_escape_string($this->mysqli, $TXT_INFOS_ST)."', 
					`NB_INFOS` = '".mysqli_real_escape_string($this->mysqli, $NB_INFOS)."' 
				WHERE `EVENT_ID` = '".$event."';";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($this->mysqli, $req);
	}

	public function updateInfosLoop($TXT_INFOS_TITRE, $TXT_INFOS_TITRE_CONTENT, $TXT_INFOS, $TXT_INFOS_CONTENT, $ICO_INFOS_P, $ICO_INFOS_P_CONTENT, $event){

		$sql = "UPDATE `SITE_INFOS_PRAT` 
				SET $TXT_INFOS_TITRE='".mysqli_real_escape_string($this->mysqli, $TXT_INFOS_TITRE_CONTENT)."', 
				$TXT_INFOS='".mysqli_real_escape_string($this->mysqli, $TXT_INFOS_CONTENT)."', 
				$ICO_INFOS_P='".mysqli_real_escape_string($this->mysqli, $ICO_INFOS_P_CONTENT)."' 
			WHERE EVENT_ID = '".$event."'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($this->mysqli, $req);

	}
}