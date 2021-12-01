<?php
include 'connect_accueil.php';
require_once './class/User.php';
$usr = new User();
$redirect = 0;
if($_GET["event"] == ""){$event = $_SESSION["event"];}else{$event = $_GET["event"];}
$eventurl = "?event=\".$event";
$errors = [];

$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$pass = array();
$alphaLength = strlen($alphabet) - 1;
for ($i = 0; $i < 8; $i++) {
    $n = rand(0, $alphaLength);
    $pass[] = $alphabet[$n];
}
$mdp = implode($pass);
$hash_mdp = sha1($mdp);


$datauser = $usr->countIdByUser("2");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['form'] == "profile"){

        if($_POST['conditions'] != 1){
	        array_push($errors, "Vous devez accepter les conditions de l'inscription aux Rencontres Fondation MAIF.");
	        $color = "#FF0000";
            if($_POST['conditions'] == ""){echo '<style>.conditions + label:before {border-color: #FF0000 !important;}</style>';}
        }

        if(($_POST['nom'] == "") OR ($_POST['prenom'] == "") OR ($_POST['mail'] == "")){
	        array_push($errors, "Tous les champs obligatoires n'ont pas été remplis dans votre profil !");
	        $color = "#FF0000";

            if($_POST['nom'] == ""){echo '<style>input[name="nom"] {border-color: #FF0000 !important;}</style>';}
            if($_POST['prenom'] == ""){echo '<style>input[name="prenom"] {border-color: #FF0000 !important;}</style>';}
            if($_POST['mail'] == ""){echo '<style>input[name="mail"] {border-color: #FF0000 !important;}</style>';}
        }
        
        if(($_POST['choix1'] == "") && ($_POST['choix3'] == "") && ($_POST['choix4'] == "") && ($_POST['choix5'] == "")){
            
	        array_push($errors, "Vous devez cocher au moins 1 case !");
	        $color = "#FF0000";
            if($_POST['choix1'] == ""){echo '<style>#choix1 + label:before {border-color: #FF0000 !important;}</style>';}
            if($_POST['choix3'] == ""){echo '<style>#choix3 + label:before {border-color: #FF0000 !important;}</style>';}
            if($_POST['choix4'] == ""){echo '<style>#choix4 + label:before {border-color: #FF0000 !important;}</style>';}
            if($_POST['choix5'] == ""){echo '<style>#choix5 + label:before {border-color: #FF0000 !important;}</style>';}
            
            
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
        

        
            if($_POST['choix1'] != "1"){$_POST['choix1'] = "0";}
            if($_POST['choix3'] != "1"){$_POST['choix3'] = "0";}
            if($_POST['choix4'] != "1"){$_POST['choix4'] = "0";}
            if($_POST['choix5'] != "1"){$_POST['choix5'] = "0";}
    
	        if(sizeof($errors) == 0){
             $usr->addUserById($_POST['civilite'], $_POST['nom'], $_POST['prenom'], $_POST['fonction'], $_POST['societe'], $_POST['tel'], $_POST['mobile'],$_POST['mail'], $_POST['conditions'], $_POST['choix1'], $_POST['choix3'], $_POST['choix4'], $_POST['choix5'], $hash_mdp);

		  
	        if($_POST['id'] == $id){


                    $email = $_POST['mail'];
                    $objet = 'Rencontres Fondation MAIF : Confirmation de participation';
                    $titre = "Rencontres Fondation MAIF : Confirmation de participation";
                    if ($_POST['civilite'] == 'M.'){
                        $texte = 'Cher '.$_POST['civilite'].' '.$_POST['prenom'].' '.$_POST['nom'].' <br>';
                    } else{
                        $texte = 'Chère '.$_POST['civilite'].' '.$_POST['prenom'].' '.$_POST['nom'].' <br>';
                    }
                    $texte .= "\r\n";
                    $texte .= 'Nous avons le plaisir de valider votre participation aux prochaines Rencontres Fondation MAIF.<br><br>';
                    $texte .= "\r\n";
                    $texte .= "Nous vous accueillerons le Mardi 24 Mars 2020 à 9h30 au Centre international de conférence de la Sorbonne Université, Campus Pierre & Marie Curie - Auditorium patio 44-45, 4 place Jussieu 75005 Paris.<br>";

                    $texte .= "\r\n";
                    $texte .= 'Retrouvez toutes les informations pratiques sur le site <a href="https://rencontresfondationmaif.fr" target="_blank">rencontresondationmaif.fr.fr</a><br><br>';
                    $texte .= "\r\n";
                    $texte .= 'Au plaisir de vous retrouver le 24 Mars 2020.<br><br>';
                    $texte .= "\r\n";
                    $texte .= 'Nous sommes disponibles pour répondre à toutes vos questions.<br><br>';
                    $texte .= "\r\n";
                    $texte .= 'Cordialement,';
                    $texte .= "\r\n";

                    include('class/Email.php');

            }   

	        if($_SESSION['event'] !== "ADMIN"){
		        if(!empty($_GET['idColaborateur'])){
			        $redirect = 1;
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
	        //$societe_infos = $societe->findOneById($_SESSION['societe_id']);
	        //$dataGeneral = $evt->findOneById($event);

	        if($_SESSION['event'] == "ADMIN"){

		        //$societe_infos = $societe->findOneById($data['SOCIETE_ID']);
	        }
                array_push($errors, "Vos informations ont bien été enregistrées !");
            $color = "#093";
                $cache = 1;
        }else{
            $data['CIVILITE'] = $_POST['civilite'];
            $data['NOM'] = $_POST['nom'];
            $data['PRENOM'] = $_POST['prenom'];
            $data['FONCTION'] = $_POST['fonction'];
            $data['MATRICULE'] = $_POST['societe'];
            $data['TEL'] = $_POST['tel'];
            $data['MOBILE'] = $_POST['mobile'];
            $data['EMAIL'] = $_POST['mail'];
            $data['PARTICIPATION'] = $_POST['participe'];
            $data['CONDITIONS'] = $_POST['conditions'];
            $data['PRESENT_REUNION1'] = $_POST['choix1'];
            $data['PRESENT_REUNION21'] = $_POST['choix3'];
            $data['PRESENT_REUNION31'] = $_POST['choix4'];
            $data['PRESENT_DINER11'] = $_POST['choix5'];
                
                
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
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i&display=swap" rel="stylesheet"> 
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


			<section id="banner" style="background: url(images/1/BANNER_5dbaa79a7ac96.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;">
				<div class="inner">
					<header>
						<h1>Inscription</h1><br>
						<h3 style="text-shadow: 0 0 10px black;">Merci de remplir les informations ci-dessous</h3>
					</header>
				</div>
			</section>



			<section id="one" class="wrapper align-center" style="padding: 5em 0 5em 0;">
                <div class="inner">
                    
                    <div class="box" style="border-color:#8a6d3b;">
                        <p style="color:#8a6d3b;">La date limite d'inscription est le vendredi 13 août !</p>
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
                
                <?php if ($datauser["totaluser"] < 200){ ?>
                
                <?php if ($cache != 1){ ?>
                <div class="inner">
                
                <h2 id="content" style="text-align: center;">INSCRIPTION à la conférence-débat du 24 mars 2020</h3>
                    
                    <center>
                    <strong style="color:#ff0000;">Mais où avons-nous la tête ?</strong><br>
                    <strong>Les approches collectives de prévention des risques à l’épreuve des comportements individuels</strong>

                    
                    </center>
                    
                    <p style="margin-top: 30px;">Madame, Monsieur,<br><br>

Nous vous remercions de l’intérêt que vous portez à cette conférence-débat.<br>
Si vous souhaitez nous adresser une demande d’invitation, merci de remplir ce formulaire.<br><br>

Si vous avez déjà reçu une invitation et souhaitez confirmer votre présence, allez sur l’onglet « Déjà inscrit » avec l’identifiant et le mot de passe notés sur l’invitation. 
</p>

                <form method="post" action="inscription.php<?php if($_GET["idColaborateur"] != ""){if($_SESSION['droit'] == 1){echo "?idColaborateur=".$_GET["idColaborateur"]."&event=".$_GET["event"];}else{echo "?idColaborateur=".$_GET["idColaborateur"];}} ?>" style="margin-top: 70px;">
                    <div class="row uniform">

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
                            <input type="text" name="societe" id=""  value="<?=$data['MATRICULE']?>" placeholder="Société">
                        </div>
                        <div class="6u$ 12u$(xsmall)">
                            <input type="text" name="fonction" id=""  value="<?=$data['FONCTION']?>" placeholder="Fonction">
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <input type="tel" name="tel" id="" value="<?=$data['TEL']?>" placeholder="Téléphone">
                        </div>
                        <div class="6u$ 12u$(xsmall)">
                            <input type="tel" name="mobile" id="" value="<?=$data['MOBILE']?>" placeholder="Mobile">
                        </div>
                        <div class="12u$ 12u$(xsmall)">
                            <input type="email" id="" name="mail" value="<?=$data['EMAIL']?>" placeholder="E-mail">
                        </div>

                        <div class="12u$ 12u$(xsmall)">
                            <hr>
                        </div>
                        
                        
                        <div class="12u$ 12u$(xsmall)" style="text-align: left;">
                            Merci de cocher les séquences auxquelles vous assisterez. Vous pouvez bien entendu assister à l’ensemble des séquences en cochant toutes les cases.
                        </div>
                        <div class="12u$ 12u$(xsmall)" style="text-align: left;">
                            <input type="checkbox" name="choix1" id="choix1" <?php if($data['PRESENT_REUNION1'] == 1){echo 'checked';}?> value="1">
                            <label for="choix1">10h - 12h30 « Le risque c’est l’autre ? Vers une montée des individualismes par abandon du récit collectif ? » - <a href="programme.php" target="_blank">Voir le programme</a></label>
                        </div>
                        <div class="12u$ 12u$(xsmall)" style="text-align: left;">
                            <input type="checkbox" name="choix3" id="choix3" <?php if($data['PRESENT_REUNION21'] == 1){echo 'checked';}?> value="1">
                            <label for="choix3">14h - 16h « Atouts et limites des nouvelles technologies pour une prévention personnalisée » - <a href="programme.php" target="_blank">Voir le programme</a></label>
                        </div>
                        <div class="12u$ 12u$(xsmall)" style="text-align: left;">
                            <input type="checkbox" name="choix4" id="choix4" <?php if($data['PRESENT_REUNION31'] == 1){echo 'checked';}?> value="1">
                            <label for="choix4">16h - 19h « Prévenir les comportements à risque : les apports des sciences cognitives et sociales » - « Progrès et Risques : quels liens ? » - <a href="programme.php" target="_blank">Voir le programme</a></label>
                        </div>
                        <div class="12u$ 12u$(xsmall)" style="text-align: left;">
                            <input type="checkbox" name="choix5" id="choix5" <?php if($data['PRESENT_DINER11'] == 1){echo 'checked';}?> value="1">
                            <label for="choix5">Je reste au cocktail apéritif</label>
                        </div>
                        

                        <div class="12u$ 12u$(xsmall)">
                            <hr>
                        </div>


                        <div class="12u$">
                                    <p style="font-size:12px !important;">
                                        Les données communiquées via ce formulaire sont collectées avec votre consentement et sont destinées à la fondation MAIF en sa qualité de responsable du traitement. Elles pourront être transmises à ses sous-traitants agissant sur strictes instructions de la fondation MAIF. Les données de ce formulaire sont collectées à des fins de gestion de la relation client à travers le site des Rencontres Fondation MAIF. Les données vous concernant sont conservées pendant 12 mois maximum après l'événement auquel vous vous inscrivez. Vous disposez de la faculté d'introduire une réclamation auprès de l’autorité de contrôle compétente ainsi qu’un droit d’accès, de rectification, d’effacement, de limitation, de portabilité et d’opposition pour motif légitime aux données personnelles vous concernant. Pour exercer ce droit, merci d'effectuer votre demande à l'adresse suivante : contact@rencontresfondationmaif.fr
                                    </p>
                                </div>

                                <center><input id="conditions" name="conditions" class="conditions" type="checkbox" value="1" <?php if($data['CONDITIONS'] == "1"){echo "checked";} ?>><label for="conditions" class="conditions">J'accepte les conditions de l'inscription aux Rencontres Fondation MAIF</label></center>

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
                <?php } ?>
                
                <?php }else{ ?>
                <div class="inner">
                    <div class="box" style="border-color:#ff0000;">
                       <p style="color:#ff0000;">Plus aucune place de disponible, les inscriptions sont closes !</p>
                    </div>
                </div>
    
                <?php } ?>
                
                
        </section>
          

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
 
                   var futureDate  = new Date(2020,03,24);

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
                if (parseInt(radioValue) !== 1){
                    $(".displayParticipe").css("display","none");
                }

                    $("#yes, #no, #test").on('change', function () {
                        radioValue = $("input[name='participe']:checked").val();
                        if (parseInt(radioValue) !== 1){
                           $(".displayParticipe").css("display","none");
                        }
                        if (parseInt(radioValue) === 1){
                            $(".displayParticipe").css("display","block");
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
