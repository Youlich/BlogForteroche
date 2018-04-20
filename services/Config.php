<?php
namespace services;

class Config
{

    public static function start() //static car appelée qu'une seule fois
    {
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

}



