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
            if ($imageexist != '0') {
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
            $bookId = $bookManager->getBook($_POST['bookSelect'])->getId();
            $selectedbook = $bookSelect->getTitle();
        }else {
            $selectedbook = "Choisissez votre livre";
        }
        require ('view/backend/boutonaddchapter.php');
    }


    public function boutondeletechapter()
    {
        $chapterManager = new ChapterManager();
        $chapters = $chapterManager->getChapters();
        if (isset($_POST['chapterselect'])) {
            $chapterselect = $chapterManager->getChapter($_POST['chapterselect']);
            $selectedchapter = $chapterselect->getTitle();
            $imageexist = $chapterselect->getImageId();
            if ($imageexist != '0') {
                $imageManager = new ImagesManager();
                $imageselect = $imageManager->getImage($_POST['chapterselect']);
                $image = $imageselect->getFileUrl();
                $message = '';
            } else {
                $image = '';
                $message = "Pas d'image pour ce chapitre";
            }
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
            $_SESSION['error'] = 'Impossible d\'ajouter le livre !';
            header('Location: index.php?action=boutonaddbook' . "#endpage");
        } else {
            $_SESSION['success'] = 'Votre nouveau livre a bien été ajouté';
            header('Location: index.php?action=boutonaddbook' . "#endpage");
        }
    }
    public function administration()
    {
        require('view/backend/AdministrationView.php');
    }

    public function addChapter()
    {
        if($_FILES['image']['name']=='') {
            $Chaptersansimage = new ChapterManager();
            $addchaptersansimage = $Chaptersansimage->AddChapter($_POST['bookSelect'], $_POST['titrechapitre'], $_POST['content'], '0');
            if ($addchaptersansimage === false) {
                $_SESSION['error'] = 'Impossible d\'ajouter votre chapitre !';
                header('Location: index.php?action=boutonaddchapter' . "#endpage");
            } else {
                $_SESSION['success'] = 'Votre chapitre a bien été ajouté';
                header('Location: index.php?action=boutonaddchapter' . "#endpage");
            }
        } else {
                $imagemanager = new ImagesManager();
                $uploadResult = $imagemanager->upload();
                if ($uploadResult['result']) {
                    $ChapterManager = new ChapterManager();
                    $Addchapter = $ChapterManager->AddChapter($_POST['bookSelect'], $_POST['titrechapitre'], $_POST['content'], $uploadResult['imageId']);
                    if ($Addchapter === false) {
                        $_SESSION['error'] = 'Votre chapitre n\'a pas pu être ajouté';
                        header('Location: index.php?action=boutonaddchapter' . "#endpage");
                    } else {
                        $chapterId = $Addchapter;
                        $modifimage = $imagemanager->ModifchapterImage($chapterId);
                        if ($modifimage === false ) {
                            $_SESSION['error'] = 'Votre image n\'a pas pu être ajoutée au chapitre';
                            header('Location: index.php?action=boutonaddchapter' . "#endpage");
                        } else {
                            $_SESSION['success'] = 'Votre chapitre a bien été ajouté avec son image';
                            header('Location: index.php?action=boutonaddchapter' . "#endpage");
                        }
                    }
                } else {
                    $_SESSION['error'] = 'Votre image n\'a pas pu être téléchargée';
                    header('Location: index.php?action=boutonaddchapter' . "#endpage");
                }
            }
    }

    public function modifChapter()
    {
        if($_FILES['image']['name']=='') {
            $ModifManager = new ChapterManager();
            $modifLines = $ModifManager->ModifChapter($_POST['chapterselect'], $_POST['titrechapter'], $_POST['content'], '0');
            if ($modifLines === false) {
                $_SESSION['error'] = 'Impossible de modifier le chapitre !';
                header('Location: index.php?action=boutonmodifchapter' . "#endpage");
            } else {
                $_SESSION['success'] = 'Votre chapitre a bien été modifié';
                header('Location: index.php?action=boutonmodifchapter' . "#endpage");
            }
        } else {
            $imagemanager = new ImagesManager();
            $uploadResult = $imagemanager->upload();
            if ($uploadResult['result']) {
                $ModifManager = new ChapterManager();
                $modifLines = $ModifManager->ModifChapter($_POST['chapterselect'], $_POST['titrechapter'], $_POST['content'], $uploadResult['imageId']);
                $_SESSION['success'] = 'Votre chapitre a bien été modifié';
                header('Location: index.php?action=boutonmodifchapter' . "#endpage");
                if ($modifLines === false) {
                    $_SESSION['error'] = 'Impossible de modifier le chapitre !';
                    header('Location: index.php?action=boutonmodifchapter' . "#endpage");
                } else {
                    $chapterId = $_POST['chapterselect'];
                    $modifimage = $imagemanager->ModifchapterImage($chapterId);
                        if ($modifimage === false) {
                            $_SESSION['error'] = 'Impossible de modifier l\'image dans le chapitre';
                            header('Location: index.php?action=boutonmodifchapter' . "#endpage");
                        } else {
                            $_SESSION['success'] = 'Votre chapitre a bien été modifié avec son image';
                            header('Location: index.php?action=boutonmodifchapter' . "#endpage");
                        }
                    }
            } else {
                $_SESSION['error'] = 'Votre image n\'a pas pu être téléchargée';
                header('Location: index.php?action=boutonmodifchapter' . "#endpage");
            }
        }
    }
  #  public function deleteChapter()
   # {
    #    $chapterManager = new ChapterManager();
    #    $supp = $chapterManager->DeleteChapter($_POST['chapterselect']);
     #   if ($supp === true) {
      #      $_SESSION['success'] = "Votre chapitre a bien été supprimé";
      #  }else {
      #      $_SESSION['error'] = "Votre chapitre n'a pas pu être supprimé";
      #  }
     #   header('Location: index.php?action=boutondeletechapter' . "#endpage");
 #   }
}