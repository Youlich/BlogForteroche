<?php

ini_set('display_errors','on');
error_reporting(E_ALL);

$root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];

define ('HOST',$host. '/BlogForteroche/');
define('ROOT',$root);
define ('CONTROLLER', ROOT . '/controller/');
define ('VIEWFRONT', ROOT . '/view/frontend/');
define ('VIEWBACK', ROOT . '/view/backend/');
define ('MODEL', ROOT . '/model/');
define ('ASSET', HOST . 'assets/');
define ('CSS', HOST .'assets/css/');
define ('JS', HOST .'assets/js/');
define ('JQ', HOST .'assets/jquery/');
define ('FONT', HOST .'assets/font-awesome/');
define ('MP',HOST .'assets/magnific-popup/');
define ('IMAGES', ROOT . '\public\images');


