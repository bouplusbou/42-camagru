<?php

require_once __DIR__.'/Database.php';

class Post {

    public static function insertPost($post) {
        $req = Database::getPDO()->prepare("  INSERT INTO posts (photo_name, creation_date, id_user) 
                                VALUES (:photo_name, :creation_date, :id_user)");
        $req->execute(array(
            "photo_name" => $post[0], 
            "creation_date" => $post[1],
            "id_user" => $post[2]
        ));
    }

    public static function deletePost($id_post, $id_user) {
        $req = Database::getPDO()->prepare("  DELETE FROM posts 
                                WHERE id_post = :id_post");
        $req->execute(array( "id_post" => $id_post ));
    }

    public static function getAllPosts() {
        $req = Database::getPDO()->prepare('  SELECT posts.id_post, posts.photo_name, posts.id_user, likes_count, users.username
                                FROM posts
                                LEFT JOIN (
                                    SELECT id_post, COUNT(*) AS likes_count
                                    FROM likes
                                    GROUP BY id_post
                                ) likes_count ON likes_count.id_post = posts.id_post
                                JOIN users ON posts.id_user = users.id_user');
        $req->execute();                    
        $data = $req->fetchAll(PDO::FETCH_CLASS, 'Post');
        return $data;
    }

    public static function getAllPostsAsArray() {
        $req = Database::getPDO()->prepare('  SELECT posts.id_post, posts.photo_name, posts.id_user, likes_count, users.username
                                FROM posts
                                LEFT JOIN (
                                    SELECT id_post, COUNT(*) AS likes_count
                                    FROM likes
                                    GROUP BY id_post
                                ) likes_count ON likes_count.id_post = posts.id_post
                                JOIN users ON posts.id_user = users.id_user');
        $req->execute();                    
        $data = $req->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    
    public static function getIdUserFromIdPost($id_post) {
        $req = Database::getPDO()->prepare('    SELECT id_user FROM posts
                                                WHERE id_post = :id_post');
        $req->execute(array( "id_post" => $id_post ));
        $data = $req->fetch();
        return $data;
    }

    public static function getUserPosts($username) {
        $req = Database::getPDO()->prepare('  SELECT posts.id_post, posts.photo_name, posts.id_user, likes_count, users.username
                                FROM posts
                                LEFT JOIN (
                                    SELECT id_post, COUNT(*) AS likes_count
                                    FROM likes
                                    GROUP BY id_post
                                ) likes_count ON likes_count.id_post = posts.id_post
                                JOIN users ON posts.id_user = users.id_user
                                WHERE users.username = :username');
        $req->execute(array( "username" => $username ));
        $data = $req->fetchAll(PDO::FETCH_CLASS, 'Post');
        return $data;
    }

    public static function getOnePost($id_post) {
        $req = Database::getPDO()->prepare('  SELECT posts.id_post, posts.photo_name, posts.id_user, likes_count, users.username
                                FROM posts
                                LEFT JOIN (
                                    SELECT id_post, COUNT(*) AS likes_count
                                    FROM likes
                                    GROUP BY id_post
                                ) likes_count ON likes_count.id_post = posts.id_post
                                JOIN users ON posts.id_user = users.id_user
                                WHERE posts.id_post = :id_post');
        $req->execute(array( "id_post" => $id_post ));
        $data = $req->fetch();
        return $data;
    }

}