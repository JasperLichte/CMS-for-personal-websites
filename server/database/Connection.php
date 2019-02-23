<?php

namespace database;

require_once 'credentials.php';

use Exception;
use mysqli;

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
            DB_HOST,
            DB_USERNAME,
            DB_PASSWORD,
            DB_NAME
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
