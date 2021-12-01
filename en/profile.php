<?php

require_once './connect_societe.php';
require_once './class/User.php';
$usr = new User();
$redirect = 0;
if($_GET["event"] == ""){$event = $_SESSION["event"];}else{$event = $_GET["event"];}
$eventurl = "?event=\".$event";
$errors = [];

if($_GET["idColaborateur"] == ""){
    $id = $_SESSION['id'];
}else{
    $id = $_GET["idColaborateur"];
}

if($_SESSION['event'] !== "ADMIN"){
	if(!empty($_GET['idColaborateur'])){
		$redirect = 1;
		if($usr->isPrivi($_SESSION['id']) == false){
			header("Location: societe.php");
			exit();
		}
		if($usr->getSocieteId($_SESSION['id'])[0] !== $usr->getSocieteId($_GET['idColaborateur'])[0] ){
			header("Location: societe.php");
			exit();
		}
		$data = $usr->findOneById($_GET['idColaborateur']);
		$data1 = $usr->findOneById($_SESSION['id']);
	}else{
		$data = $usr->findOneById($_SESSION['id']);
	}
}else{
	$data = $usr->findOneById($_GET['idColaborateur']);
	$data1 = $usr->findOneById($_SESSION['id']);

}


if(($data["FIRST_CO"] == 0) && ($_GET['idColaborateur'] == "")){

    header('Location: first-login.php');

}

if($data1['STATUT'] == 1){
    header('Location: backoffice.php');
}

$redirect = 2;
$societe_infos = $societe->findOneById($_SESSION['societe_id']);
$dataGeneral = $evt->findOneById($event);

if($_SESSION['event'] == "ADMIN"){

	$societe_infos = $societe->findOneById($data['SOCIETE_ID']);
}

/*if($societe_infos["VALIDE"] != 1){
	header("Location: societe.php");
}*/


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['form'] == "profile"){

        if($_POST['conditions'] != 1){
	        array_push($errors, "Vous devez accepter les conditions de l'inscription aux 20 ans du Groupe IDEC.");
	        $color = "#FF0000";
            if($_POST['conditions'] == ""){echo '<style>.conditions + label:before {border-color: #FF0000 !important;}</style>';}
        }

        if(($_POST['participe'] == "") OR ($_POST['nom'] == "") OR ($_POST['prenom'] == "") OR ($_POST['mail'] == "") OR ($_POST['civilite'] == "") OR ($_POST['societe'] == "") OR ($_POST['naissance'] == "") OR ($_POST['mobile'] == "")){
	        array_push($errors, "Tous les champs obligatoires n'ont pas été remplis !");
	        $color = "#FF0000";
            if($_POST['participe'] == ""){echo '<style>input[name="participe"] + label:before {border-color: #FF0000 !important;}</style>';}
            if($_POST['civilite'] == ""){echo '<style>select[name="civilite"] {border-color: #FF0000 !important;}</style>';}
            if($_POST['nom'] == ""){echo '<style>input[name="nom"] {border-color: #FF0000 !important;}</style>';}
            if($_POST['prenom'] == ""){echo '<style>input[name="prenom"] {border-color: #FF0000 !important;}</style>';}
            if($_POST['societe'] == ""){echo '<style>select[name="societe"] {border-color: #FF0000 !important;}</style>';}
            if($_POST['naissance'] == ""){echo '<style>input[name="naissance"] {border-color: #FF0000 !important;}</style>';}
            if($_POST['mail'] == ""){echo '<style>input[name="mail"] {border-color: #FF0000 !important;}</style>';}
            if($_POST['mobile'] == ""){echo '<style>input[name="mobile"] {border-color: #FF0000 !important;}</style>';}
            
        }
        
        if(($_POST['participe'] == 2) && ($_POST['absence'] == "")){
	        array_push($errors, "Merci de nous indiquer le motif de votre absence !");
	        $color = "#FF0000";
            if($_POST['absence'] == ""){echo '<style>textarea[name="absence"] {border-color: #FF0000 !important;}</style>';}
        }
        
        
            if($_POST['participe'] == 1){
            $_POST['absence'] = "";
            if(($_POST['societe'] == "") OR ($_POST['societe'] == "PARIS")){
                
                $_POST['transport'] = "2";
                $_POST['ticket'] = "2";
                
            }else{
                
                if(($_POST['transport'] == "") OR ($_POST['ticket'] == "") OR ($_POST['taille'] == "") OR ($_POST['pointure'] == "")){
                
                    array_push($errors, "Tous les champs obligatoires n'ont pas été remplis !");
                    $color = "#FF0000";
                    if($_POST['transport'] == ""){echo '<style>input[name="transport"] + label:before {border-color: #FF0000 !important;}</style>';}
                    if($_POST['ticket'] == ""){echo '<style>input[name="ticket"] + label:before {border-color: #FF0000 !important;}</style>';}
                    if($_POST['taille'] == ""){echo '<style>select[name="taille"] {border-color: #FF0000 !important;}</style>';}
                    if($_POST['pointure'] == ""){echo '<style>input[name="pointure"] {border-color: #FF0000 !important;}</style>';}
                    
                }
            }
            }else{
                $_POST['transport'] = "2";
                $_POST['ticket'] = "2";
                $_POST['mailacc'] = "";
                $_POST['taille'] = "";
                $_POST['pointure'] = "";
            }

        if(!filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)){
	        array_push($errors, 'Votre e-mail est invalide !');
            $color = "#FF0000";
            echo '<style>input[name="mail"] {border-color: #FF0000 !important;}</style>';
        }

        $datatotal = $usr->checkEmailProfil($_POST['mail'], $id);

        if($datatotal["total"] != 0) {
            array_push($errors, "Cet e-mail est déjà utilisé !");
            $color = "#FF0000";
            echo '<style>input[name="mail"] {border-color: #FF0000 !important;}</style>';
        }
        
        if(($data['NOM_ACC'] != $_POST['mailacc']) && ($_POST['mailacc'] != "")){

        $datatotalacc = $usr->checkEmailProfil2($_POST['mailacc']);

        if($datatotalacc["total"] != 0) {
            array_push($errors, "Cette personne est déjà sollicitée, vous devez renseigner une adresse email d'un autre collègue avec qui vous partagerez votre chambre !");
            $color = "#FF0000";
            echo '<style>input[name="mailacc"] {border-color: #FF0000 !important;}</style>';
        }
        
        }
    
	        if(sizeof($errors) == 0){
                
             $usr->updateUserById2_SF($_POST['id'], $_POST['participe'], $_POST['civilite'], $_POST['nom'], $_POST['prenom'], $_POST['societe'], $_POST['naissance'], $_POST['mail'], $_POST['mobile'], $_POST['remarques'], $_POST['transport'], $_POST['ticket'], $_POST['mailacc'], $_POST['conditions'], $_POST['absence'], $_POST['taille'], $_POST['pointure']);

		  
	        if($_POST['id'] == $id){

                if($_POST['participe'] == 1){

                    if($data['PARTICIPATION'] == 1){

                    $email = $_POST['mail'];
                    $objet = 'Les 20 ans du groupe IDEC - Modification informations';
                    $titre = "Modification informations";
                    $texte = '<strong>Cher(e) '.$_POST['prenom'].', </strong><br><br>';
                    $texte .= 'Nous vous confirmons la prise en compte des modifications de vos informations aux 20 ans du groupe IDEC.<br>';
                    $texte .= "\r\n";
                    $texte .= 'Voici un récapitulatif de vos informations :<br><br>';
                    $texte .= "\r\n";
                    $texte .= 'Votre nom : ';
                    $texte .= $_POST['civilite']." ".$_POST['nom']." ".$_POST['prenom'];
                    $texte .= "<br>";
                    $texte .= "\r\n";
                    $texte .= 'Votre Agence / Société / Site géographique : ';
                    $texte .= $_POST['societe'];
                    $texte .= "<br>";
                    $texte .= "\r\n";
                    $texte .= 'Votre date de naissance : ';
                    $texte .= $_POST['naissance'];
                    $texte .= "<br>";
                    $texte .= "\r\n";
                    $texte .= 'Votre e-mail : ';
                    $texte .= $_POST['mail'];
                    $texte .= "<br>";
                    $texte .= "\r\n";
                    $texte .= 'Votre mobile : ';
                    $texte .= $_POST['mobile'];
                    $texte .= "<br>";
                    $texte .= "\r\n";
                    if($_POST['remarques'] != ""){
                        $texte .= 'Vos remarques : ';
                        $texte .= $_POST['remarques'];
                        $texte .= "<br>";
                        $texte .= "\r\n";
                    }
                    $texte .= "<br>";
                    if(($_POST['societe'] != "PARIS") && ($_POST['transport'] == "1")){
                        $texte .= 'Vous souhaitez vous rendre par vos propres moyens à Paris<br><br>';
                    $texte .= "\r\n";
                    }
                    if(($_POST['societe'] != "PARIS") && ($_POST['transport'] == "0")){
                        $texte .= 'Vous souhaitez que l\'agence AREP réserve votre acheminement aller-retour :<br>';
                        $texte .= "\r\n";
                        if($_POST['societe'] == "BLOIS"){
                            $texte .= 'Aller 13 mai 2020 : TGV 8332 - SAINT PIERRE DES CORPS : 8h24 >  PARIS MONTPARNASSE : 9h35<br>Retour 15 mai 2020 : TGV 8367 - PARIS GARE MONTPARNASSE : 17:26 >  SAINT PIERRE DES CORPS : 18:35<br><br>';
                            $texte .= "\r\n";
                        }
                        if($_POST['societe'] == "POITIERS"){
                            $texte .= 'Aller 13 mai 2020 : TGV 8432 - GARE DE POITIERS : 8h20 > PARIS MONTPARNASSE : 9h57<br>Retour 15 mai 2020 : TGV 8397 -  PARIS MONTPARNASSE : 18h22 >  GARE DE POITIERS : 19h45<br><br>';
                            $texte .= "\r\n";
                        }
                        if($_POST['societe'] == "RENNES"){
                            $texte .= 'Aller 13 mai 2020 : TGV 8604 - GARE DE RENNES : 8h35 > PARIS MONTPARNASSE : 10h07<br>Retour 15 mai 2020 : TGV 8195 -  PARIS MONTPARNASSE : 17h55 >  GARE DE RENNES : 19h25<br><br>';
                            $texte .= "\r\n";
                        }
                        if($_POST['societe'] == "GRENOBLE"){
                            $texte .= 'Aller 13 mai 2020 : TGV 6906 - GARE DE GRENOBLE : 08h17 > PARIS GARE DE LYON : 11h23<br>Retour 15 mai 2020 : TGV 6923 -  PARIS GARE DE LYON : 17h41 >  GARE DE GRENOBLE : 20h42<br><br>';
                            $texte .= "\r\n";
                        }
                        if($_POST['societe'] == "MONTPELLIER"){
                            $texte .= 'Aller 13 mai 2020 : AF 7543 - AEROPORT DE MONTPELLIER : 9h15 > AEROPORT DE PARIS ORLY : 10h35<br>Retour 15 mai 2020 : AF 7552 -  APT DE PARIS ORLY : 18h30 >  APT DE MONTPELLIER : 19h50<br><br>';
                            $texte .= "\r\n";
                        }
                    }
                    $texte .= 'Nous vous donnons rendez-vous au Forum des Images - début de plénière à 12h30<br>';
                    $texte .= "\r\n";
                    $texte .= '2, rue du cinéma - 75001 Paris<br>';
                    $texte .= "\r\n";
                    $texte .= 'Métro Châtelet-les Halles (ligne 4)<br><br>';
                    $texte .= "\r\n";
                        
                    if(($_POST['societe'] != "PARIS") && ($_POST['ticket'] == "1")){
                        $texte .= 'Vous souhaitez que l\'agence vous prévoit un ticket de transport en commun pour vous rendre jusqu\'au Forum des Images<br><br>';
                        $texte .= "\r\n";
                    }
                    if(($_POST['societe'] != "PARIS") && ($_POST['ticket'] == "0")){
                        $texte .= 'Vous ne souhaitez pas que l\'agence vous prévoit un ticket de transport en commun pour vous rendre jusqu\'au Forum des Images<br><br>';
                        $texte .= "\r\n";
                    }
                    if($_POST['mailacc'] != ""){
                        $texte .= 'Vous souhaitez partager votre chambre avec : ';
                        $texte .= $_POST['mailacc'];
                        $texte .= "<br><br>";
                    $texte .= "\r\n";
                    }
                    $texte .= 'Votre taille de tee-shirt : ';
                    $texte .= $_POST['taille'];
                    $texte .= "<br>";
                    $texte .= "\r\n";
                    $texte .= 'Votre pointure : ';
                    $texte .= $_POST['pointure'];
                    $texte .= "<br><br>";
                    $texte .= "\r\n";
                    $texte .= '<strong>Pour accéder au site des 20 ans du Groupe IDEC :</strong> <a href="https://www.les20ansdugroupeidec.com" target="_blank">www.les20ansdugroupeidec.com</a>';  
                    $texte .= "\r\n";  

                    include('class/Email.php');


                    }else{

                    $email = $_POST['mail'];
                    $objet = 'Les 20 ans du groupe IDEC - Confirmation de participation';
                    $titre = "Confirmation de participation";
                    $texte = '<strong>Cher(e) '.$_POST['prenom'].', </strong><br><br>';
                    $texte .= "\r\n";
                    $texte .= 'Nous avons le plaisir de valider votre participation aux 20 ans du groupe IDEC.<br><br>';
                    $texte .= "\r\n";
                    $texte .= 'Voici un récapitulatif de vos informations :<br><br>';
                    $texte .= "\r\n";
                    $texte .= 'Votre nom : ';
                    $texte .= $_POST['civilite']." ".$_POST['nom']." ".$_POST['prenom'];
                    $texte .= "<br>";
                    $texte .= "\r\n";
                    $texte .= 'Votre Agence / Société / Site géographique : ';
                    $texte .= $_POST['societe'];
                    $texte .= "<br>";
                    $texte .= "\r\n";
                    $texte .= 'Votre date de naissance : ';
                    $texte .= $_POST['naissance'];
                    $texte .= "<br>";
                    $texte .= "\r\n";
                    $texte .= 'Votre e-mail : ';
                    $texte .= $_POST['mail'];
                    $texte .= "<br>";
                    $texte .= "\r\n";
                    $texte .= 'Votre mobile : ';
                    $texte .= $_POST['mobile'];
                    $texte .= "<br>";
                    $texte .= "\r\n";
                    if($_POST['remarques'] != ""){
                        $texte .= 'Vos remarques : ';
                        $texte .= $_POST['remarques'];
                        $texte .= "<br>";
                        $texte .= "\r\n";
                    }
                    $texte .= "<br>";
                    if(($_POST['societe'] != "PARIS") && ($_POST['transport'] == "1")){
                        $texte .= 'Vous souhaitez vous rendre par vos propres moyens à Paris<br><br>';
                    $texte .= "\r\n";
                    }
                    if(($_POST['societe'] != "PARIS") && ($_POST['transport'] == "0")){
                        $texte .= 'Vous souhaitez que l\'agence AREP réserve votre acheminement aller-retour :<br>';
                        $texte .= "\r\n";
                        if($_POST['societe'] == "BLOIS"){
                            $texte .= 'Aller 13 mai 2020 : TGV 8332 - SAINT PIERRE DES CORPS : 8h24 >  PARIS MONTPARNASSE : 9h35<br>Retour 15 mai 2020 : TGV 8367 - PARIS GARE MONTPARNASSE : 17:26 >  SAINT PIERRE DES CORPS : 18:35<br><br>';
                            $texte .= "\r\n";
                        }
                        if($_POST['societe'] == "POITIERS"){
                            $texte .= 'Aller 13 mai 2020 : TGV 8432 - GARE DE POITIERS : 8h20 > PARIS MONTPARNASSE : 9h57<br>Retour 15 mai 2020 : TGV 8397 -  PARIS MONTPARNASSE : 18h22 >  GARE DE POITIERS : 19h45<br><br>';
                            $texte .= "\r\n";
                        }
                        if($_POST['societe'] == "RENNES"){
                            $texte .= 'Aller 13 mai 2020 : TGV 8604 - GARE DE RENNES : 8h35 > PARIS MONTPARNASSE : 10h07<br>Retour 15 mai 2020 : TGV 8195 -  PARIS MONTPARNASSE : 17h55 >  GARE DE RENNES : 19h25<br><br>';
                            $texte .= "\r\n";
                        }
                        if($_POST['societe'] == "GRENOBLE"){
                            $texte .= 'Aller 13 mai 2020 : TGV 6906 - GARE DE GRENOBLE : 08h17 > PARIS GARE DE LYON : 11h23<br>Retour 15 mai 2020 : TGV 6923 -  PARIS GARE DE LYON : 17h41 >  GARE DE GRENOBLE : 20h42<br><br>';
                            $texte .= "\r\n";
                        }
                        if($_POST['societe'] == "MONTPELLIER"){
                            $texte .= 'Aller 13 mai 2020 : AF 7543 - AEROPORT DE MONTPELLIER : 9h15 > AEROPORT DE PARIS ORLY : 10h35<br>Retour 15 mai 2020 : AF 7552 -  APT DE PARIS ORLY : 18h30 >  APT DE MONTPELLIER : 19h50<br><br>';
                            $texte .= "\r\n";
                        }
                    }
                    $texte .= 'Nous vous donnons rendez-vous au Forum des Images - début de plénière à 12h30<br>';
                    $texte .= "\r\n";
                    $texte .= '2, rue du cinéma - 75001 Paris<br>';
                    $texte .= "\r\n";
                    $texte .= 'Métro Châtelet-les Halles (ligne 4)<br><br>';
                    $texte .= "\r\n";
                        
                    if(($_POST['societe'] != "PARIS") && ($_POST['ticket'] == "1")){
                        $texte .= 'Vous souhaitez que l\'agence vous prévoit un ticket de transport en commun pour vous rendre jusqu\'au Forum des Images<br><br>';
                        $texte .= "\r\n";
                    }
                    if(($_POST['societe'] != "PARIS") && ($_POST['ticket'] == "0")){
                        $texte .= 'Vous ne souhaitez pas que l\'agence vous prévoit un ticket de transport en commun pour vous rendre jusqu\'au Forum des Images<br><br>';
                        $texte .= "\r\n";
                    }
                    if($_POST['mailacc'] != ""){
                        $texte .= 'Vous souhaitez partager votre chambre avec : ';
                        $texte .= $_POST['mailacc'];
                        $texte .= "<br><br>";
                    $texte .= "\r\n";
                    }
                    $texte .= 'Votre taille de tee-shirt : ';
                    $texte .= $_POST['taille'];
                    $texte .= "<br>";
                    $texte .= "\r\n";
                    $texte .= 'Votre pointure : ';
                    $texte .= $_POST['pointure'];
                    $texte .= "<br><br>";
                    $texte .= "\r\n";
                    $texte .= '<strong>Pour accéder au site des 20 ans du Groupe IDEC :</strong> <a href="https://www.les20ansdugroupeidec.com" target="_blank">www.les20ansdugroupeidec.com</a>';  
                    $texte .= "\r\n";  
                        

                    include('class/Email.php');
                    }
                }

                if($_POST['participe'] == 2){

                    $email = $_POST['mail'];
                    $objet = 'Les 20 ans du groupe IDEC - Votre réponse';
                    $titre = "Votre réponse";
                    $texte = '<strong>Cher(e) '.$_POST['prenom'].', </strong><br><br>';
                    $texte .= 'Nous avons bien pris en compte que vous ne pourrez pas participer aux 20 ans du groupe IDEC.<br>';
                    
                    
                    
                    $texte .= "\r\n";
                    $texte .= 'Voici un récapitulatif de vos informations :<br><br>';
                    $texte .= "\r\n";
                    $texte .= 'Votre nom : ';
                    $texte .= $_POST['civilite']." ".$_POST['nom']." ".$_POST['prenom'];
                    $texte .= "<br>";
                    $texte .= "\r\n";
                    $texte .= 'Votre Agence / Société / Site géographique : ';
                    $texte .= $_POST['societe'];
                    $texte .= "<br>";
                    $texte .= "\r\n";
                    $texte .= 'Votre date de naissance : ';
                    $texte .= $_POST['naissance'];
                    $texte .= "<br>";
                    $texte .= "\r\n";
                    $texte .= 'Votre e-mail : ';
                    $texte .= $_POST['mail'];
                    $texte .= "<br>";
                    $texte .= "\r\n";
                    $texte .= 'Votre mobile : ';
                    $texte .= $_POST['mobile'];
                    $texte .= "<br>";
                    $texte .= "\r\n";
                    if($_POST['remarques'] != ""){
                        $texte .= 'Vos remarques : ';
                        $texte .= $_POST['remarques'];
                        $texte .= "<br>";
                        $texte .= "\r\n";
                    }
                    $texte .= "<br>";
                    $texte .= 'Le motif de votre absence : ';
                    $texte .= $_POST['absence'];
                    $texte .= "<br><br>";
                    $texte .= "\r\n";
                    $texte .= '<strong>Pour accéder au site des 20 ans du Groupe IDEC :</strong> <a href="https://www.les20ansdugroupeidec.com" target="_blank">www.les20ansdugroupeidec.com</a>';  
                    $texte .= "\r\n";  

                    include('class/Email.php');

                }
            }   

	        if($_SESSION['event'] !== "ADMIN"){
		        if(!empty($_GET['idColaborateur'])){
			        $redirect = 1;
			        if($usr->isPrivi($_SESSION['id']) == false){
				        header("Location: societe.php");
				        exit();
			        }
			        if($usr->getSocieteId($_SESSION['id'])[0] !== $usr->getSocieteId($_GET['idColaborateur'])[0] ){
				        header("Location: societe.php");
				        exit();
			        }
			        $data = $usr->findOneById($_GET['idColaborateur']);
			        $data1 = $usr->findOneById($_SESSION['id']);
		        }else{
			        $data = $usr->findOneById($_SESSION['id']);
		        }
	        }else{
		        $data = $usr->findOneById($_GET['idColaborateur']);
		        $data1 = $usr->findOneById($_SESSION['id']);

	        }
	        $redirect = 2;
	        $societe_infos = $societe->findOneById($_SESSION['societe_id']);
	        $dataGeneral = $evt->findOneById($event);

	        if($_SESSION['event'] == "ADMIN"){

		        $societe_infos = $societe->findOneById($data['SOCIETE_ID']);
	        }

            array_push($errors, "Les informations ont bien été modifiées !");
            $color = "#093";
        }else{
                
            $data['PARTICIPATION'] = $_POST['participe'];
            $data['CIVILITE'] = $_POST['civilite'];
            $data['NOM'] = $_POST['nom'];
            $data['PRENOM'] = $_POST['prenom'];
            $data['MATRICULE'] = $_POST['societe'];
            $data['FONCTION'] = $_POST['naissance'];
            $data['EMAIL'] = $_POST['mail'];
            $data['MOBILE'] = $_POST['mobile'];
            $data['REMARQUES'] = $_POST['remarques'];
            $data['PRESENT_DEJ1'] = $_POST['transport'];
            $data['PRESENT_REUNION1'] = $_POST['ticket'];
            $data['NOM_ACC'] = $_POST['mailacc'];
            $data['CONDITIONS'] = $_POST['conditions'];
            $data['PAYS'] = $_POST['absence'];
            $data['TEL_ACC'] = $_POST['taille'];
            $data['MOBILE_ACC'] = $_POST['pointure'];
                
                
                
                
                
        }

        
    }
    if($_POST['form'] == "password"){
        if($usr->findAllByPassword(sha1($_POST['opwd'])) == null){
            array_push($errors, "Votre mot de passe est incorrect !");
            $color = "#FF0000";
            echo '<style>input[name="opwd"] {border-color: #FF0000 !important;}</style>';


        }
        if($_POST['npwd'] !== $_POST['cpwd']){
            array_push($errors, "Les deux saisies pour votre nouveau mot de passe doivent être identiques !");
            $color = "#FF0000";
            echo '<style>input[name="npwd"] {border-color: #FF0000 !important;}</style>';
            echo '<style>input[name="cpwd"] {border-color: #FF0000 !important;}</style>';
        }

        if($_POST['npwd'] == $_POST['opwd']){
            array_push($errors, "Le mot de passe doit être différent de l'ancien !");
            $color = "#FF0000";
            echo '<style>input[name="opwd"] {border-color: #FF0000 !important;}</style>';
            echo '<style>input[name="npwd"] {border-color: #FF0000 !important;}</style>';
            echo '<style>input[name="cpwd"] {border-color: #FF0000 !important;}</style>';
        }

        if(sizeof($errors) == 0){
            $usr->updateUsersByNewPass(sha1($_POST['cpwd']), $id);
	        array_push($errors, "Votre mot de passe a bien été mis à jour.");
            $color = "#093";




                    $email = $data['EMAIL'];
                    $objet = 'Les 20 ans du groupe IDEC - Changement de mot de passe';
                    $titre = "Changement de mot de passe";
                    $texte = '<strong>Cher(e) '.$data['PRENOM'].', </strong><br><br>';
                    $texte .= 'Votre mot de passe a bien été modifié.  <br>';
                    $texte .= 'Si vous n\'êtes pas à l\'origine de cette modification merci de nous contacter.<br><br>';
                    $texte .= '<strong>Pour accéder au site des 20 ans du Groupe IDEC :</strong> <a href="https://www.les20ansdugroupeidec.com" target="_blank">www.les20ansdugroupeidec.com</a>';

                    include('class/Email.php');



        }
    }
}
?>
<!DOCTYPE HTML>
<html lang="fr">
	<head>
		<title>Inscription - <?php echo $dataGeneral['NOM']; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/flipclock.css">
	    <link rel="icon" href="images/favicon.ico" type="image/png">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
        <link rel="stylesheet" href="assets/css/gallery.theme.css">
        <link rel="stylesheet" href="assets/css/gallery.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet"> 
	</head>
	<body>

		<!-- Header -->
			<header id="header">
                <div id="nav1"><div class="inner"><?php include 'menu1.php'; ?></div></div>
				<div class="inner">
					<a href="accueil.php" class="logo"><img src="images/logo.png"></a>
					<nav id="nav">
                        <?php include 'menu.php'; ?>
					</nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
			</header>

		<!-- Banner -->


			<section id="banner" style="background: url(images/1/banner-accueil.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;">
				<div class="inner">
					<header>
						<h1>Inscription</h1><br>
						<h3 style="text-shadow: 0 0 10px black;">Merci de remplir les informations ci-dessous</h3>
					</header>
				</div>
			</section>



			<section id="one" class="wrapper align-center" style="padding: 5em 0 0 0;">
                <div class="inner">
                    
                    <div class="box" style="border-color:#8a6d3b;">
                        <p style="color:#8a6d3b;">La date limite d'inscription est le vendredi 6 mars !</p>
                    </div>

                    <?php if(sizeof($errors) > 0) : ?>
                        <div class="box" style="border-color:<?php echo $color; ?>;">
                            <p style="color:<?php echo $color; ?>;">
                                <?php
                                foreach($errors as $error) :
                                    ?><?=$error?>
                                    <br/>
                                <?php endforeach;
                                $errors = [];
                                ?>
                            </p>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="inner">

                <form method="post" action="profil.php<?php if($_GET["idColaborateur"] != ""){if($_SESSION['droit'] == 1){echo "?idColaborateur=".$_GET["idColaborateur"]."&event=".$_GET["event"];}else{echo "?idColaborateur=".$_GET["idColaborateur"];}} ?>" style="margin-top: 70px;">
                    <div class="row uniform">

                        <div class="12u$ 12u$(xsmall)">
                            <hr>
                        </div>
                        <div class="12u$ 12u$(xsmall)" style="text-align: left;">
                            <strong>Participerez-vous à la Convention Anniversaire IDEC 2020 ?</strong>
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <input type="radio" name="participe" id="yes" value="1" <?php if($data['PARTICIPATION'] == 1){echo 'checked';}?>>
                            <label for="yes">Je participe</label>
                        </div>
                        <div class="6u$ 12u$(xsmall)">
                            <input type="radio" name="participe" id="no" value="2" <?php if($data['PARTICIPATION'] == 2){echo 'checked';}?>>
                            <label for="no">Je ne pourrais pas participer</label>
                        </div>

                        <div class="12u$ 12u$(xsmall)">
                            <hr>
                        </div>

                        <div class="4u 12u$(xsmall)">
                            <select id="civilite" name="civilite">
                                <option class="civ1" <?php if($data['CIVILITE'] == ""){echo 'selected';} ?> value="">Civilité</option>
                                <option class="civ2" <?php if($data['CIVILITE'] == "M."){echo "selected";} ?> value="M.">M.</option>
                                <option class="civ3" <?php if($data['CIVILITE'] == "Mme"){echo "selected";} ?> value="Mme">Mme</option>
                                <option class="civ4" <?php if($data['CIVILITE'] == "Mlle"){echo "selected";} ?> value="Mlle">Mlle</option>
                            </select>
                        </div>
                        <div class="4u 12u$(xsmall)">
                            <input type="text" name="nom" id="" value="<?=$data['NOM']?>" placeholder="Nom">
                        </div>
                        <div class="4u$ 12u$(xsmall)">
                            <input type="text" name="prenom" id="" value="<?=$data['PRENOM']?>" placeholder="Prénom">
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <select id="societe" name="societe">
                                <option class="societe1" <?php if($data['MATRICULE'] == ""){echo 'selected';} ?> value="">Agence / Société / Site géographique</option>
                                <option class="societe2" <?php if($data['MATRICULE'] == "BLOIS"){echo "selected";} ?> value="BLOIS">BLOIS</option>
                                <option class="societe3" <?php if($data['MATRICULE'] == "GRENOBLE"){echo "selected";} ?> value="GRENOBLE">GRENOBLE</option>
                                <option class="societe4" <?php if($data['MATRICULE'] == "MONTPELLIER"){echo "selected";} ?> value="MONTPELLIER">MONTPELLIER</option>
                                <option class="societe6" <?php if($data['MATRICULE'] == "PARIS"){echo "selected";} ?> value="PARIS">PARIS</option>
                                <option class="societe7" <?php if($data['MATRICULE'] == "POITIERS"){echo "selected";} ?> value="POITIERS">POITIERS</option>
                                <option class="societe8" <?php if($data['MATRICULE'] == "RENNES"){echo "selected";} ?> value="RENNES">RENNES</option>
                            </select>
                        </div>
                        <div class="6u$ 12u$(xsmall)">
                            <input type="<?php if ($data['FONCTION'] == ""){echo 'text';}else{echo 'date';} ?>" onfocus="(this.type='date')" onblur="if (this.value=='') this.type='text'" id="naissance" name="naissance" value="<?=$data['FONCTION']?>" placeholder="Date de naissance">
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <input type="email" id="mail" name="mail" value="<?=$data['EMAIL']?>" placeholder="E-mail">
                        </div>
                        <div class="6u$ 12u$(xsmall)">
                            <input type="tel" name="mobile" id="" value="<?=$data['MOBILE']?>" placeholder="Mobile">
                        </div>
                        <div class="12u$ 12u$(xsmall)">
                            <textarea id="remarques" name="remarques" placeholder="Remarques (si vous avez des remarques complémentaires – allergies, régime alimentaire – merci de renseigner cette case)"><?php echo $data['REMARQUES']; ?></textarea>

                        <div class="12u$ 12u$(xsmall)">
                            <hr>
                        </div>
                            
                            
                        <div class="displayParticipe3 12u$ 12u$(xsmall)">
                            <textarea id="absence" name="absence" placeholder="Merci de nous indiquer le motif de votre absence"><?php echo $data['PAYS']; ?></textarea>
                        </div>
                            
                            <div class="displayParticipe3 12u$ 12u$(xsmall)">
                            <hr>
                        </div>
                        
                        
                            
                            <div class="displayParticipe4 12u$ 12u$(xsmall)" style="text-align: justify;">
                                
                                <h2 id="content" style="font-size: 26px;">Votre trajet dans Paris</h2>
                                
                                Comme vous l’avez sans doute compris, nous ne dévoilerons pas le nom du site qui accueillera la convention. <br>
<strong>Merci de ne pas vous rendre en voiture</strong> sur le lieu de la plénière d’ouverture, au Forum des Images.
<br><br>
                            Nous vous donnons rendez-vous au Forum des Images à 12h00 - début de plénière à 12h30<br>
2, rue du cinéma - 75001 Paris<br>
Métro Châtelet-les Halles (ligne 4)
                            </div>
                        

                        <div class="displayParticipe4 12u$ 12u$(xsmall)">
                            <hr>
                        </div>
                            
                            
                        
                            <div class="displayParticipe 12u$ 12u$(xsmall)" style="text-align: justify;">
                                
                                <h2 id="content" style="font-size: 26px;">Votre acheminement jusqu’à Paris</h2>
                                
                                Comme vous l’avez sans doute compris, nous ne dévoilerons pas le nom du site qui accueillera la convention. <br>
<strong>Merci de ne pas vous rendre en voiture</strong> sur le lieu de la plénière d’ouverture, au Forum des Images.<br><br>
                                <strong>Je me rends par mes propres moyens à Paris : </strong><input type="radio" name="transport" id="transportY" value="1" <?php if($data['PRESENT_DEJ1'] == 1){echo 'checked';}?>><label for="transportY" style="margin-left: 20px;">Oui</label><input type="radio" name="transport" id="transportN" value="0" <?php if(($data['PRESENT_DEJ1'] == 0) && ($data['PRESENT_DEJ1'] != null)){echo 'checked';}?>><label for="transportN">Non</label>
                            </div>
                            <div class="displayParticipe 12u$ 12u$(xsmall)">
                            <div class="villetitle" style="font-size: 12pt !important; margin-bottom:20px; text-align: justify;">Je souhaite que l’agence AREP réserve mon acheminement aller – retour sur les trains suivants :<br>
                            <div class="ville" id="blois" style="text-align: justify;">Aller 13 mai 2020 : TGV 8332 - SAINT PIERRE DES CORPS : 8h24 >  PARIS MONTPARNASSE : 9h35<br>Retour 15 mai 2020 : TGV 8367 - PARIS GARE MONTPARNASSE : 17:26 >  SAINT PIERRE DES CORPS : 18:35</div>
                            <div class="ville" id="poitiers" style="text-align: justify;">Aller 13 mai 2020 : TGV 8432 - GARE DE POITIERS : 8h20 > PARIS MONTPARNASSE : 9h57<br>Retour 15 mai 2020 : TGV 8397 -  PARIS MONTPARNASSE : 18h22 >  GARE DE POITIERS : 19h45</div>
                            <div class="ville" id="rennes" style="text-align: justify;">Aller 13 mai 2020 : TGV 8604 - GARE DE RENNES : 8h35 > PARIS MONTPARNASSE : 10h07<br>Retour 15 mai 2020 : TGV 8195 -  PARIS MONTPARNASSE : 17h55 >  GARE DE RENNES : 19h25</div>
                            <div class="ville" id="grenoble" style="text-align: justify;">Aller 13 mai 2020 : TGV 6906 - GARE DE GRENOBLE : 08h17 > PARIS GARE DE LYON : 11h23<br>Retour 15 mai 2020 : TGV 6923 -  PARIS GARE DE LYON : 17h41 >  GARE DE GRENOBLE : 20h42</div>
                            <div class="ville" id="montpellier" style="text-align: justify;">Aller 13 mai 2020 : AF 7543 - AEROPORT DE MONTPELLIER : 9h15 > AEROPORT DE PARIS ORLY : 10h35<br>Retour 15 mai 2020 : AF 7552 -  APT DE PARIS ORLY : 18h30 >  APT DE MONTPELLIER : 19h50</div></div>
                            </div><div class="displayParticipe 12u$ 12u$(xsmall)" style="text-align: justify;">
                                Nous vous donnons rendez-vous au Forum des Images – début de plénière à 12h30<br>
2, rue du cinéma - 75001 Paris<br>
Métro Châtelet-les Halles (ligne 4)<br><br>
                                <strong>Souhaitez-vous que l'agence vous prévoit un ticket de transport en commun pour vous rendre jusqu'au Forum des Images ? </strong><input type="radio" name="ticket" id="ticketY" value="1" <?php if($data['PRESENT_REUNION1'] == 1){echo 'checked';}?>><label for="ticketY" style="margin-left: 20px;">Oui</label><input type="radio" name="ticket" id="ticketN" value="0" <?php if(($data['PRESENT_REUNION1'] == 0) && ($data['PRESENT_REUNION1'] != null)){echo 'checked';}?>><label for="ticketN">Non</label>

                            </div>
                        

                        <div class="displayParticipe 12u$ 12u$(xsmall)">
                            <hr>
                        </div>
                            
                            <div class="displayParticipe2 12u$ 12u$(xsmall)" style=" text-align: justify;">
                                
                                <h2 id="content" style="font-size: 26px;">Votre hébergement</h2>
                                
                            <div style="font-size: 12pt !important; margin-bottom:20px; text-align: justify;">Nous souhaitons être tous réunis le temps de cette Convention Anniversaire, aussi, votre hébergement est prévu sur site.<br>Pour des raisons logistiques, vous partagerez votre chambre les nuits du mercredi et du jeudi avec l'un de vos collègues.<br>Nous vous prions de bien vouloir renseigner son adresse email ci-après :
</div>
                            </div>
                            
                            <div class="displayParticipe2 12u$ 12u$(xsmall)">
                            <div style="font-size: 12pt !important; margin-bottom:20px; text-align: justify;"><input type="email" id="mailacc" name="mailacc" value="<?=$data['NOM_ACC']?>" placeholder="E-mail de la personne avec qui vous souhaitez partager votre chambre"><br>
                            <em>NB : si toutefois la personne est déjà sollicitée, un message d'erreur apparaitra.</em></div>
                            </div>
                        

                        <div class="displayParticipe2 12u$ 12u$(xsmall)">
                            <hr>
                        </div>
                            
                            <div class="displayParticipe2 12u$ 12u$(xsmall)" style=" text-align: justify;">
                                
                                <h2 id="content" style="font-size: 26px;">Votre taille</h2>
                                
                            <div style="font-size: 12pt !important; text-align: justify;">Merci de nous indiquer votre taille de tee-shirt ainsi que votre pointure :</div>
                            </div>
                            
                        </div>
                            
                            <div class="displayParticipe2 6u 12u$(xsmall)" style="padding-top: 20px;">
                                <select id="taille" name="taille">
                                    <option class="taille1" <?php if($data['TEL_ACC'] == ""){echo 'selected';} ?> value="">Votre taille de tee-shirt</option>
                                    <option class="taille2" <?php if($data['TEL_ACC'] == "XS"){echo "selected";} ?> value="XS">XS</option>
                                    <option class="taille3" <?php if($data['TEL_ACC'] == "S"){echo "selected";} ?> value="S">S</option>
                                    <option class="taille4" <?php if($data['TEL_ACC'] == "M"){echo "selected";} ?> value="M">M</option>
                                    <option class="taille5" <?php if($data['TEL_ACC'] == "L"){echo "selected";} ?> value="L">L</option>
                                    <option class="taille6" <?php if($data['TEL_ACC'] == "XL"){echo "selected";} ?> value="XL">XL</option>
                                    <option class="taille7" <?php if($data['TEL_ACC'] == "XXL"){echo "selected";} ?> value="XXL">XXL</option>
                                    <option class="taille8" <?php if($data['TEL_ACC'] == "XXXL"){echo "selected";} ?> value="XXXL">XXXL</option>
                                    <option class="taille9" <?php if($data['TEL_ACC'] == "XXXXL"){echo "selected";} ?> value="XXXXL">XXXXL</option>
                                </select>
                            </div>
                            <div class="displayParticipe2 6u$ 12u$(xsmall)" style="padding-top: 20px;">
                                <input type="text" name="pointure" id="" value="<?=$data['MOBILE_ACC']?>" placeholder="Votre pointure">
                            </div>
                        

                        <div class="displayParticipe2 12u$ 12u$(xsmall)">
                            <hr>
                        </div>


                        <div class="12u$">
                                    <p style="font-size:12px !important;">
                                        Les données communiquées via ce formulaire sont collectées avec votre consentement et sont destinées au Groupe IDEC en sa qualité de responsable du traitement. Elles pourront être transmises à ses sous-traitants agissant sur strictes instructions du Groupe IDEC. Les données de ce formulaire sont collectées à des fins de gestion de la relation client à travers le site des 20 ans du Groupe IDEC. Les données vous concernant sont conservées pendant 12 mois maximum après l'événement auquel vous vous inscrivez. Vous disposez de la faculté d'introduire une réclamation auprès de l’autorité de contrôle compétente ainsi qu’un droit d’accès, de rectification, d’effacement, de limitation, de portabilité et d’opposition pour motif légitime aux données personnelles vous concernant. Pour exercer ce droit, merci d'effectuer votre demande à l'adresse suivante : contact@les20ansdugroupeidec.com
                                    </p>
                                </div>
                        <div class="12u$" style="text-align: left;">
                                <input id="conditions" name="conditions" class="conditions" type="checkbox" value="1" <?php if($data['CONDITIONS'] == "1"){echo "checked";} ?>><label for="conditions" class="conditions">J'accepte les conditions de l'inscription aux 20 ans du Groupe IDEC</label>
                            </div>
                        

                        <div class="12u$ 12u$(xsmall)">
                            <hr>
                        </div>

                        <!-- Break -->
                        <div class="12u$">
                            <input type="hidden" name="form" value="profile">
                            <input type="hidden" name="id_societe" value="<?= $societe_infos['ID']?>">
                            <input type="hidden" name="id" value="<?= $data['ID']?>">
                            <ul class="actions">
                                <li><input type="submit" value="Enregistrer" class="special"></li>
                                    <?php if ($_SESSION['droit'] == 1){ ?>
                                    <li style="float:right;"><a href="liste.php?event=<?php echo $_GET['event']; ?>" class="button special">Retour</a></li>
                                    <?php } ?>
                                    <?php if (($_GET['idColaborateur'] != "") && ($_SESSION['droit'] == 0)){ ?>
                                    <li style="float:right;"><a href="societe.php" class="button special">Retour</a></li>
                                    <?php } ?>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </section>
          


        <?php if ($data['ID'] == $_SESSION['id']) :?>
        <section id="four" class="wrapper align-center" style="padding: 5em 0 0 0;">
            <div class="inner">
                <h2 id="content" style="color:#f99f1b;">Modifier votre mot de passe</h2>
                <div id="confirm">
                    <form action="profil.php" method="post" id="connect_form" style="margin-top: 70px;">
                        <div class="row uniform">
                            <div class="4u 12u$(xsmall)">
                                <input type="password" name="opwd" id="" class="cPwd" placeholder="Mot de passe actuel">
                            </div>
                            <div class="4u 12u$(xsmall)">
                                <input type="password" name="npwd" id="npwd" value="" placeholder="Nouveau mot de passe" class="12u$" style="margin-bottom:20px; color:#1e2336;" minlength="8" required>
                            </div>
                            <div class="4u 12u$(xsmall)">
                                <input type="password" name="cpwd" id="cpwd" value="" placeholder="Retaper mot de passe" class="12u$" style="margin-bottom:20px; color:#1e2336;" minlength="8" required>
                            </div>
                            <div class="4u 12u$(xsmall)">
                            <!-- Break -->
                            <div class="12u$">
                                <input type="hidden" name="form" value="password">
                                <ul class="actions" style="margin-bottom:0;">
                                    <li><input type="submit" value="Modifier" class="special" name="confirm"></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </section>

        <?php endif;?>

  </section>




 
        <?php if ($_SESSION['droit'] != 1){ ?>
		<!-- Footer -->


        <section id="ten" class="wrapper align-center bloclock" style="">


				<div class="inner">

					<h3></h3>
                    <h2 id="content" style="">Compte à rebours</h2>


					<div class="clock"></div>

				</div>

        </section>
			<?php include 'footer.php'; ?>

        <?php } ?>

		<!-- Scripts -->
        <script src="./assets/js/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
			<script src="./assets/js/skel.min.js"></script>
			<script src="./assets/js/util.js"></script>
			<script src="./assets/js/main.js"></script>
            <script>
                var displayContent = function (event, a, b) {
                    var output = document.getElementsByClassName('out-' + a + '-' + b);
                    output[0].innerHTML = event.target.files[0].name;
                }
            </script>
        <script src="assets/js/flipclock.min.js"></script>
			<script type="text/javascript">
				var clock;

				$(document).ready(function() {

					// Grab the current date
					var currentDate = new Date();

					// Set some date in the future. In this case, it's always Jan 1
					//let futureDate = new Date(2020, 0, 30, 17, 15);
 
	var futureDate  = new Date(2020,04,13);

					// Calculate the difference in seconds between the future and current date
					var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;
                    if (diff === 0 || diff < 0) {
                        diff = 0;
                    }

					// Instantiate a coutdown FlipClock
					clock = $('.clock').FlipClock(diff, {
						clockFace: 'DailyCounter',
						countdown: true
					});

                let radioValue = $("input[name='participe']:checked").val();
                    
                        if (parseInt(radioValue) == 2){
                            $(".displayParticipe3").css("display","block");
                            $(".displayParticipe4").css("display","none");
                        }
                    
                        if (parseInt(radioValue) != 1){
                           $(".displayParticipe").css("display","none");
                            $(".ville").css("display","none");
                            $(".villetitle").css("display","none");
                            $(".displayParticipe").css("display","none");
                            $(".displayParticipe2").css("display","none");
                        }
                        if (parseInt(radioValue) == 1){
                            $(".displayParticipe3").css("display","none");
                            $(".displayParticipe2").css("display","block");
                            if($("#societe").val() != ""){
                                if($("#societe").val() != "PARIS"){
                                    $(".displayParticipe").css("display","block");
                                    $(".displayParticipe4").css("display","none");
                                }else{
                                    $(".displayParticipe4").css("display","block");
                                    $(".displayParticipe").css("display","none");
                                    $(".ville").css("display","none");
                                    $(".villetitle").css("display","none");
                                    $(".displayParticipe").css("display","none");
                                }
                            }else{
                                $(".displayParticipe4").css("display","none");
                                $(".displayParticipe").css("display","none");
                                $(".ville").css("display","none");
                                $(".villetitle").css("display","none");
                                $(".displayParticipe").css("display","none");
                            }
                        }
                    
                    
                    
                    $("#yes, #no, #test, #societe").on('change', function () {
                        radioValue = $("input[name='participe']:checked").val();
                        if (parseInt(radioValue) == 2){
                            $(".displayParticipe3").css("display","block");
                            $(".displayParticipe4").css("display","none");
                        }
                        
                        if (parseInt(radioValue) != 1){
                           $(".displayParticipe").css("display","none");
                           $(".displayParticipe2").css("display","none");
                        }
                        if (parseInt(radioValue) == 1){
                            $(".displayParticipe3").css("display","none");
                            $(".displayParticipe2").css("display","block");
                            if($("#societe").val() != ""){
                                if($("#societe").val() != "PARIS"){
                                    $(".displayParticipe").css("display","block");
                                    $(".displayParticipe4").css("display","none");
                                }else{
                                    $(".displayParticipe4").css("display","block");
                                    $(".displayParticipe").css("display","none");
                                }
                            }else{
                                $(".displayParticipe4").css("display","none");
                                $(".displayParticipe").css("display","none");
                            }
                        }
                    });
                        var montransport = $("input[name='transport']:checked").val();
                        if (montransport == 0){
                        $(".villetitle").css("display","block");
                            var destination = $("#societe").val();
                            if (destination == "BLOIS"){
                               $(".ville").css("display","none");
                               $("#blois").css("display","block");
                            }
                            if (destination == "POITIERS"){
                               $(".ville").css("display","none");
                               $("#poitiers").css("display","block");
                            }
                            if (destination == "RENNES"){
                               $(".ville").css("display","none");
                               $("#rennes").css("display","block");
                            }
                            if (destination == "MONTPELLIER"){
                               $(".ville").css("display","none");
                               $("#montpellier").css("display","block");
                            }
                            if (destination == "GRENOBLE"){
                               $(".ville").css("display","none");
                               $("#grenoble").css("display","block");
                            }
                        }else{
                           $(".ville").css("display","none");
                            $(".villetitle").css("display","none");
                        }

                    $("#societe, #transportY, #transportN").on('change', function () {
                        var montransport = $("input[name='transport']:checked").val();
                        if (montransport == 0){
                        $(".villetitle").css("display","block");
                            var destination = $("#societe").val();
                            if (destination == "BLOIS"){
                               $(".ville").css("display","none");
                               $("#blois").css("display","block");
                            }
                            if (destination == "POITIERS"){
                               $(".ville").css("display","none");
                               $("#poitiers").css("display","block");
                            }
                            if (destination == "RENNES"){
                               $(".ville").css("display","none");
                               $("#rennes").css("display","block");
                            }
                            if (destination == "MONTPELLIER"){
                               $(".ville").css("display","none");
                               $("#montpellier").css("display","block");
                            }
                            if (destination == "GRENOBLE"){
                               $(".ville").css("display","none");
                               $("#grenoble").css("display","block");
                            }
                        }else{
                           $(".ville").css("display","none");
                            $(".villetitle").css("display","none");
                        }
                    });

            });


                $(document).ready(function() {


                        var color = $('#civilite').find("option:selected").attr('value');
                        if(color == ""){
                            $('#civilite').css("color","#9a9a9a");
                        }else{
                            $('#civilite').css("color","#333a85");
                        }

                    $('#civilite').on('change', function() {
                        var color = this.value;
                        if(color == ""){
                            $('#civilite').css("color","#9a9a9a");
                        }else{
                            $('#civilite').css("color","#333a85");
                        }
                    });


                    let accompagnant = $("input[name='accompagnant']:checked").val();

                    if (parseInt(accompagnant) === 1){
                        $("#montrer").show();
                    } else {
                        $("#montrer").hide();
                    }


                    $("#accompagnant").on('change', function () {
                        let accompagnant = $("input[name='accompagnant']:checked").val();

                        if (parseInt(accompagnant) === 1){
                            $("#montrer").show();
                        } else {
                            $("#montrer").hide();
                        }
                    });
                    console.log(accompagnant)

                 });


        </script>

	</body>
</html>
