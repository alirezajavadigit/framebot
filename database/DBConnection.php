<?php


namespace database;

use PDO;
use PDOException;

class DBConnection{

    private static $dbConnectionInstance = null;
    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    private $dbHost = DB_HOST;
    private $dbUserName = DB_USERNAME;
    private $dbName = DB_NAME;
    private $dbPassword = DB_PASSWORD;
    private function __construct(){

    }

    public static function getDBConnectionInstance(){

        if(self::$dbConnectionInstance == null){
            $DBConnectionInstance = new DBConnection();
            self::$dbConnectionInstance = $DBConnectionInstance->dbConnection();
        }

        return self::$dbConnectionInstance;

    }

    private function dbConnection(){

        $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
        try{
            return new PDO("mysql:host=" . $this->dbHost. ";dbname=" . $this->dbName, $this->dbUserName, $this->dbPassword, $this->options);
        }
        catch (PDOException $e){
            echo "error in database connection: " . $e->getMessage();
            return false;
        }

    }


    public static function newInsertId(){

        return self::getDBConnectionInstance()->lastInsertId();

    }




}