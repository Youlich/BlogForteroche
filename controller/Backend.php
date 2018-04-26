<?php
namespace controller;
use services\View;

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
    public function loginadmin()
    {
        $authMembreManager = $this->adminManager;
        $authMembreManager->loginadmin();
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('loginadmin');
        $myView->renderView(array('success'=> $success, 'error'=> $error));
    }

    public function logoutadmin()
    {
        session_destroy();
        header('Location: index.php');
        exit();
    }
    public function profiladmin()
    {
        $adminmanager = $this->adminManager;
        $admin = $adminmanager->profiladmin($_SESSION['id']);
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('profiladmin');
        $myView->renderView(array('admin' => $admin, 'success'=> $success, 'error'=> $error));
    }
    public function modifmessage()
    {
        $adminmanager = $this->adminManager;
        $admin = $adminmanager->profiladmin($_SESSION['id']);
        $adminmessage = $adminmanager->modifmessage();
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('profiladmin');
        $myView->renderView(array('admin' => $admin, 'adminmessage' => $adminmessage, 'success'=> $success, 'error'=> $error));
    }
    public function approvedComment()
    {
        $approved = $this->commentManager;
        $approved->approvedComment($_GET['id']);
        $comments = $approved->getComments();
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('listcomments');
        $myView->renderView(array('comments' => $comments, 'success'=> $success, 'error'=> $error));
    }
    public function refusedComment()
    {
        $refused = $this->commentManager;
        $refused->refusedComment($_GET['id']);
        $comments = $refused->getComments();
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('listcomments');
        $myView->renderView(array('comments' => $comments, 'success'=> $success, 'error'=> $error));
    }
    public function listComments()
    {
        $commentManager = $this->commentManager;
        $comments = $commentManager->getComments();
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('listcomments');
        $myView->renderView(array('comments' => $comments, 'success'=> $success, 'error'=> $error));
    }
    public function listMembres()
    {
        $membreManager = $this->membreManager;
        $membres = $membreManager->listMembres();
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('listmembres');
        $myView->renderView(array('membres' => $membres, 'success'=> $success, 'error'=> $error));
    }
    public function boutonaddbook()
    {
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('boutonaddbook');
        $myView->renderView(array('success'=> $success, 'error'=> $error));
    }
    public function boutonmodifchapter()
    {
        $chapterManager = $this->chapterManager;
        $chapters = $chapterManager->listChapters();
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
        $chapterselect = (isset($chapterselect)?$chapterselect:null);
        $image = (isset($image)?$image:null);
        $message = (isset($message)?$message:null);
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('boutonmodifchapter');
        $myView->renderView(array('chapters' => $chapters, 'selectedchapter' => $selectedchapter, 'chapterselect' => $chapterselect, 'message' => $message,
            'image' =>$image, 'success'=> $success, 'error'=> $error));
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
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $bookId = (isset($bookId)?$bookId:null);
        $myView = new View('boutonaddchapter');
        $myView->renderView(array('books' => $books, 'bookId' => $bookId, 'selectedbook' => $selectedbook,
            'success'=> $success, 'error'=> $error));
    }
    public function boutondeletechapter()
    {
        $chapterManager = $this->chapterManager;
        $chapters = $chapterManager->listChapters();
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
        $chapterselect = (isset($chapterselect)?$chapterselect:null);
        $image = (isset($image )?$image :null);
        $message = (isset($message)?$message:null);
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('boutondeletechapter');
        $myView->renderView(array('chapters' => $chapters, 'selectedchapter' => $selectedchapter, 'chapterselect' => $chapterselect,
            'message' => $message, 'image' =>$image, 'success'=> $success, 'error'=> $error));
    }
    public function publier()
    {
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('publier');
        $myView->renderView(array('success'=> $success, 'error'=> $error));
    }

    public function addBook()
    {
        $BookManager = $this->booksManager;
        $addbook = $BookManager->addBook($_POST['titrelivre']);
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
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('administration');
        $myView->renderView(array('success'=> $success, 'error'=> $error));
    }
    public function addChapter()
    {
        $chaptermanager = $this->chapterManager;
        $resum = $chaptermanager->resumContent($_POST['content']);
        if($_FILES['image']['name']=='') {
            $Chaptersansimage = $this->chapterManager;
            $addchaptersansimage = $Chaptersansimage->addChapter($_POST['bookSelect'], $_POST['titrechapitre'], $_POST['content'], $resum, '0');
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
                $Addchapter = $ChapterManager->addChapter($_POST['bookSelect'], $_POST['titrechapitre'], $_POST['content'], $resum, $uploadResult['imageId']);
                if ($Addchapter === false) {
                    $_SESSION['error'] = 'Votre chapitre n\'a pas pu être ajouté';
                    header('Location: index.php?action=boutonaddchapter' . "#endpage");
                } else {
                    $chapterId = $Addchapter;
                    $modifimage = $imagemanager->modifchapterImage($chapterId);
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
            $modifLines = $ModifManager->modifChaptersansUpload($_POST['chapterselect'], $_POST['titrechapter'], $_POST['content'], $resum);
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
                $modifLines = $ModifManager->modifChapter($_POST['chapterselect'], $_POST['titrechapter'], $_POST['content'], $resum, $uploadResult['imageId']);
                $_SESSION['success'] = 'Votre chapitre a bien été modifié';
                header('Location: index.php?action=boutonmodifchapter' . "#endpage");
                if ($modifLines === false) {
                    $_SESSION['error'] = 'Impossible de modifier le chapitre !';
                    header('Location: index.php?action=boutonmodifchapter' . "#endpage");
                } else {
                    $chapterId = $_POST['chapterselect'];
                    $modifimage = $imagemanager->modifchapterImage($chapterId);
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
        $supp = $chapterManager->deleteChapter($_POST['chapterselect']);
        if ($supp === true) {
            $imageManager = $this->imagesManager;
            $deleteImageassoc=$imageManager->deleteImage($_POST['chapterselect']);
            $_SESSION['success'] = "Votre chapitre a bien été supprimé";
        }else {
            $_SESSION['error'] = "Votre chapitre n'a pas pu être supprimé";
        }
        header('Location: index.php?action=boutondeletechapter' . "#endpage");
    }

}