<?php

require_once './class/Model.php';

class Activity extends Model {
    protected $table = "ACTIVITES";
    protected $mysqli;

    public function selectOne ($theme){
        $result = mysqli_query($this->mysqli, "SELECT 1 FROM ACTIVITES WHERE THEME='$theme' LIMIT 1");
        return mysqli_fetch_row($result);
    }

    public function add ($THEME, $DESCRIPTION, $DATE, $HEURE, $SALLE, $event) {
        $sql = 'INSERT INTO `ACTIVITES` (`EVENT_ID`, `THEME`, `DESCRIPTION`, `DATE`, `HEURE`, `SALLE`) 
                VALUES ("'.mysqli_real_escape_string($this->mysqli, utf8_decode($event)).'", "'.mysqli_real_escape_string($this->mysqli, utf8_decode($THEME)).'", "'.mysqli_real_escape_string($this->mysqli, utf8_decode($DESCRIPTION)).'", "'.mysqli_real_escape_string($this->mysqli, utf8_decode($DATE)).'", "'.mysqli_real_escape_string($this->mysqli, utf8_decode($HEURE)).'", "'.mysqli_real_escape_string($this->mysqli, utf8_decode($SALLE)).'")';
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
        return mysqli_fetch_array($req);
    }

	public function updateActivity($theme, $description, $date, $heure, $salle, $id){
		$sql = "UPDATE `ACTIVITES` 
				SET `THEME` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($theme))."',
				    `DESCRIPTION` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($description))."', 
				    `DATE` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($date))."', 
				    `HEURE` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($heure))."', 
				    `SALLE` = '".mysqli_real_escape_string($this->mysqli, utf8_decode($salle))."' 
			    WHERE `ID` = '".$id."';";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		$data = mysqli_fetch_array($req);
	}
}