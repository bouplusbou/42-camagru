<?php

class Post {

    public static function getAllPosts() {
        require './config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $req = $PDO->query('SELECT * FROM posts');
        $data = $req->fetchAll(PDO::FETCH_CLASS, 'Post');
        return $data;
    }

}