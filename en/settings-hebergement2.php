<?php

include 'connect-backoffice.php';
require_once './class/Hotel.php';
require_once './class/Room.php';
require_once './class/User.php';
require_once './class/Event.php';

$hotel = new Hotel();
$room  = new Room();
$evt   = new Event();
$usr   = new User();

$event = $_GET["event"];
    

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['valider'])){
    
    $NOM = $_POST['NOM'];
    $ADRESSE1 = $_POST['ADRESSE1'];
    $ADRESSE2 = $_POST['ADRESSE2'];
    $CP = $_POST['CP'];
    $VILLE = $_POST['VILLE'];
    $TEL = $_POST['TEL'];
    $STOCK_SGL = $_POST['STOCK_SGL'];
    $STOCK_DBL = $_POST['STOCK_DBL'];
    $STOCK_TWIN = $_POST['STOCK_TWIN'];
    
    if($_POST['NOM'] != ""){

        if ($hotel->selectOneByName($NOM)) {
            
            $error = "Attention, ce nom est déjà utilisé.";
            $color = "#FF0000";
            $valid = "0";
		  echo "<style>#ajout{display:block;} #add{display:none;}</style>";
            echo "<style>#NOM{border-color:#ff0000;}</style>";
            
        } else {

            $data = $hotel->new($event, $NOM, $ADRESSE1, $ADRESSE2, $CP, $VILLE, $TEL, $STOCK_SGL, $STOCK_DBL, $STOCK_TWIN);
            $data2 = $hotel->findOneByName($NOM);
            $data = $room->new($event, $data2['id'], "Single");
            $data = $room->new($event, $data2['id'], "Double");
            $data = $room->new($event, $data2['id'], "Twin");

            echo "<style>#ajout{display:none;}</style>";

            $error = "L'hébergement a bien été ajouté.";
            $color = "#28a745";
            $valid = "0";
            
            $NOM = "";
            $ADRESSE1 = "";
            $ADRESSE2 = "";
            $CP = "";
            $VILLE = "";
            $TEL = "";
            $STOCK_SGL = "";
            $STOCK_DBL = "";
            $STOCK_TWIN = "";
                
        }
        
    }else{
		$error = "Attention, vous n'avez pas rempli tous les champs obligatoires.";
		$color = "#FF0000";
		$valid = "0";
		echo "<style>#ajout{display:block;} #add{display:none;}</style>";
		if ($_POST['NOM'] == ''){echo "<style>#NOM{border-color:#ff0000;}</style>";}
        
    }

}else{
    echo "<style>#ajout{display:none;}</style>"; 
}

$data = $contact->findAllById($event);
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
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/flipclock.css">
		<link rel="icon" href="images/favicon.ico" type="image/png">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
        <style>td .fa, td .fas {margin: 5px 10px;} tr{text-align: left;}
        
        .fancybox-slide--iframe .fancybox-content {
            width  : 800px;
            height : 600px !important;
            max-width  : 80%;
            max-height : 80%;
            margin: 0;
        }
            
        </style>
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

							<h2 id="content" style="color:#f99f1b;">Paramètres - <?php echo $data['NOM'] ?></h2>

                            <?php if (($error != "") && ($valid == "0")) { ?>
                                <div class="box" id="messagein" style="border-color:<?php echo $color; ?>; margin-top: 2em;">
                                    <p style="color:<?php echo $color; ?>;"><?php echo $error; ?></p>
                                </div>
                            <?php } ?>
                            
                            <span class="button special" id="add">Ajouter un hébergement</span>
                            
                            <form method="post" action="settings-hebergement2.php?event=<?php echo $data['ID']; ?>" enctype="multipart/form-data" id="ajout">

                                <div class="row uniform">

                                    <div class="12u$ 12u$(small) cacheajout">
                                        <h4 style="width:100%; color:#9a9a9a;">Ajouter un hébergement</h4>
                                    </div>

                                </div>
                                
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
                                    <div class="6u 12u$(small) cacheajout">
                                        <span class="button special" id="annuler">ANNULER</span>
                                    </div>
                                    <div class="6u 12u$(small) cacheajout">
                                        <input type="submit" value="Valider" class="special" name="valider">
                                    </div>
                                </div>
                            </form>

                            <hr>
                            
							<table style="margin-top:30px;">
                                <thead>
                                    <tr>
                                        <th>Nom de l'hébergement</th>
                                        <th>Adresse</th>
                                        <th>Adresse (suite)</th>
                                        <th>Code postal</th>
                                        <th>Ville</th>
                                        <th>Téléphone</th>
                                        <th>Stock Single</th>
                                        <th>Stock Double</th>
                                        <th>Stock Twin</th>
                                        <th style="width: 130px; text-align: center;"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $db = mysqli_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
                                    mysqli_select_db($db, 'BddIdec');
                                    mysqli_query($db, "SET NAMES 'utf8'");
                                    mysqli_query($db, "SET CHARACTER SET utf8");
                                    $sql = 'SELECT * FROM HOTELS ORDER BY ID DESC';
                                    $req = mysqli_query($db, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error());
                                    while ($data = mysqli_fetch_array($req)) {
                                        
                                        $db = mysqli_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
                                        mysqli_select_db($db, 'BddIdec');
                                        mysqli_query($db, "SET NAMES 'utf8'");
                                        mysqli_query($db, "SET CHARACTER SET utf8");
                                        $sql2 = 'SELECT ID FROM ROOM WHERE HOTELS_ID = "'.$data['ID'].'" AND ROOM_TYPE = "Single"';
                                        $req2 = mysqli_query($db, $sql2) or die('Erreur SQL !<br />'.$sql2.'<br />'.mysqli_error());
                                        $data2 = mysqli_fetch_assoc($req2);
                                        mysqli_free_result($req2);
                                        
                                        $db = mysqli_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
                                        mysqli_select_db($db, 'BddIdec');
                                        mysqli_query($db, "SET NAMES 'utf8'");
                                        mysqli_query($db, "SET CHARACTER SET utf8");
                                        $sql3 = 'SELECT COUNT(ID) as total FROM USERS WHERE HOTEL_ID="'.$data2['ID'].'"';
                                        $req3 = mysqli_query($db, $sql3) or die('Erreur SQL !<br />'.$sql3.'<br />'.mysqli_error());
                                        $data3 = mysqli_fetch_assoc($req3);
                                        mysqli_free_result($req3);
                                        
                                        $db = mysqli_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
                                        mysqli_select_db($db, 'BddIdec');
                                        mysqli_query($db, "SET NAMES 'utf8'");
                                        mysqli_query($db, "SET CHARACTER SET utf8");
                                        $sql4 = 'SELECT ID FROM ROOM WHERE HOTELS_ID = "'.$data['ID'].'" AND ROOM_TYPE = "Double"';
                                        $req4 = mysqli_query($db, $sql4) or die('Erreur SQL !<br />'.$sql4.'<br />'.mysqli_error());
                                        $data4 = mysqli_fetch_assoc($req4);
                                        mysqli_free_result($req4);
                                        
                                        $db = mysqli_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
                                        mysqli_select_db($db, 'BddIdec');
                                        mysqli_query($db, "SET NAMES 'utf8'");
                                        mysqli_query($db, "SET CHARACTER SET utf8");
                                        $sql5 = 'SELECT COUNT(ID) as total FROM USERS WHERE HOTEL_ID="'.$data4['ID'].'"';
                                        $req5 = mysqli_query($db, $sql5) or die('Erreur SQL !<br />'.$sql5.'<br />'.mysqli_error());
                                        $data5 = mysqli_fetch_assoc($req5);
                                        mysqli_free_result($req5);
                                        
                                        $db = mysqli_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
                                        mysqli_select_db($db, 'BddIdec');
                                        mysqli_query($db, "SET NAMES 'utf8'");
                                        mysqli_query($db, "SET CHARACTER SET utf8");
                                        $sql6 = 'SELECT ID FROM ROOM WHERE HOTELS_ID = "'.$data['ID'].'" AND ROOM_TYPE = "Twin"';
                                        $req6 = mysqli_query($db, $sql6) or die('Erreur SQL !<br />'.$sql6.'<br />'.mysqli_error());
                                        $data6 = mysqli_fetch_assoc($req6);
                                        mysqli_free_result($req6);
                                        
                                        $db = mysqli_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
                                        mysqli_select_db($db, 'BddIdec');
                                        mysqli_query($db, "SET NAMES 'utf8'");
                                        mysqli_query($db, "SET CHARACTER SET utf8");
                                        $sql7 = 'SELECT COUNT(ID) as total FROM USERS WHERE HOTEL_ID="'.$data6['ID'].'"';
                                        $req7 = mysqli_query($db, $sql7) or die('Erreur SQL !<br />'.$sql7.'<br />'.mysqli_error());
                                        $data7 = mysqli_fetch_assoc($req7);
                                        mysqli_free_result($req7);
                                        
                                        echo '<tr><td style="color:#f99f1b;">'.$data['NOM'].'</td><td>'.$data['ADRESSE1'].'</td><td>'.$data['ADRESSE2'].'</td><td>'.$data['CP'].'</td><td>'.$data['VILLE'].'</td><td>'.$data['TEL'].'</td><td>'.$data3['total'].'/'.$data['STOCK_SGL'].'</td><td>'.$data5['total'].'/'.$data['STOCK_DBL'].'</td><td>'.$data7['total'].'/'.$data['STOCK_TWIN'].'</td><td style="text-align: right;"><a data-fancybox data-type="iframe" data-src="settings-hebergement2-edit.php?item='.$data['ID'].'&event='.$data['EVENT_ID'].'" href="javascript:;" style="text-decoration:none;" title="Editer"><i class="fas fa-edit"></i></a><a href="duplicate-item.php?item='.$data['ID'].'&event='.$data['EVENT_ID'].'&table=HOTELS" style="text-decoration:none;" title="Copier"><i class="fas fa-clone"></i></a><a href="delete-item.php?item='.$data['ID'].'&event='.$data['EVENT_ID'].'&table=HOTELS" class="confirm" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a></td></tr>';
                                    }
                                    mysqli_free_result ($req);
                                    ?>
                                </tbody>
                            </table>
                                    <div class="12u$">
                                        <ul class="actions" style="float:right;"><li><a class="button special" href="settings.php?event=<?php echo $event; ?>">RETOUR</a></li></ul>
                                    </div>

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
			<script type="text/javascript">
				$(document).ready(function() {

					$("#add").click(function() {
						$("#ajout").css("display","block");
						$("#add").css("display","none");
					});

					$("#annuler").click(function() {
						$("#ajout").css("display","none");
						$("#add").css("display","inline-block");
						$("#messagein").css("display","none");
						$("#nom").css("border-color","#dbdbdb");
						$("#nom").val("");
					});

					$('.confirm').click(function(e) {
						e.preventDefault();
						if (window.confirm("Attention, êtes-vous sûr(e) de vouloir supprimer cet hébergement ?")) {
							location.href = this.href;
						}
					});
				});
			</script>

	</body>
</html>
