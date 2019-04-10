<?php

class Database {

    private $DB_NAME;
    private $DB_USER;
    private $DB_PASS;
    private $DB_HOST;
    private $PDO;

    public function __construct($DB_NAME = 'camagru', $DB_USER = 'root', $DB_PASS = 'r00tr00t', $DB_HOST = '127.0.0.1') {
        $this-> $DB_NAME = $DB_NAME;
        $this-> $DB_USER = $DB_USER;
        $this->$DB_PASS = $DB_PASS;
        $this->$DB_HOST = $DB_HOST;
    }

    private function getPDO() {
        if ($this->PDO === null) {
            $PDO = new PDO('mysql:dbname=camagru;host=127.0.0.1', 'root', 'r00tr00t');
            $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $this->PDO = $PDO;
        }
        return $PDO;
    }
    
    public function query($statement, $class_name) {
       $req = $this->getPDO()->query($statement);
       $data = $req->fetchAll(PDO::FETCH_CLASS, $class_name);
       return $data;
    }
}