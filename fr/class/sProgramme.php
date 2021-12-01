<?php

require_once './class/Sites.php';

class sProgramme extends Sites{

    protected $table = "SITE_PROGRAMME";
    protected $mysqli;

	public function updateBanniere($nomDestination, $event){
		$sql = "UPDATE `SITE_PROGRAMME` SET `PIC_PROGRAMME`=  '" . mysqli_real_escape_string($this->mysqli, $nomDestination) . "' WHERE EVENT_ID = $event";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($this->mysqli, $req);
	}

	public function setFileBloc($i, $nomDestination, $idEvent){
		$sql = "UPDATE `SITE_PROGRAMME` SET `PIC_PROGRAMME_J" . $i . "` = '$nomDestination' WHERE `EVENT_ID` = '$idEvent'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
	}

	public function updateContent($TXT_PROGRAMME_ST, $NB_PROGRAMME, $event){
		$sql = "UPDATE `SITE_PROGRAMME` 
				SET `TXT_PROGRAMME_ST` = '".mysqli_real_escape_string($this->mysqli, $TXT_PROGRAMME_ST)."', 
					`NB_PROGRAMME` = '".mysqli_real_escape_string($this->mysqli, $NB_PROGRAMME)."' 
				WHERE `EVENT_ID` = '".$event."';";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($this->mysqli, $req);

	}

	public function updateProgramme($TXT_PROGRAMME_TITRE, $TXT_PROGRAMME_TITRE_CONTENT, $TXT_PROGRAMME, $TXT_PROGRAMME_CONTENT, $event){
		$sql = "UPDATE `SITE_PROGRAMME` 
				SET $TXT_PROGRAMME_TITRE='".mysqli_real_escape_string($this->mysqli, $TXT_PROGRAMME_TITRE_CONTENT)."', 
					$TXT_PROGRAMME='".mysqli_real_escape_string($this->mysqli, $TXT_PROGRAMME_CONTENT)."' 
				WHERE EVENT_ID = '".$event."'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($this->mysqli, $req);
	}


}