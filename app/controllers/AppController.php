<?php

class AppController extends Controller {

    protected $template = 'default';

    public function __construct() {
        $this->template = '/app/Views/';
    }
}