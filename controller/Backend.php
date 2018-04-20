<?php
namespace controller;

\Autoload::register();

/**
 * Class Backend
 * @package controller Backend
 */

Class Backend
{
    /**
     * @var
     */
    private $membreManager;
    private $adminManager;
    private $commentManager;
    private $chapterManager;
    private $booksManager;
    private $imagesManager;

    /** injection de dépendances : appelle de tous les modèles */

    public function __construct($membreManager, $adminManager, $commentManager, $chapterManager, $booksManager, $imagesManager) {
        $this->membreManager = $membreManager;
        $this->adminManager = $adminManager;
        $this->commentManager = $commentManager;
        $this->chapterManager = $chapterManager;
        $this->booksManager = $booksManager;
        $this->imagesManager = $imagesManager;
    }

    public function connectAdmin()
    {
        $authMembreManager = $this->adminManager;
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
        $adminmanager = $this->adminManager;
        $admin = $adminmanager->getAdmin($_SESSION['id']);
        require('view/backend/profilAdmin.php');
    }
    public function modifmessageAdmin()
    {
        $adminmanager = $this->adminManager;
        $admin = $adminmanager->getAdmin($_SESSION['id']);
        $adminmessage = $adminmanager->modifmessageAdmin();
        require('view/backend/profilAdmin.php');
    }

    public function approvedComments()
    {
        $approved = $this->commentManager;
        $approved->ApprovedComment($_GET['id']);
        $comments = $approved->getComments();
        require ('view/backend/listCommentsView.php');
    }
    public function refusedComments()
    {
        $refused = $this->commentManager;
        $refused->RefusedComment($_GET['id']);
        $comments = $refused->getComments();
        require ('view/backend/listCommentsView.php');
    }
    public function listComments()
    {
        $commentManager = $this->commentManager;
        $comments = $commentManager->getComments();
        require('view/backend/listCommentsView.php');
    }
    public function listMembres()
    {
        $membreManager = $this->membreManager;
        $membres = $membreManager->getMembres();
        require('view/backend/listMembresView.php');
    }
    public function boutonaddbook()
    {
        require ('view/backend/boutonaddbook.php');
    }
    public function boutonmodifchapter()
    {
        $chapterManager = $this->chapterManager;
        $chapters = $chapterManager->getChapters();
        if (isset($_POST['chapterselect'])) {
            $chapterselect = $chapterManager->getChapter($_POST['chapterselect']);
            $selectedchapter = $chapterselect->getTitle();
            $imageexist = $chapterselect->getImageId();
            if ($imageexist != '0') {
                $imageManager = $this->imagesManager;
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
        $bookManager = $this->booksManager;
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
        $chapterManager = $this->chapterManager;
        $chapters = $chapterManager->getChapters();
        if (isset($_POST['chapterselect'])) {
            $chapterselect = $chapterManager->getChapter($_POST['chapterselect']);
            $selectedchapter = $chapterselect->getTitle();
            $imageexist = $chapterselect->getImageId();
            if ($imageexist != '0') {
                $imageManager = $this->imagesManager;
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
        $BookManager = $this->booksManager;
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
        $chaptermanager = $this->chapterManager;
        $resum = $chaptermanager->resumContent($_POST['content']);
        if($_FILES['image']['name']=='') {
            $Chaptersansimage = $this->chapterManager;
            $addchaptersansimage = $Chaptersansimage->AddChapter($_POST['bookSelect'], $_POST['titrechapitre'], $_POST['content'], $resum, '0');
            if ($addchaptersansimage === false) {
                $_SESSION['error'] = 'Impossible d\'ajouter votre chapitre !';
                header('Location: index.php?action=boutonaddchapter' . "#endpage");
            } else {
                $_SESSION['success'] = 'Votre chapitre a bien été ajouté';
                header('Location: index.php?action=boutonaddchapter' . "#endpage");
            }
        } else {
                $imagemanager = $this->imagesManager;
                $uploadResult = $imagemanager->upload();
                if ($uploadResult['result']) {
                    $ChapterManager = $this->chapterManager;
                    $Addchapter = $ChapterManager->AddChapter($_POST['bookSelect'], $_POST['titrechapitre'], $_POST['content'], $resum, $uploadResult['imageId']);
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
        $chaptermanager = $this->chapterManager;
        $resum = $chaptermanager->resumContent($_POST['content']);
        if($_FILES['image']['name']=='') {
            $ModifManager = $this->chapterManager;
            $modifLines = $ModifManager->ModifChaptersansUpload($_POST['chapterselect'], $_POST['titrechapter'], $_POST['content'], $resum);
            if ($modifLines === false) {
                $_SESSION['error'] = 'Impossible de modifier le chapitre !';
                header('Location: index.php?action=boutonmodifchapter' . "#endpage");
            } else {
                $_SESSION['success'] = 'Votre chapitre a bien été modifié';
                header('Location: index.php?action=boutonmodifchapter' . "#endpage");
            }
        } else {
            $imagemanager = $this->imagesManager;
            $uploadResult = $imagemanager->upload();
            if ($uploadResult['result']) {
                $ModifManager = $this->chapterManager;
                $modifLines = $ModifManager->ModifChapter($_POST['chapterselect'], $_POST['titrechapter'], $_POST['content'], $resum, $uploadResult['imageId']);
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
  public function deleteChapter()
    {
        $chapterManager = $this->chapterManager;
        $supp = $chapterManager->DeleteChapter($_POST['chapterselect']);
        if ($supp === true) {
            $imageManager = $this->imagesManager;
            $deleteImageassoc=$imageManager->DeleteImage($_POST['chapterselect']);
            $_SESSION['success'] = "Votre chapitre a bien été supprimé";
        }else {
            $_SESSION['error'] = "Votre chapitre n'a pas pu être supprimé";
        }
        header('Location: index.php?action=boutondeletechapter' . "#endpage");
   }
}