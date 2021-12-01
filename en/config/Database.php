<?php

class Database
{
    private static $env = 'preprod';
    private static $credentials = [];

    private static $db_dev = array("host" => "localhost", "port" => "3306", "dbname" => "arep-thelios", "login" => "vfa", "password" => "password");
    private static $db_preprod = array("host" => "localhost", "port" => "3306", "dbname" => "thelios", "login" => "admin_thelios", "password" => "Cbq_b767");
    private static $db_prod = array("host" => "localhost", "port" => "3306", "dbname" => "BddIdec", "login" => "adminidec", "password" =>    "hqwvZzbDhSBt");


    public static function getMysqli(){
        self::selectEnv();


        try {
            $db = new mysqli(self::$credentials['host'], self::$credentials['login'], self::$credentials['password'], self::$credentials["dbname"]);
        } catch (Exception $e) {
            var_dump($e);
        }
        mysqli_query($db, "SET NAMES 'utf8'");
        mysqli_query($db, "SET CHARACTER SET utf8");
        mysqli_query($db, "SET SESSION collation_connection = 'utf8_unicode_ci'");
        mysqli_query($db, "SET time_zone = '+01:30'");

        if ($db->connect_error) {
            die("Erreur de configuration de la base de données");
        }

        return $db;
    }

    public static function getPdo(){
        self::selectEnv();
        $pdo = new PDO('mysql:' . self::$credentials['host'] . ';dbname= ' . self::$credentials['dbname'], self::$credentials['login'], self::$credentials['password']);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

    private static function selectEnv(){
        switch (self::$env) {
            case 'dev':
                self::$credentials = self::$db_dev;
                break;

            case 'preprod':
                self::$credentials = self::$db_preprod;
                break;

            case 'prod':
                self::$credentials = self::$db_prod;
                break;
            default:
                die("Erreur de configuration de la base de données !");
        }
    }
 }
