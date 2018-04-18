<?php

ini_set('display_errors','on');
error_reporting(E_ALL);

class MyAutoload
{
    public static function start() //static car appelée qu'une seule fois
    {
       // spl_autoload_register(array(__CLASS__, 'autoload')); // à insérer dès que mon routeur.php sera prêt
        $root = $_SERVER['DOCUMENT_ROOT'];
        $host = $_SERVER['HTTP_HOST'];

        define ('HOST','http://'.$host. '/BlogForteroche/');
        define('ROOT',$root);
        define ('CONTROLLER', ROOT . '/controller/');
        define ('VIEWFRONT', ROOT . '/view/frontend/');
        define ('VIEWBACK', ROOT . '/view/backend/');
        define ('MODEL', ROOT . '/model/');
        define ('ENTITY', ROOT . '/entity/');
        define ('ROUTER', ROOT . '/router/');
        define ('SERVICES', ROOT . '/services/');
        define ('CSS', HOST .'assets/css/');
        define ('JS', HOST .'assets/js/');
        define ('TINYMCE', HOST .'assets/js/tinymce/');
        define ('MP', HOST .'assets/magnific-popup/');
        define ('IMAGES', HOST . 'public/images');
    }



    public static function autoload($class)
    {
        if(file_exists(MODEL.$class.'.php'))
            {
                include_once (MODEL.$class.'.php');
            }elseif (file_exists(ENTITY.$class.'.php'))
            {
                include_once (ENTITY.$class.'.php');
            }elseif (file_exists(CONTROLLER.$class.'.php'))
            {
                include_once (CONTROLLER.$class.'.php');
            }elseif (file_exists(ROUTER.$class.'.php'))
            {
                include_once (ROUTER.$class.'.php');
            }elseif(file_exists(SERVICES.$class.'.php'))
            {
                include_once (SERVICES.$class.'.php');
            }
    }
}



