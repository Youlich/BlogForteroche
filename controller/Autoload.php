<?php

/**
 * Class Autoload
 * Permet l'auto-chargement des classes
 */

class Autoload
{
    /**
     *  fonction d'autoload qui utilise la fonction chargerclasse
     */

    static function register()
    {
        spl_autoload_register(Array('Autoload','chargerClass'));
    }

    /**
     * @param $class
     */

    static function chargerClass($class)
    {

        $file = str_replace('\\','/',$class); // on met 2\\ car \ en php est un caractère réservé
        $file = ltrim($file,'/');
        require_once $file.'.php';
    }

}