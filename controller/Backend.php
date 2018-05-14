<?php
namespace controller;
use services\View;


\Autoload::register();
/**
 * Class Backend
 * @package controller Backend
 */
Class Backend extends Controller
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

    public function loginAdmin()
    {
        $authMembreManager = $this->adminManager;
        $authMembreManager->loginAdmin();
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('loginadmin');
        $myView->renderView(array('success'=> $success, 'error'=> $error));
    }

    public function logoutAdmin()
    {
        session_destroy();
        $this->redirect('Location: index.php');
        exit();
    }
    public function profilAdmin()
    {
        $adminmanager = $this->adminManager;
        $admin = $adminmanager->profilAdmin($_SESSION['id']);
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('profiladmin');
        $myView->renderView(array('admin' => $admin, 'success'=> $success, 'error'=> $error));
    }
    public function modifmessage()
    {
        $adminmanager = $this->adminManager;
        $admin = $adminmanager->profilAdmin($_SESSION['id']);
        $adminmessage = $adminmanager->modifMessage();
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('profiladmin');
        $myView->renderView(array('admin' => $admin, 'adminmessage' => $adminmessage, 'success'=> $success, 'error'=> $error));
    }
    public function approvedComment()
    {
        $approved = $this->commentManager;
        $comment = $approved->getComment($_GET['id']);
            $comment->setStatut('Valide');
        $commentapproved = $approved->approvedComment($comment);
        $comments = $approved->listComments();
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('listcomments');
        $myView->renderView(array('comments' => $comments, 'success'=> $success, 'error'=> $error));
    }
    public function refusedComment()
    {
        $refused = $this->commentManager;
	    $comment = $refused->getComment($_GET['id']);
	        $comment->setStatut('Refus');
        $commentrefused = $refused->refusedComment($comment);
        $comments = $refused->listComments();
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('listcomments');
        $myView->renderView(array('comments' => $comments, 'success'=> $success, 'error'=> $error));
    }
    public function listComments()
    {
        $commentManager = $this->commentManager;
        $comments = $commentManager->listComments();
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

    public function addBook($title)
    {
        $BookManager = $this->booksManager;
        $addbook = $BookManager->addBook($title);
        if ($addbook === false) {
            $_SESSION['error'] = 'Impossible d\'ajouter le livre !';
            $this->redirect('Location: index.php?action=boutonaddbook' . "#endpage");
        } else {
            $_SESSION['success'] = 'Votre nouveau livre a bien été ajouté';
            $this->redirect('Location: index.php?action=boutonaddbook' . "#endpage");
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
				$this->redirect('Location: index.php?action=boutonaddchapter' . "#endpage");
			} else {
				$_SESSION['success'] = 'Votre chapitre a bien été ajouté';
				$this->redirect('Location: index.php?action=boutonaddchapter' . "#endpage");
			}
		} else {
			$imagemanager = $this->imagesManager;
			$uploadResult = $imagemanager->upload();
			if ($uploadResult['result']) {
				$ChapterManager = $this->chapterManager;
				$Addchapter = $ChapterManager->addChapter($_POST['bookSelect'], $_POST['titrechapitre'], $_POST['content'], $resum, $uploadResult['imageId']);
				if ($Addchapter === false) {
					$_SESSION['error'] = 'Votre chapitre n\'a pas pu être ajouté';
					$this->redirect('Location: index.php?action=boutonaddchapter' . "#endpage");
				} else {
					$chapterId = $Addchapter;
					$modifimage = $imagemanager->modifChapterImage($chapterId);
					if ($modifimage === false ) {
						$_SESSION['error'] = 'Votre image n\'a pas pu être ajoutée au chapitre';
						$this->redirect('Location: index.php?action=boutonaddchapter' . "#endpage");
					} else {
						$_SESSION['success'] = 'Votre chapitre a bien été ajouté avec son image';
						$this->redirect('Location: index.php?action=boutonaddchapter' . "#endpage");
					}
				}
			} else {
				$_SESSION['error'] = 'Votre image n\'a pas pu être téléchargée';
				$this->redirect('Location: index.php?action=boutonaddchapter' . "#endpage");
			}
		}
	}

    public function modifChapter()
    {
        $chaptermanager = $this->chapterManager;
        $resum = $chaptermanager->resumContent($_POST['content']);
        if($_FILES['image']['name']=='') {
            $ModifManager = $this->chapterManager;
	        $chapter = $ModifManager->getChapter($_POST['chapterselect']);
	                    $chapter->setTitle($_POST['titrechapter']);
	                    $chapter->setContent($_POST['content']);
	                    $chapter->setResum($resum);
	        $modifLines = $ModifManager->modifChaptersansUpload($chapter);
            if ($modifLines === false) {
                $_SESSION['error'] = 'Impossible de modifier le chapitre !';
	            $this->redirect('Location: index.php?action=boutonmodifchapter' . "#endpage");
            } else {
                $_SESSION['success'] = 'Votre chapitre a bien été modifié';
	            $this->redirect('Location: index.php?action=boutonmodifchapter' . "#endpage");
            }
        } else {
            $imagemanager = $this->imagesManager;
            $uploadResult = $imagemanager->upload();
            if ($uploadResult['result']) {
                $ModifManager = $this->chapterManager;
	            $chapter = $ModifManager->getChapter($_POST['chapterselect']);
	            $chapter->setTitle($_POST['titrechapter']);
	            $chapter->setContent($_POST['content']);
	            $chapter->setResum($resum);
	            $chapter->setImageId($uploadResult['imageId']);
	            $modifLines = $ModifManager->modifChapter($chapter);
                $_SESSION['success'] = 'Votre chapitre a bien été modifié';
	            $this->redirect('Location: index.php?action=boutonmodifchapter' . "#endpage");
                if ($modifLines === false) {
                    $_SESSION['error'] = 'Impossible de modifier le chapitre !';
	                $this->redirect('Location: index.php?action=boutonmodifchapter' . "#endpage");
                } else {
                    $chapterId = $_POST['chapterselect'];
                    $modifimage = $imagemanager->modifChapterImage($chapterId);
                    if ($modifimage === false) {
                        $_SESSION['error'] = 'Impossible de modifier l\'image dans le chapitre';
	                    $this->redirect('Location: index.php?action=boutonmodifchapter' . "#endpage");
                    } else {
                        $_SESSION['success'] = 'Votre chapitre a bien été modifié avec son image';
	                    $this->redirect('Location: index.php?action=boutonmodifchapter' . "#endpage");
                    }
                }
            } else {
                $_SESSION['error'] = 'Votre image n\'a pas pu être téléchargée';
	            $this->redirect('Location: index.php?action=boutonmodifchapter' . "#endpage");
            }
        }
    }
    public function deleteChapter()
    {
        $chapterManager = $this->chapterManager;
        $chapter = $chapterManager->getChapter($_POST['chapterselect']);
	    $supp = $chapterManager->deleteChapter($chapter);
        if ($supp === true) {
            $imageManager = $this->imagesManager;
            $deleteImageassoc=$imageManager->deleteImage($_POST['chapterselect']);
            $_SESSION['success'] = "Votre chapitre a bien été supprimé";
        }else {
            $_SESSION['error'] = "Votre chapitre n'a pas pu être supprimé";
        }
	    $this->redirect('Location: index.php?action=boutondeletechapter' . "#endpage");
    }

}