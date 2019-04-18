<?php

var_dump($_POST);

require '../models/Comment.php';
$creation_date = date("Y-m-d H:i:s");
$comment_data = array($_POST['comment'], $creation_date, $_POST['id_user'], $_POST['id_post']);
$comment = Comment::insertComment($comment_data);
