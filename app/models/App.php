<?php

require 'Database.php';

class App {

    const DB_NAME = 'camagru';
    const DB_USER = 'root';
    const DB_PASS = 'r00tr00t';
    const DB_HOST = '127.0.0.1';


    private static $_database;

    public static function getDatabase() {
        if (self::$_database === null) {
            self::$_database = new Database(self::DB_NAME, self::DB_USER, self::DB_PASS, self::DB_HOST);
        }
        return self::$_database;
    }


}