<?php
	session_start();
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	// Check si l'utilisateur est déjà connecté, sinon le renvoi sur la page login
	require 'security.php';

	// Loader des fichiers essentiels /!\ TWIG doit être chargé après la génération du fichier Excel !
	require 'loaderFile.php';

	$bdd = isset($_GET['bdd']);
	$table = isset($_GET['table']);
	$export = isset($_GET['export']);
	$filters = isset($_GET['filters']);
	$search = isset($_GET['search']);
	$sort = isset($_GET['sort']);
	$controller = MyController::getInstance();


	if($export) {

		if($filters) {

			MyController::$bdd->query('use '.$_GET['bdd']);
			$content = $controller->getFromTable($_GET['table'], $_GET['filters']);
			$columns = $_GET['filters'];
			$headers = $columns;

			foreach ($content as $key => $value) {
				$data[] = $value;
			}

			MyController::generateExcel($_GET['bdd'], $_GET['table'], $headers, $data);

		}else{

			MyController::$bdd->query('use '.$_GET['bdd']);
			$content = $controller->getAllFromTable($_GET['table']);
			$columns = $controller->getColumnsFromTable($_GET['table']);

			foreach ($columns as $key => $value) {
				$headers[] = $value['Field'];
			}

			foreach ($content as $key => $value) {
				$data[] = $value;
			}

			// On appelle la fonction qui génère le fichier excel si l'export est demandé
			MyController::generateExcel($_GET['bdd'], $_GET['table'], $headers, $data);

		}
	}

	// On charge Twig après la génération du fichier Excel pour la modification des headers
	require 'loaderTwig.php';


	if($bdd) {
		// La base de donnée à utilisée
		MyController::$bdd->query('use '.$_GET['bdd']);

		if($table) {

            if($search) {

                $searchArray = array();
                $searchString = "";

                $columns = $controller->getColumnsFromTable($_GET['table']);

                foreach($columns as $column) {

                    if($_GET[$column['Field']] != "") {
                        $searchArray[$column['Field']] = $_GET[$column['Field']];
                    }
                }

                $count = 0;
                foreach($searchArray as $key => $searching) {
                    if($count == 0) {
                        $searchString .= $key . ' LIKE "%' . $searching .'%"';
                    }else{
                        $searchString .= ' AND ' . $key . ' LIKE "%' . $searching . '%"';
                    }

                    $count++;
                }

                $content = $controller->getAllFromTableWithSearch($_GET['table'], $searchString);
                $columns = $controller->getColumnsFromTable($_GET['table']);
                $nbColumns = count($columns);

                $vars = array(
                    'columns' => $columns,
                    'content' => $content,
                    'nbColumns' => $nbColumns,
                    'table' => $_GET['table'],
                    'bdd' => $_GET['bdd']
                );

                if(isset($_SESSION['message'])) {
                    $message = $_SESSION['message'];
                    unset($_SESSION['message']);
                }else{
                    $message = "";
                }

                $vars['message'] = $message;

                MyController::loadTemplate('content.tpl', $vars);

            }else if($sort) {

                $content = $controller->getAllFromTableBySort($_GET['table'], $_GET['sort']);
                $columns = $controller->getColumnsFromTable($_GET['table']);
                $nbColumns = count($columns);

                $vars = array(
                    'columns' => $columns,
                    'content' => $content,
                    'nbColumns' => $nbColumns,
                    'table' => $_GET['table'],
                    'bdd' => $_GET['bdd']
                );

                if(isset($_SESSION['message'])) {
                    $message = $_SESSION['message'];
                    unset($_SESSION['message']);
                }else{
                    $message = "";
                }

                $vars['message'] = $message;

                MyController::loadTemplate('content.tpl', $vars);

            }else{

                $content = $controller->getAllFromTable($_GET['table']);
                $columns = $controller->getColumnsFromTable($_GET['table']);
                $nbColumns = count($columns);

                $vars = array(
                    'columns' => $columns,
                    'content' => $content,
                    'nbColumns' => $nbColumns,
                    'table' => $_GET['table'],
                    'bdd' => $_GET['bdd']
                );

                if(isset($_SESSION['message'])) {
                    $message = $_SESSION['message'];
                    unset($_SESSION['message']);
                }else{
                    $message = "";
                }

                $vars['message'] = $message;

                MyController::loadTemplate('content.tpl', $vars);
            }

		}else{

			$tables = $controller->getAllTables();

			// On formate le tableau pour faciliter l'affichage avec Twig
			$tables = MyController::formatArrayForTables($tables, $_GET['bdd']);

			$vars = array(
				'tables' => $tables,
				'bdd' => $_GET['bdd']
			);

			MyController::loadTemplate('tables.tpl', $vars);

		}

	}else{
		$controller = MyController::getInstance();

		$available = $controller->getAvailableDb($_SESSION['CONNECTED']);

        if($available == "" || $available == "*") {
            $bdd = $controller->getAllBdd();
        }else{
            $available = explode(',', $available);
            $bases = $controller->getDb($available);
            foreach($bases as $base) {
                if($base['name'] != "") {
                    $bdd[]['Database'] = $base['name'];
                }
            }
        }

        $admin = $controller->getAdmin($_SESSION['CONNECTED']);

		$vars = array(
			'bdd' => $bdd,
            'admin' => $admin
		);

		MyController::loadTemplate('index.tpl', $vars);
	}

?>