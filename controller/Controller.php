<?php

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