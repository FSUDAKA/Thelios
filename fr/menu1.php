<?php

require_once __DIR__ . '/class/Societe.php';

$entreprise = new Societe();

$avalaibleLangages = ['fr', 'en', 'it'];

if (!isset($_GET['lang']) OR !in_array($_GET['lang'], $avalaibleLangages)) {
    setcookie('lang', 'fr', strtotime('+30 days'));
}else{
    setcookie('lang', $_GET['lang'], strtotime('+30 days'));
}

$isValid = $entreprise->isValidById($data['SOCIETE_ID']);


if (($data["FIRST_CO"] == 1) || ($data1["FIRST_CO"] == 1) OR $data1['GROUPE'] === 'ADMIN' || $data['GROUPE'] === 'ADMIN') {
?>
    <a href="../en" data-lang="en" class="iconlang">
        <img src="images/en.png">
    </a>
    <a href="../fr" data-lang="fr" class="iconlang">
        <img src="images/fr.png">
    </a>
    <a href="../it" data-lang="it" class="iconlang">
        <img src="images/it.png">
    </a>

<?php
    if (($_SESSION['droit'] == 1) && ($_GET["idColaborateur"] != "")) { ?>
        <span id="welcome"><?php echo $data1['PRENOM'] . " " . $data1['NOM'] ?></span>
        <a href="deconnexion.php" id="deconnexion">Déconnexion</a>
    <?php } elseif ($_SESSION['id'] !== null) { ?>
        <?php /* if (($_GET["view"] != "") || ($_SESSION['droit'] != 1)) {
            echo '<a href="';
            if ($_GET["event"] != "") {
                echo "#";
            } else {
                echo "societe.php";
            }
            echo '">Société</a>';
        } */ ?>
        <?php
        if ($_GET["event"] == "") {
            if ($_GET["idColaborateur"] == "") {
                if ($_SESSION['droit'] == 1) {
                    echo '<span id="welcome">' . $data1['PRENOM'] . " " . $data1['NOM'] . '</span>';
                } else {
                    echo '<span id="welcome">' . $data['PRENOM'] . " " . $data['NOM'] . '</span>';
                }
            } else {
                echo '<span id="welcome">' . $data1['PRENOM'] . " " . $data1['NOM'] . '</span>';
            }
        } else {
            if ($_GET["view"] == "admin") {
                echo '<span id="welcome">Prénom NOM</span>';
            } else {
                echo '<span id="welcome">' . $data1['PRENOM'] . " " . $data1['NOM'] . '</span>';
            }
        }
        ?>
        <?php if ($_GET["event"] == "") {
            echo '<a href="deconnexion.php" id="deconnexion">Déconnexion</a>';
        } else {
            echo '<a href="./deconnexion.php" id="deconnexion">Déconnexion</a>';
        } ?>
    <?php } else { ?>


        <a href="profil.php" id="deconnexion">Inscrivez-vous</a>

    <?php }
} else {
    ?>

<a href="../en" data-lang="en" class="iconlang"><img src="images/en.png" style=""></a>
<a href="../fr" data-lang="fr" class="iconlang"><img src="images/fr.png" style=""></a>
<a href="../it" data-lang="it" class="iconlang"><img src="images/it.png" style=""></a>

        <a href="profil.php" id="deconnexion" trad-ref='inscription'>Inscrivez-vous</a>

<?php } ?>
