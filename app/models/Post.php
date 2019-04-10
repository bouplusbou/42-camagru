<?php

require 'App.php';

class Post {

    public static function getAllPosts() {
        return App::getDatabase()->query('SELECT * FROM posts', __CLASS__);
    }

}