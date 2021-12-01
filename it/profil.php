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

        
        if($_POST['participe'] == 2){
            if(($_POST['civilite'] == "") OR ($_POST['nom'] == "") OR ($_POST['prenom'] == "") OR ($_POST['naissance'] == "") OR ($_POST['tel'] == "") OR ($_POST['mail'] == "") OR ($_POST['identite'] == "") OR  ($_POST['numero_identite'] == "") OR  ($_POST['validite_identite'] == "") OR  ($_POST['statut'] == "")){
				$iserror = 1;
                if($_POST['civilite'] == ""){echo '<style>select[name="civilite"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['nom'] == ""){echo '<style>input[name="nom"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['prenom'] == ""){echo '<style>input[name="prenom"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['naissance'] == ""){echo '<style>input[name="naissance"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['tel'] == ""){echo '<style>input[name="tel"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['mail'] == ""){echo '<style>input[name="mail"] {border-color: #FF0000 !important;}</style>';}
				if($_POST['identite'] == ""){echo '<style>input[name="identite"] + label:before {border-color: #FF0000 !important;}</style>';}
                if($_POST['numero_identite'] == ""){echo '<style>input[name="numero_identite"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['validite_identite'] == ""){echo '<style>input[name="validite_identite"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['statut'] == ""){echo '<style>input[name="statut"] + label:before {border-color: #FF0000 !important;}</style>';}
            }
            if($_POST['statut'] == "1"){
                if($_POST['fonction'] == ""){$iserror = 1; echo '<style>input[name="fonction"] {border-color: #FF0000 !important;}</style>';}
            }
            if($_POST['statut'] == "2"){
                if($_POST['magasin'] == ""){$iserror = 1; echo '<style>input[name="magasin"] {border-color: #FF0000 !important;}</style>';}
            }
        }
		if($_POST['participe'] == 1){
            if(($_POST['civilite'] == "") OR ($_POST['nom'] == "") OR ($_POST['prenom'] == "") OR ($_POST['naissance'] == "") OR ($_POST['tel'] == "") OR ($_POST['mail'] == "") OR ($_POST['identite'] == "") OR ($_POST['numero_identite'] == "") OR ($_POST['nationalite'] == "") OR ($_POST['validite_identite'] == "") OR ($_POST['statut'] == "") OR ($_POST['transport'] == "") OR ($_POST['ville_depart'] == "") OR ($_POST['date_depart'] == "") OR ($_POST['horaire_depart'] == "") OR ($_POST['ville_retour'] == "") OR ($_POST['date_retour'] == "") OR ($_POST['horaire_retour'] == "") OR ($_POST['transfert_hotel'] == "") OR ($_POST['transfert_aeroport_gare'] == "") OR ($_POST['accompagnant_transport'] == "") OR ($_POST['accompagnant_hebergement'] == "") OR ($_POST['accompagnant_enfant'] == "") OR ($_POST['pcr'] == "")){
				$iserror = 1;
                if($_POST['civilite'] == ""){echo '<style>select[name="civilite"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['nom'] == ""){echo '<style>input[name="nom"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['prenom'] == ""){echo '<style>input[name="prenom"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['naissance'] == ""){echo '<style>input[name="naissance"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['tel'] == ""){echo '<style>input[name="tel"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['mail'] == ""){echo '<style>input[name="mail"] {border-color: #FF0000 !important;}</style>';}
				if($_POST['identite'] == ""){echo '<style>input[name="identite"] + label:before {border-color: #FF0000 !important;}</style>';}
                if($_POST['numero_identite'] == ""){echo '<style>input[name="numero_identite"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['nationalite'] == ""){echo '<style>input[name="nationalite"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['validite_identite'] == ""){echo '<style>input[name="validite_identite"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['statut'] == ""){echo '<style>input[name="statut"] + label:before {border-color: #FF0000 !important;}</style>';}
                if($_POST['transport'] == ""){echo '<style>input[name="transport"] + label:before {border-color: #FF0000 !important;}</style>';}
                if($_POST['ville_depart'] == ""){echo '<style>input[name="ville_depart"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['date_depart'] == ""){echo '<style>input[name="date_depart"] {border-color: #FF0000 !important;}</style>';}
				if($_POST['horaire_depart'] == ""){echo '<style>select[name="horaire_depart"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['ville_retour'] == ""){echo '<style>input[name="ville_retour"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['date_retour'] == ""){echo '<style>input[name="date_retour"] {border-color: #FF0000 !important;}</style>';}
				if($_POST['horaire_retour'] == ""){echo '<style>select[name="horaire_retour"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['transfert_hotel'] == ""){echo '<style>input[name="transfert_hotel"] + label:before {border-color: #FF0000 !important;}</style>';}
                if($_POST['transfert_aeroport_gare'] == ""){echo '<style>input[name="transfert_aeroport_gare"] + label:before {border-color: #FF0000 !important;}</style>';}
                if($_POST['accompagnant_transport'] == ""){echo '<style>input[name="accompagnant_transport"] + label:before {border-color: #FF0000 !important;}</style>';}
                if($_POST['accompagnant_hebergement'] == ""){echo '<style>input[name="accompagnant_hebergement"] + label:before {border-color: #FF0000 !important;}</style>';}
                if($_POST['accompagnant_enfant'] == ""){echo '<style>input[name="accompagnant_enfant"] + label:before {border-color: #FF0000 !important;}</style>';}
                if($_POST['pcr'] == ""){echo '<style>input[name="pcr"] + label:before {border-color: #FF0000 !important;}</style>';}
            }
            if($_POST['statut'] == "1"){
                if($_POST['fonction'] == ""){$iserror = 1; echo '<style>input[name="fonction"] {border-color: #FF0000 !important;}</style>';}
            }
            if($_POST['statut'] == "2"){
                if($_POST['magasin'] == ""){$iserror = 1; echo '<style>input[name="magasin"] {border-color: #FF0000 !important;}</style>';}
            }
            if($_POST['accompagnant_transport'] == "1"){
                if($_POST['mail_accompagnant_transport'] == ""){$iserror = 1; echo '<style>input[name="mail_accompagnant_transport"] {border-color: #FF0000 !important;}</style>';}
            }
            if($_POST['accompagnant_hebergement'] == "1"){
                if($_POST['mail_accompagnant_hebergement'] == ""){$iserror = 1; echo '<style>input[name="mail_accompagnant_hebergement"] {border-color: #FF0000 !important;}</style>';}
                if($_POST['lit'] == ""){$iserror = 1; echo '<style>input[name="lit"] + label:before {border-color: #FF0000 !important;}</style>';}
            }
			if($_POST['conditions_sanitaire'] != 1){
				array_push($errors, "È necessario impegnarsi a rispettare le istruzioni di sicurezza sanitaria.");
				$color = "#FF0000";
				if($_POST['conditions'] == ""){echo '<style>.conditions + label:before {border-color: #FF0000 !important;}</style>';}
			}
        }
		if($_POST['participe'] == ""){
            $iserror = 1;
            if($_POST['participe'] == ""){echo '<style>input[name="participe"] + label:before {border-color: #FF0000 !important;}</style>';}
        }else{
			if($_POST['conditions'] != 1){
				array_push($errors, "Devi accettare le condizioni di registrazione.");
				$color = "#FF0000";
				if($_POST['conditions'] == ""){echo '<style>.conditions + label:before {border-color: #FF0000 !important;}</style>';}
			}
		}
		if($iserror == 1){
            $color = "#FF0000";
			array_push($errors, "Tutti i campi obbligatori non sono stati compilati!");
		}

        /*
        if(($data['NOM_ACC'] != $_POST['mailacc']) && ($_POST['mailacc'] != "")){
            $datatotalacc = $usr->checkEmailProfil2($_POST['mailacc']);
            if($datatotalacc["total"] != 0) {
                array_push($errors, "Cette personne est déjà sollicitée, vous devez renseigner un autre nom et prénom d'un autre collègue avec qui vous partagerez votre chambre !");
                $color = "#FF0000";
                echo '<style>input[name="mailacc"] {border-color: #FF0000 !important;}</style>';
            }
        }
		*/

        if(sizeof($errors) == 0){

            if($_POST['participe'] == 1){
				if($_POST['statut'] == "1"){
					$_POST['magasin'] = "";
				}
				if($_POST['statut'] == "2"){
					$_POST['fonction'] = "";
				}
				if($_POST['accompagnant_transport'] == "2"){
					$_POST['mail_accompagnant_transport'] = "";
				}
				if($_POST['accompagnant_hebergement'] == "2"){
					$_POST['mail_accompagnant_hebergement'] = "";
					$_POST['lit'] = "";
				}
                $usr->updateUserById2_GT($_POST['id'], $_POST['participe'], $_POST['civilite'], $_POST['nom'], $_POST['prenom'], $_POST['naissance'], $_POST['tel'], $_POST['mail'], $_POST['remarques'], $_POST['identite'], $_POST['numero_identite'], $_POST['nationalite'], $_POST['validite_identite'], $_POST['statut'], $_POST['fonction'], $_POST['magasin'], $_POST['transport'], $_POST['ville_depart'], $_POST['date_depart'], $_POST['horaire_depart'], $_POST['ville_retour'], $_POST['date_retour'], $_POST['horaire_retour'], $_POST['reference_billet_aller'], $_POST['reference_billet_retour'], $_POST['transfert_hotel'], $_POST['transfert_aeroport_gare'], $_POST['accompagnant_transport'], $_POST['mail_accompagnant_transport'], $_POST['accompagnant_hebergement'], $_POST['mail_accompagnant_hebergement'], $_POST['accompagnant_enfant'], $_POST['lit'], $_POST['commentaires'], $_POST['pcr'], $_POST['conditions_sanitaire'], $_POST['conditions']);
            }else{
				if($_POST['statut'] == "1"){
					$_POST['magasin'] = "";
				}
				if($_POST['statut'] == "2"){
					$_POST['fonction'] = "";
				}
                $usr->updateUserById2_GT($_POST['id'], $_POST['participe'], $_POST['civilite'], $_POST['nom'], $_POST['prenom'], $_POST['naissance'], $_POST['tel'], $_POST['mail'], $_POST['remarques'], $_POST['identite'], $_POST['numero_identite'], $_POST['numero_identite'], $_POST['validite_identite'], $_POST['statut'], $_POST['fonction'], $_POST['magasin'], $_POST['transport'], "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", $_POST['conditions']);
            }

            if($_POST['id'] == $id){

                if($_POST['participe'] == 1){

                    $email = $_POST['mail'];
                    $objet = 'Thélios Spring Convention 2021';
                    $titre = "Thélios Spring Convention 2021";
                    if ($_POST['civilite'] == 'M.'){
                        $texte = 'Caro '.$_POST['civilite'].' '.$_POST['prenom'].' '.$_POST['nom'].' <br><br>';
                    } else{
                        $texte = 'Caro '.$_POST['civilite'].' '.$_POST['prenom'].' '.$_POST['nom'].' <br><br>';
                    }
                    $texte .= "\r\n";
                    $texte .= 'Abbiamo notato che parteciperai alla Thélios Spring Convention 2021.<br>';
                    $texte .= "\r\n";
					
					if($_GET['idColaborateur'] == ""){
                    	include('class/Email.php');
					}
					
					$form = "ok";
                    
                }

                if($_POST['participe'] == 2){

                    $email = $_POST['mail'];
                    $objet = 'Thélios Spring Convention 2021';
                    $titre = "Thélios Spring Convention 2021";
                    if ($_POST['civilite'] == 'M.'){
                        $texte = 'Caro '.$_POST['civilite'].' '.$_POST['prenom'].' '.$_POST['nom'].' <br>';
                    } else{
                        $texte = 'Caro '.$_POST['civilite'].' '.$_POST['prenom'].' '.$_POST['nom'].' <br>';
                    }
                    $texte .= "\r\n";
                    $texte .= '<br>Abbiamo preso in considerazione la tua risposta e prendiamo atto che non sarai presente alla Thélios Spring Convention 2021.';
                    $texte .= "\r\n";
					
					if($_GET['idColaborateur'] == ""){
                    	include('class/Email.php');
					}
					
					$form = "ok";

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

            $color = "#093";
        }else{

            $data['PARTICIPATION'] = $_POST['participe'];
            $data['CIVILITE'] = $_POST['civilite'];
            $data['NOM'] = $_POST['nom'];
            $data['PRENOM'] = $_POST['prenom'];
            $data['ADRESSE1'] = $_POST['naissance'];
            $data['MOBILE'] = $_POST['tel'];
            $data['EMAIL'] = $_POST['mail'];
            $data['REMARQUES'] = $_POST['remarques'];
            $data['CP'] = $_POST['identite'];
            $data['VILLE'] = $_POST['numero_identite'];
            $data['TEL'] = $_POST['validite_identite'];
            $data['MATRICULE'] = $_POST['statut'];
            $data['FONCTION'] = $_POST['fonction'];
            $data['TYPE'] = $_POST['magasin'];
            $data['TRANSPORT'] = $_POST['transport'];
            $data['VILLE_DEPART1'] = $_POST['ville_depart'];
            $data['TRANS_ALLER'] = $_POST['date_depart'];
            $data['PRESENT_DEJ1'] = $_POST['horaire_depart'];
            $data['VILLE_DEPART2'] = $_POST['ville_retour'];
            $data['TRANS_RETOUR'] = $_POST['date_retour'];
            $data['PRESENT_DEJ2'] = $_POST['horaire_retour'];
            $data['PRESENT_REUNION1'] = $_POST['transfert_hotel'];
            $data['PRESENT_REUNION21'] = $_POST['transfert_aeroport_gare'];
            $data['PRESENT_REUNION31'] = $_POST['accompagnant_transport'];
            $data['PRESENT_REUNION4'] = $_POST['mail_accompagnant_transport'];
            $data['PRESENT_NUIT1'] = $_POST['accompagnant_hebergement'];
            $data['PRESENT_NUIT2'] = $_POST['mail_accompagnant_hebergement'];
            $data['PRESENT_NUIT3'] = $_POST['lit'];
            $data['REMARQUES_TRANS'] = $_POST['commentaires'];
            $data['NAVETTE'] = $_POST['pcr'];
            $data['NAV'] = $_POST['conditions_sanitaire'];
            $data['CONDITIONS'] = $_POST['conditions'];
            $data['PRESENT_DEJ3'] = $_POST['reference_billet_aller'];
            $data['PRESENT_DEJ4'] = $_POST['reference_billet_retour'];
			$data['PRESENT_PDEJ4'] = $_POST['accompagnant_enfant'];
			$data['ADRESSE2'] = $_POST['nationalite'];
			
        }


    }
    if($_POST['form'] == "password"){
        if($usr->findAllByPassword(sha1($_POST['opwd'])) == null){
            array_push($errors, "La tua password non è corretta !");
            $color = "#FF0000";
            echo '<style>input[name="opwd"] {border-color: #FF0000 !important;}</style>';


        }
        if($_POST['npwd'] !== $_POST['cpwd']){
            array_push($errors, "Le due voci per la tua nuova password devono essere identiche !");
            $color = "#FF0000";
            echo '<style>input[name="npwd"] {border-color: #FF0000 !important;}</style>';
            echo '<style>input[name="cpwd"] {border-color: #FF0000 !important;}</style>';
        }

        if($_POST['npwd'] == $_POST['opwd']){
            array_push($errors, "La password deve essere diversa da quella vecchia !");
            $color = "#FF0000";
            echo '<style>input[name="opwd"] {border-color: #FF0000 !important;}</style>';
            echo '<style>input[name="npwd"] {border-color: #FF0000 !important;}</style>';
            echo '<style>input[name="cpwd"] {border-color: #FF0000 !important;}</style>';
        }

        if(sizeof($errors) == 0){
            $usr->updateUsersByNewPass(sha1($_POST['cpwd']), $id);
            array_push($errors, "La tua password è stata aggiornata con successo.");
            $color = "#093";




            $email = $data['EMAIL'];
            $objet = 'Thélios Spring Convention 2021 - Modifica della password';
            $titre = "Modifica della password";
            $texte = '<strong>Buongiorno '.$data['PRENOM'].' '.$data['NOM'].', </strong><br><br>';
            $texte .= 'La tua password è stata cambiata con successo.  <br>';
            $texte .= 'Se non sei all\'origine di questa modifica, ti preghiamo di contattarci.';
            $texte .= "\r\n";

            include('class/Email.php');



        }
    }
}
?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
    <title>Iscriviti - <?php echo $dataGeneral['NOM']; ?></title>
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
	<style>
		.displayParticipeAAA{
			display: none;
		}
		
		.displayParticipe2, .displayEmploye, .displayClient, .displayTransport, .displayHebergement{display: none;}
	
	</style>
</head>
<body>

<!-- Header -->
<header id="header">
    <div id="nav1"><div class="inner"><?php include 'menu1.php'; ?></div></div>
    <div class="inner">
        <a href="accueil.php" class="logo"><img src="images/logo-white.png"></a>
        <nav id="nav">
            <?php include 'menu.php'; ?>
        </nav>
        <a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
    </div>
</header>

<!-- Banner -->


			<section id="banner" style="background: url(images/jardin-cercle-aumale.jpeg); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="inner">
        <header>
            <h1>Iscriviti</h1><br>
        </header>
    </div>
</section>



<section id="one" class="wrapper align-center" style="padding: 5em 0 0 0;">
    <div class="inner">

        <div class="box" style="border-color:#8a6d3b;">
            <p style="color:#8a6d3b;">La data limite di iscrizione è il 13 settembre 2021 !</p>
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
		
		<?php
			if(($data['ENREGISTREMENT'] == "OK") && ($_GET['idColaborateur'] == "")){
				
				?>
		
		<div class="box" style="border-color:#093;">
                <p style="color:#093;">
                    La tua risposta è stata presa in considerazione.
                                    </p>
            </div>
		
		<?php
		
			}else{
		?>
		
		

        <form method="post" action="profil.php<?php if($_GET["idColaborateur"] != ""){if($_SESSION['droit'] == 1){echo "?idColaborateur=".$_GET["idColaborateur"]."&event=".$_GET["event"];}else{echo "?idColaborateur=".$_GET["idColaborateur"];}} ?>" style="margin-top: 70px;">
            <div class="row uniform" style="display: none !important;">

                <div class="12u$ 12u$(xsmall)">
                    <hr>
                </div>

                <div class="12u$ 12u$(xsmall)" style="text-align: left;">
                    <strong>Participerez-vous à la Thélios Spring Convention 2021 ?</strong>
                </div>
                <div class="6u 12u$(xsmall)">
                    <input type="radio" name="participe" id="yes" value="1" checked >
                    <label for="yes">Je participe</label>
                </div>
                <div class="6u$ 12u$(xsmall)">
                    <input type="radio" name="participe" id="no" value="2">
                    <label for="no">Je ne pourrais pas participer</label>
                </div>

                <div class="12u$ 12u$(xsmall)">
                    <hr>
                </div>
                
            </div>

  		    	<div class="row uniform displayParticipe">
					
					<h2 id="content" style="color:#f99f1b; font-size: 38px; line-height: 38px; margin-top: 0px; width: 100%;">Generalità</h2>

                    <div class=" 2u 12u$(xsmall)">
                        <select id="civilite" name="civilite">
                            <option class="civ1" <?php if($data['CIVILITE'] == ""){echo 'selected';} ?> value="">Stato civile</option>
                            <option class="civ2" <?php if($data['CIVILITE'] == "Sig."){echo "selected";} ?> value="Sig.">Sig.</option>
                            <option class="civ3" <?php if($data['CIVILITE'] == "Sig.ra"){echo "selected";} ?> value="Sig.ra">Sig.ra</option>
                            <option class="civ4" <?php if($data['CIVILITE'] == "Sig.na"){echo "selected";} ?> value="Sig.na">Sig.na</option>
                        </select>
                    </div>
                    <div class=" 5u 12u$(xsmall)">
                        <input type="text" name="nom" id="nom" value="<?=$data['NOM']?>" placeholder="Cognome">
                    </div>
                    <div class=" 5u$ 12u$(xsmall)">
                        <input type="text" name="prenom" id="prenom" value="<?=$data['PRENOM']?>" placeholder="Nome">
                    </div>
                    <div class=" 6u 12u$(xsmall)">
                        <input type="text" onfocus="(this.type='date')" name="naissance" id="naissance"  value="<?=$data['ADRESSE1']?>" placeholder="Data di nascita">
                    </div>
                    <div class=" 6u$ 12u$(xsmall)">
                        <input type="tel" name="tel" id="tel" value="<?=$data['MOBILE']?>" placeholder="Numero di telefono">
                    </div>
                    <div class=" 12u$ 12u$(xsmall)">
                        <input type="email" id="mail" name="mail" value="<?=$data['EMAIL']?>" placeholder="Recapito mail">
                    </div>
					<div class="12u$ 12u$(xsmall)">
                        <input type="radio" name="statut" id="employe" value="1" <?php if($data['MATRICULE'] == 1){echo 'checked';}?>>
                        <label for="employe">Dipendente Thélios</label>
                    </div>
                    <div class="12u$ 12u$(xsmall)">
                        <input type="radio" name="statut" id="client" value="2" <?php if($data['MATRICULE'] == 2){echo 'checked';}?>>
                        <label for="client">Cliente</label>
                    </div>
                    <div class="12u$ 12u$(xsmall) displayEmploye">
                        <input type="text" name="fonction" id="fonction" value="<?=$data['FONCTION']?>" placeholder="Funzione">
                    </div>
                    <div class="12u$ 12u$(xsmall) displayClient">
                        <input type="text" name="magasin" id="magasin" value="<?=$data['TYPE']?>" placeholder="Nome del negozio">
                    </div>
					<div class="6u 12u$(xsmall)">
                        <input type="radio" name="identite" id="passeport" value="1" <?php if($data['CP'] == 2){echo 'checked';}?>>
                        <label for="passeport">Passaporto</label>
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <input type="radio" name="identite" id="cni" value="2" <?php if($data['CP'] == 1){echo 'checked';}?>>
                        <label for="cni">Carta d’identità</label>
                    </div>
                    <div class="12u$ 12u$(xsmall)">
                        <input type="text" name="numero_identite" id="numero_identite"  value="<?=$data['VILLE']?>" placeholder="Numero passaporto/CI">
                    </div>
                    <div class="12u$ 12u$(xsmall)">
                        <input type="text" name="nationalite" id="nationalite"  value="<?=$data['ADRESSE2']?>" placeholder="Cittadinanza">
                    </div>
                    <div class="12u$ 12u$(xsmall)">
                        <input type="text" name="validite_identite" onfocus="(this.type='date')" id="validite_identite" value="<?=$data['TEL']?>" placeholder="Data di scadenza del passaporto/CI">
                    </div>
					
			</div>
			<div class="row uniform displayParticipe2">

                    <div class=" 12u$ 12u$(xsmall)">
                        <hr>
                    </div>
					
					<h2 id="content" style="color:#f99f1b; font-size: 38px; line-height: 38px; margin-top: 0px; width: 100%;">Viaggio</h2>
			
					<div class="6u 12u$(xsmall)">
                        <input type="radio" name="transport" id="avion" value="1" <?php if($data['TRANSPORT'] == 1){echo 'checked';}?>>
                        <label for="avion">Aereo</label>
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <input type="radio" name="transport" id="train" value="2" <?php if($data['TRANSPORT'] == 2){echo 'checked';}?>>
                        <label for="train">Treno (prima classe)</label>
                    </div>
                    <div class="12u$ 12u$(xsmall)">
                        <input type="text" name="ville_depart" id="ville_depart"  value="<?=$data['VILLE_DEPART1']?>" placeholder="Da quale aeroporto o stazione vuoi partire?">
                    </div>
                    <div class="12u$ 12u$(xsmall)">
                        <input type="text" onfocus="(this.type='date')" name="date_depart" id="date_depart"  value="<?=$data['TRANS_ALLER']?>" placeholder="Data di partenza">
                    </div>
					<div class="12u$ 12u$(xsmall)">
                        <select id="horaire_depart" name="horaire_depart">
                            <option class="horaire_depart1" <?php if($data['PRESENT_DEJ1'] == ""){echo 'selected';} ?> value="">Fascia oraria di partenza desiderata</option>
                            <option class="horaire_depart2" <?php if($data['PRESENT_DEJ1'] == "7h00/12h00"){echo "selected";} ?> value="7h00/12h00">7h00/12h00</option>
                            <option class="horaire_depart3" <?php if($data['PRESENT_DEJ1'] == "12h00/17h00"){echo "selected";} ?> value="12h00/17h00">12h00/17h00</option>
                            <option class="horaire_depart4" <?php if($data['PRESENT_DEJ1'] == "17h00/22h00"){echo "selected";} ?> value="17h00/22h00">17h00/22h00</option>
                        </select>
                    </div>
                    <div class="12u$ 12u$(xsmall)">
                        <input type="text" name="ville_retour" id="ville_retour"  value="<?=$data['VILLE_DEPART2']?>" placeholder="Verso quale aeroporto o stazione vuoi tornare?">
                    </div>
                    <div class="12u$ 12u$(xsmall)">
                        <input type="text" onfocus="(this.type='date')" name="date_retour" id="date_retour"  value="<?=$data['TRANS_RETOUR']?>" placeholder="Data di ritorno">
                    </div>
					<div class="12u$ 12u$(xsmall)">
                        <select id="horaire_retour" name="horaire_retour">
                            <option class="horaire_retour1" <?php if($data['PRESENT_DEJ2'] == ""){echo 'selected';} ?> value="">Fascia oraria di ritorno desiderata</option>
                            <option class="horaire_retour2" <?php if($data['PRESENT_DEJ2'] == "7h00/12h00"){echo "selected";} ?> value="7h00/12h00">7h00/12h00</option>
                            <option class="horaire_retour3" <?php if($data['PRESENT_DEJ2'] == "12h00/17h00"){echo "selected";} ?> value="12h00/17h00">12h00/17h00</option>
                            <option class="horaire_retour4" <?php if($data['PRESENT_DEJ2'] == "17h00/22h00"){echo "selected";} ?> value="17h00/22h00">17h00/22h00</option>
                        </select>
                    </div>
                    <div class="12u$ 12u$(xsmall)">
                        <input type="text" name="reference_billet_aller" id="reference_billet_aller"  value="<?=$data['PRESENT_DEJ3']?>" placeholder="Se preferisci specificare il volo di andata che desideri prendere, grazie di precisarlo">
                    </div>
                    <div class="12u$ 12u$(xsmall)">
                        <input type="text" name="reference_billet_retour" id="reference_billet_retour"  value="<?=$data['PRESENT_DEJ4']?>" placeholder="Se preferisci specificare il volo di ritorno che desideri prendere, grazie di precisarlo">
                    </div>
                    <div class="12u$ 12u$(xsmall)" style="text-align: left;">
                        <strong>Viaggi con qualcuno ?</strong>
                    </div>
					<div class="6u 12u$(xsmall)">
                        <input type="radio" name="accompagnant_transport" id="accompagnant_transportoui" value="1" <?php if($data['PRESENT_REUNION31'] == 1){echo 'checked';}?>>
                        <label for="accompagnant_transportoui">Si</label>
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <input type="radio" name="accompagnant_transport" id="accompagnant_transportnon" value="2" <?php if($data['PRESENT_REUNION31'] == 2){echo 'checked';}?>>
                        <label for="accompagnant_transportnon">No</label>
                    </div>
                    <div class=" 12u$ 12u$(xsmall) displayTransport">
                        <textarea id="mail_accompagnant_transport" name="mail_accompagnant_transport" placeholder="Accompagnatore: cognome, nome e recapito mail"><?=$data['PRESENT_REUNION4']?></textarea>
                    </div>
                    <div class="12u$ 12u$(xsmall)" style="text-align: left;">
                        <strong>Il giorno dell’arrivo, desideri un transfer dall’aeroporto o dalla stazione verso :</strong>
                    </div>
					<div class="4u 12u$(xsmall)">
                        <input type="radio" name="transfert_hotel" id="transfert_hoteloui1" value="Hôtel" <?php if($data['PRESENT_REUNION1'] == "Hôtel"){echo 'checked';}?>>
                        <label for="transfert_hoteloui1">Hotel</label>
                    </div>
					<div class="4u 12u$(xsmall)">
                        <input type="radio" name="transfert_hotel" id="transfert_hoteloui2" value="Cercle d’Aumale" <?php if($data['PRESENT_REUNION1'] == "Cercle d’Aumale"){echo 'checked';}?>>
                        <label for="transfert_hoteloui2">Cercle d’Aumale</label>
                    </div>
                    <div class="4u$ 12u$(xsmall)">
                        <input type="radio" name="transfert_hotel" id="transfert_hotelnon" value="2" <?php if($data['PRESENT_REUNION1'] == 2){echo 'checked';}?>>
                        <label for="transfert_hotelnon">No</label>
                    </div>
                    <div class="12u$ 12u$(xsmall)" style="text-align: left;">
                        <strong>Il giorno della partenza, desideri un transfer verso :</strong>
                    </div>
					<div class="4u 12u$(xsmall)">
                        <input type="radio" name="transfert_aeroport_gare" id="transfert_aeroport_gareoui1" value="Aéroport" <?php if($data['PRESENT_REUNION21'] == "Aéroport"){echo 'checked';}?>>
                        <label for="transfert_aeroport_gareoui1">Aeroporto</label>
                    </div>
					<div class="4u 12u$(xsmall)">
                        <input type="radio" name="transfert_aeroport_gare" id="transfert_aeroport_gareoui2" value="Gare" <?php if($data['PRESENT_REUNION21'] == "Gare"){echo 'checked';}?>>
                        <label for="transfert_aeroport_gareoui2">Stazione</label>
                    </div>
                    <div class="4u$ 12u$(xsmall)">
                        <input type="radio" name="transfert_aeroport_gare" id="transfert_aeroport_garenon" value="Non" <?php if($data['PRESENT_REUNION21'] == "Non"){echo 'checked';}?>>
                        <label for="transfert_aeroport_garenon">No</label>
                    </div>
					
					<div class=" 12u$ 12u$(xsmall)">
                        <hr>
                    </div>
					
					<h2 id="content" style="color:#f99f1b; font-size: 38px; line-height: 38px; margin-top: 0px; width: 100%;">Hotel</h2>
					
                    <div class="12u$ 12u$(xsmall)" style="text-align: left;">
                        <strong>Condividi la camera ?</strong>
                    </div>
					<div class="6u 12u$(xsmall)">
                        <input type="radio" name="accompagnant_hebergement" id="accompagnant_hebergementoui" value="1" <?php if($data['PRESENT_NUIT1'] == 1){echo 'checked';}?>>
                        <label for="accompagnant_hebergementoui">Si</label>
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <input type="radio" name="accompagnant_hebergement" id="accompagnant_hebergementnon" value="2" <?php if($data['PRESENT_NUIT1'] == 2){echo 'checked';}?>>
                        <label for="accompagnant_hebergementnon">No</label>
                    </div>
                    <div class=" 12u$ 12u$(xsmall) displayHebergement">
                        <textarea id="mail_accompagnant_hebergement" name="mail_accompagnant_hebergement" placeholder="Accompagnatore : cognome, nome e recapito mail"><?=$data['PRESENT_NUIT2']?></textarea>
                    </div>
					
					<div class="6u 12u$(xsmall) displayHebergement">
                        <input type="radio" name="lit" id="double" value="1" <?php if($data['PRESENT_NUIT3'] == 1){echo 'checked';}?>>
                        <label for="double">1 letto matrimoniale</label>
                    </div>
                    <div class="6u$ 12u$(xsmall) displayHebergement">
                        <input type="radio" name="lit" id="simple" value="2" <?php if($data['PRESENT_NUIT3'] == 2){echo 'checked';}?>>
                        <label for="simple">2 letti singoli</label>
                    </div>
					<div class="12u$ 12u$(xsmall)" style="text-align: left;">
                        <strong>Viaggi con un bambino ?</strong>
                    </div>
					<div class="6u 12u$(xsmall)">
                        <input type="radio" name="accompagnant_enfant" id="accompagnant_enfantoui" value="1" <?php if($data['PRESENT_PDEJ4'] == 1){echo 'checked';}?>>
                        <label for="accompagnant_enfantoui">Si</label>
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <input type="radio" name="accompagnant_enfant" id="accompagnant_enfantnon" value="2" <?php if($data['PRESENT_PDEJ4'] == 2){echo 'checked';}?>>
                        <label for="accompagnant_enfantnon">No</label>
                    </div>
					
					<div class=" 12u$ 12u$(xsmall)">
                        <hr>
                    </div>
					
					<h2 id="content" style="color:#f99f1b; font-size: 38px; line-height: 38px; margin-top: 0px; width: 100%;">Convalida</h2>
					
                    <div class="12u$ 12u$(xsmall)">
                        <textarea id="commentaires" name="commentaires" placeholder="Commenti: Per eventuali richieste particolari, segnalarlo qui (visita culturale desiderata, prenotazione ristorante, ecc.)"><?=$data['REMARQUES_TRANS']?></textarea>
                    </div>
					<div class="12u$ 12u$(xsmall)" style="text-align: left;">
                        <strong>Dovrai effettuare un tampone molecolare in previsione del ritorno? </strong>
                    </div>
					<div class="6u 12u$(xsmall)">
                        <input type="radio" name="pcr" id="pcroui" value="1" <?php if($data['NAVETTE'] == 1){echo 'checked';}?>>
                        <label for="pcroui">Si</label>
                    </div>
                    <div class="6u$ 12u$(xsmall)">
                        <input type="radio" name="pcr" id="pcrnon" value="2" <?php if($data['NAVETTE'] == 2){echo 'checked';}?>>
                        <label for="pcrnon">No</label>
                    </div>
                    <div class="12u$" style="text-align: left;">
                        <input id="conditions_sanitaire" name="conditions_sanitaire" class="conditions" type="checkbox" value="1" <?php if($data['NAV'] == "1"){echo "checked";} ?>><label for="conditions_sanitaire" class="conditions">Mi impegno a rispettare le regole relative alla sicurezza sanitaria del mio Paese di provenienza e della Francia per entrare ed uscire dal territorio.</label>
                    </div>
					
			</div>
			<div class="row uniform displayParticipe">
					
					<div class=" 12u$ 12u$(xsmall)">
                        <hr>
                    </div>
					
                    <div class="12u$">
                        <p style="font-size:12px !important;">
                            I dati comunicati nel presente modulo sono raccolti con la tua autorizzazione e destinati a Thélios in qualità di responsabile della loro elaborazione. Potranno essere trasmessi a subappaltatori che intervengono rispettando strettamente le direttive di Thélios. I dati raccolti nel presente modulo sono elaborati ai fini della gestione del rapporto con i clienti tramite il sito di Thélios. I dati che ti riguardano verranno conservati per 12 mesi al massimo dopo la fine dell’evento a cui ti sei iscritto. Puoi presentare un reclamo all’autorità di controllo competente e hai un diritto di accesso, di rettifica, di cancellatura, di restrizione, di trasferimento e di opposizione per legittimi motivi ai dati personali che ti riguardano. Per far valere questo diritto, grazie di presentare la domanda al seguente indirizzo : contact@arep.co.com</p>
                    </div>
                    <div class="12u$" style="text-align: left;">
                        <input id="conditions" name="conditions" class="conditions" type="checkbox" value="1" <?php if($data['CONDITIONS'] == "1"){echo "checked";} ?>><label for="conditions" class="conditions">Accetto le condizioni di iscrizione di Thélios</label>
                    </div>

                
                        
            </div>



                </div>
                <!-- Break -->
        <div class="inner">
        <div class="row uniform">
                <div class="12u$">
                    <input type="hidden" name="form" value="profile">
                    <!--<input type="hidden" name="id_societe" value="">-->
                    <input type="hidden" name="id" value="<?= $data['ID']?>">
                    <ul class="actions" style="text-align: center;"><br>
                        <li><input type="submit" id="submit" value="Registra" class="special" style="font-size: 18px;"></li>
                        <?php if ($_SESSION['droit'] == 1){ ?>
                            <li style="float:right;"><a href="liste.php?event=<?php echo $_GET['event']; ?>" class="button special">Retour</a></li>
                        <?php } ?>
                        <?php if (($_GET['idColaborateur'] != "") && ($_SESSION['droit'] == 0)){ ?>
                            <li style="float:right;"><a href="societe.php" class="button special">Retour</a></li>
                        <?php } ?>
                    </ul>
                </div>
                            </div>
        </div>
    </div>

            </div>
        </form>
	
		<?php
			} 
		?>
	
    </div>
</section>



<?php if ($data['ID'] == $_SESSION['id']) :?>
    <section id="four" class="wrapper align-center" style="padding: 5em 0 0 0;
border-top: 1px solid #ccc;
margin-top: 12em;">
        <div class="inner">
            <h2 id="content" style="color:#f99f1b;">Cambia la password</h2>
            <div id="confirm">
                <form action="profil.php" method="post" id="connect_form" style="margin-top: 70px;">
                    <div class="row uniform">
                        <div class="4u 12u$(xsmall)">
                            <input type="password" name="opwd" id="" class="cPwd" placeholder="Password attuale">
                        </div>
                        <div class="4u 12u$(xsmall)">
                            <input type="password" name="npwd" id="npwd" value="" placeholder="Nuova password" class="12u$" style="margin-bottom:20px; color:#1e2336;" minlength="8" required>
                        </div>
                        <div class="4u 12u$(xsmall)">
                            <input type="password" name="cpwd" id="cpwd" value="" placeholder="Digita nuovamente la password" class="12u$" style="margin-bottom:20px; color:#1e2336;" minlength="8" required>
                        </div>
                        <div class="4u 12u$(xsmall)">
                            <!-- Break -->
                            <div class="12u$">
                                <input type="hidden" name="form" value="password">
                                <ul class="actions" style="margin-bottom:0;">
                                    <li><input type="submit" value="Modifica" class="special" name="confirm"></li>
                                </ul>
                            </div>
                        </div>
                </form>
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
            <h2 id="content" style="">Conto alla rovescia</h2>


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

        var futureDate  = new Date(2021,08,21);

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

        ///////////////////////////////////////////////////////////// PARTICIPATION ////////////////////////////////////////////
        var radioValue = $("input[name='participe']:checked").val();
        if (parseInt(radioValue) !== 1 || parseInt(radioValue) !== 2){
            $(".displayParticipe").css("display","none");
        }
		
		
            radioValue = $("input[name='participe']:checked").val();
            if (parseInt(radioValue) == 2){ 
                $(".displayParticipe").css("display","block");
                $(".displayParticipe2").css("display","none");
            }
            if (parseInt(radioValue) == 1){ 
                $(".displayParticipe").css("display","block");
                $(".displayParticipe2").css("display","block");
            }
            radioValue = $("input[name='statut']:checked").val();
            if (parseInt(radioValue) == 1){ 
                $(".displayEmploye").css("display","block");
                $(".displayClient").css("display","none");
            }
            if (parseInt(radioValue) == 2){ 
                $(".displayClient").css("display","block");
                $(".displayEmploye").css("display","none");
            }
            radioValue = $("input[name='accompagnant_transport']:checked").val();
            if (parseInt(radioValue) == 1){ 
                $(".displayTransport").css("display","block");
            }
            if (parseInt(radioValue) == 2){ 
                $(".displayTransport").css("display","none");
            }
            radioValue = $("input[name='accompagnant_hebergement']:checked").val();
            if (parseInt(radioValue) == 1){ 
                $(".displayHebergement").css("display","block");
            }
            if (parseInt(radioValue) == 2){ 
                $(".displayHebergement").css("display","none");
            }

        $("#yes, #no, #test").on('change', function () {
            radioValue = $("input[name='participe']:checked").val();
            if (parseInt(radioValue) == 2){ 
                $(".displayParticipe").css("display","block");
                $(".displayParticipe2").css("display","none");
            }
            if (parseInt(radioValue) == 1){ 
                $(".displayParticipe").css("display","block");
                $(".displayParticipe2").css("display","block");
            }
        });

        $("#employe, #client").on('change', function () {
            radioValue = $("input[name='statut']:checked").val();
            if (parseInt(radioValue) == 1){ 
                $(".displayEmploye").css("display","block");
                $(".displayClient").css("display","none");
            }
            if (parseInt(radioValue) == 2){ 
                $(".displayClient").css("display","block");
                $(".displayEmploye").css("display","none");
            }
        });

        $("#accompagnant_transportoui, #accompagnant_transportnon").on('change', function () {
            radioValue = $("input[name='accompagnant_transport']:checked").val();
            if (parseInt(radioValue) == 1){ 
                $(".displayTransport").css("display","block");
            }
            if (parseInt(radioValue) == 2){ 
                $(".displayTransport").css("display","none");
            }
        });

        $("#accompagnant_hebergementoui, #accompagnant_hebergementnon").on('change', function () {
            radioValue = $("input[name='accompagnant_hebergement']:checked").val();
            if (parseInt(radioValue) == 1){ 
                $(".displayHebergement").css("display","block");
            }
            if (parseInt(radioValue) == 2){ 
                $(".displayHebergement").css("display","none");
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




    });


</script>


</body>
</html>
