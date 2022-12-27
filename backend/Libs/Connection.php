<?php

namespace backend\Libs;
use PDO;
use PDOException;

abstract class Connection{

    private static $instance;    
    
    public static function getInstance() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "";
        
        if (!isset(self::$instance)) {
            try {
                self::$instance = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	            // $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // self::$instance = new PDO("pgsql:host=localhost;port=5432;dbname=sistema;user=postgres;password=postgres");
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                self::$instance->query("SET TIME ZONE 'America/Sao_Paulo'");
                self::$instance->query('SET datestyle TO "SQL, dmY"');
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return self::$instance;
    }
}