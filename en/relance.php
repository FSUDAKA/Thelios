<?php
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

$db = mysqli_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
        mysqli_select_db($db, 'BddIdec');
mysqli_query($db, "SET NAMES 'utf8'");
mysqli_query($db, "SET CHARACTER SET utf8");
mysqli_query($db, "SET SESSION collation_connection = 'utf8_unicode_ci'");

	session_start();
	$id = $_GET["user"];

	$sql2 = "UPDATE USERS SET PASSWORD= '$hash_mdp' WHERE ID = '$id'";
	$req2 = mysqli_query($db, $sql2) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($db));

	$sql = "SELECT * FROM USERS WHERE ID = '".$id."'"; 
	$req = mysqli_query($db, $sql) or die('Erreur SQL !<br>'.$sql.'<br>'.mysqli_error()); 
	while($data = mysqli_fetch_assoc($req)) {
		$password = $data["PASSWORD"];
		$civilite = $data["CIVILITE"];
		$nom = $data["NOM"];
		$prenom = $data["PRENOM"];
		$email = $data["EMAIL"];
            
            $email = $data["EMAIL"];
            $objet = 'Convention 2019 : Inscrivez-vous maintenant !';
            $titre = "Convention 2019 : Inscrivez-vous maintenant !";
            $texte = '<strong>Bonjour '.$prenom.' '.$nom.', </strong><br><br>';
            $texte .= 'Nous sommes heureux de vous accueillir sur le site de la Convention SOCODA ! <br>';
            $texte .= 'Nous vous invitons à modifier votre mot de passe lors de votre première connexion.<br><br>';
            $texte .= 'Votre identifiant est : <strong style="color:#333a85;">'. utf8_decode($email) .'</strong><br>';
            $texte .= 'Votre mot de passe provisoire est : <strong style="color:#333a85;"> '. $mdp . '</strong><br><br>';
            $texte .= '<strong>Pour accéder au site de la Convention 2020 :</strong> <a href="https://convention.socoda.fr" target="_blank">convention.socoda.fr</a><br><br>';
            $texte .= 'Cordialement,';
            $texte .= "\r\n";
            
            include('class/Email.php');
        
		$error = "L'invitation a été renvoyé, le mot de passe a été régénéré !";
    }
?>