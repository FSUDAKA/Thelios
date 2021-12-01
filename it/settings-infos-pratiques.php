<?php

include 'connect-backoffice.php';

include_once './class/sInfoPrat.php';
include_once './class/Event.php';
include_once './class/User.php';

$usr       = new User();
$infosPrat = new sInfoPrat();
$evt       = new Event();

$event = $_GET["event"];
    

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['valider'])){

	$nomOrigine = $_FILES['PIC_INFOS']['name'];
	$elementsChemin = pathinfo($nomOrigine);
	$extensionFichier = $elementsChemin['extension'];
	$extensionsAutorisees = array("jpeg", "jpg", "gif", "png");
    $nomOrigine2 = "banner-infos-pratiques.".$extensionFichier;
	if (!(in_array($extensionFichier, $extensionsAutorisees))) {
	} else {
        
        $dossierimage = "images/".$event;
        if (!file_exists($dossierimage)) {
            mkdir($dossierimage, 0777, true);
        }
        
		$repertoireDestination = dirname(__FILE__)."/".$dossierimage."/";
		$nomDestination = $nomOrigine2;

        unlink(dirname(__FILE__)."/".$dossierimage."/" . $_POST[$oldnamepicture]);

		if (move_uploaded_file($_FILES["PIC_INFOS"]["tmp_name"],$repertoireDestination.$nomDestination)) {

		    $data = $infosPrat->updateInfosPic($nomDestination, $event);
		}
	}
    
    $TXT_INFOS_ST = $_POST['TXT_INFOS_ST'];
    $NB_INFOS = $_POST['NB_INFOS'];

    $data = $infosPrat->updateInfos($TXT_INFOS_ST, $NB_INFOS, $event);

    $error = "Les informations ont bien été mises à jour.";
    $color = "#28a745";
    $valid = "0";
    
    
    for ($i = 1; $i <= $NB_INFOS; $i++) {
        
        $TXT_INFOS_TITRE = "TXT_INFOS_P".$i."_TITRE";
        $TXT_INFOS_TITRE_CONTENT = $_POST['TXT_INFOS_P'.$i.'_TITRE'];
        $TXT_INFOS = "TXT_INFOS_P".$i;
        $TXT_INFOS_CONTENT = $_POST['TXT_INFOS_P'.$i];
        $ICO_INFOS_P = "ICO_INFOS_P".$i;
        $ICO_INFOS_P_CONTENT = $_POST['ICO_INFOS_P'.$i];

        $data = $infosPrat->updateInfosLoop($TXT_INFOS_TITRE, $TXT_INFOS_TITRE_CONTENT, $TXT_INFOS, $TXT_INFOS_CONTENT, $ICO_INFOS_P, $ICO_INFOS_P_CONTENT, $event);

    }
}

$eventNom = $evt->getNameById($event);
$data = $infosPrat->findAllById($event);
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
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
        <style>.partie{display: none;} .pictos label{width: 19%;}</style>
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
                                        <th>Page infos pratiques</th>
                                        <th style="text-align: right;"><a data-fancybox data-type="iframe" data-src="infos-pratiques.php?event=<?php echo $event; ?>&view=admin" href="javascript:;" style="text-decoration:none;"><i class="fas fa-eye"></i></a></th>
                                    </tr>
                                </thead>
                            </table>
                            
                            <form method="post" action="settings-infos-pratiques.php?event=<?php echo $event; ?>" enctype="multipart/form-data">
                                <div class="row uniform">
                                    <div class="12u$ 12u$(xsmall)">
                                        <div class="fakeinput">Bannière :
                                            <input id="PIC_INFOS" name="PIC_INFOS" type="file" onchange="displayContent(event, 0, 0)" class="fake-btn">
                                            <input type="button" class="real-button" onclick="document.getElementById('PIC_INFOS').click()" value="choisir une photo">
                                            <p class="out-0-0"></p>
                                            <?php if($data["PIC_INFOS"] != ""){
                                                echo'
                                                <a href="delete.php?picture='.$data['PIC_INFOS'].'&url=settings-infos-pratiques.php&event='.$event.'&jour=PIC_INFOS&table=infos-pratiques" class="confirm" style="text-decoration:none; float:right; margin-left: 10px;" title="Supprimer">
                                                    <i class="fas fa-trash"></i>
                                                </a>
                                                <a data-fancybox="images" href="images/'.$event.'/'.$data["PIC_INFOS"].'" style="text-decoration:none; float:right;" title="Voir la photo">
                                                    <div class="miniature" style="background: url(images/'.$event.'/'.$data["PIC_INFOS"].')"></div>
                                                </a>';
                                            } ?>
                                        </div>
                                        <input type="hidden" id="OLD_PIC_INFOS" name="OLD_PIC_INFOS" value="<?php echo $data['PIC_INFOS']; ?>">
                                    </div>
                                    <div class="12u$ 12u$(xsmall)">
                                        <input type="text" name="TXT_INFOS_ST" id="TXT_INFOS_ST" value="<?php echo $data['TXT_INFOS_ST']; ?>" placeholder="Sous-titre">
                                    </div>
                                    <div class="12u$ 12u$(xsmall)">
                                        <select name="NB_INFOS" id="NB_INFOS">
										    <option id="P0" value="0" <?php if($data["NB_INFOS"] == "0"){echo "selected";} ?>>Nombre d'infos pratiques</option>
										    <option id="P1" value="1" <?php if($data["NB_INFOS"] == "1"){echo "selected";} ?>>1 info pratique</option>
										    <option id="P2" value="2" <?php if($data["NB_INFOS"] == "2"){echo "selected";} ?>>2 infos pratiques</option>
										    <option id="P3" value="3" <?php if($data["NB_INFOS"] == "3"){echo "selected";} ?>>3 infos pratiques</option>
										    <option id="P4" value="4" <?php if($data["NB_INFOS"] == "4"){echo "selected";} ?>>4 infos pratiques</option>
										    <option id="P5" value="5" <?php if($data["NB_INFOS"] == "5"){echo "selected";} ?>>5 infos pratiques</option>
										    <option id="P6" value="6" <?php if($data["NB_INFOS"] == "6"){echo "selected";} ?>>6 infos pratiques</option>
                                        </select>
                                    </div>
                                    <?php for ($i = 1; $i <= 9; $i++) {
                                    $ICO_INFOS_P = "ICO_INFOS_P".$i;
                                    $TXT_INFOS_P_TITRE = "TXT_INFOS_P".$i."_TITRE";
                                    $TXT_INFOS_P = "TXT_INFOS_P".$i;
                                    ?>
                                    <div class="4u<?php if($i % 3 == 0){echo '$';} ?> 12u$(medium) P<?php echo $i; ?> partie" <?php if($data["NB_INFOS"] >= $i){echo "style='display:block;'";} ?>>
                                        <div class="row uniform">
                                            <div class="12u$ 12u$(xsmall)" style="padding-top: 0;">
                                                <div class="separator">Info pratique <?php echo $i; ?></div>
                                            </div>
                                            <div class="12u$ 12u$(xsmall)">
                                                <input type="text" name="TXT_INFOS_P<?php echo $i; ?>_TITRE" id="TXT_INFOS_P<?php echo $i; ?>_TITRE" value="<?php echo $data[$TXT_INFOS_P_TITRE]; ?>" placeholder="Titre de l'info pratique <?php echo $i; ?>">
                                            </div>
                                            <div class="12u$ 12u$(xsmall) pictos">
                                                    <input type="radio" id="file-alt<?php echo $i; ?>" name="<?php echo "ICO_INFOS_P".$i; ?>" <?php if($data[$ICO_INFOS_P] == "file-alt"){echo "checked";} ?> value="file-alt">
                                                    <label for="file-alt<?php echo $i; ?>"><i class="fa fa-file-alt"></i></label>
                                                    <input type="radio" id="suitcase<?php echo $i; ?>" name="<?php echo "ICO_INFOS_P".$i; ?>" <?php if($data[$ICO_INFOS_P] == "suitcase"){echo "checked";} ?> value="suitcase">
                                                    <label for="suitcase<?php echo $i; ?>"><i class="fa fa-suitcase"></i></label>
                                                    <input type="radio" id="clock<?php echo $i; ?>" name="<?php echo "ICO_INFOS_P".$i; ?>" <?php if($data[$ICO_INFOS_P] == "clock"){echo "checked";} ?> value="clock">
                                                    <label for="suitcase<?php echo $i; ?>"><i class="fa fa-suitcase"></i></label>
                                                    <input type="radio" id="map-marker-alt<?php echo $i; ?>" name="<?php echo "ICO_INFOS_P".$i; ?>" <?php if($data[$ICO_INFOS_P] == "map-marker-alt"){echo "checked";} ?> value="map-marker-alt">
                                                    <label for="map-marker-alt<?php echo $i; ?>"><i class="fa fa-map-marker-alt"></i></label>
                                                    <input type="radio" id="heartbeat<?php echo $i; ?>" name="<?php echo "ICO_INFOS_P".$i; ?>" <?php if($data[$ICO_INFOS_P] == "heartbeat"){echo "checked";} ?> value="heartbeat">
                                                    <label for="heartbeat<?php echo $i; ?>"><i class="fa fa-heartbeat"></i></label>
                                                    <input type="radio" id="user<?php echo $i; ?>" name="<?php echo "ICO_INFOS_P".$i; ?>" <?php if($data[$ICO_INFOS_P] == "user"){echo "checked";} ?> value="user">
                                                    <label for="user<?php echo $i; ?>"><i class="fa fa-user"></i></label>
                                                    <input type="radio" id="plane<?php echo $i; ?>" name="<?php echo "ICO_INFOS_P".$i; ?>" <?php if($data[$ICO_INFOS_P] == "plane"){echo "checked";} ?> value="plane">
                                                    <label for="plane<?php echo $i; ?>"><i class="fa fa-plane"></i></label>
                                                    <input type="radio" id="comments<?php echo $i; ?>" name="<?php echo "ICO_INFOS_P".$i; ?>" <?php if($data[$ICO_INFOS_P] == "comments"){echo "checked";} ?> value="comments">
                                                    <label for="comments<?php echo $i; ?>"><i class="fa fa-comments"></i></label>
                                                    <input type="radio" id="plug<?php echo $i; ?>" name="<?php echo "ICO_INFOS_P".$i; ?>" <?php if($data[$ICO_INFOS_P] == "plug"){echo "checked";} ?> value="plug">
                                                    <label for="plug<?php echo $i; ?>"><i class="fa fa-plug"></i></label>
                                                    <input type="radio" id="bus<?php echo $i; ?>" name="<?php echo "ICO_INFOS_P".$i; ?>" <?php if($data[$ICO_INFOS_P] == "bus"){echo "checked";} ?> value="bus">
                                                    <label for="bus<?php echo $i; ?>"><i class="fa fa-bus"></i></label>
                                            </div>
                                            <div class="12u$">
                                                <textarea name="TXT_INFOS_P<?php echo $i; ?>" class="summernote" id="TXT_INFOS_P<?php echo $i; ?>" placeholder="Contenu de l'info pratique <?php echo $i; ?>" rows="6"><?php echo $data[$TXT_INFOS_P]; ?></textarea>
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
                    
                    $("#NB_INFOS").change(function(){
                      var id = $(this).find("option:selected").attr("id");

                      switch (id){
                        case "P0":
                          $(".P1").css("display","none");
                          $(".P2").css("display","none");
                          $(".P3").css("display","none");
                          $(".P4").css("display","none");
                          $(".P5").css("display","none");
                          $(".P6").css("display","none");
                          break;
                        case "P1":
                          $(".P1").css("display","block");
                          $(".P2").css("display","none");
                          $(".P3").css("display","none");
                          $(".P4").css("display","none");
                          $(".P5").css("display","none");
                          $(".P6").css("display","none");
                          break;
                        case "P2":
                          $(".P1").css("display","block");
                          $(".P2").css("display","block");
                          $(".P3").css("display","none");
                          $(".P4").css("display","none");
                          $(".P5").css("display","none");
                          $(".P6").css("display","none");
                          break;
                        case "P3":
                          $(".P1").css("display","block");
                          $(".P2").css("display","block");
                          $(".P3").css("display","block");
                          $(".P4").css("display","none");
                          $(".P5").css("display","none");
                          $(".P6").css("display","none");
                          break;
                        case "P4":
                          $(".P1").css("display","block");
                          $(".P2").css("display","block");
                          $(".P3").css("display","block");
                          $(".P4").css("display","block");
                          $(".P5").css("display","none");
                          $(".P6").css("display","none");
                          break;
                        case "P5":
                          $(".P1").css("display","block");
                          $(".P2").css("display","block");
                          $(".P3").css("display","block");
                          $(".P4").css("display","block");
                          $(".P5").css("display","block");
                          $(".P6").css("display","none");
                          break;
                        case "P6":
                          $(".P1").css("display","block");
                          $(".P2").css("display","block");
                          $(".P3").css("display","block");
                          $(".P4").css("display","block");
                          $(".P5").css("display","block");
                          $(".P6").css("display","block");
                          break;
                      }
                    });
				});
			</script>

	</body>
</html>
