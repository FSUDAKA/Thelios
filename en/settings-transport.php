<?php

include 'connect-backoffice.php';

require_once './class/Transport.php';
require_once './class/Event.php';
require_once './class/User.php';

$transport = new Transport();
$evt       = new Event();
$usr       = new User();

$event = $_GET["event"];
    

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['valider'])){
    
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
            
            $error = "Attention, ce nom est déjà utilisé.";
            $color = "#FF0000";
            $valid = "0";
		  echo "<style>#ajout{display:block;} #add{display:none;}</style>";
            echo "<style>#NOM{border-color:#ff0000;}</style>";
            
        } else {
            $data = $transport->new($event, $TYPE, $MOYEN, $NOM, $DESCRIPTION, $NUMERO, $DE, $A, $DATE_DEPART, $HEURE_DEPART, $DATE_ARRIVEE, $HEURE_ARRIVEE);
            echo "<style>#ajout{display:none;}</style>";

            $error = "Le transport a bien été ajouté.";
            $color = "#28a745";
            $valid = "0";
    
            $TYPE = "";
            $MOYEN = "";
            $NOM = "";
            $DESCRIPTION = "";
            $NUMERO = "";
            $DE = "";
            $A = "";
            $DATE_DEPART = "";
            $HEURE_DEPART = "";
            $DATE_ARRIVEE = "";
            $HEURE_ARRIVEE = "";

                
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
                            
                            <span class="button special" id="add">Ajouter un transport</span>
                            
                            <form method="post" action="settings-transport.php?event=<?php echo $data['ID']; ?>" enctype="multipart/form-data" id="ajout">

                                <div class="row uniform">

                                    <div class="12u$ 12u$(small) cacheajout">
                                        <h4 style="width:100%; color:#9a9a9a;">Ajouter un transport</h4>
                                    </div>

                                </div>
                                
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
                                    <div class="6u 12u$(small) cacheajout">
                                        <span class="button special" id="annuler">ANNULER</span>
                                    </div>
                                    <div class="6u$ 12u$(small) cacheajout">
                                        <input type="submit" value="Valider" class="special" name="valider">
                                    </div>
                                </div>
                            </form>

                            <hr>
                            
							<table style="margin-top:30px;">
                                <thead>
                                    <tr>
                                        <th>Nom du transport</th>
                                        <th>Description</th>
                                        <th>Type de transport</th>
                                        <th>Moyen de transport</th>
                                        <th>Numéro</th>
                                        <th>Lieu de départ</th>
                                        <th>Lieu d'arrivée</th>
                                        <th>Date de départ</th>
                                        <th>Heure de départ</th>
                                        <th>Date d'arrivée</th>
                                        <th>Heure d'arrivée</th>
                                        <th style="width: 130px; text-align: center;"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $db = mysqli_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
                                    mysqli_select_db($db, 'BddIdec');
                                    mysqli_query($db, "SET NAMES 'utf8'");
                                    mysqli_query($db, "SET CHARACTER SET utf8");
                                    $sql = 'SELECT * FROM TRANSPORTS ORDER BY ID DESC';
                                    $req = mysqli_query($db, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error());
                                    while ($data = mysqli_fetch_array($req)) {
                                        
                                        if($data['DATE_DEPART'] != ""){
                                        $date_depart = explode("-", $data['DATE_DEPART']);
                                        $date_depart = $date_depart[2].'/'.$date_depart[1].'/'.$date_depart[0];
                                        }else{
                                            $date_depart = "";
                                        }
                                            
                                        if($data['DATE_ARRIVEE'] != ""){
                                        $date_arrivee = explode("-", $data['DATE_ARRIVEE']);
                                        $date_arrivee = $date_arrivee[2].'/'.$date_arrivee[1].'/'.$date_arrivee[0];
                                        }else{
                                            $date_arrivee = "";
                                        }
                                        
                                        
                                        echo '<tr><td style="color:#f99f1b;">'.$data['NOM'].'</td><td>'.$data['DESCRIPTION'].'</td><td>'.$data['TYPE'].'</td><td>'.$data['MOYEN'].'</td><td>'.$data['NUMERO'].'</td><td>'.$data['DE'].'</td><td>'.$data['A'].'</td><td>'.$date_depart.'</td><td>'.$data['HEURE_DEPART'].'</td><td>'.$date_arrivee.'</td><td>'.$data['HEURE_ARRIVEE'].'</td><td style="text-align: right;"><a data-fancybox data-type="iframe" data-src="settings-transport-edit.php?item='.$data['ID'].'&event='.$data['EVENT_ID'].'" href="javascript:;" style="text-decoration:none;" title="Editer"><i class="fas fa-edit"></i></a><a href="duplicate-item.php?item='.$data['ID'].'&event='.$data['EVENT_ID'].'&table=TRANSPORTS" style="text-decoration:none;" title="Copier"><i class="fas fa-clone"></i></a><a href="delete-item.php?item='.$data['ID'].'&event='.$data['EVENT_ID'].'&table=TRANSPORTS" class="confirm" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a></td></tr>';
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
						if (window.confirm("Attention, êtes-vous sûr(e) de vouloir supprimer ce transport ?")) {
							location.href = this.href;
						}
					});
				});
			</script>

	</body>
</html>
