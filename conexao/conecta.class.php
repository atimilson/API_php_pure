<?php 

class CON {
    public static $instance;

    private function __construct() {
        //
    }

    public static function getInstance() {
        try{
        //    $username = 'root';
        //    $password = '';
        //    self::$instance = new PDO('mysql:host=localhost;dbname=testebd', $username, $password);
            $username = 'root';
            $password = '';
            self::$instance = new PDO('mysql:host=localhost;dbname=testeDB', $username, $password);
            self::$instance->setAttribute(PDO::ATTR_ERRMODE,
            PDO::ERRMODE_EXCEPTION);
            self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS,
            PDO::NULL_EMPTY_STRING);
        }catch(PDOException $e){
            echo 'ERROR: ' . $e->getMessage();
        }
        return self::$instance;
    }

}

