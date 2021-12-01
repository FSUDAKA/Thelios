<?php include 'connect-backoffice.php';

require_once './class/User.php';
require_once './class/Profil.php';

$profil = new Profil();
$usr   = new User();

$user = $_GET["user"];
$event = $_GET["event"];


if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['valider'])){
    if($_POST['form1'] == "form1"){
        $civilite= $_POST['civilite'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date_in = $_POST['date_in'];
        $date_out = $_POST['date_out'];
        $participe = $_POST['participe'];
        $isvalid = $_POST['isvalid'];
        $isprivilegie = $_POST['isprivilegie'];
        
        $societe = $_POST['societe'];
        $typesoc = $_POST['typesoc'];
        $secteur = $_POST['secteur'];
        $fonction = $_POST['fonction'];
        $adresse = $_POST['adresse'];
        $adresse2 = $_POST['adresse2'];
        $cp = $_POST['cp'];
        $ville = $_POST['ville'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $mobile = $_POST['mobile'];
        $cadeau = $_POST['cadeau']; 
        $remarques = $_POST['remarques']; 

        if ($nom != ''){
            date_default_timezone_set('Europe/Paris');
	        $db = mysqli_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
	        mysqli_select_db($db, 'BddIdec');
            $sql = "UPDATE `PROFILS` SET 
            `NOM` = '".mysql_real_escape_string(utf8_decode($nom))."',
            `PRENOM` = '".mysql_real_escape_string(utf8_decode($prenom))."',
            `PARTICIPATION` = '".mysql_real_escape_string(utf8_decode($participe))."',
            `SOCIETE` = '".mysql_real_escape_string(utf8_decode($societe))."',
            `SECTEUR` = '".mysql_real_escape_string(utf8_decode($secteur))."',
            `FONCTION` = '".mysql_real_escape_string(utf8_decode($fonction))."',
            `ADRESSE` = '".mysql_real_escape_string(utf8_decode($adresse))."',
            `ADRESSE2` = '".mysql_real_escape_string(utf8_decode($adresse2))."',
            `CP` = '".mysql_real_escape_string(utf8_decode($cp))."',
            `VILLE` = '".mysql_real_escape_string(utf8_decode($ville))."',
            `EMAIL` = '".mysql_real_escape_string(utf8_decode($email))."',
            `TEL` = '".mysql_real_escape_string(utf8_decode($tel))."',
            `MOBILE` = '".mysql_real_escape_string(utf8_decode($mobile))."',
            `DATE_IN` = '".mysql_real_escape_string(utf8_decode($date_in))."',
            `DATE_OUT` = '".mysql_real_escape_string(utf8_decode($date_out))."'
            WHERE `ID` = '".$user."';";
            $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
            $data1 = mysql_fetch_array($req);
            $data = $profil->updateProfil($civilite, $nom, $prenom, $participe, $isvalid, $isprivilegie, $societe, $typesoc, $secteur, $fonction, $adresse, $adresse2, $cp, $ville, $email, $tel, $mobile, $date_in, $date_out, $user);

            $error = "Les paramètres ont bien été mis à jour.";
            $color = "#28a745";
            $valid = "0";


        } else{
            $error = "Attention, vous n'avez pas rempli tous les champs obligatoires.";
            $color = "#FF0000";
            $valid = "0";
            if ($nom == ''){echo "<style>#nom{border-color:#ff0000;}</style>";}
        }
    }
    if($_POST['form2'] == "form2"){    
        
        $inscriptionok = 1;
        
        if(($_POST["settings_ateliers"] == 1) || ($_POST["settings_hebergement2"] == 1) || ($_POST["settings_transport"] == 1)){
            if($_POST["settings_inscription"] == 1){
                $inscriptionok = 1;
            }else{
                $inscriptionok = 0;
            }
        }
        
        if ($inscriptionok != 0){

            $data = $profil->addCadeau($cadeau, $remarques, $user);

          $error = "Les paramètres ont bien été mis à jour.";
          $color = "#28a745";
          $valid = "0";
        
        } else{
            $error = "Attention, vous devez sélectionner la page inscription avant de choisir les options ateliers, hébergement, room et transport.";
            $color = "#FF0000";
            $valid = "0";
            echo "<style>.settings_inscription:before{border-color:#ff0000;}</style>";
        }
    }
    
}
$db = mysqli_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
mysqli_select_db($db, 'BddIdec');
mysqli_query($db, "SET NAMES 'utf8'");
mysqli_query($db, "SET CHARACTER SET utf8");
mysqli_query($db, "SET SESSION collation_connection = 'utf8_unicode_ci'");
$data = $profil->findOneById($user);
$data1 = $usr->findOneById($_SESSION['id']);


if($data1['STATUT'] == 1){
    header('Location: backoffice.php');
}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Paramètres - <?php echo $data['NOM'] ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/flipclock.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
		<link rel="icon" href="images/favicon.ico" type="image/png">
        <style>
        table table tr {
            background: #fff !important;
            border: 0;
        }
        table table {
            margin-top: 10px !important;
            margin-bottom: 0 !important;
        }
        table table tr td {
            padding: 0px 0px 2px 40px;
        }
            
        #date_in, #date_out {
            padding-left: 70px;
        }
            
       .date_debut_fin {
            position: relative;
            margin-left: 1em;
            height: 45px;
            line-height: 45px;
            color: #bbb !important;
            /*! width: 25%; */
            float: left;
        }

       #date_in, #date_out {

    padding-left: 10px;
    width: 25%;
    float: left;
    margin-left: 10px;

}

        
            
            @media screen and (min-width: 1681px) {
            
                #date_in, #date_out {
                    padding-left: 90px;
                }

                .date_debut_fin {
                    height: 52px;
                    line-height: 52px;
                }
                
            }
        </style>
	</head>
	<body>

		<!-- Header -->
			<header id="header">
                <div id="nav1"><div class="inner"><?php include 'menu1.php'; ?></div></div>
				<div class="inner">
					<a href="index.php" class="logo"><img src="images/logo.png"></a>
					<nav id="nav">
                        <?php include 'menu.php'; ?>
					</nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
			</header>

		<!-- Three -->
			<section id="one" class="wrapper align-center" style="margin-top: 40px;">
				<div class="inner">

					<div class="row uniform">

						<div class="9u 12u$(small)" style="width: 100%">

							<h2 id="content" style="color:#f99f1b;">Paramètres - <?php echo $data['NOM'] ?></h2>

                            <?php if (($error != "") && ($valid == "0")) { ?>
                                <div class="box" id="messagein" style="border-color:<?php echo $color; ?>; margin-top: 2em;">
                                    <p style="color:<?php echo $color; ?>;"><?php echo $error; ?></p>
                                </div>
                            <?php } ?>

							<table style="margin-top:30px;">
                                <thead>
                                    <tr>
                                        <th>Paramètres</th>
                                    </tr>
                                </thead>
                            </table>
                            
                            <form method="post" action="settings-profil.php?user=<?php echo $data['ID']; ?>" enctype="multipart/form-data">
                                <input type="hidden" id="form1" name="form1" class="form1" value="form1">
                                <div class="row uniform">
                                   <div class="6u 12u$(xsmall)" style="text-align: left;">
                                     <input id="settings_participe" name="participe" class="settings_participe" type="checkbox" value="1" <?php if($data["PARTICIPATION"] == "1"){echo "checked";} ?>><label for="settings_participe" class="settings_accueil" style="margin-bottom: 0;">PARTICIPERA</label>
                                     <input id="settings_isvalid" name="isvalid" class="settings_isvalid" type="checkbox" value="1" <?php if($data["ISVALID"] == "1"){echo "checked";} ?>><label for="settings_isvalid" class="settings_isvalid" style="margin-bottom: 0;">COMPTE VALIDE</label>
                                   </div>
                                    <div class="6u 12u$(xsmall)" style="text-align: left;">
                                        <span class="date_debut_fin">Arrive le : </span>
                                        <input type="date" name="date_in" id="date_in" value="<?php echo $data['DATE_IN']; ?>">
                                        <span class="date_debut_fin">Part le : </span>
                                        <input type="date" name="date_out" id="date_out" value="<?php echo $data['DATE_OUT']; ?>">
                                   </div>

                                      <div class="6u 12u$(xsmall)" style="text-align: left;"> 
                                      <input id="settings_isprivilegie" name="isprivilegie" class="settings_isprivilegie" type="checkbox" value="1" <?php if($data["ISPRIVILEGIE"] == "1"){echo "checked";} ?>>
                                      <label for="settings_isprivilegie" class="settings_isprivilegie" style="margin-bottom: 0;">COMPTE PRIVILEGIE</label></div>
                                    <div class="6u$ 12u$(xsmall)" style="text-align: left;">
                                        
                                    </div>


                                    <div class="6u 12u$(xsmall)">
                                       <input type="text" name="civilite" id="civilite" value="<?php echo $data['CIVILITE']; ?>"  placeholder="Civilité du participant" style="width: 20%;float: left;">
                                      <input type="text" name="nom" id="nom" value="<?php echo $data['NOM']; ?>" placeholder="Nom du participant" style="width: 70%;float: left;margin-left: 10px;">
                                    </div>
                                     <div class="6u$ 12u$(xsmall)">
                                        <input type="text" name="prenom" id="prenom" value="<?php echo $data['PRENOM']; ?>" placeholder="Prénom du participant">
                                    </div>

                                       <div class="6u 12u$(xsmall)" style="text-align: left;">   <span class="date_debut_fin">SOCIETE</span></div>
                                    <div class="6u$ 12u$(xsmall)" style="text-align: left;"></div>
                                    

                                    <div class="6u 12u$(xsmall)">
                                        <input type="text" name="societe" id="societe" value="<?php echo $data['SOCIETE']; ?>" placeholder="Société">
                                    </div>
                                    
                                     <div class="6u$ 12u$(xsmall)">
                                       <input type="text" name="fonction" id="fonction" value="<?php echo $data['FONCTION']; ?>" placeholder="Fonction">
                                    </div>
                                    <div class="6u 12u$(xsmall)">
                                        <input type="text" name="typesoc" id="typesoc" value="<?php echo $data['TYPE_SOC']; ?>" placeholder="Type de société">
                                    </div>
                                     <div class="6u 12u$(xsmall)">
                                        <input type="text" name="secteur" id="secteur" value="<?php echo $data['SECTEUR']; ?>" placeholder="Secteur">
                                    </div>

                                     <div class="6u 12u$(xsmall)" style="text-align: left;">   <span class="date_debut_fin">COORDONNEES</span></div>
                                    <div class="6u$ 12u$(xsmall)" style="text-align: left;"></div>

                                    <div class="6u 12u$(xsmall)">
                                        <input type="text" name="adresse" id="adresse" value="<?php echo $data['ADRESSE']; ?>" placeholder="Adressse">
                                    </div>
                                     <div class="6u$ 12u$(xsmall)">
                                       <input type="text" name="adresse2" id="adresse2" value="<?php echo $data['ADRESSE2']; ?>" placeholder="Adresse2">
                                    </div>


                                    <div class="6u 12u$(xsmall)">
                                        <input type="text" name="cp" id="cp" value="<?php echo $data['CP']; ?>" placeholder="CP">
                                    </div>
                                     <div class="6u$ 12u$(xsmall)">
                                       <input type="text" name="ville" id="ville" value="<?php echo $data['VILLE']; ?>" placeholder="Ville">
                                    </div>
                                    <div class="6u 12u$(xsmall)">
                                        <input type="text" name="email" id="email" value="<?php echo $data['EMAIL']; ?>" placeholder="EMAIL">
                                    </div>
                                     <div class="6u$ 12u$(xsmall)">
                                       <input type="text" name="tel" id="tel" value="<?php echo $data['TEL']; ?>" placeholder="TEL">
                                    </div>

                                     <div class="6u$ 12u$(xsmall)">
                                       <input type="text" name="mobile" id="mobile" value="<?php echo $data['MOBILE']; ?>" placeholder="MOBILE">
                                    </div>



                                    <div class="12u$">
                                        <ul class="actions" style="float:left;">
                                            <li><input type="submit" value="Valider les paramètres" class="special" name="valider"></li>
                                        </ul>
                                        <ul class="actions" style="float:right;"><li><a class="button special" href="liste.php?event=<?php echo $data['EVENT_ID']; ?>">RETOUR</a></li></ul>
                                    </div>
                                </div>
                            </form>
<!--
                            <form method="post" action="settings-profil.php?user=<?php echo $data['ID']; ?>" enctype="multipart/form-data">
                                <input type="hidden" id="form2" name="form2" class="form2" value="form2">
                                <table style="margin-top:30px; margin-bottom: 1.5em;">
                                    <thead>
                                        <tr>
                                            <th>Contenu</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input id="settings_remarques" name="cadeau" class="settings_accueil" type="checkbox" value="1" <?php if($data["CADEAU"] == "1"){echo "checked";} ?>><label for="settings_remarques" class="settings_accueil" style="margin-bottom: 0;">Remise cadeau</label>
                                                
                                                <div class="6u$ 12u$(xsmall)">
                                                    <input type="text" name="remarques" id="remarques" value="<?php echo $data['REMARQUES']; ?>" placeholder="REMARQUES">
                                                </div>

                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <input id="settings_programme" name="settings_programme" class="settings_programme" type="checkbox" value="1" <?php if($data["OPT_PROGRAMME"] == "1"){echo "checked";} ?>><label for="settings_programme" class="settings_programme" style="margin-bottom: 0;">Page programme</label>
                                                <?php if($data['OPT_PROGRAMME'] == 1){ ?><div style="float: right; float: right; height: 26px;"><?php echo'<a href="settings-programme.php?event='.$data['ID'].'" style="text-decoration:none;"><i class="fas fa-cog" style="line-height: 26px;"></i></a>'; ?></div><?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input id="settings_hebergement" name="settings_hebergement" class="settings_hebergement" type="checkbox" value="1" <?php if($data["OPT_HEBERGEMENT"] == "1"){echo "checked";} ?>><label for="settings_hebergement" class="settings_hebergement" style="margin-bottom: 0;">Page hébergement</label>
                                                <?php if($data['OPT_HEBERGEMENT'] == 1){ ?><div style="float: right; float: right; height: 26px;"><?php echo'<a href="settings-hebergement.php?event='.$data['ID'].'" style="text-decoration:none;"><i class="fas fa-cog" style="line-height: 26px;"></i></a>'; ?></div><?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input id="settings_infospratiques" name="settings_infospratiques" class="settings_infospratiques" type="checkbox" value="1" <?php if($data["OPT_INFOSPRATIQUES"] == "1"){echo "checked";} ?>><label for="settings_infospratiques" class="settings_infospratiques" style="margin-bottom: 0;">Page infos pratiques</label>
                                                <?php if($data['OPT_INFOSPRATIQUES'] == 1){ ?><div style="float: right; float: right; height: 26px;"><?php echo'<a href="settings-infos-pratiques.php?event='.$data['ID'].'" style="text-decoration:none;"><i class="fas fa-cog" style="line-height: 26px;"></i></a>'; ?></div><?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input id="settings_contact" name="settings_contact" class="settings_contact" type="checkbox" value="1" <?php if($data["OPT_CONTACT"] == "1"){echo "checked";} ?>><label for="settings_contact" class="settings_contact" style="margin-bottom: 0;">Page contactez-nous</label>
                                                <?php if($data['OPT_CONTACT'] == 1){ ?><div style="float: right; float: right; height: 26px;"><?php echo'<a href="settings-contact.php?event='.$data['ID'].'" style="text-decoration:none;"><i class="fas fa-cog" style="line-height: 26px;"></i></a>'; ?></div><?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input id="settings_inscription" name="settings_inscription" class="settings_inscription" type="checkbox" value="1" <?php if($data["OPT_INSCRIPTION"] == "1"){echo "checked";} ?>><label for="settings_inscription" class="settings_inscription" style="margin-bottom: 0;">Page inscription</label>
                                                <?php if($data['OPT_INSCRIPTION'] == 1){ ?><div style="float: right; float: right; height: 26px;"><?php echo'<a href="settings-inscription.php?event='.$data['ID'].'" style="text-decoration:none;"><i class="fas fa-cog" style="line-height: 26px;"></i></a>'; ?></div><?php } ?>
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input id="settings_ateliers" name="settings_ateliers" class="settings_ateliers" type="checkbox" value="1" <?php if($data["OPT_ATELIERS"] == "1"){echo "checked";} ?>><label for="settings_ateliers" class="settings_ateliers" style="margin-bottom: 0;">Ateliers</label>
                                                            </td>
                                                            <?php if($data['OPT_ATELIERS'] == 1){ ?><td style="text-align: right;">
                                                                <?php echo'<a href="settings-atelier.php?event='.$data['ID'].'" style="text-decoration:none;"><i class="fas fa-cog" style="line-height: 26px;"></i></a>'; ?>
                                                            </td><?php } ?>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input id="settings_hebergement2" name="settings_hebergement2" class="settings_hebergement2" type="checkbox" value="1" <?php if($data["OPT_HEBERGEMENT2"] == "1"){echo "checked";} ?>><label for="settings_hebergement2" class="settings_hebergement2" style="margin-bottom: 0;">Hébergement</label>
                                                            </td>
                                                            <?php if($data['OPT_HEBERGEMENT2'] == 1){ ?><td style="text-align: right;">
                                                                <?php echo'<a href="settings-hebergement2.php?event='.$data['ID'].'" style="text-decoration:none;"><i class="fas fa-cog" style="line-height: 26px;"></i></a>'; ?>
                                                            </td><?php } ?>
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                                <input id="settings_transport" name="settings_transport" class="settings_transport" type="checkbox" value="1" <?php if($data["OPT_TRANSPORT"] == "1"){echo "checked";} ?>><label for="settings_transport" class="settings_transport" style="margin-bottom: 0;">Transport</label>
                                                            </td>
                                                            <?php if($data['OPT_TRANSPORT'] == 1){ ?><td style="text-align: right;">
                                                                <?php echo'<a href="settings-transport.php?event='.$data['ID'].'" style="text-decoration:none;"><i class="fas fa-cog" style="line-height: 26px;"></i></a>'; ?>
                                                            </td><?php } ?>
                                                        </tr>
                                                    </tbody>
                                                </table>  
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
								<div class="12u$">
									<ul class="actions" style="float:left;">
										<li><input type="submit" value="Valider le contenu" class="special" name="valider"></li>
									</ul>
									<ul class="actions" style="float:right;"><li><a class="button special" href="backoffice.php"">RETOUR</a></li></ul>
								</div>
                            </form> -->

						</div>

					</div>

				</div>
			</section>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script type="text/javascript">
				$(document).ready(function() {

				});
			</script>

	</body>
</html>
