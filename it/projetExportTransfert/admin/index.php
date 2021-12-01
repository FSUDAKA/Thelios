<?php
session_start();

// Loader des fichiers essentiels /!\ TWIG doit être chargé après la génération du fichier Excel !
require '../loaderFile.php';

// Check si l'utilisateur est déjà connecté et administrateur, sinon le renvoi sur la page login
require 'security.php';

$controller = MyController::getInstance();
$databases = $controller->getAllBddIndexed();

// On charge Twig après la génération du fichier Excel pour la modification des headers
require 'loaderTwig.php';

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $admin = (isset($_POST['admin'])) ? $_POST['admin'] : 0;

    $user = array(
        $_POST['username'],
        md5($_POST['password']),
        implode(',', $_POST['dbs']),
        $admin
    );
    $controller->addUser($user);
    $users = $controller->getAllUsers();

    MyController::loadTemplate('admin.tpl', array(
        'databases' => $databases,
        'message' => 'L\'utilisateur a bien été créé',
        'users' => $users
    ));
}else{

    if($_GET['action'] == "delete") {
        $controller->deleteUser($_GET['id']);
    }

    $users = $controller->getAllUsers();

    MyController::loadTemplate('admin.tpl', array(
        'databases' => $databases,
        'users' => $users
    ));
}


?>