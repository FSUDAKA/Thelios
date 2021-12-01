<?php

require_once './class/User.php';

$model = new User();
$id = $_GET["user"];

if($id != ""){
    //$item = $_GET["item"];
    $event = $_GET["event"];
    $table = $_GET["table"];
	$soc = $_GET["soc"];

  //  si un numéro de société est passé en paramètre alors supprimer la société, le principal et tous les collaborateurs sinon ne supprimer que le collaborateur
	if($soc != ""){	$data = $model->deleteFromSoc($soc);}
	else{	$data = $model->deleteFromId($id);;}

    header("Location: liste.php?event=".$event);
}
?>