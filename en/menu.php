<?php if (($_SESSION['droit'] == 1) && ($_GET["view"] != "admin")){ ?>
<a href="backoffice.php">Gestion des événements</a>
<?php }else{ ?>
		<a href="../en" class="onlymobile" style="width: 50px !important; float: left; text-align: center; border:0 !important;"><img src="images/en.png" style="width: 30px;"></a>
		<a href="../fr" class="onlymobile" style="width: 50px !important; float: left; text-align: center; border:0 !important;"><img src="images/fr.png" style="width: 30px;"></a>
		<a href="../it" class="onlymobile" style="width: 50px !important; float: left; text-align: center; border:0 !important;"><img src="images/it.png" style="width: 30px;"></a>
<?php if($dataGeneral['OPT_ACCUEIL'] == 1){echo '<a class="mobileee" href="accueil.php'; if($_GET["event"] != ""){echo "?event=".$_GET["event"]."&view=admin";} echo'">Presentation</a>';} ?>
<?php if($dataGeneral['OPT_ACTUALITES'] == 1){echo '<a href="actualites.php'; if($_GET["event"] != ""){echo "?event=".$_GET["event"]."&view=admin";} echo'">Actualités</a>';} ?>
<?php /* if (($_SESSION['droit'] != 1) || ($_GET["event"] != "")){echo '<a data-fancybox href="#">Vidéo</a>';} */ ?>
<?php if($dataGeneral['OPT_PROGRAMME'] == 1){echo '<a href="programme.php'; if($_GET["event"] != ""){echo "?event=".$_GET["event"]."&view=admin";} echo'">Programme</a>';} ?>
<?php if($dataGeneral['OPT_HEBERGEMENT'] == 1){echo '<a class="mobileee" href="hotel.php'; if($_GET["event"] != ""){echo "?event=".$_GET["event"]."&view=admin";} echo'">Hotel</a>';} ?>
<?php if($dataGeneral['OPT_INFOSPRATIQUES'] == 1){echo '<a href="infos-pratiques.php'; if($_GET["event"] != ""){echo "?event=".$_GET["event"]."&view=admin";} echo'">Infos Pratiques</a>';} ?>
<?php if($dataGeneral['OPT_PRESSE'] == 1){echo '<a href="espace-presse.php'; if($_GET["event"] != ""){echo "?event=".$_GET["event"]."&view=admin";} echo'">Espace Presse</a>';} ?>
<?php if($dataGeneral['OPT_CONTACT'] == 1){echo '<a href="contactez-nous.php'; if($_GET["event"] != ""){echo "?event=".$_GET["event"]."&view=admin";} echo'">Contact</a>';} ?>
<?php } ?>


        <?php if (($_GET["view"] != "") || ($_SESSION['droit'] != 1) && ($isValid[0] == 1)) {
            echo '<a href="';
            if ($_GET["event"] != "") {
                echo "#";
            } else {
                echo "profil.php";
            }
            echo '" id="deconnexion" class="inscr nomobile" style="    margin-left: 50px;
    background: #fff;
    color: #000;">Registration</a>';
        } ?>





<?php if (($_SESSION['droit'] == 1) && ($_GET["idColaborateur"] != "")){ ?>
<span id="welcome" class="onlymobile"><?php echo $data1['PRENOM']." ".$data1['NOM'] ?></span>
<a href="deconnexion.php" id="deconnexion" class="onlymobile">Log out</a>
<?php }else{ ?>
<?php if ($_SESSION['id'] !== null) { ?>
<?php if(($_GET["view"] != "") || ($_SESSION['droit'] != 1)){echo '<a id="deconnexion" style="margin-bottom: 0.75em;" href="profil.php'; if($_GET["event"] != ""){echo "?event=".$_GET["event"];} echo'" class="onlymobile">Registration</a>';} ?>


<?php
    if($_GET["event"] == ""){
        if($_GET["idColaborateur"] == ""){
            if($_SESSION['droit'] == 1){
                echo '<span id="welcome" class="onlymobile">'.$data1['PRENOM']." ".$data1['NOM'].'</span>';
            }else{
                echo '<span id="welcome" class="onlymobile">'.$data['PRENOM']." ".$data['NOM'].'</span>';
            }
        }else{
            echo '<span id="welcome" class="onlymobile">'.$data1['PRENOM']." ".$data1['NOM'].'</span>';
        }
    }else{
        if($_GET["view"] == "admin"){
            echo '<span id="welcome" class="onlymobile">Prénom NOM</span>';
        }else{
            echo '<span id="welcome" class="onlymobile">'.$data1['PRENOM']." ".$data1['NOM'].'</span>';
        }
    }
?>
<?php if($_GET["event"] == ""){echo '<a href="deconnexion.php" id="deconnexion" class="onlymobile">Log out</a>';}else{echo '<a href="#" id="deconnexion" class="onlymobile">Log out</a>';} ?>
<?php }else{ ?>

        <a href="profil.php" id="deconnexion" class="onlymobile">Registration</a>
<?php } ?>
<?php } ?>