<?php include 'connect_accueil.php';

require_once './class/User.php';

$usr = new User();

$data = $usr->findOneById($_SESSION['id']);

if($_GET["event"] != ""){$eventurl = "?event=".$_GET['event'];}

if($dataGeneral["OPT_ACCUEIL"] != 1){
    if($dataGeneral["OPT_INSCRIPTION"] != 1){
        if($dataGeneral["OPT_PROGRAMME"] != 1){
            if($dataGeneral["OPT_HEBERGEMENT"] != 1){
                if($dataGeneral["OPT_INFOSPRATIQUES"] != 1){
                    if($dataGeneral["OPT_CONTACT"] != 1){
                    }else{
                        header("Location: contactez-nous.php$eventurl");
                    }
                }else{
                    header("Location: infos-pratiques.php$eventurl");
                }
            }else{
                header("Location: hebergement.php$eventurl");
            }
        }else{
            header("Location: programme.php$eventurl");
        }
    }else{
        header("Location: inscription.php$eventurl");
    }
}else{
    header("Location: accueil.php$eventurl");
}

?>
