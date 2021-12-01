<?php

include 'connect-backoffice.php';

require_once './class/sProgramme.php';
require_once './class/Event.php';
require_once './class/User.php';

$programme = new sProgramme();
$evt       = new Event();
$usr       = new User();

$event = $_GET["event"];
$error = "";
    

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['valider'])){

	$nomOrigine = $_FILES['PIC_PROGRAMME']['name'];
	$elementsChemin = pathinfo($nomOrigine);
	$extensionFichier = $elementsChemin['extension'];
	$extensionsAutorisees = array("jpeg", "jpg", "gif", "png");
    $nomOrigine2 = "banner-programme.".$extensionFichier;
	if (!(in_array($extensionFichier, $extensionsAutorisees))) {
	} else {
        
        $dossierimage = "images/".$event;
        if (!file_exists($dossierimage)) {
            mkdir($dossierimage, 0777, true);
        }
        
		$repertoireDestination = dirname(__FILE__)."/".$dossierimage."/";
		$nomDestination = $nomOrigine2;

        unlink(dirname(__FILE__)."/".$dossierimage."/" . $_POST[$oldnamepicture]);

		if (move_uploaded_file($_FILES["PIC_PROGRAMME"]["tmp_name"],$repertoireDestination.$nomDestination)) {

		    $data = $programme->updateBanniere($nomDestination, $event);
		}
	}
    
    $TXT_PROGRAMME_ST = $_POST['TXT_PROGRAMME_ST'];
    $NB_PROGRAMME = $_POST['NB_PROGRAMME'];
    

    $data = $programme->updateContent($TXT_PROGRAMME_ST, $NB_PROGRAMME, $event);


    $error = "Les informations ont bien été mises à jour.";
    $color = "#28a745";
    $valid = "0";
    
    
    for ($i = 1; $i <= $NB_PROGRAMME; $i++) {
        
        $namepicture = "PIC_PROGRAMME_J".$i;
        $oldnamepicture = "OLD_PIC_PROGRAMME_J".$i;
        $nomOrigine = $_FILES[$namepicture]['name'];
        $elementsChemin = pathinfo($nomOrigine);
        $extensionFichier = $elementsChemin['extension'];
        $extensionsAutorisees = array("jpeg", "jpg", "gif", "png");
        $nomOrigine2 = "programme-".$i.".".$extensionFichier;
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

	            $programme->setFileBloc($i, $nomDestination, $event);

            }
        }
        $TXT_PROGRAMME_TITRE = "TXT_PROGRAMME_J".$i."_TITRE";
        $TXT_PROGRAMME_TITRE_CONTENT = $_POST['TXT_PROGRAMME_J'.$i.'_TITRE'];
        $TXT_PROGRAMME = "TXT_PROGRAMME_J".$i;
        $TXT_PROGRAMME_CONTENT = $_POST['TXT_PROGRAMME_J'.$i];

	    $data = $programme->updateProgramme($TXT_PROGRAMME_TITRE, $TXT_PROGRAMME_TITRE_CONTENT, $TXT_PROGRAMME, $TXT_PROGRAMME_CONTENT, $event);
    }
}

$eventNom = $evt->getNameById($event);
$data = $programme->findAllById($event);
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
        <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote.css" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/flipclock.css">
		<link rel="icon" href="images/favicon.ico" type="image/png">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
        <style>.jour{display: none;}</style>
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
                                        <th>Page programme</th>
                                        <th style="text-align: right;"><a data-fancybox data-type="iframe" data-src="programme.php?event=<?php echo $event; ?>&view=admin" href="javascript:;" style="text-decoration:none;"><i class="fas fa-eye"></i></a></th>
                                    </tr>
                                </thead>
                            </table>
                            
                            <form method="post" action="settings-programme.php?event=<?php echo $event; ?>" enctype="multipart/form-data">
                                <div class="row uniform">
                                    <div class="12u$ 12u$(xsmall)">
                                        <div class="fakeinput">Bannière :
                                            <input id="PIC_PROGRAMME" name="PIC_PROGRAMME" type="file" class="fake-btn" onchange="displayContent(event, 0, 0)">
                                            <input type="button" class="real-button" onclick="document.getElementById('PIC_PROGRAMME').click()" value="choisir une photo">
                                            <p class="output out-0-0"></p><?php if($data["PIC_PROGRAMME"] != ""){
                                                echo'
                                                    <a href="delete.php?picture='.$data['PIC_PROGRAMME'].'&url=settings-programme.php&event='.$event.'&jour=PIC_PROGRAMME&table=programme" class="confirm" style="text-decoration:none; float:right; margin-left: 10px;" title="Supprimer">
                                                        <i class="fas fa-trash"></i></a>
                                                    <a data-fancybox="images" href="images/'.$event.'/'.$data["PIC_PROGRAMME"].'" style="text-decoration:none; float:right;" title="Voir la photo">
                                                        <div class="miniature" style="background: url(images/'.$event.'/'.$data["PIC_PROGRAMME"].')"></div>
                                                    </a>';
                                            } ?>
                                        </div>
                                        <input type="hidden" id="OLD_PIC_PROGRAMME" name="OLD_PIC_PROGRAMME" value="<?php echo $data['PIC_PROGRAMME']; ?>">
                                    </div>
                                    <div class="12u$ 12u$(xsmall)">
                                        <input type="text" name="TXT_PROGRAMME_ST" id="TXT_PROGRAMME_ST" placeholder="Sous-titre" value="<?php echo $data['TXT_PROGRAMME_ST']; ?>">
                                       
                                    </div>
                                    <div class="12u$ 12u$(xsmall)">
                                        <select name="NB_PROGRAMME" id="NB_PROGRAMME">
										    <option id="J0" value="0" <?php if($data["NB_PROGRAMME"] == "0"){echo "selected";} ?>>Nombre de jours</option>
										    <option id="J1" value="1" <?php if($data["NB_PROGRAMME"] == "1"){echo "selected";} ?>>1 jour</option>
										    <option id="J2" value="2" <?php if($data["NB_PROGRAMME"] == "2"){echo "selected";} ?>>2 jours</option>
										    <option id="J3" value="3" <?php if($data["NB_PROGRAMME"] == "3"){echo "selected";} ?>>3 jours</option>
										    <option id="J4" value="4" <?php if($data["NB_PROGRAMME"] == "4"){echo "selected";} ?>>4 jours</option>
										    <option id="J5" value="5" <?php if($data["NB_PROGRAMME"] == "5"){echo "selected";} ?>>5 jours</option>
										    <option id="J6" value="6" <?php if($data["NB_PROGRAMME"] == "6"){echo "selected";} ?>>6 jours</option>
										    <option id="J7" value="7" <?php if($data["NB_PROGRAMME"] == "7"){echo "selected";} ?>>7 jours</option>
										    <option id="J8" value="8" <?php if($data["NB_PROGRAMME"] == "8"){echo "selected";} ?>>8 jours</option>
										    <option id="J9" value="9" <?php if($data["NB_PROGRAMME"] == "9"){echo "selected";} ?>>9 jours</option>
                                        </select>
                                    </div>
                                    <?php for ($i = 1; $i <= 9; $i++) {
                                    $PIC_PROGRAMME_J = "PIC_PROGRAMME_J".$i;
                                    $TXT_PROGRAMME_J_TITRE = "TXT_PROGRAMME_J".$i."_TITRE";
                                    $TXT_PROGRAMME_J = "TXT_PROGRAMME_J".$i;
                                    ?>
                                    <div class="4u<?php if($i % 3 == 0){echo '$';} ?> 12u$(medium) J<?php echo $i; ?> jour" <?php if($data["NB_PROGRAMME"] >= $i){echo "style='display:block;'";} ?>>
                                        <div class="row uniform">
                                            <div class="12u$ 12u$(xsmall)" style="padding-top: 0;">
                                                <div class="separator">Jour <?php echo $i; ?></div>
                                            </div>
                                            <div class="12u$ 12u$(xsmall)">
                                                <div class="fakeinput">Bannière :
                                                    <input id="PIC_PROGRAMME_J<?php echo $i; ?>" name="PIC_PROGRAMME_J<?php echo $i; ?>" type="file" onchange="displayContent(event, 1, <?=$i?>)" class="fake-btn">
                                                    <input type="button" style="width: calc(100% - 120px);" value="choisir une photo" class="real-button" onclick="document.getElementById('PIC_PROGRAMME_J<?php echo $i; ?>').click()">
                                                    <p class="out-1-<?=$i?>"></p>
                                                    <?php if($data[$PIC_PROGRAMME_J] != ""){
                                                        echo'
                                                            <a href="delete.php?picture='.$data[$PIC_PROGRAMME_J].'&url=settings-programme.php&event='.$event.'&jour=PIC_PROGRAMME_J'.$i.'&table=programme" class="confirm" style="text-decoration:none; float:right; margin-left: 10px;" title="Supprimer">
                                                                <i class="fas fa-trash"></i>
                                                            </a>
                                                            <a data-fancybox="images_J'.$i.'" href="images/'.$event.'/'.$data[$PIC_PROGRAMME_J].'" style="text-decoration:none; float:right;" title="Voir la photo">
                                                                <div class="miniature" style="background: url(images/'.$event.'/'.$data[$PIC_PROGRAMME_J].')"></div>
                                                            </a>';
                                                    } ?>
                                                </div>
                                                <input type="hidden" id="OLD_PIC_PROGRAMME_J<?php echo $i; ?>" name="OLD_PIC_PROGRAMME_J<?php echo $i; ?>" value="<?php echo $data[$PIC_PROGRAMME_J]; ?>">
                                            </div>
                                            <div class="12u$ 12u$(xsmall)">
                                                <input type="text" name="TXT_PROGRAMME_J<?php echo $i; ?>_TITRE" id="TXT_PROGRAMME_J<?php echo $i; ?>_TITRE" value="<?php echo $data[$TXT_PROGRAMME_J_TITRE]; ?>" placeholder="Titre du jour <?php echo $i; ?>">
                                            </div>
                                            <div class="12u$">
                                                <textarea name="TXT_PROGRAMME_J<?php echo $i; ?>" class="summernote" id="TXT_PROGRAMME_J<?php echo $i; ?>" placeholder="Contenu du jour <?php echo $i; ?>" rows="6"><?php echo $data[$TXT_PROGRAMME_J]; ?></textarea>
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
                    
                    $("#NB_PROGRAMME").change(function(){
                      var id = $(this).find("option:selected").attr("id");

                      switch (id){
                        case "J0":
                          $(".J1").css("display","none");
                          $(".J2").css("display","none");
                          $(".J3").css("display","none");
                          $(".J4").css("display","none");
                          $(".J5").css("display","none");
                          $(".J6").css("display","none");
                          $(".J7").css("display","none");
                          $(".J8").css("display","none");
                          $(".J9").css("display","none");
                          break;
                        case "J1":
                          $(".J1").css("display","block");
                          $(".J2").css("display","none");
                          $(".J3").css("display","none");
                          $(".J4").css("display","none");
                          $(".J5").css("display","none");
                          $(".J6").css("display","none");
                          $(".J7").css("display","none");
                          $(".J8").css("display","none");
                          $(".J9").css("display","none");
                          break;
                        case "J2":
                          $(".J1").css("display","block");
                          $(".J2").css("display","block");
                          $(".J3").css("display","none");
                          $(".J4").css("display","none");
                          $(".J5").css("display","none");
                          $(".J6").css("display","none");
                          $(".J7").css("display","none");
                          $(".J8").css("display","none");
                          $(".J9").css("display","none");
                          break;
                        case "J3":
                          $(".J1").css("display","block");
                          $(".J2").css("display","block");
                          $(".J3").css("display","block");
                          $(".J4").css("display","none");
                          $(".J5").css("display","none");
                          $(".J6").css("display","none");
                          $(".J7").css("display","none");
                          $(".J8").css("display","none");
                          $(".J9").css("display","none");
                          break;
                        case "J4":
                          $(".J1").css("display","block");
                          $(".J2").css("display","block");
                          $(".J3").css("display","block");
                          $(".J4").css("display","block");
                          $(".J5").css("display","none");
                          $(".J6").css("display","none");
                          $(".J7").css("display","none");
                          $(".J8").css("display","none");
                          $(".J9").css("display","none");
                          break;
                        case "J5":
                          $(".J1").css("display","block");
                          $(".J2").css("display","block");
                          $(".J3").css("display","block");
                          $(".J4").css("display","block");
                          $(".J5").css("display","block");
                          $(".J6").css("display","none");
                          $(".J7").css("display","none");
                          $(".J8").css("display","none");
                          $(".J9").css("display","none");
                          break;
                        case "J6":
                          $(".J1").css("display","block");
                          $(".J2").css("display","block");
                          $(".J3").css("display","block");
                          $(".J4").css("display","block");
                          $(".J5").css("display","block");
                          $(".J6").css("display","block");
                          $(".J7").css("display","none");
                          $(".J8").css("display","none");
                          $(".J9").css("display","none");
                          break;
                        case "J7":
                          $(".J1").css("display","block");
                          $(".J2").css("display","block");
                          $(".J3").css("display","block");
                          $(".J4").css("display","block");
                          $(".J5").css("display","block");
                          $(".J6").css("display","block");
                          $(".J7").css("display","block");
                          $(".J8").css("display","none");
                          $(".J9").css("display","none");
                          break;
                        case "J8":
                          $(".J1").css("display","block");
                          $(".J2").css("display","block");
                          $(".J3").css("display","block");
                          $(".J4").css("display","block");
                          $(".J5").css("display","block");
                          $(".J6").css("display","block");
                          $(".J7").css("display","block");
                          $(".J8").css("display","block");
                          $(".J9").css("display","none");
                          break;
                        case "J9":
                          $(".J1").css("display","block");
                          $(".J2").css("display","block");
                          $(".J3").css("display","block");
                          $(".J4").css("display","block");
                          $(".J5").css("display","block");
                          $(".J6").css("display","block");
                          $(".J7").css("display","block");
                          $(".J8").css("display","block");
                          $(".J9").css("display","block");
                          break;
                      }
                    });
				});
			</script>

	</body>
</html>
