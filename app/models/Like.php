<?php

class Like {

    public static function newLike($id_post, $id_user) {
        require __DIR__.'/../../config/database.php';
        $PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $req = $PDO->prepare("INSERT INTO likes (id_user, id_post) 
            VALUES (:id_user, :id_post)");
        $req->execute(array(
            "id_user" => $id_user,
            "id_post" => $id_post
        ));
    }

}