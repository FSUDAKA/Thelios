<?php
session_start();
require_once './class/User.php';
require_once './class/Model.php';

require_once './class/Event.php';

$evt = new Event();

if($_GET["event"] == "") {
    $event = 1;
}else{
    $event = $_GET["event"];
}

$usr   = new User();
$error = "";

if($_SESSION['id'] == ""){
    header('Location: login.php');
}

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['confirm'])){
	session_start();

	$newpassword = sha1($_POST['npwd']);
	$confirmpassword = sha1($_POST['cpwd']);

	$id = $_SESSION["id"];
	$oldpass = $usr->selectPassById($id);

	if($newpassword == $confirmpassword) {
	
$longueurmdp = iconv_strlen($_POST['npwd']);
if($longueurmdp !=40) {

		if($newpassword !=$oldpass[0]) {
			$data1 = $usr->updateUsersByNewPass($newpassword, $id);
			$data2 = $usr->updateFirstcoById($id);
            $data = $usr->findOneById($id);

                    $email = $data['EMAIL'];
                    $objet = 'Thélios Spring Convention 2021 - Modifica della password';
                    $titre = "Modifica della password";
                    $texte = '<strong>Buongiorno '.$data['PRENOM'].' '.$data['NOM'].', </strong><br><br>';
                    $texte .= 'La tua password è stata cambiata con successo.  <br>';
                    $texte .= 'Se non sei all\'origine di questa modifica, ti preghiamo di contattarci.';
                    $texte .= "\r\n";

                    include('class/Email.php');
            
			header("Location: profil.php");
		}
		else {$error = "La password deve essere diversa da quella vecchia. ".$longueurmdp;}
   	
   	}

else {$error = "La password è troppo piccola. ".$longueurmdp;}



  	}



   	else{$error = "Le password non sono le stesse. ".$longueurmdp;}  
}
?>

<!DOCTYPE HTML>
<html style="height:100%;">
	<head>
		<title>Cambia la password - Thélios Spring Convention 2021</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main-login.css" />
		  <link rel="icon" href="images/favicon.ico" type="image/png">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	</head>
	<body style="height:100%;">

		<!-- Banner -->
			<section id="banner" style="height:100%;">
				<div id="page_connect">
					<img src="images/logo.png" style="margin-bottom:20px;" id="logo_home">
					<h1 style="color: white;text-shadow: 0 0 10px black;">Cambia la password</h1>
					<div id="confirm">
						<form action="first-login.php" method="post" id="connect_form">
							<input type="password" name="npwd" id="npwd" value="" placeholder="Nuova password" class="12u$" style="margin-bottom:20px; color:#1e2336;" minlength="8" required>
							<input type="password" name="cpwd" id="cpwd" value="" placeholder="Ripeti password" class="12u$" style="margin-bottom:20px; color:#1e2336;" minlength="8" required>
							<input type="submit" value="Per confermare" class="special" name="confirm">
						</form>
					</div>
					
					<?php if($error != ""){echo"<p style='background:#333a85; color:#fff;'>".$error."</p>";} ?>
				</div>
			</section>
        
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>
