<?php

require "database.php";

try {
 
    $DB_DSN = 'mysql:dbname=camagru;host=127.0.0.1';
    $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

    
    $req = $PDO->prepare("INSERT INTO users (username, email, pswd, confirmed, creation_date) VALUES (:username, :email, :pswd, :confirmed, :creation_date)");
    $users = array(
        array('boris', 'boris@gmail.com', 'password', '1', '2019-04-01 00:00:00'),
        array('frankie', 'frankie@gmail.com', 'password', '0', '2018-04-01 00:00:00'),
        array('lou', 'lou@gmail.com', 'password', '1', '2017-04-01 00:00:00'),
        array('charlie', 'charlie@gmail.com', 'password', '1', '2016-04-01 00:00:00')
    );
    foreach ($users as $user) {
        $req->execute(array(
            "username" => $user[0], 
            "email" => $user[1],
            "pswd" => $user[2],
            "confirmed" => $user[3],
            "creation_date" => $user[4],
        ));
        print("User $user[0] created.\n");
    }
    
    $req = $PDO->prepare("INSERT INTO posts (photo_path, creation_date, id_user) VALUES (:photo_path, :creation_date, :id_user)");
    $posts = array(
        array('./app/assets/images/posts_images/final.png', '2019-03-01 00:00:00', '1'),
        array('./app/assets/images/posts_images/final.png', '2019-05-01 00:00:00', '2'),
        array('./app/assets/images/posts_images/final.png', '2019-01-01 00:00:00', '1'),
        array('./app/assets/images/posts_images/final.png', '2019-02-01 00:00:00', '3'),
    );
    foreach ($posts as $post) {
        $req->execute(array(
                "photo_path" => $post[0], 
                "creation_date" => $post[1],
                "id_user" => $post[2],
                ));
        print("Post with photo $post[0] created.\n");
    }

} catch (PDOException $e) {
    die("DB ERROR: ". $e->getMessage());
}


