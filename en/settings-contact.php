<?php include 'connect-backoffice.php';

require_once './class/sContact.php';
require_once './class/User.php';
require_once './class/Event.php';

$contact = new sContact();
$evt     = new Event();
$usr     = new User();

$error = "";
$event = $_GET["event"];

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['valider'])){

	$nomOrigine = $_FILES['PIC_CONTACT']['name'];
	$elementsChemin = pathinfo($nomOrigine);
	$extensionFichier = $elementsChemin['extension'];
	$extensionsAutorisees = array("jpeg", "jpg", "gif", "png");
    $nomOrigine2 = "banner-contact.".$extensionFichier;
	if (!(in_array($extensionFichier, $extensionsAutorisees))) {
	} else {
        
        $dossierimage = "images/".$event;
        if (!file_exists($dossierimage)) {
            mkdir($dossierimage, 0777, true);
        }
        
		$repertoireDestination = dirname(__FILE__)."/".$dossierimage."/";
		$nomDestination = $nomOrigine2;

        unlink(dirname(__FILE__)."/".$dossierimage."/" . $_POST[$oldnamepicture]);

		if (move_uploaded_file($_FILES["PIC_CONTACT"]["tmp_name"],$repertoireDestination.$nomDestination)) {


			$contact->setPicContact($nomDestination, $event);
		}
	}
    
    $TXT_CONTACT_ST = $_POST['TXT_CONTACT_ST'];
    $MAIL_CONTACT = $_POST['MAIL_CONTACT'];

	$contact->addContact($TXT_CONTACT_ST, $MAIL_CONTACT, $event);

    $error = "Les informations ont bien été mises à jour.";
    $color = "#28a745";
    $valid = "0";


}
$eventNom = $evt->getNameById($event);
$data = $contact->findAllById($event);
$data1 = $usr->findOneById($_SESSION['id']);


if($data1['STATUT'] == 1){
    header('Location: backoffice.php');
}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Paramètres - <?php echo $eventNom['NOM'] ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
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

		<!-- Three -->
			<section id="one" class="wrapper align-center" style="margin-top: 40px;">
				<div class="inner">

					<div class="row uniform">

						<div class="9u 12u$(small)" style="width: 100%">

							<h2 id="content" style="color:#f99f1b;">Paramètres - <?php echo $eventNom['NOM'] ?></h2>

                            <?php if (($error != "") && ($valid == "0")) { ?>
                                <div class="box" id="messagein" style="border-color:<?php echo $color; ?>; margin-top: 2em;">
                                    <p style="color:<?php echo $color; ?>;"><?php echo $error; ?></p>
                                </div>
                            <?php } ?>

							<table style="margin-top:30px;">
                                <thead>
                                    <tr>
                                        <th>Page contactez-nous</th>
                                        <th style="text-align: right;"><a data-fancybox data-type="iframe" data-src="contactez-nous.php?event=<?php echo $event; ?>&view=admin" href="javascript:;" style="text-decoration:none;"><i class="fas fa-eye"></i></a></th>
                                    </tr>
                                </thead>
                            </table>
                            
                            <form method="post" action="settings-contact.php?event=<?php echo $event; ?>" enctype="multipart/form-data">
                                <div class="row uniform">
                                    <div class="12u$ 12u$(xsmall)">
                                        <div class="fakeinput">Bannière :
                                            <input id="PIC_CONTACT" name="PIC_CONTACT" type="file" onchange="displayContent(event, 0, 0)" class="fake-btn">
                                            <input type="button" class="real-button" onclick="document.getElementById('PIC_CONTACT').click()" value="choisir une photo">
                                            <p class="out-0-0"></p>
                                            <?php if($data["PIC_CONTACT"] != ""){
                                                echo'
                                                    <a href="delete.php?picture='.$data['PIC_CONTACT'].'&url=settings-contact.php&event='.$event.'&jour=PIC_CONTACT&table=contact" class="confirm" style="text-decoration:none; float:right; margin-left: 10px;" title="Supprimer">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <a data-fancybox="images" href="images/'.$event.'/'.$data["PIC_CONTACT"].'" style="text-decoration:none; float:right;" title="Voir la photo">
                                                        <div class="miniature" style="background: url(images/'.$event.'/'.$data["PIC_CONTACT"].')"></div>
                                                    </a>';
                                            } ?>
                                        </div>
                                        <input type="hidden" id="OLD_PIC_CONTACT" name="OLD_PIC_CONTACT" value="<?php echo $data['PIC_CONTACT']; ?>">
                                    </div>
                                    <div class="12u$ 12u$(xsmall)">
                                        <input type="text" name="TXT_CONTACT_ST" id="TXT_CONTACT_ST" value="<?php echo $data['TXT_CONTACT_ST']; ?>" placeholder="Sous-titre">
                                    </div>
                                    <div class="12u$ 12u$(xsmall)">
                                        <input type="text" name="MAIL_CONTACT" id="MAIL_CONTACT" value="<?php echo $data['MAIL_CONTACT']; ?>" placeholder="E-mail destinataire">
                                    </div>
                                    <div class="12u$">
                                        <ul class="actions" style="float:left;">
                                            <li><input type="submit" value="Valider" class="special" name="valider"></li>
                                        </ul>
                                        <ul class="actions" style="float:right;"><li><a class="button special" href="settings.php?event=<?php echo $event; ?>">RETOUR</a></li></ul>
                                    </div>
                                    
                                </div>
                            </form>

						</div>

					</div>

				</div>
			</section>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
            <script>
                var displayContent = function (event, a, b) {
                    var output = document.getElementsByClassName('out-' + a + '-' + b);
                    output[0].innerHTML = event.target.files[0].name;
                }
            </script>
			<script type="text/javascript">
				$(document).ready(function() {

					$('.confirm').click(function(e) {
						e.preventDefault();
						if (window.confirm("Attention, êtes-vous sûr(e) de vouloir supprimer cette photo ?")) {
							location.href = this.href;
						}
					});

				});
			</script>

	</body>
</html>
