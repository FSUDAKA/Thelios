<?php
require_once './PHPExcel.php';
require_once '../projetExportTransfert/PHPExcel/IOFactory.php';
require_once  '../config/Database.php';

$db = Database::getMysqli();
$exporter = new PHPExcel();
date_default_timezone_set('Europe/Paris');

// Onglet 1
if ($_GET['export'] == 'onglet1'){

    $headers = 	['Participation', 'Civilité', 'Nom', 'Prénom', 'Date de naissance', 'Numéro de téléphone', 'E-mail', 'Pièce d\'identité', 'Numéro de passeport/CNI', 'Nationalité', 'Date de validité du passeport/CNI', 'Employé/client', 'Fonction', 'Magasin', 'Type de transport', 'De quel aéroport ou gare souhaitez-vous partir ?', 'Date de départ', 'Plage horaire souhaitée de départ', 'Vers quel aéroport ou gare souhaitez-vous revenir ?', 'Date de retour', 'Plage horaire souhaitée de retour', 'Transfert vers hôtel', 'Transfert vers aéroport/gare', 'Voyagez-vous accompagné(e) ?', 'Accompagnant(s) transport', 'Référence billet aller', 'Référence billet retour', 'Partagez-vous votre chambre ?', 'Accompagnant(s) hébergement', 'Accompagnant enfant', 'Lit', 'Commentaires', 'Test PCR', 'Conditions sanitaire', 'Conditions', 'Connexion', 'Enregistrement'];

    $sql = 'SELECT PARTICIPATION, CIVILITE, NOM, PRENOM, ADRESSE1, MOBILE, EMAIL, CP, VILLE, ADRESSE2, TEL, MATRICULE, FONCTION, TYPE, TRANSPORT, VILLE_DEPART1, TRANS_ALLER, PRESENT_DEJ1, VILLE_DEPART2, TRANS_RETOUR, PRESENT_DEJ2, PRESENT_REUNION1, PRESENT_REUNION21, PRESENT_REUNION31, PRESENT_REUNION4, PRESENT_DEJ3, PRESENT_DEJ4, PRESENT_NUIT1, PRESENT_NUIT2, PRESENT_PDEJ4, PRESENT_NUIT3, REMARQUES_TRANS, NAVETTE, NAV, CONDITIONS, CONNEXION, NOM_ACC FROM USERS WHERE DROIT = 0 ORDER BY NOM, PRENOM';
	
		
		$data['PRESENT_PDEJ4'] = $_POST['accompagnant_enfant'];

    $req = mysqli_query($db, $sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysqli_error());
    $i=1;
    $data = mysqli_fetch_all($req);
    foreach($data as $key => $line){

        if($data[$key][0] == "1"){$data[$key][0] = 'Oui';}
        if($data[$key][0] == "2"){$data[$key][0] = 'Non';}

        if($data[$key][7] == "1"){$data[$key][7] = 'Passeport';}
        if($data[$key][7] == "2"){$data[$key][7] = 'CNI';}

        if($data[$key][11] == "1"){$data[$key][11] = 'Employé';}
        if($data[$key][11] == "2"){$data[$key][11] = 'Client';}

        if($data[$key][14] == "1"){$data[$key][14] = 'Avion';}
        if($data[$key][14] == "2"){$data[$key][14] = 'Train';}

        if($data[$key][21] == "1"){$data[$key][21] = 'Oui';}
        if($data[$key][21] == "2"){$data[$key][21] = 'Non';}

        if($data[$key][22] == "1"){$data[$key][22] = 'Oui';}
        if($data[$key][22] == "2"){$data[$key][22] = 'Non';}

        if($data[$key][23] == "1"){$data[$key][23] = 'Oui';}
        if($data[$key][23] == "2"){$data[$key][23] = 'Non';}

        if($data[$key][27] == "1"){$data[$key][27] = 'Oui';}
        if($data[$key][27] == "2"){$data[$key][27] = 'Non';}

        if($data[$key][29] == "1"){$data[$key][29] = 'Oui';}
        if($data[$key][29] == "2"){$data[$key][29] = 'Non';}

        if($data[$key][30] == "1"){$data[$key][30] = '1 grand lit pour 2 personnes';}
        if($data[$key][30] == "2"){$data[$key][30] = '2 lits simples';}

        if($data[$key][32] == "1"){$data[$key][32] = 'Oui';}
        if($data[$key][32] == "2"){$data[$key][32] = 'Non';}

        if($data[$key][33] == "1"){$data[$key][33] = 'Acceptées';}
		
		if($data[$key][34] == "1"){$data[$key][34] = 'Acceptées';}
    }

    $exporter->getProperties()->setCreator("AREP EXIGENCES");

    $feuille = $exporter->setActiveSheetIndex(0);
    $feuille->setTitle('Export');

    $exporter->getActiveSheet()->fromArray($headers, NULL, "A1", true);

    $i = 2;
    foreach($data as $value) {
        $exporter->getActiveSheet()->fromArray($value, NULL, "A".$i , true);
        $i++;
    }

    // Redirect output to a client’s web browser (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    // Nom de l'export
    header('Content-Disposition: attachment;filename=Export_'.date("Y-m-d").'.xls');

    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($exporter, 'Excel5');
    $objWriter->save('php://output');
}