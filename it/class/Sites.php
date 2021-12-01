<?php

require_once './config/Database.php';

class Sites {

    protected $mysqli;
    protected $pdo;
    protected $table;

    public function __construct() {
        $this->mysqli = Database::getMysqli();
        $this->pdo = Database::getPdo();

    }

    public function findAllById($event){





        $sql = "SELECT * FROM `$this->table` WHERE `EVENT_ID` = $event";
        $req = mysqli_query($this->mysqli, $sql) ;
        return mysqli_fetch_assoc($req);


        /*$statment = $this->pdo->prepare('SELECT * FROM :selected_table WHERE EVENT_ID = :event_id');

        $statment->execute([
            ':selected_table' => $this->table,
            ':event_id' => $event
        ]);

        return $statment->fetchAll();*/

    }

	public function deletePicture($jour, $event){
		$sql = "UPDATE $this->table SET $jour ='' WHERE EVENT_ID = '$event'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
	}
	public function findNomById($event){
		$sql = "SELECT `NOM` FROM EVENTS WHERE `ID` = '$event'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_assoc($req);
	}
}