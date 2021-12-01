<?php
include 'connect-backoffice.php';
require_once './class/Activity.php';
require_once './class/Event.php';
require_once './class/User.php';

$activity = new Activity();
$evt = new Event();
$usr = new User();

$event = $_GET["event"];

if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['valider'])){
    
    $THEME = $_POST['THEME'];
    $DESCRIPTION = $_POST['DESCRIPTION'];
    $DATE = $_POST['DATE'];
    $HEURE = $_POST['HEURE'];
    $SALLE = $_POST['SALLE'];
    
    if($_POST['THEME'] != ""){
        // todo tester cette version $activity->selectOne($THEME)
        $db = mysql_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
        mysql_select_db('BddIdec',$db);
        $result = mysql_query("SELECT 1 FROM ACTIVITES WHERE THEME='$THEME' LIMIT 1");
        if (mysql_fetch_row($result)) {
            
            $error = "Attention, ce nom est déjà utilisé.";
            $color = "#FF0000";
            $valid = "0";
		  echo "<style>#ajout{display:block;} #add{display:none;}</style>";
            echo "<style>#THEME{border-color:#ff0000;}</style>";
            
        } else {
	        $data = $activity->add($THEME, $DESCRIPTION, $DATE, $HEURE, $SALLE, $event);
            
            echo "<style>#ajout{display:none;}</style>";

            $error = "L'activité a bien été ajouté.";
            $color = "#28a745";
            $valid = "0";
            
            $THEME = "";
            $DESCRIPTION = "";
            $DATE = "";
            $HEURE = "";
            $SALLE = "";

                
        }
        
    }else{
		$error = "Attention, vous n'avez pas rempli tous les champs obligatoires.";
		$color = "#FF0000";
		$valid = "0";
		echo "<style>#ajout{display:block;} #add{display:none;}</style>";
		if ($_POST['THEME'] == ''){echo "<style>#THEME{border-color:#ff0000;}</style>";}
        
    }

}else{
    echo "<style>#ajout{display:none;}</style>"; 
}


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
                            
                            <span class="button special" id="add">Ajouter une activité</span>
                            
                            <form method="post" action="settings-activites.php?event=<?php echo $data['ID']; ?>" enctype="multipart/form-data" id="ajout">

                                <div class="row uniform">

                                    <div class="12u$ 12u$(small) cacheajout">
                                        <h4 style="width:100%; color:#9a9a9a;">Ajouter une activité</h4>
                                    </div>

                                </div>
                                
                                <div class="row uniform">
                                    <div class="12u$ 12u$(xsmall)">
                                        <input type="text" name="THEME" id="THEME" value="<?php echo $THEME; ?>" placeholder="Nom">
                                    </div>
                                    <div class="6u 12u$(xsmall)">
                                        <input type="text" name="DESCRIPTION" id="DESCRIPTION" value="<?php echo $DESCRIPTION; ?>" placeholder="Description">
                                    </div>
                                    <div class="6u$ 12u$(xsmall)" style="text-align: left;"><span class="date_debut_fin">Date :</span>
                                        <input type="date" name="DATE" id="DATE" value="<?php echo $DATE; ?>">
                                    </div>
                                    <div class="6u 12u$(xsmall)">
                                        <input type="text" name="HEURE" id="HEURE" value="<?php echo $HEURE; ?>" placeholder="Heure">
                                    </div>
                                    <div class="6u$ 12u$(xsmall)">
                                        <input type="text" name="SALLE" id="SALLE" value="<?php echo $SALLE; ?>" placeholder="Lieu">
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
                                        <th>Nom de l'activité</th>
                                        <th>Description</th>
                                        <th>Date</th>
                                        <th>Heure</th>
                                        <th>Lieu</th>
                                        <th style="width: 130px; text-align: center;"></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $db = mysqli_connect('localhost', 'adminidec', 'hqwvZzbDhSBt');
                                    mysqli_select_db($db, 'BddIdec');
                                    mysqli_query($db, "SET NAMES 'utf8'");
                                    mysqli_query($db, "SET CHARACTER SET utf8");
                                    $sql = 'SELECT * FROM ACTIVITES ORDER BY ID DESC';
                                    $req = mysqli_query($db, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error());
                                    
                                    while ($data = mysqli_fetch_array($req)) {
                                        
                                        $date = explode("-", $data['DATE']);
                                        $date = $date[2].'/'.$date[1].'/'.$date[0];
                                        
                                        echo '<tr><td style="color:#f99f1b;">'.$data['THEME'].'</td><td>'.$data['DESCRIPTION'].'</td><td>'.$date.'</td><td>'.$data['HEURE'].'</td><td>'.$data['SALLE'].'</td><td style="text-align: right;"><a data-fancybox data-type="iframe" data-src="settings-activites-edit.php?item='.$data['ID'].'&event='.$data['EVENT_ID'].'" href="javascript:;" style="text-decoration:none;" title="Editer"><i class="fas fa-edit"></i></a><a href="duplicate-item.php?item='.$data['ID'].'&event='.$data['EVENT_ID'].'&table=ACTIVITES" style="text-decoration:none;" title="Copier"><i class="fas fa-clone"></i></a><a href="delete-item.php?item='.$data['ID'].'&event='.$data['EVENT_ID'].'&table=ACTIVITES" class="confirm" style="text-decoration:none;" title="Supprimer"><i class="fas fa-trash"></i></a></td></tr>';
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
						if (window.confirm("Attention, êtes-vous sûr(e) de vouloir supprimer cette activité ?")) {
							location.href = this.href;
						}
					});
				});
			</script>

	</body>
</html>
