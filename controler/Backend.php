<?php
namespace controler;
use entity\Images;
use entity\Membres;
use model\AdminManager;
use model\BooksManager;
use model\ChapterManager;
use model\CommentManager;
use model\ImagesManager;
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
    public function profilAdmin()
    {
        $adminmanager = new AdminManager();
        $admin = $adminmanager->getAdmin($_SESSION['id']);
        require('view/backend/profilAdmin.php');
    }
    public function modifAdmin()
    {
        $adminmanager = new AdminManager();
        $admin = $adminmanager->modifAdmin();
        if ($_POST['image']) {
            $image = $_POST['image'];
        } else {
            $image = '';
        }
        require('view/backend/profilAdmin.php');
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
        require('view/backend/listCommentsView.php');
    }
    public function listMembres()
    {
        $membreManager = new MembreManager();
        $membres = $membreManager->getMembres();
        require('view/backend/listMembresView.php');
    }
    public function boutonaddbook()
    {
        require ('view/backend/boutonaddbook.php');
    }
    public function boutonmodifchapter()
    {
        $chapterManager = new ChapterManager();
        $chapters = $chapterManager->getChapters();

        if (isset($_POST['chapterselect'])) {
            $chapterselect = $chapterManager->getChapter($_POST['chapterselect']);
            $selectedchapter = $chapterselect->getTitle();
            $imageexist = $chapterselect->getImageId();
            if ($imageexist != '') {
                $imageManager = new ImagesManager();
                $imageselect = $imageManager->getImage($_POST['chapterselect']);
                $image = $imageselect->getFileUrl();
                $message = '';
            } else {
                $image = '';
                $message = "Vous n'avez pas encore inséré d'image pour ce chapitre";
            }
        }else {
            $selectedchapter = "Choisissez votre chapitre";
        }
        require ('view/backend/boutonmodifchapter.php');
    }
    public function boutonaddchapter()
    {
        $bookManager = new BooksManager();
        $books = $bookManager->getBooks();
        if (isset($_POST['bookSelect'])) {
            $bookSelect = $bookManager->getBook($_POST['bookSelect']);
            $selectedbook = $bookSelect->getTitle();
        }else {
            $selectedbook = "Choisissez votre livre";
        }
        require ('view/backend/boutonaddchapter.php');
    }

    public function boutonaddimage()
    {
        $bookManager = new BooksManager();
        $books = $bookManager->getBooks();
        $chapterManager = new ChapterManager();
        $chapters = $chapterManager->getChapters();
        if (isset($_POST['bookSelect']) AND ($_POST['chapterselect']) ) {
            $bookSelect = $bookManager->getBook($_POST['bookSelect']);
            $selectedbook = $bookSelect->getTitle();
            $chapterselect = $chapterManager->getChapter($_POST['chapterselect']);
            $selectedchapter = $chapterselect->getTitle();
            $imageexist = $chapterselect->getImageId();
            if ($imageexist != '') {
                $imageManager = new ImagesManager();
                $imageselect = $imageManager->getImage($_POST['chapterselect']);
                $image = $imageselect->getFileUrl();
            } else {
                $image = '';
            }
        }else {
            $selectedbook = "Choisissez votre livre";
            $selectedchapter = "Choisissez votre chapitre";
        }
        require ('view/backend/boutonaddimage.php');
    }

    public function upload()
    {
        if (isset($_FILES['image'])) {
            $imageManager = new ImagesManager();
            $file = $imageManager->upload();

            $bookManager = new BooksManager();
            $books = $bookManager->getBooks();
            $chapterManager = new ChapterManager();
            $chapters = $chapterManager->getChapters();
            $bookSelect = $bookManager->getBook($_POST['bookSelect']);
            $selectedbook = $bookSelect->getTitle();
            $chapterselect = $chapterManager->getChapter($_POST['chapterselect']);
            $selectedchapter = $chapterselect->getTitle();

            require('view/backend/boutonaddimage.php');
        }else {
      echo "erreur"; }
    }

    public function boutondeletechapter()
    {
        $chapterManager = new ChapterManager();
        $chapters = $chapterManager->getChapters();
        if (isset($_POST['chapterselect'])) {
            $chapterselect = $chapterManager->getChapter($_POST['chapterselect']);
            $selectedchapter = $chapterselect->getTitle();
        }else {
            $selectedchapter = "Choisissez votre chapitre";
        }
        require ('view/backend/boutondeletechapter.php');
    }
    public function Publier()
    {
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

    public function administration()
    {
        require('view/backend/AdministrationView.php');
    }

    public function addChapter($bookId, $title, $content, $file)
    {
        $upload = new ImagesManager();
        $uploadResult = $upload->upload($file);
        if ($uploadResult['result']) {
            $ChapterManager = new ChapterManager();
            $addchapter = $ChapterManager->AddChapter($bookId, $title, $content, $uploadResult['imageId']);
            $newchapterId = $ChapterAdd['id'];
            if ($addchapter === false) {
                throw new \Exception('Impossible d\'ajouter le chapitre !');
            } else {
                header('Location: index.php?action=publier' . "#endpage");
                exit();
            }
        } else {
            $_SESSION['error'] = $uploadResult['error'];
            header('Location: index.php?action=publier' . "#endpage");
        }
    }
    public function ModifChapter()
    {
        $file = $_FILES['image'];
        $ModifManager = new ChapterManager();
        $modifLines = $ModifManager->ModifChapter();
        $imagemanager = new ImagesManager();
        $uploadResult = $imagemanager->upload($file);
        $affichImage = $imagemanager->getImage($_POST['chapterId']);
        $image = $imagemanager->ModifImage($_POST['chapterselect']);
        if ($modifLines === false) {
            $_SESSION['error'] = 'Impossible de modifier le chapitre !';
            return $_SESSION['error'];
        } else {
            $_SESSION['success'] = 'Votre chapitre a bien été modifié';
            require('view/backend/templatePublications.php');
        }
    }
    public function deleteChapter()
    {
        $chapterManager = new ChapterManager();
        $supp = $chapterManager->DeleteChapter($_POST['id']);
        if ($supp) {
            $_SESSION['success'] = "Votre chapitre a bien été supprimé";
        }else {
            $_SESSION['error'] = "Votre chapitre n'a pas pu être supprimé";
        }
        header('Location: index.php?action=publier');
    }
}