<?php

require_once './Model.php';

class Room extends Model {

	public function deleteByHotelId($hotelId){
		$sql = 'DELETE FROM ROOM WHERE HOTELS_ID = "'.$hotelId.'"';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />' . $sql . '<br />' . mysqli_error($this->mysqli));
		return mysqli_fetch_array($req);
	}

	public function new($EVENT_ID, $ID, $style){
		$sql = "INSERT INTO `ROOM` (`EVENT_ID`, `HOTELS_ID`, `ROOM_TYPE`) 
				VALUES (mysqli_real_escape_string($this->mysqli, utf8_decode($EVENT_ID)), 
						mysqli_real_escape_string($this->mysqli, utf8_decode($ID)),
						$style)";
	}

	public function findId($ID, $style){
		$sql2 = "SELECT ID FROM ROOM WHERE HOTELS_ID =  $ID  AND ROOM_TYPE = $style";
		$req2 = mysqli_query($this->mysqli, $sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_assoc($req2);
	}
}