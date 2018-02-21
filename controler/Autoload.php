<?php

/** Permet l'auto-chargement des classes */

class Autoload
{

    static function register()
    {
        spl_autoload_register(Array('Autoload','chargerClass'));
    }

    static function chargerClass($class)
    {

        $file = str_replace('\\','/',$class); // on met 2\\ car \ en php est un caractère réservé
        $file = ltrim($file,'/');
        require_once $file.'.php';
    }

}