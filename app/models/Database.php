<?php

class Database {
    
    public $PDO;

    public static function getPDO() {
        require __DIR__.'/../../config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        return $PDO;
    }

}