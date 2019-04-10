<?php

require 'Controller.php';
require 'AppController.php';
require './app/models/Post.php';

class PostsController extends AppController {

    public function index() {
        $posts = Post::getAllPosts();
        $this->render('posts.index');
    }

    public function show() {
        
    }


    // get    "restaurants",          to: "restaurants#index"

    // get    "restaurants/new",      to: "restaurants#new"
    // post   "restaurants",          to: "restaurants#create"
  
    // # NB: The `show` route needs to be *after* `new` route.
    // get    "restaurants/:id",      to: "restaurants#show"
  
    // get    "restaurants/:id/edit", to: "restaurants#edit"
    // patch  "restaurants/:id",      to: "restaurants#update"
  
    // delete "restaurants/:id",      to: "restaurants#destroy"


}