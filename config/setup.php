<?php
if ($_SERVER['REQUEST_METHOD']) {
	header('HTTP/1.0 403 Forbidden');
	echo 'You are forbidden!';
	exit;
}

require "database.php";

try {
    $db = new PDO('mysql:host=127.0.0.1', $DB_USER, $DB_PASSWORD);
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION ); // Error Handling
    
    $db->exec("DROP DATABASE `$DB_NAME`;")
    or die(print_r($db->errorInfo(), true));
    print("Database ".$DB_NAME." dropped.\n");

    $db->exec("CREATE DATABASE IF NOT EXISTS `$DB_NAME`;
            CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
            GRANT ALL ON `$DB_NAME`.* TO '$user'@'localhost';
            FLUSH PRIVILEGES;")
    or die(print_r($db->errorInfo(), true));
    print("Created ".$DB_NAME." database.\n");
    
    $DB_DSN = 'mysql:dbname=camagru;host=127.0.0.1';
    $db = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    $table = "users";
    $sql ="CREATE table $table(
    id_user SMALLINT( 11 ) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR( 40 ) NOT NULL, 
    email VARCHAR( 255 ) NOT NULL, 
    pswd CHAR( 128 ) NOT NULL,
    confirmed TINYINT( 1 ) NOT NULL,
    creation_date DATETIME NOT NULL )";
    $db->exec($sql);
    print("Created $table table.\n");

    $table = "posts";
    $sql ="CREATE table $table(
    id_post SMALLINT( 11 ) AUTO_INCREMENT PRIMARY KEY,
    photo_name VARCHAR( 500 ) NOT NULL, 
    creation_date DATETIME NOT NULL,
    id_user SMALLINT( 11 ),
    FOREIGN KEY (id_user) REFERENCES users(id_user) )";
    $db->exec($sql);
    print("Created $table table.\n");

    $table = "comments";
    $sql ="CREATE table $table(
    id_comment SMALLINT( 11 ) AUTO_INCREMENT PRIMARY KEY,
    comment VARCHAR( 8000 ) NOT NULL, 
    creation_date DATETIME NOT NULL,
    id_user SMALLINT( 11 ),
    FOREIGN KEY (id_user) REFERENCES users(id_user),
    id_post SMALLINT( 11 ),
    FOREIGN KEY (id_post) REFERENCES posts(id_post) )";
    $db->exec($sql);
    print("Created $table table.\n");

    $table = "likes";
    $sql ="CREATE table $table(
    id_like SMALLINT( 11 ) AUTO_INCREMENT PRIMARY KEY,
    id_user SMALLINT( 11 ),
    FOREIGN KEY (id_user) REFERENCES users(id_user),
    id_post SMALLINT( 11 ),
    FOREIGN KEY (id_post) REFERENCES posts(id_post) )";
    $db->exec($sql);
    print("Created $table table.\n");

} catch (PDOException $e) {
    die("DB ERROR: ". $e->getMessage());
}