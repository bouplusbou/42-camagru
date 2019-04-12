<?php
session_start();

require '../../config/database.php';
$PDO = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
$PDO->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
$req = $PDO->query('SELECT * FROM posts');
$posts = $req->fetchAll();
foreach ($posts as $post) {
    if ($post['id_user'] === $_SESSION['id_user']) {
        $posts_photos[] = $post["photo_name"];
    }
}
echo end($posts_photos);
