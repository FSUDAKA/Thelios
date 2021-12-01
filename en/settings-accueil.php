<?php

include 'connect-backoffice.php';
require_once './class/sAccueil.php';

$event = $_GET["event"];

$error = "";
require_once './class/sAccueil.php';
require_once './class/User.php';

$Saccueil = new sAccueil();
$user     = new User();
$eventNom = $Saccueil->findNomById($event);
$data     = $Saccueil->findAllById($event);
$data1    = $user->findOneById($_SESSION['id']);

if (($_SERVER['REQUEST_METHOD'] == 'POST')){

	$nomOrigine = $_FILES['PIC_ACCUEIL']['name'];
	$elementsChemin = pathinfo($nomOrigine);
	$extensionFichier = $elementsChemin['extension'];
	$extensionsAutorisees = array("jpeg", "jpg", "gif", "png");
    $nomOrigine2 = "banner-accueil.".$extensionFichier;
	if (!(in_array($extensionFichier, $extensionsAutorisees))) {
	} else {

        $dossierimage = "images/".$event;
        if (!file_exists($dossierimage)) {
            mkdir($dossierimage, 0777, true);
        }

		$repertoireDestination = dirname(__FILE__)."/".$dossierimage."/";
		$nomDestination = $nomOrigine2;

        unlink(dirname(__FILE__)."/".$dossierimage."/" . $_POST["OLD_PIC_ACCUEIL"]);

		if (move_uploaded_file($_FILES["PIC_ACCUEIL"]["tmp_name"],$repertoireDestination.$nomDestination)) {
			$Saccueil->setPicAccueil($nomDestination, $event);
		}
	}

    $TXT_ACCUEIL_ST = $_POST['TXT_ACCUEIL_ST'];
    $TXT_ACCUEIL_T_EDITO = $_POST['TXT_ACCUEIL_T_EDITO'];
    $TXT_ACCUEIL_EDITO = $_POST['TXT_ACCUEIL_EDITO'];
    $TITRE_BLOCS = $_POST['TITRE_BLOCS'];


    date_default_timezone_set('Europe/Paris');

	$Saccueil->updateTXT($TXT_ACCUEIL_ST, $TXT_ACCUEIL_T_EDITO, $TXT_ACCUEIL_EDITO, $TITRE_BLOCS, $event);

	$error = "Les informations ont bien été mises à jour.";
    $color = "#28a745";
    $valid = "0";




   if ($_POST['NB_SLIDES']!=""){
    $NB_SLIDES = $_POST['NB_SLIDES'];

    for ($i = 1; $i <= $NB_SLIDES; $i++) {

        $namepicture = "SLIDER_".$i;
        $namebase = "SLIDER_".$i;
        $oldnamepicture = "OLD_PIC_SLIDE_".$i;
        $nomOrigine = $_FILES[$namepicture]['name'];
        $elementsChemin = pathinfo($nomOrigine);
        $extensionFichier = $elementsChemin['extension'];
        $extensionsAutorisees = array("jpeg", "jpg", "gif", "png");
        $nomOrigine2 = "SLIDER_".$i.".".$extensionFichier;
        if (!(in_array($extensionFichier, $extensionsAutorisees))) {
        } else {

            $dossierimage = "images/".$event;
            if (!file_exists($dossierimage)) {
                mkdir($dossierimage, 0777, true);
            }

            $repertoireDestination = dirname(__FILE__)."/".$dossierimage."/";
            $nomDestination = $nomOrigine2;

            unlink(dirname(__FILE__)."/".$dossierimage."/" . $_POST[$oldnamepicture]);

            if (move_uploaded_file($_FILES[$namepicture]["tmp_name"],$repertoireDestination.$nomDestination)) {

                $db = mysqli_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
                mysqli_select_db($db, 'BddIdec');
                $sql = "UPDATE `SITE_ACCUEIL` SET $namebase='".mysqli_real_escape_string($db, utf8_decode($nomDestination))."' WHERE `EVENT_ID` = '".$event."'";
                $req = mysqli_query($db, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($db));
                $data = mysqli_fetch_array($req);
                mysqli_free_result($req);
                mysqli_close($db);

            }
        }

        $db = mysqli_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
        mysqli_select_db($db, 'BddIdec');
        $sql = "UPDATE `SITE_ACCUEIL` SET NB_SLIDES = " . $NB_SLIDES . " WHERE EVENT_ID = ".$event;
        $req = mysqli_query($db, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($db));
        $data = mysqli_fetch_array($req);
        mysqli_free_result($req);
        mysqli_close($db);
    }
    }





   if ($_POST['NB_BLOCS']!=""){
    $NB_BLOCS = $_POST['NB_BLOCS'];

    for ($i = 1; $i <= $NB_BLOCS; $i++) {

        $namepicture = "PIC_".$i;
        $namebase = "PIC_".$i;
        $oldnamepicture = "OLD_PIC_BLOC_".$i;
        $nomOrigine = $_FILES[$namepicture]['name'];
        $elementsChemin = pathinfo($nomOrigine);
        $extensionFichier = $elementsChemin['extension'];
        $extensionsAutorisees = array("jpeg", "jpg", "gif", "png");
        $nomOrigine2 = "PIC_".$i.".".$extensionFichier;
        if (!(in_array($extensionFichier, $extensionsAutorisees))) {
        } else {

            $dossierimage = "images/".$event;
            if (!file_exists($dossierimage)) {
                mkdir($dossierimage, 0777, true);
            }

            $repertoireDestination = dirname(__FILE__)."/".$dossierimage."/";
            $nomDestination = $nomOrigine2;

            unlink(dirname(__FILE__)."/".$dossierimage."/" . $_POST[$oldnamepicture]);

            if (move_uploaded_file($_FILES[$namepicture]["tmp_name"],$repertoireDestination.$nomDestination)) {

               $db = mysqli_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
        mysqli_select_db($db, 'BddIdec');
                $sql = "UPDATE `SITE_ACCUEIL` SET $namebase='".mysqli_real_escape_string($db, utf8_decode($nomDestination))."' WHERE `EVENT_ID` = '".$event."'";
                $req = mysqli_query($db, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error($db));
                $data = mysqli_fetch_array($req);
                mysqli_free_result($req);
                mysqli_close($db);

            }
        }
        $TITRE = "TITRE_".$i;
        $TITRE_CONTENT = $_POST['TITRE_'.$i];
        $TXT = "TXT_".$i;
        $TXT_CONTENT = $_POST['TXT_'.$i];


        $data = $Saccueil->updateCaroussel($NB_BLOCS, $TITRE, $TITRE_CONTENT, $TXT, $TXT_CONTENT, $event);
        }
    }

}


$eventNom = $Saccueil->findNomById($event);
$data     = $Saccueil->findAllById($event);
$data1    = $user->findOneById($_SESSION['id']);


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
		<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
 		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/flipclock.css">
		<link rel="icon" href="images/favicon.ico" type="image/png">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
        <style>.bloc1,.bloc2,.bloc3,.bloc4,.bloc5,.bloc6,.bloc7,.bloc8,.bloc9{display: none;}
        .slide1,.slide2,.slide3,.slide4,.slide5,.slide6{display: none;}</style>
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
                                        <th>Page accueil</th>
                                        <th style="text-align: right;"><a data-fancybox data-type="iframe" data-src="accueil.php?event=<?php echo $event; ?>&view=admin" href="javascript:;" style="text-decoration:none;"><i class="fas fa-eye"></i></a></th>
                                    </tr>
                                </thead>
                            </table>

                            <form method="post" action="settings-accueil.php?event=<?php echo $event; ?>" enctype="multipart/form-data">
                                <div class="row uniform">
                                    <div class="12u$ 12u$(xsmall)">
                                        <div class="fakeinput">Bannière :
                                            <input id="PIC_ACCUEIL" name="PIC_ACCUEIL" type="file" onchange="displayContent(event,0,0)" class="fake-btn">
                                            <input type="button" onclick="document.getElementById('PIC_ACCUEIL').click()" class="real-button" value="choisir une photo">
                                            <p class="output out-0-0"></p>
                                            <?php if($data["PIC_ACCUEIL"] != ""){
                                                echo'
                                                    <a href="delete.php?picture='.$data['PIC_ACCUEIL'].'&url=settings-accueil.php&event='.$event.'&jour=PIC_ACCUEIL&table=accueil" class="confirm" style="text-decoration:none; float:right; margin-left: 10px;" title="Supprimer">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                    <a data-fancybox="images" href="images/'.$event.'/'.$data["PIC_ACCUEIL"].'" style="text-decoration:none; float:right;" title="Voir la photo">
                                                        <div class="miniature" style="background: url(images/'.$event.'/'.$data["PIC_ACCUEIL"].')"></div>
                                                    </a>';
                                            } ?>
                                        </div>
                                        <input type="hidden" id="OLD_PIC_ACCUEIL" name="OLD_PIC_ACCUEIL" value="<?php echo $data['PIC_ACCUEIL']; ?>">
                                    </div>
                                    <div class="12u$ 12u$(xsmall)">
                                        <input type="text" name="TXT_ACCUEIL_ST" id="TXT_ACCUEIL_ST" value="<?php echo $data['TXT_ACCUEIL_ST']; ?>" placeholder="Sous-titre">
                                    </div>
                                    <div class="12u$ 12u$(xsmall)">
                                        <input type="text" name="TXT_ACCUEIL_T_EDITO" id="TXT_ACCUEIL_T_EDITO" value="<?php echo $data['TXT_ACCUEIL_T_EDITO']; ?>" placeholder="Chapeau">
                                    </div>
                                    <div class="12u$">
                                        <textarea name="TXT_ACCUEIL_EDITO" class="summernote" id="TXT_ACCUEIL_EDITO" placeholder="Edito" rows="6"><?php echo $data['TXT_ACCUEIL_EDITO']; ?></textarea>
                                    </div>





                                  <?php    if (isset($_POST['NB_SLIDES'])){
    $NB_SLIDES = $_POST['NB_SLIDES']; }else{

        $data = $Saccueil->findAllById($event);

        $NB_SLIDES = $data['NB_SLIDES'];

      }?>

                                   <div class="12u$ 12u$(xsmall)">

							<table style="margin-top:30px;">
                                <thead>
                                    <tr>
                                        <th>Slider</th>
                                    </tr>
                                </thead>
                            </table>


                                            <select name="NB_SLIDES" id="NB_SLIDES">
										    <option id="Slide0" value="0" <?php if($NB_SLIDES == "0"){echo "selected";} ?>>Nombre de slides</option>
										    <option id="Slide1" value="1" <?php if($NB_SLIDES == "1"){echo "selected";} ?>>1 slide</option>
										    <option id="Slide2" value="2" <?php if($NB_SLIDES == "2"){echo "selected";} ?>>2 slides</option>
										    <option id="Slide3" value="3" <?php if($NB_SLIDES == "3"){echo "selected";} ?>>3 slides</option>
										    <option id="Slide4" value="4" <?php if($NB_SLIDES == "4"){echo "selected";} ?>>4 slides</option>
										    <option id="Slide5" value="5" <?php if($NB_SLIDES == "5"){echo "selected";} ?>>5 slides</option>
										    <option id="Slide6" value="6" <?php if($NB_SLIDES == "6"){echo "selected";} ?>>6 slides</option>
                                        </select>
                                    </div>


                                     <?php for ($i = 1; $i <= 6; $i++) {
                                    $PIC = "SLIDER_".$i;
                                    ?>
                                    <div class="4u<?php if($i % 3 == 0){echo '$';} ?> 12u$(medium) slide<?php echo $i; ?>" <?php if($NB_SLIDES >= $i){echo "style='display:block;'";} ?>>
                                        <div class="row uniform">
                                            <div class="12u$ 12u$(xsmall)" style="padding-top: 0;">
                                                <div class="separator">Slide <?php echo $i; ?></div>
                                            </div>
                                            <div class="12u$ 12u$(xsmall)">
                                                <div class="fakeinput">Image :
                                                    <input id="<?php echo $PIC; ?>" name="<?php echo $PIC; ?>" type="file" onchange="displayContent(event, 2, <?=$i?>)" class="fake-btn">
                                                    <input type="button" style="width: calc(100% - 120px);" value="choisir une photo" class="real-button" onclick="document.getElementById('<?php echo $PIC; ?>').click()">
                                                    <p class="out-2-<?=$i?>"></p>
                                                    <?php if($data[$PIC] != ""){
                                                        echo'
                                                            <a href="delete.php?picture='.$data[$PIC].'&url=settings-accueil.php&event='.$event.'&jour=SLIDER_'.$i.'&table=accueil" class="confirm" style="text-decoration:none; float:right; margin-left: 10px;" title="Supprimer">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                            <a data-fancybox="images_J'.$i.'" href="images/'.$event.'/'.$data[$PIC].'" style="text-decoration:none; float:right;" title="Voir la photo">
                                                                <div class="miniature" style="background: url(images/'.$event.'/'.$data[$PIC].')"></div>
                                                            </a>';
                                                    } ?>
                                                </div>
                                                <input type="hidden" id="OLD_PIC_SLIDE_<?php echo $i; ?>" name="OLD_PIC_SLIDE_<?php echo $i; ?>" value="<?php echo $data[$PIC]; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>








                                  <?php    if (isset($_POST['NB_BLOCS'])){
    $NB_BLOCS = $_POST['NB_BLOCS']; }else{


$data = $Saccueil->findAllById($event);

        $NB_BLOCS = $data['NB_BLOCS'];

      }?>




                                    <div class="12u$ 12u$(xsmall)">
                                        <input type="text" name="TITRE_BLOCS" id="TITRE_BLOCS" value="<?php echo $data['TITRE_BLOCS']; ?>" placeholder="Titre des blocs">
                                    </div>

                                   <div class="12u$ 12u$(xsmall)">

							<table style="margin-top:30px;">
                                <thead>
                                    <tr>
                                        <th>Blocs</th>
                                    </tr>
                                </thead>
                            </table>


                                            <select name="NB_BLOCS" id="NB_BLOCS">
										    <option id="Bloc0" value="0" <?php if($NB_BLOCS == "0"){echo "selected";} ?>>Nombre de blocs</option>
										    <option id="Bloc1" value="1" <?php if($NB_BLOCS == "1"){echo "selected";} ?>>1 bloc</option>
										    <option id="Bloc2" value="2" <?php if($NB_BLOCS == "2"){echo "selected";} ?>>2 blocs</option>
										    <option id="Bloc3" value="3" <?php if($NB_BLOCS == "3"){echo "selected";} ?>>3 blocs</option>
										    <option id="Bloc4" value="4" <?php if($NB_BLOCS == "4"){echo "selected";} ?>>4 blocs</option>
										    <option id="Bloc5" value="5" <?php if($NB_BLOCS == "5"){echo "selected";} ?>>5 blocs</option>
										    <option id="Bloc6" value="6" <?php if($NB_BLOCS == "6"){echo "selected";} ?>>6 blocs</option>
										    <option id="Bloc7" value="7" <?php if($NB_BLOCS == "7"){echo "selected";} ?>>7 blocs</option>
										    <option id="Bloc8" value="8" <?php if($NB_BLOCS == "8"){echo "selected";} ?>>8 blocs</option>
										    <option id="Bloc9" value="9" <?php if($NB_BLOCS == "9"){echo "selected";} ?>>9 blocs</option>
                                        </select>
                                    </div>


                                     <?php for ($i = 1; $i <= 9; $i++) {
                                    $PIC = "PIC_".$i;
                                    $TITRE = "TITRE_".$i;
                                    $TXT = "TXT_".$i;
                                    ?>
                                    <div class="4u<?php if($i % 3 == 0){echo '$';} ?> 12u$(medium) bloc<?php echo $i; ?>" <?php if($NB_BLOCS >= $i){echo "style='display:block;'";} ?>>
                                        <div class="row uniform">
                                            <div class="12u$ 12u$(xsmall)" style="padding-top: 0;">
                                                <div class="separator">Bloc <?php echo $i; ?></div>
                                            </div>
                                            <div class="12u$ 12u$(xsmall)">
                                                <div class="fakeinput">Image :
                                                    <input id="<?php echo $PIC; ?>" name="<?php echo $PIC; ?>" type="file" onchange="displayContent(event, 1, <?=$i?>)" class="fake-btn">
                                                    <input type="button" style="width: calc(100% - 120px);" value="choisir une photo" class="real-button" onclick="document.getElementById('<?php echo $PIC; ?>').click()">
                                                    <p class="out-1-<?=$i?>"></p>
                                                    <?php if($data[$PIC] != ""){
                                                        echo'
                                                            <a href="delete.php?picture='.$data[$PIC].'&url=settings-accueil.php&event='.$event.'&jour=PIC_'.$i.'&table=accueil" class="confirm" style="text-decoration:none; float:right; margin-left: 10px;" title="Supprimer">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                            <a data-fancybox="images_J'.$i.'" href="images/'.$event.'/'.$data[$PIC].'" style="text-decoration:none; float:right;" title="Voir la photo">
                                                                <div class="miniature" style="background: url(images/'.$event.'/'.$data[$PIC].')"></div>
                                                            </a>';
                                                    } ?>
                                                </div>
                                                <input type="hidden" id="OLD_PIC_BLOC_<?php echo $i; ?>" name="OLD_PIC_BLOC_<?php echo $i; ?>" value="<?php echo $data[$PIC]; ?>">
                                            </div>
                                            <div class="12u$ 12u$(xsmall)">
                                                <input type="text" name="<?php echo $TITRE; ?>" id="<?php echo $TITRE; ?>" value="<?php echo $data[$TITRE]; ?>" placeholder="Titre du bloc <?php echo $i; ?>">
                                            </div>
                                            <div class="12u$">
                                                <textarea name="<?php echo $TXT; ?>" class="summernote" id="<?php echo $TXT; ?>" placeholder="Contenu du bloc <?php echo $i; ?>" rows="6"><?php echo $data[$TXT]; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>



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
		    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
		    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.js"></script>
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

					  $('.summernote').summernote({
                        height: 100,
                    });

					$('.confirm').click(function(e) {
						e.preventDefault();
						if (window.confirm("Attention, êtes-vous sûr(e) de vouloir supprimer cette photo ?")) {
							location.href = this.href;
						}
					});

				 $("#NB_SLIDES").change(function(){
                      var id = $(this).find("option:selected").attr("id");
                      console.log ("id: "+id);

	 					  $(".slide1").css("display","none");
                          $(".slide2").css("display","none");
                          $(".slide3").css("display","none");
                          $(".slide4").css("display","none");
                          $(".slide5").css("display","none");
                          $(".slide6").css("display","none");



                      switch (id){

                        case "Slide1":
                          $(".slide1").css("display","block");

                          break;
                        case "Slide2":
                          $(".slide1").css("display","block");
                          $(".slide2").css("display","block");

                          break;
                        case "Slide3":
                          $(".slide1").css("display","block");
                          $(".slide2").css("display","block");
                          $(".slide3").css("display","block");

                          break;
                        case "Slide4":
                          $(".slide1").css("display","block");
                          $(".slide2").css("display","block");
                          $(".slide3").css("display","block");
                          $(".slide4").css("display","block");

                          break;
                        case "Slide5":
                          $(".slide1").css("display","block");
                          $(".slide2").css("display","block");
                          $(".slide3").css("display","block");
                          $(".slide4").css("display","block");
                          $(".slide5").css("display","block");

                          break;
                        case "Slide6":
                          $(".slide1").css("display","block");
                          $(".slide2").css("display","block");
                          $(".slide3").css("display","block");
                          $(".slide4").css("display","block");
                          $(".slide5").css("display","block");
                          $(".slide6").css("display","block");

                          break;
                      }
                    });

				 $("#NB_BLOCS").change(function(){
                      var id = $(this).find("option:selected").attr("id");
                      console.log ("id: "+id);

	 					  $(".bloc1").css("display","none");
                          $(".bloc2").css("display","none");
                          $(".bloc3").css("display","none");
                          $(".bloc4").css("display","none");
                          $(".bloc5").css("display","none");
                          $(".bloc6").css("display","none");
                          $(".bloc7").css("display","none");
                          $(".bloc8").css("display","none");
                          $(".bloc9").css("display","none");



                      switch (id){

                        case "Bloc1":
                          $(".bloc1").css("display","block");

                          break;
                        case "Bloc2":
                          $(".bloc1").css("display","block");
                          $(".bloc2").css("display","block");

                          break;
                        case "Bloc3":
                          $(".bloc1").css("display","block");
                          $(".bloc2").css("display","block");
                          $(".bloc3").css("display","block");

                          break;
                        case "Bloc4":
                          $(".bloc1").css("display","block");
                          $(".bloc2").css("display","block");
                          $(".bloc3").css("display","block");
                          $(".bloc4").css("display","block");

                          break;
                        case "Bloc5":
                          $(".bloc1").css("display","block");
                          $(".bloc2").css("display","block");
                          $(".bloc3").css("display","block");
                          $(".bloc4").css("display","block");
                          $(".bloc5").css("display","block");

                          break;
                        case "Bloc6":
                          $(".bloc1").css("display","block");
                          $(".bloc2").css("display","block");
                          $(".bloc3").css("display","block");
                          $(".bloc4").css("display","block");
                          $(".bloc5").css("display","block");
                          $(".bloc6").css("display","block");

                          break;
                        case "Bloc7":
                          $(".bloc1").css("display","block");
                          $(".bloc2").css("display","block");
                          $(".bloc3").css("display","block");
                          $(".bloc4").css("display","block");
                          $(".bloc5").css("display","block");
                          $(".bloc6").css("display","block");
                          $(".bloc7").css("display","block");

                          break;
                        case "Bloc8":
                          $(".bloc1").css("display","block");
                          $(".bloc2").css("display","block");
                          $(".bloc3").css("display","block");
                          $(".bloc4").css("display","block");
                          $(".bloc5").css("display","block");
                          $(".bloc6").css("display","block");
                          $(".bloc7").css("display","block");
                          $(".bloc8").css("display","block");

                          break;
                        case "Bloc9":
                          $(".bloc1").css("display","block");
                          $(".bloc2").css("display","block");
                          $(".bloc3").css("display","block");
                          $(".bloc4").css("display","block");
                          $(".bloc5").css("display","block");
                          $(".bloc6").css("display","block");
                          $(".bloc7").css("display","block");
                          $(".bloc8").css("display","block");
                          $(".bloc9").css("display","block");
                          break;
                      }
                    });
				});
			</script>


	</body>
</html>
