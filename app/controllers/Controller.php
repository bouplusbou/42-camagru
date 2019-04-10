<?php

class Controller {

    protected $viewPath;
    protected $template;

    public function render($view) {
        ob_start();
        require($view->viewPath . str_replace('.', '/', $view) . '.php');
        $content = ob_get_clean();
        require($this->viewPath . 'templates/' . $this->template . '.php');
    }

}