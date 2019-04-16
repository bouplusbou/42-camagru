<?php

class User {

    public static function insertUser($user) {
        require './config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $req = $PDO->prepare("  INSERT INTO users (username, email, pswd, verif_hash, confirmed, creation_date) 
                                VALUES (:username, :email, :pswd, :verif_hash, :confirmed, :creation_date)");
        $req->execute(array(
            "username" => $user[0], 
            "email" => $user[1],
            "pswd" => $user[2],
            "verif_hash" => $user[3],
            "confirmed" => $user[4],
            "creation_date" => $user[5]
        ));
    }

    public static function userCredsOK($user_cred) {
        require './config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $username = $user_cred['username'];
        $pswd = $user_cred['pswd'];
        $req = $PDO->prepare("SELECT pswd FROM users WHERE username = :username");
        $req->execute( array('username' => $username) );
        $hashed_pswd = $req->fetch();
        if (password_verify($pswd, $hashed_pswd['pswd'])) {
            $req = $PDO->prepare("SELECT id_user, username, confirmed FROM users WHERE username = :username");
            $req->execute( array('username' => $username) );
            $data = $req->fetch();
            return $data;
        } else {
            return false;
        }
    }

    public static function usernameExists($username) {
        require './config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $req = $PDO->prepare("SELECT * FROM users WHERE username = :username");
        $req->execute( array( 'username' => $username ) );
        $data = $req->fetch();
        return $data;
    }

    public static function emailExists($email) {
        require './config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $req = $PDO->prepare("SELECT verif_hash FROM users WHERE email = :email");
        $req->execute( array( 'email' => $email ) );
        $data = $req->fetch();
        return $data;
    }

    public static function userConfirmed($email, $hash) {
        require './config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $req = $PDO->prepare("SELECT verif_hash FROM users WHERE email = :email");
        $req->execute( array( 'email' => $email ) );
        $verif_hash = $req->fetch();
        if ($hash === $verif_hash['verif_hash']) {
            echo "\nHASH OK\n";
            $req = $PDO->prepare("UPDATE users SET confirmed = :confirmed WHERE email = :email");
            $req->execute( array( 
                'confirmed' => '1',
                'email' => $email
            ));
            return true;
        } else {
            return false;
        }
    }
}