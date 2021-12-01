<?php
session_start();

include 'connect-backoffice.php';
require_once './class/Event.php';
require_once './class/User.php';

$event = $_GET['event'];

$usr = new User();
$errors = [];
$obli = 0;
$error = "";

$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$pass = array();
$alphaLength = strlen($alphabet) - 1;
for ($i = 0; $i < 8; $i++) {
    $n = rand(0, $alphaLength);
    $pass[] = $alphabet[$n];
}
$mdp = implode($pass);
$hash_mdp = sha1($mdp);

$data1 = $usr->selectByID($_SESSION['id']);
$data = $usr->findOneById($_SESSION['id']);

if($_GET["relance"] != ""){

    $error = "";
	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    $mdp = implode($pass);
    $hash_mdp = sha1($mdp);

	session_start();
	$id = $_GET["user"];

	$usr -> updateRelance($hash_mdp, $id);
	$usr -> selectAllById($id);

	while($data = mysqli_fetch_assoc($req)) {
		$password = $data["PASSWORD"];
		$civilite = $data["CIVILITE"];
		$nom = $data["NOM"];
		$prenom = $data["PRENOM"];
		$email = $data["EMAIL"];

            $email = $data["EMAIL"];
        
                    $objet = 'Séminaire National Alliance Healthcare : Modification informations';
                    $titre = "Inscrivez-vous maintenant !";
                    $texte = '<strong>Cher(e) '.$prenom.', </strong><br><br>';
                    $texte .= 'Sauf erreur, nous n\'avons pas eu le plaisir de recevoir votre inscription au Séminaire National Alliance Healthcare.<br><br>';
                    $texte .= 'Identifiant : '. utf8_decode($email) .'<br>';
                    $texte .= 'Mot de passe : '. $mdp . '<br><br>';
                    $texte .= '<strong>Pour accéder au site du Séminaire National Alliance Healthcare :</strong> <a href="https://challenge-pro.fr/alliance-healthcare" target="_blank"></a>';

            $texte .= "\r\n";

            include('class/Email.php');
            $obli = 1;
            $color = "#093";
            array_push($errors, "L'invitation a été renvoyé, le mot de passe a été régénéré !");
    }
}

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['valider'])){
	session_start();
	$nom = $_POST['nom'];
	$prenom = $_POST['prenom'];
	$email = $_POST['email'];

    if ($nom != '' && $prenom != '' && $email != ''){

        $data5 = $usr -> selectByMail($email);

        if($data5 != 0) {
            array_push($errors, "Cet e-mail est déjà inscrit !");
            $color = "#FF0000";
            $obli = 1;
            echo "<style>#ajout{display:block;} #add{display:none;}</style>";
            echo '<style>input[name="email"] {border-color: #FF0000 !important;}</style>';
        }else{

            $usr -> insertNewInvite($nom, $prenom, $hash_mdp, $email, $event);

            $email = $_POST['email'];

            $objet = 'Séminaire National Alliance Healthcare';
            $titre = "Du mercredi 13 au vendredi 15 mai 2020 - Forum des Images";
            $texte = '<strong>Cher(e) '.$prenom.', </strong><br><br>';
            $texte .= 'Comme annoncé précédemment, le Séminaire National Alliance Healthcare aura lieu du 4 au 5 septembre prochain.<br><br>';
            $texte .= 'Voici l\'identifiant et le mot de passe qui vous permettront d\'accéder au site d\'inscription :<br><br>';
            $texte .= 'Identifiant : '. utf8_decode($email) .'<br>';
            $texte .= 'Mot de passe : '. $mdp . '<br><br>';
            $texte .= '<strong>Pour accéder au site du Séminaire National Alliance Healthcare :</strong> <a href="#" target="_blank"></a>';


            include('class/Email.php');

            array_push($errors, "Le contact a bien été ajouté !");
            $color = "#093";

            echo "<style>#ajout{display:none;}</style>";

            $nom = "";
            $prenom = "";
            $email = "";

        }
    }else{
            array_push($errors, "Tous les champs n'ont pas été remplis !");
            $color = "#FF0000";
            $valid = "0";
            echo "<style>#ajout{display:block;} #add{display:none;}</style>";

            if($_POST['nom'] == ""){echo '<style>input[name="nom"] {border-color: #FF0000 !important;}</style>';}
            if($_POST['prenom'] == ""){echo '<style>input[name="prenom"] {border-color: #FF0000 !important;}</style>';}
            if($_POST['email'] == ""){echo '<style>input[name="email"] {border-color: #FF0000 !important;}</style>';}
    }
}else{
	echo "<style>#ajout{display:none;}</style>";
}


?>

<!DOCTYPE HTML>
<html>
	<head>
		<title>Gestion des inscrits - <?php echo $dataGeneral['NOM']; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/flipclock.css">
		         <link rel="icon" href="images/favicon.ico" type="image/png">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet"> 

        <link rel="stylesheet" href="assets/css/onglets.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <script>
            $( function() {
                $( "#tabs" ).tabs({
                collapsible: true
            });
            });
          </script>

 <style>.fa, .fas {margin: 15px 10px;} tr{text-align: left;}
                .fa-envelope, .fa-industry, .fa-cog, .fa-trash {margin: 4px 10px !important;}


      .mobile_right {text-align: right; width:100px;}
     
     .fa-minus{color:#ccc;}
     
     .fa-minus, .fa-check, .fa-times{margin: 15px 0 !important;}


        </style>

  	</head>
	<body>
		<!-- Header -->
			<header id="header">
                <div id="nav1"><div class="inner"><?php include 'menu1.php'; ?></div></div>
				<div class="inner">
					<a href="index.php" class="logo"><img src="images/logo-white.png"></a>
					<nav id="nav">
                        <?php include 'menu.php'; ?>
					</nav>
					<a href="#navPanel" class="navPanelToggle"><span class="fa fa-bars"></span></a>
				</div>
			</header>



<!-- Three -->
		<section id="two" class="wrapper align-center" style="margin-top: 140px;">
			<div class="inner">
				<div class="row uniform">
					<div class="9u 12u$(small)" style="width: 100%">
						<h2 id="content" style="color:#004b96;">Gestion des inscrits</h2>

						<?php if(sizeof($errors) > 0) : ?>
    					<div class="box" style="border-color:<?php echo $color; ?>;">
						<p style="color:<?php echo $color; ?>;">
						<?php foreach($errors as $error) :?>
						<?=$error?>
                		<br/>
            			<?php endforeach; $errors = [];?>
						</p>
    					</div>
						<?php endif; ?>

                        <hr>
                        <div class="row">

						<form method="post" action="liste.php?event=<?php echo $event ?>" id="recherche">
 					
                            <?php $nomcherche = $_POST['nomcherche']; ?>

								
    					<div class="row uniform">

                                <div class="12u 12u(small)">
                                    <h4 style="width:100%; color:#9a9a9a;">Rechercher un invité</h4>
                                      	<input type="text" name="nomcherche" id="nom" value="<?php echo $nomcherche ?>" placeholder="Nom de l'invité">
                                       	<input type="submit" style="margin-top: 20px;" value="Rechercher" class="special" name="Rechercher">
                                </div>


								<?php $error="";
								if ($error != "")  { ?>
                                	<div class="box" id="messagein" style="border-color:<?php echo $color; ?>; margin-top: 2em;">
                                    	<p style="color:<?php echo $color; ?>;"><?php echo $error; ?></p>
                                	</div>
                            	<?php } ?></div>

						</form>
                        </div>

<div id="tabs">
    <ul style="border: 0;">
    <?php /* <li><a href="#tabs-1">LES 20 ANS DU GROUPE IDEC</a></li>*/ ?>
    </ul>

    <div id="tabs-1">

        <table style="margin-top:30px;">

            <!-- Convention -->
            <?php
            $participation = $usr -> selectByParticipation($event);
            ?>
            <tr>
                <th><b>Nom Prénom</b></th>
                <th class="mobile_right" style="text-align: left;"><b>Participe</b></th>
                <th class="mobile_right">&nbsp;</th>
            </tr>
            <?php
            $datas = $usr -> selectInfosListe();

            if($nomcherche != ""){
                $datas = $usr -> rechercheListe($nomcherche);
            }

            $i=1;

            foreach($datas as $data){
                echo '<tr>';

                /* Civilité, Nom, Prénom */
                echo '<th class="mobile_no">'.$data[1].' '.$data[2].' '.$data[3].'</th>';

                //Participation
                if($data[7] == 1){
                    echo '<th class="mobile_right" style="text-align: left;"><i class="fas fa-check"></i></th>';}
                else {
                    echo '<th class="mobile_right" style="text-align: left;"><i class="fas fa-minus"></i></th>';}

                echo '<th style="text-align: right; width: 110px;">';
                echo '<a href="profil.php?idColaborateur='.$data[0].'&event='.$event.'" style="text-decoration:none;" title="Paramètres du profil"><i class="fas fa-cog"></i></a>';
                echo '<a href="delete-profil.php?user='.$data[0].'&event='.$event.'&table=USERS" class="confirm3" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a>';
                echo '</th>';

                echo '</tr>';


                            }
         ?>
            <th>Total :</th>
            <th class="mobile_right" style="text-align: left;"><b><?php echo $participation; ?></b></th>
            <th class="mobile_right"></th>
	</table>

      <span class="actions" onclick="listingOnglet1()" style="cursor:pointer; color:#000;"><i class="fas
      fa-file-excel" style="font-size: 22px; margin-right: 5px;"></i> Exporter les données</span>
  </div>
 


					<ul class="actions" style="float:right;"><li><a class="button special" href="backoffice.php" style="margin-top: 20px;">RETOUR</a></li></ul>
				</div>
			</div>
		</section>

		<!-- Scripts
			<script src="assets/js/jquery.min.js"></script>-->
            <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script type="text/javascript">
				$(document).ready(function() {

					$("#add").click(function() {
						$("#ajout").css("display","block");
						$("#add").css("display","none");
					});

					$("#annuler").click(function() {
						$("#ajout").css("display","none");
						$("#add").css("display","inline-block");
						$("#messagein").css("display","none");
						$("#nom").css("border-color","#dbdbdb");
						$("#nom").val("");
					});

					$('.confirm').click(function(e) {
						e.preventDefault();
						if (window.confirm("Attention, êtes-vous sûr(e) de vouloir supprimer cette fiche principale? Cette action est irréversible et la société ainsi que tous les collaborateurs seront supprimés.")) {
							location.href = this.href;
						}
					});

                    $('.confirm3').click(function(e) {
                        e.preventDefault();
                        if (window.confirm("Attention, êtes-vous sûr(e) de vouloir supprimer cette fiche? Cette action est irréversible et toutes les données seront perdues !")) {
                            location.href = this.href;
                        }
                    });

					$('.confirm2').click(function(e) {
						e.preventDefault();
						if (window.confirm("Attention, êtes-vous sûr(e) de vouloir renvoyer le mail d'invitation ?")) {
							location.href = this.href;
						}
					});

				});
			</script>

			<script type="text/javascript">
				var clock;

					function listingOnglet1() {
					    let url = 'https://challenge-pro.fr/thelios/fr/projetExportTransfert/exportByOnglet.php?export=onglet1';
					    window.open(url)
                    }
					/*
                    function listingOnglet2() {
					    let url = 'https://les20ansdugroupeidec.com/projetExportTransfert/exportByOnglet.php?export=onglet2';
					    window.open(url)
                    }
					function listingOnglet3() {
					    let url = 'https://les20ansdugroupeidec.com/projetExportTransfert/exportByOnglet.php?export=onglet3';
					    window.open(url)
                    }
					function listingOnglet4() {
					    let url = 'https://les20ansdugroupeidec.com/projetExportTransfert/exportByOnglet.php?export=onglet4';
					    window.open(url)
                    }
                    function listingOnglet5() {
					    let url = 'https://les20ansdugroupeidec.com/projetExportTransfert/exportByOnglet.php?export=onglet5';
					    window.open(url)
                    }
                    function listingOnglet6() {
					    let url = 'https://les20ansdugroupeidec.com/projetExportTransfert/exportByOnglet.php?export=onglet6';
					    window.open(url)
                    }*/


				$(document).ready(function() {

					$("#add").click(function() {
						$("#ajout").css("display","block");
						$("#add").css("display","none");
					});

					$("#fermervalid").click(function() {
						$("#messageok").css("display","none");
					});

					$("#annuler").click(function() {
						$("#ajout").css("display","none");
						$("#add").css("display","inline-block");
						$("#messagein").css("display","none");
						$("#monsieur2").css("color","#9a9a9a");
						$("#madame2").css("color","#9a9a9a");
						$("#mademoiselle2").css("color","#9a9a9a");
						$("#monsieur").prop('checked', false);
						$("#madame").prop('checked', false);
						$("#mademoiselle").prop('checked', false);
						$("#nom").css("border-color","#dbdbdb");
						$("#nom").val("");
						$("#prenom").css("border-color","#dbdbdb");
						$("#prenom").val("");
						$("#email").css("border-color","#dbdbdb");
						$("#email").val("");
						$("#societe").css("border-color","#dbdbdb");
						$("#societe").val("");
						$("#code").css("border-color","#dbdbdb");
						$("#code").val("");
					});

					// Grab the current date
					var currentDate = new Date();

					// Set some date in the future. In this case, it's always Jan 1
					var futureDate  = new Date(2019,9,10);

					// Calculate the difference in seconds between the future and current date
					var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;
                    if (diff == 0 | diff < 0) {
                        diff = 0;
                    }

					// Instantiate a coutdown FlipClock
					clock = $('.clock').FlipClock(diff, {
						clockFace: 'DailyCounter',
						countdown: true
					});

					$('.confirm').click(function(e) {
						e.preventDefault();
						if (window.confirm("Attention, êtes-vous sûr(e) de vouloir supprimer ce profil ?")) {
							location.href = this.href;
						}
					});

					$('.confirm2').click(function(e) {
						e.preventDefault();
						if (window.confirm("Attention, êtes-vous sûr(e) de vouloir renvoyer le mail d'invitation ?")) {
							location.href = this.href;
						}
					});


				});



</script>

	</body>
</html>
