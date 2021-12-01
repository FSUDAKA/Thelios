<?php

require_once './class/User.php';
require_once './class/Model.php';
require_once './class/Societe.php';
require_once './class/Event.php';
 
$usr   = new User();
$societe = new Societe();
$evt = new Event();
$error = "";

if($_GET["event"] == "") {
    $event = 1;
}else{
    $event = $_GET["event"];
}

$dataGeneral = $evt->findOneById($event);

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['connexion'])){
	session_start();
	$mail = $_POST["email"];
	$password = sha1($_POST["connect"]);

	$data = $usr->selectLogUser($mail, $password);
	//$data = $usr->selectByEmail($mail);

	if($data['PASSWORD'] == $password){
		date_default_timezone_set('Europe/Paris');
				$event = $data["GROUPE"];
				$id = $data["ID"];
				$droit = $data["DROIT"];
				$first_co = $data["FIRST_CO"];
				$is_valid = $data["IS_VALID"];
            	$is_principal = $data["IS_PRIVILEGIE"];
            	
            	$_SESSION["event"] = $event;
            	$_SESSION["id"] = $id;
				$_SESSION["droit"] = $droit;
				$_SESSION["first_co"] = $first_co;
				$_SESSION["is_valid"] = $is_valid;
				$_SESSION['societe_id'] = $data['SOCIETE_ID'];
				
				/*echo 'id : '.$id.'Droit: '.$droit;
				echo 'id : '.$id.'Valide: '.$is_valid.' First: '.$first_co;*/

    $usr->updateConnexionById($id);
    
    // Si compte Admin 
    if($droit == 1){ header("Location: backoffice.php");}
        else{
           if($is_valid == 1){ 

    	     if($is_principal ==1) {
    	       if($first_co != 1){ header("Location: first-login.php");}
               else{ header("Location: profil.php");}
  			 }
    	   else {
                          // Si Collaborateur validé, on vérifié si société valide et pas refusée
                          $soc = $societe->findOneById($data['SOCIETE_ID']);
                          if($soc["VALIDE"] != 1){$error = "Votre société n'a pas validé sa fiche d'inscription";}
                          else {
                           	if($soc["VALIDE"] == 2){$error = "Votre société a décliné sa participation";}	

                           	 else {
                                  if($first_co != 1){ header("Location: first-login.php");}
                                  else{ header("Location: profil.php");}
                              	   }//Fin REFUS

                          }//Fin societe valide
                         // $error = 'PRINCIPAL: '.$is_principal.'- ID SOC : '.$soc["ID"].' NOM: '.$soc["NOM"].'REFUS: '.$soc["REFUS"].'VALIDE:'.$soc["VALIDE"];
			  }//Fin principal ==1
	        } //Fin valide ==1


	       else{$error = "Votre compte n'est pas validé. Contactez le webmaster du site!";}	
			}
}	
else{$error = "La combinaison identifiant / mot de passe est incorrecte !";}


}


?>
<!DOCTYPE HTML>
<html style="height:100%;">
	<head>
		<title>Connexion - Thélios Spring Convention 2021</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main-login.css" />
		 <link rel="icon" href="images/favicon.ico" type="image/png">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

	</head>
	<body style="height:100%;">

		<!-- Banner -->
			<section id="banner" style="background-image: url('images/bg_black.jpg'); height:100%;">
				<div id="page_connect">
					<img src="images/logo.png" style="margin-bottom:20px; width: 175px;" id="logo_home">
					<div id="connexion">
						<form action="login.php" method="post" id="connect_form">
							<input type="text" name="email" id="email" value="" placeholder="Email" class="12u$" style="margin-bottom:20px; color:#1e2336;">
							<input type="password" name="connect" id="connect" value="" placeholder="Mot de passe" class="12u$" style="margin-bottom:20px; color:#1e2336;">
							<input type="submit" value="Connexion" class="special" name="connexion">
						</form>
					</div>
					<p><a href="forget.php" style="color: #000;">Mot de passe oublié ?</a></p>
					<?php if($error != ""){echo"<p style='background:#ff0000; color:#fff;'>".$error."</p>";} ?>
				</div>
			</section>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
