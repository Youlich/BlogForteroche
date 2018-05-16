<?php
namespace services;


/**
 * Class View
 * @package services
 */

class View
{
	private $template;

	/**
	 * View constructor.
	 *
	 * @param $template
	 */

	public function __construct($template)
	{
		$this->template = $template;
	}

	/**
	 * Fonction qui permet d'obtenir la bonne vue, avec son contenu et son gabarit
	 * @param array $params
	 */

	public function renderView($params = array()) {
		extract( $params ); // création de la variable dynamiquement
		$template = $this->template;
		$file = $template . '.php';
		if ($file = is_file( VIEWBACK . $template . '.php' ) ) {
			ob_start();
			include( VIEWBACK . $template . '.php' );
			$content = ob_get_clean();
			include_once( VIEWBACK . '_gabaritBack.php' );
		} elseif($file = is_file( VIEWFRONT . $template . '.php' ) ) {
			ob_start();
			include( VIEWFRONT . $template . '.php' );
			$content = ob_get_clean();
			$user_is_connected = (isset($_SESSION['id']))?true:false;
			include_once( VIEWFRONT . '_gabaritFront.php' );

		} else {
			header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");
			ob_start();
			include_once (VIEWFRONT . '404.php');
			$content = ob_get_clean();
			include_once( VIEWFRONT . '_gabaritFront.php' );
		}
	}
}