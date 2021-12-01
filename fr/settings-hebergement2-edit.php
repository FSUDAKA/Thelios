<?php
include 'connect-backoffice.php';

require_once './class/User.php';
require_once './class/Event.php';
require_once './class/Hotel.php';
require_once './class/Room.php';

$evt = new Event();
$usr = new User();
$room = new Room();
$hotel = new Hotel();



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

$data8 = $hotel->findOneById($item);

    $NOM = $data8['NOM'];
    $ADRESSE1 = $data8['ADRESSE1'];
    $ADRESSE2 = $data8['ADRESSE2'];
    $CP = $data8['CP'];
    $VILLE = $data8['VILLE'];
    $TEL = $data8['TEL'];
    $STOCK_SGL = $data8['STOCK_SGL'];
    $STOCK_DBL = $data8['STOCK_DBL'];
    $STOCK_TWIN = $data8['STOCK_TWIN'];
    
    

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['valider'])){
    
    $nocheck = 0;
    if($NOM == $_POST['NOM']){$nocheck = 1;}
    $NOM = $_POST['NOM'];
    $ADRESSE1 = $_POST['ADRESSE1'];
    $ADRESSE2 = $_POST['ADRESSE2'];
    $CP = $_POST['CP'];
    $VILLE = $_POST['VILLE'];
    $TEL = $_POST['TEL'];
    $STOCK_SGL = $_POST['STOCK_SGL'];
    $STOCK_DBL = $_POST['STOCK_DBL'];
    $STOCK_TWIN = $_POST['STOCK_TWIN'];
    
    $data2 = $room->findId($data8['ID'], "Single");
    $data3 = $usr->countIdByHotel($data2['ID']);
    $data4 = $room->findId($data8['ID'], "Double");
	$data5 = $usr->countIdByHotel($data4['ID']);
	$data6 = $room->findId($data8['ID'], "Twin");
	$data7 = $usr->countIdByHotel($data6['ID']);
    
    if($STOCK_SGL < $data3['total']){

      $error = "Attention, vous ne pouvez pas diminuer la quantité de Single en dessous du stock déjà reservé.";
      $color = "#FF0000";
      $valid = "0";
      echo "<style>#STOCK_SGL{border-color:#ff0000;}</style>";
        
    }else{
        
        if($STOCK_DBL < $data5['total']){

          $error = "Attention, vous ne pouvez pas diminuer la quantité de Double en dessous du stock déjà reservé.";
          $color = "#FF0000";
          $valid = "0";
          echo "<style>#STOCK_DBL{border-color:#ff0000;}</style>";

        }else{
            
            if($STOCK_TWIN < $data7['total']){

              $error = "Attention, vous ne pouvez pas diminuer la quantité de Twin en dessous du stock déjà reservé.";
              $color = "#FF0000";
              $valid = "0";
              echo "<style>#STOCK_TWIN{border-color:#ff0000;}</style>";

            }else{
    
                if($_POST['NOM'] != ""){

                    if ($hotel->selectOneByName($NOM)) {

                        if($nocheck == 1){

                            $data = $hotel->new($NOM, $ADRESSE1, $ADRESSE2, $CP, $VILLE, $TEL, $STOCK_SGL, $STOCK_DBL, $STOCK_TWIN, $item);

                        $error = "L'hébergement a bien été mis à jour.";
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

	                    $data = $hotel->updateAll($NOM, $ADRESSE1, $ADRESSE2, $CP, $VILLE, $TEL, $STOCK_SGL, $STOCK_DBL, $STOCK_TWIN, $item);

                        $error = "L'hébergement a bien été mis à jour.";
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
                    $NOM = $data8['NOM'];
                    $error = "Attention, vous n'avez pas rempli tous les champs obligatoires.";
                    $color = "#FF0000";
                    $valid = "0";
                    if ($_POST['NOM'] == ''){echo "<style>#NOM{border-color:#ff0000;}</style>";}

                }
            }
        }
    }

}


$db = mysqli_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
mysqli_select_db($db, 'BddIdec');
mysqli_query($db, "SET NAMES 'utf8'");
mysqli_query($db, "SET CHARACTER SET utf8");
mysqli_query($db, "SET SESSION collation_connection = 'utf8_unicode_ci'");
$sql = 'SELECT * FROM EVENTS WHERE ID = "'.$event.'"';
$req = mysqli_query($db, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
$data = mysqli_fetch_assoc($req);
mysqli_free_result($req);
mysqli_close();

$db = mysqli_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
mysqli_select_db($db, 'BddIdec');
mysqli_query($db, "SET NAMES 'utf8'");
mysqli_query($db, "SET CHARACTER SET utf8");
mysqli_query($db, "SET SESSION collation_connection = 'utf8_unicode_ci'");
$sql = 'SELECT * FROM USERS WHERE ID = "'.$_SESSION["id"].'"';
$req = mysqli_query($db, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
$data1 = mysqli_fetch_assoc($req);
mysqli_free_result($req);

mysqli_close();


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
        <style>td .fa, td .fas {margin: 0 10px;} tr{text-align: left;}</style>
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
                            
                            
                            <form method="post" action="settings-hebergement2-edit.php?item=<?php echo $item; ?>" enctype="multipart/form-data">
                                
                                <div class="row uniform">
                                    <div class="6u 12u$(xsmall)">
                                        <input type="text" name="NOM" id="NOM" value="<?php echo $NOM; ?>" placeholder="Nom">
                                    </div>
                                    <div class="6u$ 12u$(xsmall)">
                                        <input type="text" name="ADRESSE1" id="ADRESSE1" value="<?php echo $ADRESSE1; ?>" placeholder="Adresse">
                                    </div>
                                    <div class="6u 12u$(xsmall)">
                                        <input type="text" name="ADRESSE2" id="ADRESSE2" value="<?php echo $ADRESSE2; ?>" placeholder="Adresse (suite)">
                                    </div>
                                    <div class="6u$ 12u$(xsmall)">
                                        <input type="text" name="CP" id="CP" value="<?php echo $CP; ?>" placeholder="Code postal">
                                    </div>
                                    <div class="6u 12u$(xsmall)">
                                        <input type="text" name="VILLE" id="VILLE" value="<?php echo $VILLE; ?>" placeholder="Ville">
                                    </div>
                                    <div class="6u$ 12u$(xsmall)">
                                        <input type="text" name="TEL" id="TEL" value="<?php echo $TEL; ?>" placeholder="Téléphone">
                                    </div>
                                    <div class="4u 12u$(xsmall)">
                                        <input type="text" name="STOCK_SGL" id="STOCK_SGL" value="<?php echo $STOCK_SGL; ?>" placeholder="Stock Single">
                                    </div>
                                    <div class="4u 12u$(xsmall)">
                                        <input type="text" name="STOCK_DBL" id="STOCK_DBL" value="<?php echo $STOCK_DBL; ?>" placeholder="Stock Double">
                                    </div>
                                    <div class="4u$ 12u$(xsmall)">
                                        <input type="text" name="STOCK_TWIN" id="STOCK_TWIN" value="<?php echo $STOCK_TWIN; ?>" placeholder="Stock Twin">
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
