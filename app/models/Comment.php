<?php

class Comment {

    public static function insertComment($comment) {
        require '../../config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $req = $PDO->prepare("INSERT INTO comments (comment, creation_date, id_user, id_post) 
            VALUES (:comment, :creation_date, :id_user, :id_post)");
        $req->execute(array(
            "comment" => $comment[0], 
            "creation_date" => $comment[1],
            "id_user" => $comment[2],
            "id_post" => $comment[3]
        ));
    }

    public static function getComments($id_post) {
        require './config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $req = $PDO->query('SELECT * FROM comments JOIN users ON comments.id_user = users.id_user WHERE comments.id_post ='.$id_post);
        $data = $req->fetchAll();
        return $data;
    }

}