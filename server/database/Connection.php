<?php

namespace database;

use base\config\Credentials;
use Exception;
use mysqli;

require_once __DIR__ . './../config/Credentials.php';

class Connection {

    private static $instance;
    private $dbConn;

    private function __construct() {}

    /**
     * @return Connection
     */
    private static function get(){
        if (self::$instance == null){
            $className = __CLASS__;
            self::$instance = new $className;
        }

        return self::$instance;
    }

    /**
     * @return Connection
     */
    private static function initConnection(){
        $db = self::get();
        $db->dbConn = new mysqli(
            Credentials::DB_HOST,
            Credentials::DB_USERNAME,
            Credentials::DB_PASSWORD,
            Credentials::DB_NAME
        );
        $db->dbConn->set_charset('utf8');
        return $db;
    }

    /**
     * @return mysqli
     */
    public static function getInstance() {
        try {
            $db = self::initConnection();
            return $db->dbConn;
        } catch (Exception $e) {
            die('Unable to open a connection to the database. ' . $e->getMessage());
        }
    }

}
