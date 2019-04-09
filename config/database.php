<?php
$DB_DSN = 'mysql:host=127.0.0.1';

$DB_NAME = 'camagru';
$DB_USER = 'root';
$DB_PASSWORD = 'r00tr00t';

$host="127.0.0.1"; 

$user='bboucher';
$pass='bboucher';

    try {
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);

        $dbh->exec("CREATE DATABASE `$DB_NAME`;
                CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
                GRANT ALL ON `$DB_NAME`.* TO '$user'@'localhost';
                FLUSH PRIVILEGES;")
        or die(print_r($dbh->errorInfo(), true));
        print("Created ".$DB_NAME." database.\n");

        $DB_DSN = 'mysql:dbname=camagru;host=127.0.0.1';

        $table = "users";
        $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); // Error Handling
        $sql ="CREATE table $table(
        ID SMALLINT( 11 ) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR( 40 ) NOT NULL, 
        email VARCHAR( 255 ) NOT NULL, 
        pswd CHAR( 128 ) NOT NULL,
        confirmed TINYINT( 1 ) NOT NULL,
        creationdate DATETIME NOT NULL )";
        $db->exec($sql);
        print("Created $table Table.\n");

        $table = "posts";
        $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); // Error Handling
        $sql ="CREATE table $table(
        ID SMALLINT( 11 ) AUTO_INCREMENT PRIMARY KEY,
        comment VARCHAR( 8000 ) NOT NULL, 
        confirmed TINYINT( 1 ) NOT NULL,
        id_user SMALLINT( 11 ),
        FOREIGN KEY (id_user) REFERENCES users(id),
        creationdate DATETIME NOT NULL )";
        $db->exec($sql);
        print("Created $table Table.\n");


    } catch (PDOException $e) {
        die("DB ERROR: ". $e->getMessage());
    }
 
