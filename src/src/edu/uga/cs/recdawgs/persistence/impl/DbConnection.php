<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/6/16
 * Time: 09:34
 */

namespace edu\uga\cs\recdawgs\persistence\impl;

//config file
require_once('Config.php');

class DbConnection {

    public $data = "";
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASSWORD;
    private $dbtype = DB_TYPE;
    private $dbpath = ""; // SQL Lite
    private $dbname = DB_NAME;
    public $db = NULL;

    public function __construct(){

        $this->dbConnect();

    }

    private function dbConnect()    {

        $dbconn = "";

        // switching
        switch($this->dbtype){
            case "mysql":
                $dbconn = "mysql:host=$this->host;dbname=$this->dbname";
                break;

            case "sqlite":
                $dbconn = "sqlite:$this->dbpath";
                break;

            case "postgresql":
                $dbconn = "pgsql:host=$this->host dbname=$this->dbname";
                break;
        }

        // database connection
        $this->db = new \PDO($dbconn,$this->user,$this->pass);


    }
}