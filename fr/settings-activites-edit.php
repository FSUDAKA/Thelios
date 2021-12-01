<?php

include 'connect-backoffice.php';
require_once './class/Activity.php';
require_once './class/User.php';
require_once './class/Event.php';

$activity = new Activity();
$evt = new Event();
$usr = new User();

?>

<link rel="stylesheet" href="assets/css/main.css"/>
<link rel="stylesheet" href="assets/css/flipclock.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css"
      integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"/>

<script src="assets/js/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

<?php

$event = $_GET["event"];
$item = $_GET["item"];

$data8 = $activity->findOneById($item);

$THEME = $data8['THEME'];
$DESCRIPTION = $data8['DESCRIPTION'];
$DATE = $data8['DATE'];
$HEURE = $data8['HEURE'];
$SALLE = $data8['SALLE'];

if(($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['valider'])){

	$nocheck = 0;
	if($THEME == $_POST['THEME']){
		$nocheck = 1;
	}
	$THEME = $_POST['THEME'];
	$DESCRIPTION = $_POST['DESCRIPTION'];
	$DATE = $_POST['DATE'];
	$HEURE = $_POST['HEURE'];
	$SALLE = $_POST['SALLE'];


	if($_POST['THEME'] != ""){

		if($result = $activity->selectOne($THEME)){


			if($nocheck == 1){

				$data = $activity->updateActivity($THEME, $DESCRIPTION, $DATE, $HEURE, $SALLE, $item);

				$error = "L'activité a bien été mis à jour.";
				$color = "#28a745";
				$valid = "0";


				echo '

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
				echo "<style>#THEME{border-color:#ff0000;}</style>";
			}


	}else{

			$data = $activity->updateActivity($THEME, $DESCRIPTION, $DATE, $HEURE, $SALLE, $item);

			$error = "L'activité a bien été mis à jour.";
			$color = "#28a745";
			$valid = "0";


			echo '

              <script type="text/javascript">
                  $(document).ready(function() {
                      parent.location.reload(true);
                  });
              </script>

              ';
		}
	}

}else{
	$THEME = $data3['THEME'];
	$error = "Attention, vous n'avez pas rempli tous les champs obligatoires.";
	$color = "#FF0000";
	$valid = "0";
	if($_POST['THEME'] == ''){
		echo "<style>#THEME{border-color:#ff0000;}</style>";
	}
}

$data = $evt->findOneById($event);
$data1 = $usr->findOneById($_SESSION['id']);


if($data1['STATUT'] == 1){
    header('Location: backoffice.php');
}

?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Paramètres - <?php echo $data['NOM'] ?></title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="images/favicon.ico" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <style>td .fa, td .fas {
            margin: 0 10px;
        }

        tr {
            text-align: left;
        }

        #DATE {
            padding-left: 70px;
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

            #DATE {
                padding-left: 90px;
            }

            .date_debut_fin {
                height: 52px;
                line-height: 52px;
            }

        }</style>
</head>
<body>

<!-- Three -->
<section id="one" class="wrapper align-center" style="padding: 3em 0;">
    <div class="inner">

        <div class="row uniform">

            <div class="9u 12u$(small)" style="width: 100%">

				<?php if(($error != "") && ($valid == "0")){ ?>
                    <div class="box" id="messagein" style="border-color:<?php echo $color; ?>;">
                        <p style="color:<?php echo $color; ?>;"><?php echo $error; ?></p>
                    </div>
				<?php } ?>


                <form method="post" action="settings-activites-edit.php?item=<?php echo $item; ?>"
                      enctype="multipart/form-data">

                    <div class="row uniform">
                        <div class="12u$ 12u$(xsmall)">
                            <input type="text" name="THEME" id="THEME" value="<?php echo $THEME; ?>" placeholder="Nom">
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <input type="text" name="DESCRIPTION" id="DESCRIPTION" value="<?php echo $DESCRIPTION; ?>"
                                   placeholder="Description">
                        </div>
                        <div class="6u$ 12u$(xsmall)" style="text-align: left;"><span
                                    class="date_debut_fin">Date :</span>
                            <input type="date" name="DATE" id="DATE" value="<?php echo $DATE; ?>">
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <input type="text" name="HEURE" id="HEURE" value="<?php echo $HEURE; ?>"
                                   placeholder="Heure">
                        </div>
                        <div class="6u$ 12u$(xsmall)">
                            <input type="text" name="SALLE" id="SALLE" value="<?php echo $SALLE; ?>" placeholder="Lieu">
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
    $(document).ready(function () {

    });
</script>

</body>
</html>
