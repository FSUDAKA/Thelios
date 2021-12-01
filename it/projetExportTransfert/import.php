<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    date_default_timezone_set ( 'Europe/Paris' );
    session_start();
    require 'PHPExcel.php';

    /*
     * UPLOAD XLSX
     */

    $name = $_FILES['import']['name'];
    $tmp = $_FILES['import']['tmp_name'];
    $extension = pathinfo($name, PATHINFO_EXTENSION);
    $newName = 'file' . rand(1,10000) . '.' . $extension;
    var_dump($newName);
    $validExtension = array('xlsx', 'xls');

    try {
        if (in_array($extension, $validExtension)) {

            move_uploaded_file($tmp, './imports/'.$newName);

            /*
             * Read XLSX
             */

            $path = './imports/'.$newName;
            $objPHPExcel = PHPExcel_IOFactory::load($path);
            foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                $worksheetTitle     = $worksheet->getTitle();
                $highestRow         = $worksheet->getHighestRow(); // e.g. 10
                $highestColumn      = $worksheet->getHighestColumn(); // e.g 'F'
                $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
                $nrColumns = ord($highestColumn) - 64;

                for ($row = 1; $row <= $highestRow; ++ $row) {
                    for ($col = 0; $col < $highestColumnIndex; ++ $col) {
                        $cell = $worksheet->getCellByColumnAndRow($col, $row);
                        $val = $cell->getValue();

                        $data[$row][] = $val;

                        $dataType = PHPExcel_Cell_DataType::dataTypeForValue($val);
                    }
                }
            }

            /*
             *  INSERT DATA
             */

            // Before, the array must be cleaned
            foreach($data as $key => $value) {
                foreach ($value as $key2 => $string) {
                    $data[$key][$key2] = str_replace('"', '', $string);
                }
            }


            $columns = implode(', ', $data[1]);
            $countData = count($data) + 1;

            $bdd = new PDO('mysql:host=localhost;', 'arep_CATB', 'arep-sa');
            $bdd->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $bdd->exec('set names utf8');

            $bdd->exec('use '.$_POST['bdd']);

            for($i=2; $i < $countData; $i++) {
                $values = implode('", "', $data[$i]);

                try {
                    $request = $bdd->prepare('INSERT INTO '.$_POST['table'].' ('.$columns.') VALUES ("'.$values.'")');
                    $request->execute(array());
                }catch(PDOException $e) {
                    $code = $e->getCode();

                    $erreur = array(
                        "42S22" => "Erreur : Les colonnes ne correspondent pas",
                        "23000" => "Erreur : La colonne ID ne doit pas être présente"
                    );

                    $_SESSION['message'] = (isset($erreur[$code])) ? $erreur[$code] : 'Erreur : ' . $e->getMessage();

                    unlink($newName);
                    header('Location: ' . $_POST['redirect_url']);
                }
            }

            unlink($newName);
            $_SESSION['message'] = "Le fichier a bien été importé";
            header('Location: ' . $_POST['redirect_url']);

        } else {
            throw new Exception('Le fichier n\'est pas valide');
        }
    }catch(Exception $e) {
        $_SESSION['message'] = $e->getMessage();
        header('Location: ' . $_POST['redirect_url']);
    }
