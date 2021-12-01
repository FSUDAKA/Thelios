<?php

include 'connect_contact.php';

require_once './class/User.php';

$usr = new User();
$error = "";


if($_SESSION["id"] != ""){
	$data = $usr->findOneById($_SESSION['id']);
	$societe_infos = $usr->findSociete($_SESSION['societe_id']);
	$data2 = $usr->findOneById($dataGeneral['PAR']);
}


if($data["FIRST_CO"] == 0){
    $data = "";
    $societe_infos = "";
}

if($dataGeneral["OPT_CONTACT"] != 1){header("Location: accueil.php$eventurl");}

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['valider'])){

	if (($_POST['name'] != "") && ($_POST['societe'] != "") && ($_POST['mobile'] != "") && ($_POST['email'] != "") && ($_POST['category'] != "") && ($_POST['message'] != "")){

		$name = $_POST["name"];
		$societe = $_POST["societe"];
		$mobile = $_POST["mobile"];
		$email = $_POST["email"];
		$category = $_POST["category"];
		$message = $_POST["message"];
        
        if($dataEvt['MAIL_CONTACT'] != ""){
            $destinataire = $dataEvt['MAIL_CONTACT'];
        }else{
            $destinataire = $data2['EMAIL'];
        }

		$objet    = "Les 20 ans du groupe IDEC - Contact : ".$category;

                    $email = $destinataire;
		            $mail = $_POST["email"];
                    $objet = $objet;
                    $titre = $objet;
                    $texte = '<strong>Un nouveau message depuis le formulaire de contact a été envoyé :</strong><br><br>';
                    $texte .= '<strong>Nom : </strong>'.$name.'<br><strong>Société : </strong>'.$societe.'<br><strong>Mobile : </strong>'.$mobile.'<br><strong>E-mail : </strong>'.$mail.'<br><br>';
                    $texte .= '<strong>Sujet : </strong>'.$category.'<br><br>'.$message.'<strong>';
                    $texte .= '<strong>Pour accéder au site des 20 ans du Groupe IDEC :</strong> <a href="https://www.les20ansdugroupeidec.com" target="_blank">www.les20ansdugroupeidec.com</a>';

                  include('class/Email.php');
        
		$error = "Votre message a bien été envoyé, vous recevrez une réponse prochainement.";
		$color = "#093";
        
		$category = "";
		$message = "";
		$email = $_POST["email"];
        
	}else{
		$name = $_POST['name'];
		$societe = $_POST['societe'];
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		$category = $_POST['category'];
		$message = $_POST['message'];
		$error = "Attention, merci de remplir tous les champs.";
		$color = "#FF0000";
            
            if($_POST['name'] == ""){echo '<style>input[name="name"] {border-color: #FF0000 !important;}</style>';}
            if($_POST['societe'] == ""){echo '<style>input[name="societe"] {border-color: #FF0000 !important;}</style>';}
            if($_POST['mobile'] == ""){echo '<style>input[name="mobile"] {border-color: #FF0000 !important;}</style>';}
            if($_POST['email'] == ""){echo '<style>input[name="email"] {border-color: #FF0000 !important;}</style>';}
            if($_POST['category'] == ""){echo '<style>input[name="category"] {border-color: #FF0000 !important;}</style>';}
            if($_POST['message'] == ""){echo '<style>textarea[name="message"] {border-color: #FF0000 !important;}</style>';}
	}
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Contactez-nous - <?php echo $dataGeneral['NOM']; ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/flipclock.css">
		<link rel="icon" href="images/favicon.ico" type="image/png">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet"> 
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

		<!-- Banner -->
			<section id="banner" style="background: url(images/1/banner-accueil.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;">
				<div class="inner">
					<header>
						<h1>Contactez-nous</h1><br>
						<h3 style="text-shadow: 0 0 10px black;"><?php echo $dataEvt['TXT_CONTACT_ST']; ?></h3>
					</header>
				</div>
			</section>


		<!-- Three -->
			<section id="one" class="wrapper align-center">
                <div class="inner">
                    
                    

                    

                    <?php if ($error != "") { ?>
                        <div class="box" style="border-color:<?php echo $color; ?>;">
                            <p style="color:<?php echo $color; ?>;"><?php echo $error; ?></p>
                        </div>
                    <?php
                    unset($error);
                    } ?>

                    <form method="post">
                        <div class="row uniform">
                            <div class="6u 12u$(xsmall)">
                                <!--  todo a verifier -->
                                <input type="text" name="name" id="name" value="<?php if(isset($name)){echo $name;}else{if(($data['NOM'] == "") || ($data['PRENOM'] == "")){}else{echo $data['PRENOM'] . " " . $data['NOM'];}} ?>" placeholder="Nom">
                            </div>
                            <div class="6u$ 12u$(xsmall)">
                                <input type="text" name="societe" id="societe" value="<?php if(isset($societe)){echo $societe;}else{echo $societe_infos[0];} ?>" placeholder="Société">
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <input type="text" name="mobile" id="mobile" value="<?php if(isset($mobile)){echo $mobile;}else{echo $data['MOBILE'];} ?>" placeholder="Téléphone">
                            </div>
                            <div class="6u$ 12u$(xsmall)">
                                <input type="email" name="email" id="email" value="<?php if(isset($email)){echo $email;}else{echo $data['EMAIL'];} ?>" placeholder="E-mail">
                            </div>
                            <!-- Break -->
                            <div class="12u$ 12u$(xsmall)">
                                <input type="text" name="category" id="category" value="<?php if(isset($category)){echo $category;} ?>" placeholder="Sujet">
                            </div>
                            <!-- Break -->
                            <div class="12u$">
                                <textarea name="message" id="message" placeholder="Votre message" rows="6"><?php if(isset($message)){echo $message;} ?></textarea>
                            </div>
                            <!-- Break -->
                            <div class="12u$">
                                <ul class="actions">
                                    <li><input type="submit" value="Envoyez votre message" class="special" name="valider"></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                        
                        
                </div>
			</section>

		<!-- Footer -->
        
        
        <section id="ten" class="wrapper align-center bloclock" style="">
         
        
				<div class="inner">

					<h3></h3>
                    <h2 id="content" style="">Compte à rebours</h2>


					<div class="clock"></div>

				</div>
            
        </section>
			<?php include 'footer.php'; ?>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script src="assets/js/flipclock.min.js"></script>
			<script type="text/javascript">
				var clock;

				$(document).ready(function() {
					
					// Grab the current date
					var currentDate = new Date();

					// Set some date in the future. In this case, it's always Jan 1
        var futureDate  = new Date(2021,08,3);
	
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
				});
			</script>


	</body>
</html>
