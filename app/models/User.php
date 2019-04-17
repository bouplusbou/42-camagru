<?php

class User {

    public static function insertUser($user) {
        require __DIR__.'/../../config/database.php';
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
        require __DIR__.'/../../config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $username = $user_cred['username'];
        $pswd = $user_cred['pswd'];
        $req = $PDO->prepare("SELECT pswd FROM users WHERE username = :username");
        $req->execute( array('username' => $username) );
        $hashed_pswd = $req->fetch();
        if (password_verify($pswd, $hashed_pswd['pswd'])) {
            $req = $PDO->prepare("SELECT id_user, username, confirmed, email FROM users WHERE username = :username");
            $req->execute( array('username' => $username) );
            $data = $req->fetch();
            return $data;
        } else {
            return false;
        }
    }

    public static function usernameExists($username) {
        require __DIR__.'/../../config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $req = $PDO->prepare("SELECT * FROM users WHERE username = :username");
        $req->execute( array( 'username' => $username ) );
        $data = $req->fetch();
        return $data;
    }

    public static function emailExists($email) {
        require __DIR__.'/../../config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $req = $PDO->prepare("SELECT verif_hash FROM users WHERE email = :email");
        $req->execute( array( 'email' => $email ) );
        $data = $req->fetch();
        return $data;
    }

    public static function userConfirmed($email, $hash) {
        if (User::emailHashMatch($email, $hash)) {
            require __DIR__.'/../../config/database.php';
            $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
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

    public static function emailHashMatch($email, $hash) {
        require __DIR__.'/../../config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $req = $PDO->prepare("SELECT verif_hash FROM users WHERE email = :email");
        $req->execute( array( 'email' => $email ) );
        $verif_hash = $req->fetch();
        return ($hash === $verif_hash['verif_hash']);
    }
    
    public static function pswdEmailMatch($pswd, $email) {
        require __DIR__.'/../../config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $req = $PDO->prepare("SELECT pswd FROM users WHERE email = :email");
        $req->execute( array('email' => $email) );
        $hashed_pswd = $req->fetch();
        if (password_verify($pswd, $hashed_pswd['pswd'])) {
            $req = $PDO->prepare("SELECT id_user, username, confirmed FROM users WHERE email = :email");
            $req->execute( array('email' => $email) );
            $data = $req->fetch();
            return $data;
        } else {
            return false;
        }
    }

    public static function pswdUsernameMatch($pswd, $username) {
        require __DIR__.'/../../config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
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

    public static function updatePswd($email, $new_pswd) {
        require __DIR__.'/../../config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $req = $PDO->prepare("UPDATE users SET pswd = :pswd WHERE email = :email");
        $req->execute( array( 
            'pswd' => $new_pswd,
            'email' => $email
        ));
    }


    public static function updateUsername($current_username, $new_username) {
        require __DIR__.'/../../config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $req = $PDO->prepare("UPDATE users SET username = :new_username WHERE username = :current_username");
        $req->execute( array( 
            'new_username' => $new_username,
            'current_username' => $current_username
        ));
    }

    public static function updateEmail($username, $new_email) {
        require __DIR__.'/../../config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $req = $PDO->prepare("UPDATE users SET email = :email WHERE username = :username");
        $req->execute( array( 
            'email' => $new_email,
            'username' => $username
        ));
    }
}