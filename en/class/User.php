<?php

require_once './class/Model.php';

class User extends Model{

    protected $table = "USERS";

	public function checkEmail($email){
		$sql = 'SELECT COUNT(ID) as total FROM USERS WHERE EMAIL="'.$email.'"';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_assoc($req);
	}

	public function checkEmailProfil($email, $id){
		$sql = 'SELECT COUNT(ID) as total FROM USERS WHERE EMAIL="'.$email.'"  AND ID != "'.$id.'"';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_assoc($req);
	}

	public function checkEmailProfil2($email){
		$sql = 'SELECT COUNT(ID) as total FROM USERS WHERE NOM_ACC="'.$email.'"';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_assoc($req);
	}


	public function countIdByHotel($hotelId){
		$sql3 = 'SELECT COUNT(ID) as total FROM USERS WHERE HOTEL_ID="'.$hotelId.'"';
		$req3 = mysqli_query($this->mysqli, $sql3) or die('Erreur SQL !<br />'.$sql3.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_assoc($req3);
	}
    
    public function countIdByUser($type){
		$sql3 = 'SELECT COUNT(ID) as totaluser FROM USERS WHERE TYPE="'.$type.'"';
		$req3 = mysqli_query($this->mysqli, $sql3) or die('Erreur SQL !<br />'.$sql3.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_assoc($req3);
	}

	public function selectIdByPassword($password){
		$sql = 'SELECT ID FROM USERS WHERE PASSWORD = "'.$password.'"';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_num_rows($req);
	}

	public function findAllByPassword($password){
		$sql = 'SELECT * FROM USERS WHERE PASSWORD = "'.$password.'"';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysqli_error($this->mysqli));
		return mysqli_fetch_assoc($req);
	}

	public function updateConnexionById($id){
		$sql = "UPDATE USERS SET CONNEXION='".date("d-m-Y H:i")."' WHERE ID = '".$id."'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
	}

	public function selectIdByNewPass($newpassword){
		$sql = 'SELECT ID FROM USERS WHERE PASSWORD = "'.$newpassword.'"';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_num_rows($req);
	}

    public function selectPassById($id){
		$sql = 'SELECT PASSWORD FROM USERS WHERE ID = "'.$id.'"';
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_row($req);
		//return mysqli_num_rows($req);
	}


	public function updateUsersByNewPass($newpassword, $id){
		$sql = "UPDATE USERS SET PASSWORD= '$newpassword' , FIRST_CO = '1'WHERE id = '$id'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
	}

	public function updateFirstcoById($id){
		$sql = "UPDATE USERS SET FIRST_CO = '1' WHERE id ='$id'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
	}

	public function selectIdByEmail($forget){
		$sql = "SELECT ID FROM USERS WHERE EMAIL = '$forget'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_num_rows($req);
	}

	public function selectEmailByPass($mail, $pass){
		$sql = "SELECT EMAIL, PASSWORD FROM USERS WHERE EMAIL = '$mail' AND PASSWORD = '$pass'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_assoc($req);
	}

    public function selectLogUser($mail, $pass){
		$sql = "SELECT * FROM USERS WHERE EMAIL = '$mail' AND PASSWORD = '$pass'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_assoc($req);
	}

	public function selectPassByEmail($mail){
		$sql = "SELECT PASSWORD FROM USERS WHERE EMAIL = '$mail'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_array($req);
	}

	public function updateFirstcoByEmail($forget){
		$sql = "UPDATE USERS SET FIRST_CO = '0' WHERE EMAIL ='$forget'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
	}

	public function updatePasswordByEmail($hash_mdp, $forget){
		$sql = "UPDATE USERS SET PASSWORD= '$hash_mdp' WHERE EMAIL = '$forget'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
	}

	public function selectByEmail($forget, $pass){
		$sql = "SELECT * FROM USERS WHERE email = '$forget' AND PASSWORD = '$pass'";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_assoc($req);
	}
	public function updateUserById ($id, $nom, $prenom, $fonction, $participe, $adresse_1, $adresse_2, $cp, $ville, $pays, $tel, $mobile, $email, $metier, $sous_metier, $day1, $day2, $dine){
			$nuit = 0;
			$day1 = $this->checkBoxTraitement($day1);
			$day2 = $this->checkBoxTraitement($day2);
			$cgv = $this->checkBoxTraitement($day2);
			if($day2 == 1 && $day1 == 1){
				$nuit = 1;
			}
			$ticket = $day1 + $day2;
		$nom = mysqli_real_escape_string($this->mysqli, $nom);
		$prenom = mysqli_real_escape_string($this->mysqli, $prenom);
		$fonction = mysqli_real_escape_string($this->mysqli, $fonction);
		$adresse_1 = mysqli_real_escape_string($this->mysqli, $adresse_1);
		$adresse_2 = mysqli_real_escape_string($this->mysqli, $adresse_2);
		$cp = mysqli_real_escape_string($this->mysqli, $cp);
		$ville = mysqli_real_escape_string($this->mysqli, $ville);
		$pays = mysqli_real_escape_string($this->mysqli, $pays);
		$tel = mysqli_real_escape_string($this->mysqli, $tel);
		$email = mysqli_real_escape_string($this->mysqli, $email);
		$mobile = mysqli_real_escape_string($this->mysqli, $mobile);
		$metier = mysqli_real_escape_string($this->mysqli, $metier);
		$sous_metier = mysqli_real_escape_string($this->mysqli, $sous_metier);
		$participe = intval($participe);

		$sql = "UPDATE `USERS` 
				SET NOM = '$nom',
				    PRENOM = '$prenom',
				    PARTICIPATION = $participe,
				    FONCTION = '$fonction',
				    ADRESSE1 = '$adresse_1',
				    ADRESSE2 = '$adresse_2',
				    CP = '$cp',
				    VILLE = '$ville',
				    PAYS = '$pays',
				    TEL = '$tel',
				    MOBILE = '$mobile',
				    EMAIL = '$email',
				    METIER = '$metier',
				    SOUS_METIER = '$sous_metier',
					PRESENT_DEJ1 = '" .intval($day1) . "' ,
				    PRESENT_DEJ2 = '" .intval($day2) . "' ,
				    PRESENT_NUIT1 = '" . intval($nuit) . "',
				    PRESENT_DINER1 = '" . intval($dine) . "',
				    NB_TICKETS_METRO = '" . intval($ticket) . "'
				    WHERE ID = '$id'";
		mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
	}

	public function updateUserById_SF ($id, $civilite, $nom, $prenom, $fonction, $participe, $tel, $mobile,
	                                   $email, $remarques, $accompagnant, $conditions, $civiliteAcc, $nomAcc, $prenomAcc,
	                                   $telAcc, $mobileAcc, $fonctionAcc){


		//$ticket = $day1 + $day2;

		
		$civilite = mysqli_real_escape_string($this->mysqli, $civilite);
		$nom = mysqli_real_escape_string($this->mysqli, $nom);
		$prenom = mysqli_real_escape_string($this->mysqli, $prenom);
		$fonction = mysqli_real_escape_string($this->mysqli, $fonction);
		$tel = mysqli_real_escape_string($this->mysqli, $tel);
		$email = mysqli_real_escape_string($this->mysqli, $email);
		$mobile = mysqli_real_escape_string($this->mysqli, $mobile);
		$remarques = mysqli_real_escape_string($this->mysqli, $remarques);
		$nomAcc = mysqli_real_escape_string($this->mysqli, $nomAcc);
		$prenomAcc = mysqli_real_escape_string($this->mysqli, $prenomAcc);
		$civiliteAcc = mysqli_real_escape_string($this->mysqli, $civiliteAcc);
		$telAcc = mysqli_real_escape_string($this->mysqli, $telAcc);
		$mobileAcc = mysqli_real_escape_string($this->mysqli, $mobileAcc);
		$fonctionAcc = mysqli_real_escape_string($this->mysqli, $fonctionAcc);

		$participe = intval($participe);
        $accompagnant = $this->checkBoxTraitement($accompagnant);

		$sql = "UPDATE `USERS` SET 
				    
				    CIVILITE = '$civilite',
				    NOM = '$nom',
				    PRENOM = '$prenom',
				    FONCTION = '$fonction',
				    PARTICIPATION = '$participe',
				    TEL = '$tel',
				    MOBILE = '$mobile',
				    EMAIL = '$email',
				    REMARQUES = '$remarques',
				    ACCOMPAGNANT = '$accompagnant',
				    CONDITIONS = '$conditions',
				    CIV_ACC = '$civiliteAcc',
                   	NOM_ACC = '$nomAcc',
                   	PRENOM_ACC = '$prenomAcc',
                   	TEL_ACC = '$telAcc',
                   	MOBILE_ACC = '$mobileAcc',
                   	FONCTION_ACC = '$fonctionAcc'                  	                  			    
				    WHERE ID = $id";
		mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
	}


    

	public function updateUserById2_SF ($id, $participe, $civilite, $nom, $prenom, $societe, $naissance, $email, $mobile, $remarques, $transport, $ticket, $mailacc, $conditions, $absence, $taille, $pointure){
        

		$participe = intval($participe);
		$civilite = mysqli_real_escape_string($this->mysqli, $civilite);
		$nom = mysqli_real_escape_string($this->mysqli, $nom);
		$prenom = mysqli_real_escape_string($this->mysqli, $prenom);
		$societe = mysqli_real_escape_string($this->mysqli, $societe);
		$naissance = mysqli_real_escape_string($this->mysqli, $naissance);
		$email = mysqli_real_escape_string($this->mysqli, $email);
		$mobile = mysqli_real_escape_string($this->mysqli, $mobile);
		$remarques = mysqli_real_escape_string($this->mysqli, $remarques);
		$transport = mysqli_real_escape_string($this->mysqli, $transport);
		$mailacc = mysqli_real_escape_string($this->mysqli, $mailacc);
		$ticket = mysqli_real_escape_string($this->mysqli, $ticket);
		$absence = mysqli_real_escape_string($this->mysqli, $absence);
		$taille = mysqli_real_escape_string($this->mysqli, $taille);
		$pointure = mysqli_real_escape_string($this->mysqli, $pointure);
        
        


		$sql = "UPDATE `USERS` SET 
				    PARTICIPATION = '$participe',
				    CIVILITE = '$civilite',
				    NOM = '$nom',
				    PRENOM = '$prenom',
				    MATRICULE = '$societe',	
				    FONCTION = '$naissance',			    
				    EMAIL = '$email',
				    MOBILE = '$mobile',
                   	REMARQUES = '$remarques',
                   	PRESENT_DEJ1 = '$transport',
				    PRESENT_REUNION1 = '$ticket',
				    NOM_ACC = '$mailacc',
				    CONDITIONS = '$conditions',
				    PAYS = '$absence',
				    TEL_ACC = '$taille',
				    MOBILE_ACC = '$pointure'                                
				    WHERE ID = $id";
        
        
		mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
	}
    
    
    
    public function addUserById ($civilite, $nom, $prenom, $fonction, $societe, $tel, $mobile, $email, $conditions, $choix1, $choix3, $choix4, $choix5, $hash_mdp){

		$civilite = mysqli_real_escape_string($this->mysqli, $civilite);
		$nom = mysqli_real_escape_string($this->mysqli, $nom);
		$prenom = mysqli_real_escape_string($this->mysqli, $prenom);
		$fonction = mysqli_real_escape_string($this->mysqli, $fonction);
		$societe = mysqli_real_escape_string($this->mysqli, $societe);
		$tel = mysqli_real_escape_string($this->mysqli, $tel);
		$mobile = mysqli_real_escape_string($this->mysqli, $mobile);
		$email = mysqli_real_escape_string($this->mysqli, $email);
		$choix1 = mysqli_real_escape_string($this->mysqli, $choix1);
		$choix3 = mysqli_real_escape_string($this->mysqli, $choix3);
		$choix4 = mysqli_real_escape_string($this->mysqli, $choix4);
		$choix5 = mysqli_real_escape_string($this->mysqli, $choix5);
		$participe = intval($participe);


		$sql = "INSERT INTO `USERS` (CIVILITE, NOM, PRENOM, FONCTION, MATRICULE, PARTICIPATION, TEL, MOBILE, EMAIL, CONDITIONS, PRESENT_REUNION1, PRESENT_REUNION21, PRESENT_REUNION31, PRESENT_DINER11, PASSWORD, GROUPE, TYPE, DROIT, IS_PRIVILEGIE, IS_VALID, SOCIETE_ID, SOUS_METIER) VALUE ('$civilite', '$nom', '$prenom', '$fonction', '$societe', '1', '$tel', '$mobile', '$email', '$conditions', '$choix1', '$choix3', '$choix4', '$choix5', '$hash_mdp', '1','2','0','1','1','194','0')";
		mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
	}
    
    

	public function selectCollabBySociete ($idSociete, $id){
	    $sql = "SELECT ID, CIVILITE, NOM, PRENOM, FONCTION, PRESENT_DEJ1, PRESENT_DEJ2, PRESENT_NUIT1, PRESENT_NUIT2, PRESENT_DINER1 FROM $this->table WHERE SOCIETE_ID = $idSociete AND ID != $id ORDER BY NOM, PRENOM DESC";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_all($req);

	}


	public function selectCollabBySociete_SF($idSociete, $id){
		$sql = "SELECT ID, CIVILITE, NOM, PRENOM, FONCTION, PARTICIPATION, PRESENT_DEJ1, PRESENT_DEJ2, PRESENT_NUIT1, PRESENT_NUIT2, PRESENT_DINER1, IS_PRIVILEGIE FROM $this->table WHERE SOCIETE_ID = $idSociete AND ID != $id ORDER BY NOM, PRENOM DESC";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_all($req);

	}

	/**
	 * @param $id
	 * @return bool
	 */
	public function isPrivi($id){
		$sql = "SELECT IS_PRIVILEGIE FROM USERS WHERE ID = $id";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return boolval(mysqli_fetch_row($req)[0]);
	}

	public function getSocieteId($id){
		$sql = "SELECT SOCIETE_ID FROM USERS WHERE ID = $id";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_row($req);
	}

	public function isEnable ($id){
		$sql = "SELECT IS_VALID FROM USERS WHERE ID = $id";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return boolval(mysqli_fetch_row($req)[0]);
	}

	public function changeActivtion($id){
		$sql = "UPDATE USERS SET IS_VALID = ( CASE IS_VALID WHEN 1 THEN 0 WHEN 0 THEN 1 END ) WHERE ID = $id";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		mysqli_fetch_row($req);
	}

	public function createNew($nom, $prenom, $email, $societe_id, $password, $event){
		$sql = "INSERT INTO USERS (NOM, PRENOM, EMAIL, SOCIETE_ID, PASSWORD, GROUPE, DROIT, TYPE) VALUES ('".mysqli_real_escape_string($this->mysqli, $nom)."', '".mysqli_real_escape_string($this->mysqli, $prenom)."', '".mysqli_real_escape_string($this->mysqli, $email)."', '$societe_id', '$password', '$event', '0', '1')";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
	}

	public function findSociete($id){
		$sql = "SELECT NOM FROM SOCIETE WHERE ID = $id";
		$req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
		return mysqli_fetch_row($req);
	}

	private function checkBoxTraitement($checkbox){
		if($checkbox == null){
			$result = 0;
		}else{
			$result = 1;
		}
		return $result;
	}

	public function invitesConfirmes($event){
        $sql = "SELECT * FROM USERS WHERE PARTICIPATION = 1 AND DROIT = '0' AND GROUPE = '$event'";
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
        return mysqli_num_rows($req);
    }

    public function inscrits($event){
        $sql = "SELECT * FROM USERS WHERE DROIT = '0' AND /*IS_PRIVILEGIE = '1' AND */ GROUPE = '$event' ";
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
        return mysqli_num_rows($req);
    }

    public function accompagnants($event){
        $sql = "SELECT * FROM USERS WHERE ACCOMPAGNANT = '1' AND DROIT = '0' AND GROUPE = '$event'";
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
        return mysqli_num_rows($req);
    }

    public function usersSocieteId($event){
        $sql = $sql = "SELECT * FROM USERS WHERE DROIT = '0' AND GROUPE = '$event' ORDER BY USERS.NOM ASC";
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
        return mysqli_fetch_all($req);
    }

    public function selectById($id){
        $sql = 'SELECT * FROM USERS WHERE ID = "'.$id.'"';
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
        return mysqli_fetch_assoc($req);
    }

    public function selectByMail($email){
        $sql = 'SELECT * FROM USERS WHERE EMAIL = "'.$email.'"';
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
        return mysqli_num_rows($req);
    }

    public function insertNewInvite($nom, $prenom, $hash_mdp, $email, $event){
        $sql = 'INSERT INTO USERS (NOM, PRENOM, PASSWORD, EMAIL, GROUPE, DROIT, IS_PRIVILEGIE, IS_VALID, SOCIETE_ID) 
				VALUES ("'.mysqli_real_escape_string($this->mysqli, $nom).'",
				"'.mysqli_real_escape_string($this->mysqli, $prenom).'",
				"'.$hash_mdp.'",
				"'.mysqli_real_escape_string($this->mysqli, $email).'",
				"'.$event.'","0","1","1","194")';
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
    }

    public function updateRelance($hash_mdp, $id){
        $sql = "UPDATE USERS SET PASSWORD= '$hash_mdp' WHERE ID = '$id'";
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
    }

    public function selectAllById($id){
        $sql = 'SELECT * FROM USERS WHERE ID = "'.$id.'"';
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));
    }

    public function selectByParticipation($event){
        $sql = 'SELECT ID FROM USERS WHERE PARTICIPATION = 1 AND GROUPE = "'.$event.'"';
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error());
        return mysqli_num_rows($req);
    }

    public function selectInfosListe(){
        $sql = 'SELECT ID, CIVILITE, NOM, PRENOM, MATRICULE, FONCTION, PAYS, PARTICIPATION FROM USERS WHERE DROIT = 0';
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error());
        return mysqli_fetch_all($req);
    }

    public function rechercheListe($nomcherche){
        $sql = "SELECT ID, CIVILITE, NOM, PRENOM, MATRICULE, FONCTION, PAYS, PARTICIPATION FROM USERS WHERE DROIT = 0 AND (NOM LIKE CONCAT('%', '$nomcherche', '%') OR PRENOM LIKE CONCAT('%', '$nomcherche', '%')) ORDER BY NOM ASC";
        $req = mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error());
        return mysqli_fetch_all($req);
    }

    public function updateUserById2_GT ($id, $participe, $civilite, $nom, $prenom, $naissance, $tel, $mail, $remarques, $identite, $numero_identite, $nationalite, $validite_identite, $statut, $fonction, $magasin, $transport, $ville_depart, $date_depart, $horaire_depart, $ville_retour, $date_retour, $horaire_retour, $reference_billet_aller, $reference_billet_retour, $transfert_hotel, $transfert_aeroport_gare, $accompagnant_transport, $mail_accompagnant_transport, $accompagnant_hebergement, $mail_accompagnant_hebergement, $accompagnant_enfant, $lit, $commentaires, $pcr, $conditions_sanitaire, $conditions){
		
		
		$date = date("d-m-Y H:i");

        $participe = intval($participe);
		$civilite = mysqli_real_escape_string($this->mysqli, $civilite);
		$nom = mysqli_real_escape_string($this->mysqli, $nom);
		$prenom = mysqli_real_escape_string($this->mysqli, $prenom);
		$naissance = mysqli_real_escape_string($this->mysqli, $naissance);
		$tel = mysqli_real_escape_string($this->mysqli, $tel);
		$mail = mysqli_real_escape_string($this->mysqli, $mail);
		$remarques = mysqli_real_escape_string($this->mysqli, $remarques);
		$identite = mysqli_real_escape_string($this->mysqli, $identite);
		$numero_identite = mysqli_real_escape_string($this->mysqli, $numero_identite);
		$nationalite = mysqli_real_escape_string($this->mysqli, $nationalite);
		$validite_identite = mysqli_real_escape_string($this->mysqli, $validite_identite);
		$statut = mysqli_real_escape_string($this->mysqli, $statut);
		$fonction = mysqli_real_escape_string($this->mysqli, $fonction);
		$magasin = mysqli_real_escape_string($this->mysqli, $magasin);
		$transport = mysqli_real_escape_string($this->mysqli, $transport);
		$$ville_depart = mysqli_real_escape_string($this->mysqli, $ville_depart);
		$date_depart = mysqli_real_escape_string($this->mysqli, $date_depart);
		$horaire_depart = mysqli_real_escape_string($this->mysqli, $horaire_depart);
		$ville_retour = mysqli_real_escape_string($this->mysqli, $ville_retour);
		$date_retour = mysqli_real_escape_string($this->mysqli, $date_retour);
		$horaire_retour = mysqli_real_escape_string($this->mysqli, $horaire_retour);
		$reference_billet_aller = mysqli_real_escape_string($this->mysqli, $reference_billet_aller);
		$reference_billet_retour = mysqli_real_escape_string($this->mysqli, $reference_billet_retour);
		$transfert_hotel = mysqli_real_escape_string($this->mysqli, $transfert_hotel);
		$transfert_aeroport_gare = mysqli_real_escape_string($this->mysqli, $transfert_aeroport_gare);
		$accompagnant_transport = mysqli_real_escape_string($this->mysqli, $accompagnant_transport);
		$mail_accompagnant_transport = mysqli_real_escape_string($this->mysqli, $mail_accompagnant_transport);
		$accompagnant_hebergement = mysqli_real_escape_string($this->mysqli, $accompagnant_hebergement);
		$mail_accompagnant_hebergement = mysqli_real_escape_string($this->mysqli, $mail_accompagnant_hebergement);
		$accompagnant_enfant = mysqli_real_escape_string($this->mysqli, $accompagnant_enfant);
		$lit = mysqli_real_escape_string($this->mysqli, $lit);
		$commentaires = mysqli_real_escape_string($this->mysqli, $commentaires);
		$pcr = mysqli_real_escape_string($this->mysqli, $pcr);
		$conditions_sanitaire = mysqli_real_escape_string($this->mysqli, $conditions_sanitaire);
		$conditions = mysqli_real_escape_string($this->mysqli, $conditions);

        $sql = "UPDATE `USERS` SET 
				    PARTICIPATION = '$participe',
					CIVILITE = '$civilite',
					NOM = '$nom',
					PRENOM = '$prenom',
					ADRESSE1 = '$naissance',
					MOBILE = '$tel',
					EMAIL = '$mail',
					REMARQUES = '$remarques',
					CP = '$identite',
					VILLE = '$numero_identite',
					ADRESSE2 = '$nationalite',
					TEL = '$validite_identite',
					MATRICULE = '$statut',
					FONCTION = '$fonction',
					TYPE = '$magasin',
					TRANSPORT = '$transport',
					VILLE_DEPART1 = '$ville_depart',
					TRANS_ALLER = '$date_depart',
					PRESENT_DEJ1 = '$horaire_depart',
					VILLE_DEPART2 = '$ville_retour',
					TRANS_RETOUR = '$date_retour',
					PRESENT_DEJ2 = '$horaire_retour',
					PRESENT_DEJ4 = '$reference_billet',
					PRESENT_REUNION1 = '$transfert_hotel',
					PRESENT_REUNION21 = '$transfert_aeroport_gare',
					PRESENT_REUNION31 = '$accompagnant_transport',
					PRESENT_REUNION4 = '$mail_accompagnant_transport',
					PRESENT_NUIT1 = '$accompagnant_hebergement',
					PRESENT_NUIT2 = '$mail_accompagnant_hebergement',
					PRESENT_PDEJ4 = '$accompagnant_enfant',
					PRESENT_NUIT3 = '$lit',
					REMARQUES_TRANS = '$commentaires',
					NAVETTE = '$pcr',
					NAV = '$conditions_sanitaire',
					CONDITIONS = '$conditions',
				    ENREGISTREMENT = 'OK',
				    NOM_ACC = '$date'        
				    WHERE ID = $id";


        mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));

    }
	
	    public function updateUserById2_GT2 ($id, $participe, $civilite, $nom, $prenom, $societe, $fonction, $tel,  $mobile, $mail, $remarques, $transport, $moyen, $voyage, $trans_aller, $ville_d1, $trans_retour, $ville_d2, $navette, $nav, $remarques_trans, $mailacc, $conditions, $covoit){


        $participe = intval($participe);
        $civilite = mysqli_real_escape_string($this->mysqli, $civilite);
        $nom = mysqli_real_escape_string($this->mysqli, $nom);
        $prenom = mysqli_real_escape_string($this->mysqli, $prenom);
        $societe = mysqli_real_escape_string($this->mysqli, $societe);
        $fonction = mysqli_real_escape_string($this->mysqli, $fonction);
        $tel = mysqli_real_escape_string($this->mysqli, $tel);
        $mobile = mysqli_real_escape_string($this->mysqli, $mobile);
        $mail = mysqli_real_escape_string($this->mysqli, $mail);
        $remarques = mysqli_real_escape_string($this->mysqli, $remarques);
        $transport = mysqli_real_escape_string($this->mysqli, $transport);
        $moyen = mysqli_real_escape_string($this->mysqli, $moyen);
        $voyage = mysqli_real_escape_string($this->mysqli, $voyage);
        $trans_aller = mysqli_real_escape_string($this->mysqli, $trans_aller);
        //$heure_d1 = mysqli_real_escape_string($this->mysqli, $heure_d1);
        $ville_d1 = mysqli_real_escape_string($this->mysqli, $ville_d1);
        //$heure_a1 = mysqli_real_escape_string($this->mysqli, $heure_a1);
        //$ville_a1 = mysqli_real_escape_string($this->mysqli, $ville_a1);
        $trans_retour = mysqli_real_escape_string($this->mysqli, $trans_retour);
        //$heure_d2 = mysqli_real_escape_string($this->mysqli, $heure_d2);
        $ville_d2 = mysqli_real_escape_string($this->mysqli, $ville_d2);
        //$heure_a2 = mysqli_real_escape_string($this->mysqli, $heure_a2);
        //$ville_a2 = mysqli_real_escape_string($this->mysqli, $ville_a2);
        $navette = mysqli_real_escape_string($this->mysqli, $navette);
        $nav = mysqli_real_escape_string($this->mysqli, $nav);
        $remarques_trans = mysqli_real_escape_string($this->mysqli, $remarques_trans);
        $mailacc = mysqli_real_escape_string($this->mysqli, $mailacc);
        $conditions = mysqli_real_escape_string($this->mysqli, $conditions);
        $covoit = mysqli_real_escape_string($this->mysqli, $covoit);

        $sql = "UPDATE `USERS` SET 
				    PARTICIPATION = '$participe',
				    CIVILITE = '$civilite',
				    NOM = '$nom',
				    PRENOM = '$prenom',
				    MATRICULE = '$societe',	
				    FONCTION = '$fonction',	
                    TEL = '$tel',
                    MOBILE = '$mobile',
				    EMAIL = '$mail',				    
                   	REMARQUES = '$remarques',
                    TRANSPORT = '$transport',
                    MOYEN = '$moyen',
                    VOYAGE = '$voyage',
                   	TRANS_ALLER = '$trans_aller',
                    VILLE_DEPART1 = '$ville_d1',
                    TRANS_RETOUR = '$trans_retour',
                    VILLE_DEPART2 = '$ville_d2',
                    NAVETTE = '$navette',
                    NAV = '$nav',
                    REMARQUES_TRANS = '$remarques_trans',
				    NOM_ACC = '$mailacc',
				    CONDITIONS = '$conditions',
				    ENREGISTREMENT = 'OK',
				    ADRESSE2 = '$covoit'
				    
				                                   
				    WHERE ID = $id";


        mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli));

    }

    public function updateUserById2_GT1 ($id, $participe, $civilite, $nom, $prenom, $societe, $fonction, $tel,  $mobile, $mail, $remarques, $conditions){

        $participe = intval($participe);
        $civilite = mysqli_real_escape_string($this->mysqli, $civilite);
        $nom = mysqli_real_escape_string($this->mysqli, $nom);
        $prenom = mysqli_real_escape_string($this->mysqli, $prenom);
        $societe = mysqli_real_escape_string($this->mysqli, $societe);
        $fonction = mysqli_real_escape_string($this->mysqli, $fonction);
        $tel = mysqli_real_escape_string($this->mysqli, $tel);
        $mobile = mysqli_real_escape_string($this->mysqli, $mobile);
        $mail = mysqli_real_escape_string($this->mysqli, $mail);
        $remarques = mysqli_real_escape_string($this->mysqli, $remarques);   
        $conditions = mysqli_real_escape_string($this->mysqli, $conditions);

        $sql = "UPDATE `USERS` SET 
				    PARTICIPATION = '$participe',
                    CIVILITE = '$civilite',
				    NOM = '$nom',
				    PRENOM = '$prenom',
				    MATRICULE = '$societe',	
				    FONCTION = '$fonction',	
                    TEL = '$tel',
                    MOBILE = '$mobile',
				    EMAIL = '$mail',				    
                   	REMARQUES = '$remarques',
				    CONDITIONS = '$conditions'
				    
				                                   
				    WHERE ID = $id";


        mysqli_query($this->mysqli, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($this->mysqli)); 

    }
}