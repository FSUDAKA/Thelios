<?php

require_once '../projetExportTransfert/PHPExcel.php';
require_once '../projetExportTransfert/PHPExcel/IOFactory.php';
require_once '../config/Database.php';

if($_GET['export'] === 'true'){

	error_reporting(E_ALL);
	set_time_limit(0);

	$exporter = new PHPExcel();

	$db = Database::getMysqli();

    $sql = 'SELECT PARTICIPATION, CIVILITE, NOM, PRENOM, FONCTION, EMAIL, MOBILE FROM USERS WHERE DROIT = 0 ORDER BY NOM, PRENOM';

	try{
		$req = mysqli_query($db, $sql);
		$export = mysqli_fetch_all($req);

	}catch(Exception $e){
		echo $e->getMessage();
		die();
	}

	foreach($export as $key => $item){
		// Participation
		if($export[$key][0] == 1){$export[$key][0] = 'Oui';}else{if($export[$key][0] == 0){$export[$key][2] = 'En attente';}else{$export[$key][0] = 'Non';}}
	}

	$headers = [
		'Participation',
		'Civilité',
        "Nom",
        "Prénom",
        "Fonction",
        "Email",
        "Mobile"
	];

	$exporter->getProperties()->setCreator("AREP EXIGENCES");

	$feuille = $exporter->setActiveSheetIndex(0);
	$feuille->setTitle('Export');

	$exporter->getActiveSheet()->fromArray($headers, NULL, "A1", true);

	$i = 2;
	foreach($export as $value){
		$exporter->getActiveSheet()->fromArray($value, NULL, "A" . $i, true);
		$i++;
	}

	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

	// Nom de l'export
	header('Content-Disposition: attachment;filename=Export_'.date("Y-m-d").'.xls');

	header('Cache-Control: max-age=0');
	$objWriter = PHPExcel_IOFactory::createWriter($exporter, 'Excel5');
	$objWriter->save('php://output');
}
