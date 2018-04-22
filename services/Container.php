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


class Container
{
    protected $parameters;
    private $pdo;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function getPDO()
    {
        if ($this->pdo == null) {
            $this->pdo = new \PDO('mysql:host=localhost;dbname=projetblog;charset=utf8', 'root', '');
        }
        return $this->pdo;
    }

    public function getMembreManager()
    {
        return new MembreManager($this->getPDO());
    }
    public function getAdminManager()
    {
        return new AdminManager($this->getPDO());
    }
    public function getCommentManager()
    {
        $commentManager = new CommentManager($this->getPDO());
        $commentManager->setBooksManager($this->getBooksManager());
        $commentManager->setChapterManager($this->getChapterManager());
        return $commentManager;
    }
    public function getChapterManager()
    {
        $chapterManger = new ChapterManager($this->getPDO());
        $chapterManger->setImagesManager($this->getImagesManager());
        return $chapterManger;
    }
    public function getBooksManager()
    {
        return new BooksManager($this->getPDO());
    }
    public function getImagesManager()
    {
        return new ImagesManager($this->getPDO());
    }
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

    public function getControllerServices()
    {
        return new Mail();
    }


}