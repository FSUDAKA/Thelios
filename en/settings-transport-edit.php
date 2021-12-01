<?php

include 'connect-backoffice.php';

require_once './class/Transport.php';
require_once './class/Event.php';
require_once './class/User.php';

$transport = new Transport();
$evt       = new Event();
$usr       = new User();
?>

		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/flipclock.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />

       <script src="assets/js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<?php

$event = $_GET["event"];
$item = $_GET["item"];

$data8 = $transport->findOneById($item);

    $TYPE = $data8['TYPE'];
    $MOYEN = $data8['MOYEN'];
    $NOM = $data8['NOM'];
    $DESCRIPTION = data8['DESCRIPTION'];
    $NUMERO = $data8['NUMERO'];
    $DE = $data8['DE'];
    $A = $data8['A'];
    $DATE_DEPART = $data8['DATE_DEPART'];
    $HEURE_DEPART = $data8['HEURE_DEPART'];
    $DATE_ARRIVEE = $data8['DATE_ARRIVEE'];
    $HEURE_ARRIVEE = $data8['HEURE_ARRIVEE'];
    
if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['valider'])){
    
    $nocheck = 0;
    if($NOM == $_POST['NOM']){$nocheck = 1;}

    $TYPE = $_POST['TYPE'];
    $MOYEN = $_POST['MOYEN'];
    $NOM = $_POST['NOM'];
    $DESCRIPTION = $_POST['DESCRIPTION'];
    $NUMERO = $_POST['NUMERO'];
    $DE = $_POST['DE'];
    $A = $_POST['A'];
    $DATE_DEPART = $_POST['DATE_DEPART'];
    $HEURE_DEPART = $_POST['HEURE_DEPART'];
    $DATE_ARRIVEE = $_POST['DATE_ARRIVEE'];
    $HEURE_ARRIVEE = $_POST['HEURE_ARRIVEE'];
    
    
      if($_POST['NOM'] != ""){
          if ($transport->selectOne($NOM)) {
              if($nocheck == 1){

                  $data = $transport->update($TYPE, $MOYEN, $NOM, $DESCRIPTION, $NUMERO, $DE, $A, $DATE_DEPART, $HEURE_DEPART, $DATE_ARRIVEE, $HEURE_ARRIVEE, $event);

              $error = "Le transport a bien été mis à jour.";
              $color = "#28a745";
              $valid = "0";


                  echo'

                  <script type="text/javascript">
                      $(document).ready(function() {
                          parent.location.reload(true);
                      });
                  </script>

                  ';


              }else{

                  $error = "Attention, ce nom est déjà utilisé.";
                  $color = "#FF0000";
                  $valid = "0";
                  echo "<style>#NOM{border-color:#ff0000;}</style>";
              }

          } else {

	          $data = $transport->update($TYPE, $MOYEN, $NOM, $DESCRIPTION, $NUMERO, $DE, $A, $DATE_DEPART, $HEURE_DEPART, $DATE_ARRIVEE, $HEURE_ARRIVEE, $event);

              $error = "Le transport a bien été mis à jour.";
              $color = "#28a745";
              $valid = "0";


              echo'

              <script type="text/javascript">
                  $(document).ready(function() {
                      parent.location.reload(true);
                  });
              </script>

              ';

          }

      }else{
          $NOM = $data3['NOM'];
          $error = "Attention, vous n'avez pas rempli tous les champs obligatoires.";
          $color = "#FF0000";
          $valid = "0";
          if ($_POST['NOM'] == ''){echo "<style>#NOM{border-color:#ff0000;}</style>";}

    }

}

$data = $programme->findAllById($event);
$data1 = $usr->findOneById($_SESSION['id']);


if($data1['STATUT'] == 1){
    header('Location: backoffice.php');
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Paramètres - <?php echo $data['NOM'] ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="icon" href="images/favicon.ico" type="image/png">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
        <style>td .fa, td .fas {margin: 0 10px;} tr{text-align: left;}
            
            
        #DATE_DEPART, #DATE_ARRIVEE {
            padding-left: 130px;
        }
            
        .date_debut_fin {
            position: absolute;
            margin-left: 1em;
            height: 45px;
            line-height: 45px;
            color: #bbb !important;
            opacity: 1.0;
        }
            
            @media screen and (min-width: 1681px) {
            
                #DATE_DEPART, #DATE_ARRIVEE {
                    padding-left: 150px;
                }

                .date_debut_fin {
                    height: 52px;
                    line-height: 52px;
                }
                
            }
            
             </style>
	</head>
	<body>

		<!-- Three -->
			<section id="one" class="wrapper align-center" style="padding: 3em 0;">
				<div class="inner">

					<div class="row uniform">

						<div class="9u 12u$(small)" style="width: 100%">

                            <?php if (($error != "") && ($valid == "0")) { ?>
                                <div class="box" id="messagein" style="border-color:<?php echo $color; ?>;">
                                    <p style="color:<?php echo $color; ?>;"><?php echo $error; ?></p>
                                </div>
                            <?php } ?>
                            
                            
                            <form method="post" action="settings-transport-edit.php?item=<?php echo $item; ?>" enctype="multipart/form-data">
                                
                                <div class="row uniform">
                                    <div class="6u 12u$(xsmall)">
                                        <input type="text" name="NOM" id="NOM" value="<?php echo $NOM; ?>" placeholder="Nom du transport">
                                    </div>
                                    <div class="6u$ 12u$(xsmall)">
                                        <input type="text" name="DESCRIPTION" id="DESCRIPTION" value="<?php echo $DESCRIPTION; ?>" placeholder="Description">
                                    </div>
                                    <div class="6u 12u$(xsmall)">
                                        <input type="text" name="TYPE" id="TYPE" value="<?php echo $TYPE; ?>" placeholder="Type de transport">
                                    </div>
                                    <div class="6u$ 12u$(xsmall)">
                                        <input type="text" name="MOYEN" id="MOYEN" value="<?php echo $MOYEN; ?>" placeholder="Moyen de transport">
                                    </div>
                                    <div class="4u 12u$(xsmall)">
                                        <input type="text" name="NUMERO" id="NUMERO" value="<?php echo $NUMERO; ?>" placeholder="Numéro">
                                    </div>
                                    <div class="4u 12u$(xsmall)">
                                        <input type="text" name="DE" id="DE" value="<?php echo $DE; ?>" placeholder="Lieu de départ">
                                    </div>
                                    <div class="4u$ 12u$(xsmall)">
                                        <input type="text" name="A" id="A" value="<?php echo $A; ?>" placeholder="Lieu d'arrivée">
                                    </div>
                                    <div class="6u 12u$(xsmall)" style="text-align: left;"><span class="date_debut_fin">Date de départ :</span>
                                        <input type="date" name="DATE_DEPART" id="DATE_DEPART" value="<?php echo $DATE_DEPART; ?>">
                                    </div>
                                    <div class="6u 12u$(xsmall)">
                                        <input type="text" name="HEURE_DEPART" id="HEURE_DEPART" value="<?php echo $HEURE_DEPART; ?>" placeholder="Heure de départ">
                                    </div>
                                    <div class="6u 12u$(xsmall)" style="text-align: left;"><span class="date_debut_fin">Date d'arrivée :</span>
                                        <input type="date" name="DATE_ARRIVEE" id="DATE_ARRIVEE" value="<?php echo $DATE_ARRIVEE; ?>">
                                    </div>
                                    <div class="6u$ 12u$(xsmall)">
                                        <input type="text" name="HEURE_ARRIVEE" id="HEURE_ARRIVEE" value="<?php echo $HEURE_ARRIVEE; ?>" placeholder="Heure d'arrivée">
                                    </div>
                                    <div class="12u 12u$(small) cacheajout">
                                        <ul class="actions" style="float:left;">
                                            <li><input type="submit" value="Modifier" class="special" name="valider"></li>
                                        </ul>
                                    </div>
                                </div>
                            </form>


						</div>

					</div>

				</div>
			</section>

		<!-- Scripts -->
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			<script type="text/javascript">
				$(document).ready(function() {

				});
			</script>

	</body>
</html>
