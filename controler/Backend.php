<?php
namespace controler;
use entity\Membres;
use model\AdminManager;
use model\BooksManager;
use model\ChapterManager;
use model\CommentManager;
use model\MembreManager;
use services\Telechargements;

require_once('Autoload.php'); // Chargement des class
\Autoload::register();

Class Backend
{

    public function suppMembre()
    {
        $suppMembre = new MembreManager();
        $suppMembre->deleteMembre();
        $nbcomments = new MembreManager();
        $nbComms = $nbcomments->CountCommentsMembre($_SESSION['id']);
    }

    public function connectAdmin()
    {
        $authMembreManager = new AdminManager();
        $authMembreManager->authAdmin();
        require('view/backend/AuthAdminView.php');
    }

    public function deconnectAdmin()
    {
        session_destroy();
        header('Location: index.php');
        exit();
    }

    public function approvedComments()
    {
        $approved = new CommentManager();
        $approved->ApprovedComment($_GET['id']);
        $comments = $approved->getComments();
        require ('view/backend/listCommentsView.php');
    }

    public function refusedComments()
    {
        $refused = new CommentManager();
        $refused->RefusedComment($_GET['id']);
        $comments = $refused->getComments();
        require ('view/backend/listCommentsView.php');
    }

    public function listComments()
    {
        $commentManager = new CommentManager();
        $comments = $commentManager->getComments();
        //$bookManager = new BooksManager();
        //$book = $bookManager->getBook();
        //$chapterManager = new ChapterManager();
        //$chapter = $chapterManager->getChapter();
        require('view/backend/listCommentsView.php');
    }

    public function listMembres()
    {
        $membreManager = new MembreManager();
        $membres = $membreManager->getMembres();
        require('view/backend/listMembresView.php');
    }

    public function Publier()
    {
        #$bookManager = new BooksManager();
        #$books = $bookManager->getBooks();
        #if (isset($_POST['bookSelect'])) {
        #   $bookSelect = $bookManager->getBook($_POST['bookSelect']);
        #    require('view/backend/Publications.php');
        #  } else {
        #      $bookSelect = '';
        #     require('view/backend/Publications.php');
        # }
        #  $ImageManager = new ImagesManager();
        #  if (isset($_POST['image'])) {
        #       $image = $ImageManager->getImage($_POST['id']);
        #  } else {
        #      $image = '';
        #  }
        #  $chapterManager = new ChapterManager();
        #  $chapters = $chapterManager->getChapters();
        # if (isset($_POST['chapterselect'])) {
        #     $chapterselect = $chapterManager->getChapter($_POST['chapterselect']);
        #     require('view/backend/Publications.php');
        #  } else {
        #      $chapterselect = '';
        #    require('view/backend/Publications.php');
        #  }
        require ('view/backend/templatePublications.php');
    }

    public function addBook($title)
    {
        $BookManager = new BooksManager();
        $addbook = $BookManager->AddBook($title);
        if ($addbook === false) {
            throw new \Exception('Impossible d\'ajouter le livre !');
        } else {
            require('view/backend/templatePublications.php');
        }
    }

    public function bookSelect()
    {
        $bookManager = new BooksManager();
        $books = $bookManager->getBooks();


    }

    public function listBooks()
    {
        $bookManager = new BooksManager();
        $books = $bookManager->getBooks();
        require('view/backend/templatePublications.php');
    }

    public function administration()
    {
        require('view/backend/AdministrationView.php');
    }

    public function addChapter($bookId, $title, $content, $file)
    {
        if (isset($_FILES['image']) AND (!empty($_FILES['image']['name']))){
            $upload = new Telechargements();
            $file = $upload->upload();}
        #$bookManager = new BooksManager();
        #$bookSelect = $bookManager->getBook($_POST['bookSelect']);
        $ChapterManager = new ChapterManager();
        $addchapter = $ChapterManager->AddChapter($bookId, $title, $content, $file);
        if ($addchapter === false) {
            throw new \Exception('Impossible d\'ajouter le chapitre !');
        } else {
            header('Location: index.php?action=publier' . "#endpage");
            exit();
        }
    }

    public function ModifChapter()
    {
        // $ModifManager = new ChapterManager();
        // $modifLines = $ModifManager->ModifChapter();
        // if (isset($_FILES['image']) AND (!empty($_FILES['image']['name']))){
        //  $upload = new Telechargements();
        //  $file = $upload->upload();
        //   }
        //   if ($modifLines === false) {
        //       throw new \Exception('Impossible de modifier le chapitre !');
        // } else {
        //      header('Location: index.php?action=publier' . "#endpage");
        //     exit();
        //  }

        $ModifManager = new ChapterManager();
        $modifLines = $ModifManager->ModifChapter();
        if ($modifLines === false) {
            throw new \Exception('Impossible de modifier le chapitre !');
        } else {
            header('Location: index.php?action=publier' . "#endpage");
            exit();
        }
    }

    public function deleteChapter()
    {
        $chapterManager = new ChapterManager();
        $chapters = $chapterManager->getChapters();
        if (isset($_POST['chapterselect'])) {
            $chapterselect = $chapterManager->getChapter($_POST['chapterselect']);
            $deleteManager = new ChapterManager();
            $deleteChapter = $deleteManager->DeleteChapter();
            if ($deleteChapter === false) {
                throw new \Exception('Impossible de supprimer le chapitre !');
            } else {
                header('Location: index.php?action=publier' . "#endpage");;
                exit();
            }
        } else {
            $chapterselect = '';
            require('view/backend/templatePublications.php');
        }
    }

}