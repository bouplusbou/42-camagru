<?php

class Post {

    public static function insertPost($post) {
        require '../../config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $req = $PDO->prepare("INSERT INTO posts (photo_name, creation_date, id_user) 
            VALUES (:photo_name, :creation_date, :id_user)");
        $req->execute(array(
            "photo_name" => $post[0], 
            "creation_date" => $post[1],
            "id_user" => $post[2]
        ));
    }

    public static function getAllPosts() {
        require './config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $req = $PDO->query('SELECT posts.id_post, posts.photo_name, posts.id_user, likes_count, users.username
                            FROM posts
                            LEFT JOIN (
                                SELECT id_post, COUNT(*) AS likes_count
                                FROM likes
                                GROUP BY id_post
                            ) likes_count ON likes_count.id_post = posts.id_post
                            JOIN users ON posts.id_user = users.id_user');
        $data = $req->fetchAll(PDO::FETCH_CLASS, 'Post');
        return $data;
    }

    public static function getOnePost($id_post) {
        require './config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $req = $PDO->query('SELECT * FROM posts JOIN users ON posts.id_user = users.id_user WHERE posts.id_post = '.$id_post);
        $data = $req->fetch();
        return $data;
    }

}