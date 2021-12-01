<?php

function randomPassword() {
$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$pass = array(); // Declare $pass en tableau (array)
$alphaLength = strlen($alphabet) - 1;
for ($i = 0; $i < 8; $i++) {
    $n = rand(0, $alphaLength);
    $pass[] = $alphabet[$n];
}
return implode($pass); //array en string
}

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['pass'])){
	session_start();
	$pass = $_POST["firstmdp"];

	$db = mysql_connect('localhost', 'adminidec', 'hqwvZzbDhSBt'); 
	mysql_select_db('BddIdec',$db);
    $sql = mysql_query("SELECT id FROM USERS WHERE email = '$pass'");
    
    if(mysql_num_rows($sql) >= 1){
		$sql = "SELECT * FROM USERS WHERE email ="; 
		mysql_query("SET NAMES 'utf8'");
        $req = mysql_query($sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysql_error()); 

        while($data = mysql_fetch_assoc($req)) {
		$password = $data["PASSWORD"];
		$civilite = $data["CIVILITE"];
		$nom = $data["NOM"];
		$prenom = $data["PRENOM"];
        $email = $data["EMAIL"];

        $objet    = "Bienvenue";

		$contenu = '<img src="https://convention.socoda.com/images/logo.png" style="width:150px;"><br><br><br>';
        $contenu .= "\r\n";
        if($civilite == "M."){$contenu .= "<strong>Cher ";}
        if($civilite == "Mme"){$contenu .= "<strong>Chère ";}
        if($civilite == "Mlle"){$contenu .= "<strong>Chère ";}
        $contenu .= $civilite.' '.$prenom.' '.$nom.', </strong><br><br>Voici votre mot de passe : <strong style="color:#f99f1b;">'.$PASS.'<strong>';
        $contenu .= "\r\n";

        $headers  = 'From: "'.utf8_decode("SOCODA").'" <noreply@arep.co.com>' . "\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1';
        mail($email, utf8_decode($objet), utf8_decode($contenu), $headers);
        }
	}else{
		$error = "Votre e-mail n'est pas enregistré dans la base de donnée.";
	}
}
mysqli_free_result($req);
mysqli_close();
?>
<!DOCTYPE HTML>
<html style="height:100%;">
	<head>
		<title>Mot de passe oublié ? - SOCODA</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main-login.css" />
		<link rel="icon" type="image/x-icon" media="all" href="images/favicon.ico" >
	</head>
	<body style="height:100%;">

		<!-- Banner -->
			<section id="banner" style="background-image: url('images/background.jpg'); height:100%;">
				<div id="page_connect">
					<img src="images/logo.png" style="margin-bottom:20px; width: 175px;" id="logo_home">
					<h1 style="color: white;text-shadow: 0 0 10px black;">Mot de passe oublié ?</h1>
					<div id="connexion">
						<form action="forget.php" method="post" id="forget_form">
							<input type="text" name="forgetmdp" id="forgetmdp" value="" placeholder="Votre e-mail" class="12u$" style="margin-bottom:20px; color:#1e2336;">
							<input type="submit" value="Renvoyer mon mot de passe" class="special" name="forget">
						</form>
					</div>
					<p><a href="index.php" style="color: white;text-shadow: 0 0 10px black;">Retourner sur la page de connexion</a></p>
					<?php if($error != ""){echo"<p style='background:#f99f1b; color:#000;'>".$error."</p>";} ?>
				</div>
			</section>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

	</body>
</html>