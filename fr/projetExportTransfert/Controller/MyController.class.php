<?php

class MyController {
	public static $bdd;
	public static $twig;
	protected static $instance;
	private $myModel;

	public function __construct() {
		$this->myModel = new MyModel();
	}	

	public static function getInstance() {
		$class = get_called_class();
		if($class::$instance == null) {
			$class::$instance = new $class();
		}

		return $class::$instance;
	}

	public static function redirect($target) {
		echo '<meta http-equiv="refresh" content="0;url='.$target.'">';
	}

	public static function displayError($error) {
		echo '<p class="error">'.$error.'<p>';
	}

    public function getAllBdd() {
		$bdd = $this->myModel->getAllBdd();

		return $bdd;
	}

    public function getAllBddIndexed() {
        $result = $this->myModel->getAllBddIndexed();

        return $result;
    }

    public function addUser($user) {
	    $result = $this->myModel->addUser($user);
    }

    public function getAllUsers() {
	    $result = $this->myModel->getAllUsers();

	    return $result;
    }

    public function deleteUser($id) {
	    $this->myModel->deleteUser($id);
    }

    public function getAllTables() {
		$tables = $this->myModel->getAllTables();
	
		return $tables;	
	}

    public function getAvailableDb($session) {
	    $content = $this->myModel->getAvailableDb($session);

	    return $content;
    }

    public function getDb($db) {
	    $bdd = $this->myModel->getDb($db);

	    return $bdd;
    }

    public function getAllFromTable($table) {
		$content = $this->myModel->getAllFromTable($table);

		return $content;
	}

	public function getAllFromTableWithSearch($table, $search) {
        $content = $this->myModel->getAllFromTableWithSearch($table, $search);

        return $content;
    }

    public function getAllFromTableBySort($table, $sort) {
        $content = $this->myModel->getAllFromTableBySort($table, $sort);

        return $content;
    }

    public function getColumnsFromTable($table) {
		$columns = $this->myModel->getColumnsFromTable($table);

		return $columns;
	}

    public function getFromTable($table, $columns) {
		$content = $this->myModel->getFromTable($table, $columns);

		return $content;
	}

    public function getFromTableWithSearch($table, $columns, $search) {
        $content = $this->myModel->getFromTableWithSearch($table, $columns, $search);

        return $content;
    }

    public function getAdmin($user) {
	    $admin = $this->myModel->getAdmin($user);
	    return $admin;
    }

	public static function loadTemplate($template, $array) {
		echo self::$twig->render($template, $array);	
	}

	public static function error($error) {

	}

	public static function formatArrayForTables($array, $bdd) {
		$i = 0;
		foreach ($array as $key => $value) {
			$tables[$i]['name'] = $value['Tables_in_'.$bdd];
			$i++;
		}

		return $tables;
	}

	public static function generateExcel($bdd, $table, $headers, $data) {

		date_default_timezone_set('Europe/Paris');

		$objPHPExcel = new PHPExcel();


		$objPHPExcel->getProperties()->setCreator("AREP EXIGENCES");


		$feuille = $objPHPExcel->setActiveSheetIndex(0);
		$feuille->setTitle($table);


		$objPHPExcel->getActiveSheet()->fromArray($headers, NULL, "A1", true);

		$i = 2;
		foreach($data as $value) {
			$objPHPExcel->getActiveSheet()->fromArray($value, NULL, "A".$i , true);	
			$i++;
		}

		    
		// Redirect output to a client’s web browser (Excel2007)
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); 
    	header('Content-Disposition: attachment;filename="'.$bdd.'-'.$table.'-'.date('d').'/'.date('m').'/'.date('y').'.xls"'); 
    	header('Cache-Control: max-age=0'); 
    	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    	$objWriter->save('php://output');
	}
}

?>