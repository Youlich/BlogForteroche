<?php
/**
 * Created by PhpStorm.
 * User: jutat
 * Date: 08/05/2018
 * Time: 22:34
 */

namespace controller;

/**
 * Class Controller
 * @package controller super classe des controller Frontend et backend qui utilisent tous les 2 la fonction header à répétition
 */

class Controller {

	/**
	 * @param $url
	 * fonction qui remplace la fonction header par exemple header('Location: index.php');
	 */
	protected function redirect($url)
	{
		header($url);
	}
}