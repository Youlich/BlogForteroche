<?php

namespace services;

use controller\Backend;
use controller\Frontend;
use model\AdminManager;
use model\BooksManager;
use model\ChapterManager;
use model\CommentManager;
use model\ImagesManager;
use model\MembreManager;

/**
 * Class Container
 * @package services
 */

class Container
{
	protected $parameters;
	private $pdo;

	/**
	 * Container constructor.
	 *
	 * @param array $parameters
	 */

	public function __construct(array $parameters)
	{
		$this->parameters = $parameters;
	}

	/**
	 * @return \PDO
	 */

	public function getPDO()
	{
		$hostname=$this->parameters['host'];
		$dbname=$this->parameters['dbname'];
		$username=$this->parameters['username'];
		$password= $this->parameters['password'];
		if ($this->pdo == null) {
			$this->pdo = new \PDO('mysql:host='.$hostname.';dbname='.$dbname.';charset=utf8', $username, $password);
		}
		return $this->pdo;
	}

	/**
	 * @return Backend et ses modèles
	 */

	public function getControllerBackend()
	{
		return new Backend(
			$this->getMembreManager(),
			$this->getAdminManager(),
			$this->getCommentManager(),
			$this->getChapterManager(),
			$this->getBooksManager(),
			$this->getImagesManager()

		);
	}

	/**
	 * @return Frontend et ses modèles
	 */
	public function getControllerFrontend()
	{
		return new Frontend(
			$this->getMembreManager(),
			$this->getAdminManager(),
			$this->getCommentManager(),
			$this->getChapterManager(),
			$this->getBooksManager(),
			$this->getImagesManager()
		);
	}

	/**
	 * Fonction qui permet d'instancier l'objet Mail
	 */
	public function getControllerMail()
	{
		$service = new Mail();
		$service->contact();
	}

	/**
	 * @return MembreManager connecté à la BDD
	 */

	public function getMembreManager()
	{
		return new MembreManager($this->getPDO());
	}

	/**
	 * @return AdminManager connecté à la BDD
	 */
	public function getAdminManager()
	{
		return new AdminManager($this->getPDO());
	}

	/**
	 * @return CommentManager connecté à la BDD et ses setters utiles
	 */
	public function getCommentManager()
	{
		$commentManager = new CommentManager($this->getPDO());
		$commentManager->setBooksManager($this->getBooksManager());
		$commentManager->setChapterManager($this->getChapterManager());
		return $commentManager;
	}

	/**
	 * @return ChapterManager connecté à la BDD et ses setters utiles
	 */

	public function getChapterManager()
	{
		$chapterManager = new ChapterManager($this->getPDO());
		$chapterManager->setImagesManager($this->getImagesManager());
		return $chapterManager;
	}

	/**
	 * @return BooksManager connecté à la BDD
	 */

	public function getBooksManager()
	{
		return new BooksManager($this->getPDO());
	}

	/**
	 * @return ImagesManager connecté à la BDD
	 */
	public function getImagesManager()
	{
		return new ImagesManager($this->getPDO());
	}
}