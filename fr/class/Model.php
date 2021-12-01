<?php

require_once './config/Database.php';

class Model {

	protected $table;
	protected $mysqli;


	public function __construct(){
		$this->mysqli = Database::getMysqli();
	}

	public function findOneById($id){

		$sql = "SELECT * FROM `$this->table` WHERE `ID` = $id";
		$req = mysqli_query($this->mysqli, $sql);
		return mysqli_fetch_assoc($req);
	}

    public function findNomPrenom($id){

        $sql = "SELECT NOM, PRENOM FROM USERS WHERE ID = $id";
        $req = mysqli_query($this->mysqli, $sql);
        return mysqli_fetch_assoc($req);
    }

	public function allOrderByID(){
		$sql = 'SELECT * FROM ACTIVITES ORDER BY ID DESC';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($req);
	}

	public function deleteFromId($id){
		$sql = "DELETE FROM $this->table WHERE ID = $id";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
	}
// Ajout de Fabrce 16/10 pour le delete de Principal dans liste.php
	public function deleteFromSoc($soc){
		$sql = "DELETE FROM $this->table WHERE SOCIETE_ID = $soc";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));

		$sql2 = "DELETE FROM SOCIETE WHERE ID = $soc";
		$req2 = mysqli_query($this->mysqli, $sql2) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
	}


	public function deletePicture($jour, $event){
		$sql = "UPDATE $this->table SET $jour='' WHERE ID = '" . $event . "'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($req);
	}

	public function deleteItem($table, $item){
		$sql = "DELETE FROM $table WHERE ID = $item";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($req);
	}

	public function selectItem($table, $item){
		$sql = "SELECT * FROM  $table WHERE ID = $item";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($req);
	}
}