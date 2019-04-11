<?php

class User {

    public static function insertUser($user) {
        require './config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $req = $PDO->prepare("INSERT INTO users (username, email, pswd, confirmed, creation_date) 
            VALUES (:username, :email, :pswd, :confirmed, :creation_date)");
        $req->execute(array(
            "username" => $user[0], 
            "email" => $user[1],
            "pswd" => $user[2],
            "confirmed" => $user[3],
            "creation_date" => $user[4],
        ));
        mail($user[1],'Welcome aboard !','Hello '.$user[0].', welcome on Camagru !');
    }


    public static function userExists($user_cred) {
        require './config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $username = $user_cred['username'];
        $pswd = $user_cred['pswd'];
        $req = $PDO->prepare("SELECT * FROM users WHERE username = :username AND pswd = :pswd");
        $req->execute( array( 'username' => $username, 'pswd' => $pswd ) );
        $data = $req->fetch();
        return $data;
    }

}
