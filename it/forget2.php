<?php
require_once './class/User.php';
require_once './class/Event.php';

$evt = new Event();

if($_GET["event"] == "") {
    $event = 1;
}else{
    $event = $_GET["event"];
}

$dataGeneral = $evt->findOneById($event);

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

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['forget'])){
	session_start();
	$forget = $_POST["forgetmdp"];
	$id = $_SESSION["id"];

    require_once 'config/Database.php';

    $db = Database::getMysqli();
	$sql = mysqli_query($db, "SELECT ID FROM USERS WHERE EMAIL = '$forget'");
	
	$sql1 = "UPDATE USERS SET FIRST_CO = '0' WHERE EMAIL ='$forget'";
	$req1 = mysqli_query($db, $sql1) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($db));

	$sql2 = "UPDATE USERS SET PASSWORD= '$hash_mdp' WHERE EMAIL = '$forget'";
	$req2 = mysqli_query($db, $sql2) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($db));

	if(mysqli_num_rows($sql) >= 1){
		$sql = "SELECT * FROM USERS WHERE email = '".$forget."'"; 
		$req = mysqli_query($db, $sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysqli_error()); 
		while($data = mysqli_fetch_assoc($req)) {
			$password = $data["PASSWORD"];
			$civilite = $data["CIVILITE"];
			$nom = $data["NOM"];
			$prenom = $data["PRENOM"];
			$email = $data["EMAIL"];
            
            $email = $data["EMAIL"];
            $objet = 'Thélios Spring Convention 2021 - Modifica delle informazioni';
            $titre = "Modifica delle informazioni";
            $texte .= '<strong>Buongiorno '.$prenom.' '.$nom.', </strong><br><br>Hai richiesto di recuperare la tua password.<br>Ecco una nuova password : <strong style="color:#000;">'.$mdp.'</strong><br><br>';
            $texte .= "\r\n";
             
            include('class/Email.php');
			$error = "La tua password è stata appena inviata alla tua e-mail.";
		}
	}else{
		$error = "La tua e-mail non è stata salvata nel database.";
	}
mysqli_free_result($req);
mysqli_close($db);
}
?>
<!DOCTYPE HTML>
<html style="height:100%;">
	<head>
		<title>Hai dimenticato la password ? - Thélios Spring Convention 2021</title>
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
					<img src="images/logo.png" style="margin-bottom:20px;" id="logo_home">
					<h1 style="color: #000;">Hai dimenticato la password ?</h1>
					<div id="connexion">
						<form action="forget.php" method="post" id="forget_form">
							<input type="text" name="forgetmdp" id="forgetmdp" value="" placeholder="Email" class="12u$" style="margin-bottom:20px; color:#1e2336;">
							<input type="submit" value="Reinvia la mia password" class="special" name="forget">
						</form>
					</div>
					<p><a href="login.php" style="color: #000;">Torna alla pagina di accesso</a></p>
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