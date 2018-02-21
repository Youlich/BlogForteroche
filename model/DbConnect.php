<?php
namespace model;
/**
 * Class DbConnect
 * Permet de se connecter à la base de données
 */

class DbConnect

{
    private static $instance;

    public static function dbConnect()
    {
        if(null === self::$instance)
        {
            try
            {
                self::$instance = new \PDO('mysql:host=localhost;dbname=projetblog;charset=utf8', 'root', '');
            }
            catch (PDOException $e)
            {
                die('Erreur de connexion : ' . $e->getMessage() );
            }
        }
        return self::$instance;
    }

}