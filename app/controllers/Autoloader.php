<?php

// permet le chargement dynamique dans les différentes class
// plus besoin de faire des requires à chaque fois 

class Autoloader {

    static function register() {

        spl_autoload_register(array(__CLASS__, 'autoload'));

    }

    static function autoload($class_name) {
        require $class_name . '.php';
    }


}