<?php

namespace model;
use controller\Controller;

/**
 * Class Manager
 * Permet de se connecter à la base de données
 */

class Manager extends Controller

{
	private $pdo;

	public function __construct($pdo)
	{
		$this->pdo = $pdo;
	}
	public function dbConnect()
	{
		return $this->pdo;
	}

}