<?php
namespace controller;

use entity\Membres;
use services\View;
\Autoload::register();
/**
 * Class Frontend
 * @package controller Frontend
 */
Class Frontend extends Controller
{
    private $membreManager;
    private $adminManager;
    private $commentManager;
    private $chapterManager;
    private $booksManager;
    private $imagesManager;

    /**
     * Frontend constructor.
     * les modèles appelés :
     * @param $membreManager
     * @param $adminManager
     * @param $commentManager
     * @param $chapterManager
     * @param $booksManager
     * @param $imagesManager
     *
     */
    public function __construct($membreManager, $adminManager, $commentManager, $chapterManager, $booksManager, $imagesManager) {
        $this->membreManager = $membreManager;
        $this->adminManager = $adminManager;
        $this->commentManager = $commentManager;
        $this->chapterManager = $chapterManager;
        $this->booksManager = $booksManager;
        $this->imagesManager = $imagesManager;
    }
    public function chapter($id) //affichage d'un chapitre : Chapter.php
    {
        if (isset($id) && $id > 0) {
            $chapterManager = $this->chapterManager;
            $commentManager = $this->commentManager;
            $chapter = $chapterManager->getChapter($id);
            $imageexist = $chapter->getImageId();
            if ($imageexist != '0') {
                $imageManager = $this->imagesManager;
                $imagechapter = $imageManager->getImage($id);
                $image = $imagechapter->getFileUrl();
            } else {
                $image = ''; }
            $comments = $commentManager->getCommentsChapter($id);
            $nbComms = $commentManager->countCommentsChapter($id);
            $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
            $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
            $pseudo = (isset($_SESSION['pseudo'])?$_SESSION['pseudo']:null);
	        $id = (isset($_SESSION['id'])?$_SESSION['id']:null);
            $myView = new View('chapter');
            $myView->renderView(array('chapter' => $chapter,'comments'=> $comments,'nbComms'=>$nbComms,'image'=>$image, 'success'=> $success,
                                      'error'=> $error, 'pseudo'=>$pseudo, 'id'=>$id));
        } else {
            $_SESSION['error'] = 'Aucun identifiant de chapitre envoyé';
        }
    }
    public function comment ($numComm) // pour "modifier" un commentaire : comment.php
    {
        if (isset($numComm) && $numComm > 0) {
            $commentManager = $this->commentManager;
            $comment = $commentManager->getComment($numComm); // c'est l'id numComm qui est envoyé
            $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
            $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
            $myView = new View('comment');
            $myView->renderView(array('comment' => $comment, 'success'=> $success, 'error'=> $error));
        } else {
            $_SESSION['error'] = 'Aucun identifiant de commentaire envoyé';
        }
    }
    public function listChapters() // affiche l'ensemble des chapitres
    {
        $chapterManager = $this->chapterManager;
        $chapters = $chapterManager->listChapters();
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('listChapters');
        $myView->renderView(array('chapters' => $chapters, 'success'=> $success, 'error'=> $error));
    }
    public function lastChapter() //affiche le dernier chapitre créé par l'auteur
    {
        $chapterManager = $this->chapterManager;
        $lastchapter = $chapterManager->getLastChapter();
        $idlastchapter = $lastchapter->getId();
        $commentManager = $this->commentManager;
        $comments = $commentManager->getCommentsChapter($idlastchapter);
        $imageManager = $this->imagesManager;
        $imagechapter = $imageManager->getImage($idlastchapter);
        $image = $imagechapter->getFileUrl();
        $nbComms = $commentManager->countCommentsChapter($idlastchapter);
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
	    $pseudo = (isset($_SESSION['pseudo'])?$_SESSION['pseudo']:null);
	    $id = (isset($_SESSION['id'])?$_SESSION['id']:null);
        $myView = new View('lastChapter');
        $myView->renderView(array('lastchapter' => $lastchapter,
            'idlastchapter' => $idlastchapter, 'comments'=>$comments,'imagechapter' => $imagechapter,
            'image' => $image, 'nbComms' => $nbComms, 'success'=> $success, 'error'=> $error, 'pseudo'=>$pseudo, 'id'=>$id));
    }
    public function listCommentsMembre() // tableau des commentaires dans le profil du membre
    {
        $commentManager = $this->commentManager;
        $comments = $commentManager->listCommentsMembre($_SESSION['id']);
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('profilmembre');
        $myView->renderView(array('comments' => $comments, 'success'=> $success, 'error'=> $error));
    }
    public function addComment($chapterId) //ajout d'un commentaire dans un chapitre
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_SESSION['pseudo']) && !empty($_POST['comment'])) {
                $CommentManager = $this->commentManager;
                $CommentManager->addComment($chapterId, $_SESSION['pseudo'], 'En attente', $_POST['comment'], $_SESSION['id']);
            } else {
                $_SESSION['error'] = 'Tous les champs ne sont pas remplis !';
	            $this->redirect('Location: index.php?action=chapter&id=' . $chapterId . "#nbcomments");
                exit();
            }
        } else {
            $_SESSION['error'] = 'Aucun identifiant de billet envoyé';
	        $this->redirect('Location: index.php?action=chapter&id=' . $chapterId . "#nbcomments");
            exit();
        }
    }
    public function modifComment () // modification d'un commentaire dans le tableau des commentaires du profil du membre
    {
        if (isset($_GET['numComm']) && $_GET['numComm'] > 0) {
            if (!empty($_SESSION['pseudo']) && !empty($_POST['comment'])) {
                $ModifManager = $this->commentManager;
                $comment = $ModifManager->getComment($_POST['numComm']);
	                $comment->setMembreId($_SESSION['id']);
	                $comment->setMembrePseudo($_SESSION['pseudo']);
	                $comment->setComment($_POST['comment']);
	                $comment->setStatut('En attente');
                $modifComment = $ModifManager->modifComment($comment);
            } else {
                $_SESSION['error'] = 'Tous les champs ne sont pas remplis !';
                $this->redirect('Location: index.php?action=boutonafficherlescommentaires' . "#endpage");
                exit();
            }
        } else {
            $_SESSION['error'] = 'Aucun identifiant de billet envoyé';
	        $this->redirect('Location: index.php?action=boutonafficherlescommentaires' . "#endpage");
            exit();
        }
    }

    public function deleteComment($membreId) // suppression d'un commentaire dans le tableau des commentaires du profil du membre
    {
        $deleteManager = $this->commentManager;
        $deleteComment = $deleteManager->deleteComment($_SESSION['id']);

    }

	public function signaledComment() //signaler un commentaire abusif
	{
		$signaleManager = $this->commentManager;
		$signaledComment = $signaleManager->signaledComment($_GET['id']);
		$chapterManager = $this->chapterManager;
		$commentManager = $this->commentManager;
		$imageManager = $this->imagesManager;
		$chapter = $chapterManager->getChapter($_GET['id']);
		$comments = $commentManager->getCommentsChapter($_GET['id']);
		$imagechapter = $imageManager->getImage($_GET['id']);
		$image = $imagechapter->getFileUrl();
		$nbComms = $commentManager->countCommentsChapter($_GET['id']);
		$success = (isset($_SESSION['success'])?$_SESSION['success']:null);
		$error = (isset($_SESSION['error'])?$_SESSION['error']:null);
		$myView = new View('chapter');
		$myView->renderView(array('signaledComment' => $signaledComment,'imagechapter' => $imagechapter, 'chapter' => $chapter,'comments'=> $comments,'nbComms'=>$nbComms,'image'=>$image,
		                          'success'=> $success, 'error'=> $error));
	}

    /*Partie Membre*/
    public function loginMembre()
    {
        $authMembreManager = $this->membreManager;
        $authMembre = $authMembreManager->loginMembre();
        $session = (isset($_SESSION['id']));
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('loginmembre');
        $myView->renderView(array('authMembre' => $authMembre, 'success'=> $success, 'error'=> $error, 'id'=> $session));
    }
    public function logoutMembre()
    {
        session_destroy();
        $this->redirect('Location: index.php');
        exit();
    }
    public function inscription()
    {
        $newMembre = $this->membreManager;
        $addMembre = $newMembre->inscription();
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('inscription');
        $myView->renderView(array('addMembre' => $addMembre, 'success'=> $success, 'error'=> $error));
    }
    public function deleteAccount()
    {
        $suppMembre = $this->membreManager;
        $suppMembre->deleteAccount();
        $nbcomments = $this->membreManager;
    }
    public function boutonmodifpseudomdp()
    {
        $membreManager = $this->membreManager;
        $membre = $membreManager->getMembre(($_SESSION['id']));
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
	    $pseudo = (isset($_SESSION['pseudo'])?$_SESSION['pseudo']:null);
	    $email = (isset($_SESSION['email'])?$_SESSION['email']:null);
	    $id = (isset($_SESSION['id'])?$_SESSION['id']:null);
        $myView = new View('boutonmodifpseudomdp');
        $myView->renderView(array('membre' => $membre, 'success'=> $success, 'error'=> $error, 'pseudo'=>$pseudo, 'email'=>$email, 'id'=>$id));
    }
    public function boutonmodifiermail()
    {
        $membreManager = $this->membreManager;
        $membre = $membreManager->getMembre($_SESSION['id']);
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
	    $pseudo = (isset($_SESSION['pseudo'])?$_SESSION['pseudo']:null);
	    $email = (isset($_SESSION['email'])?$_SESSION['email']:null);
	    $id = (isset($_SESSION['id'])?$_SESSION['id']:null);
        $myView = new View('boutonmodifiermail');
        $myView->renderView(array('membre' => $membre, 'success'=> $success, 'error'=> $error, 'pseudo'=>$pseudo, 'email'=>$email, 'id'=>$id));
    }
    public function boutonafficherlescommentaires()
    {
        $membreManager = $this->membreManager;
        $membre = $membreManager->getMembre($_SESSION['id']);
        $commentManager = $this->commentManager;
            $membre->setId($_SESSION['id']);
        $comments = $commentManager->listCommentsMembre($membre);
        $pseudo = (isset($_SESSION['pseudo'])?$_SESSION['pseudo']:null);
        $email = (isset($_SESSION['email'])?$_SESSION['email']:null);
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $id = (isset($_SESSION['id'])?$_SESSION['id']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('boutonafficherlescommentaires');
        $myView->renderView(array('membre' => $membre,'comments' => $comments, 'success'=> $success, 'error'=> $error, 'pseudo'=>$pseudo,
                                  'email'=>$email, 'id'=>$id));
    }
    public function boutonsupprimerprofil()
    {
        $membreManager = $this->membreManager;
        $membre = $membreManager->getMembre($_SESSION['id']);
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
	    $pseudo = (isset($_SESSION['pseudo'])?$_SESSION['pseudo']:null);
	    $email = (isset($_SESSION['email'])?$_SESSION['email']:null);
	    $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
	    $id = (isset($_SESSION['id'])?$_SESSION['id']:null);
        $myView = new View('boutonsupprimerprofil');
        $myView->renderView(array('membre' => $membre, 'success'=> $success, 'error'=> $error, 'pseudo'=>$pseudo,
                                  'email'=>$email, 'id'=>$id));
    }
    public function modifPseudoMdp()
    {

        $nbcomments = $this->membreManager;
        $newpseudo = $this->membreManager;
        $modifmembre = $newpseudo->modifPseudoMdp();
        if ($modifmembre) {
            $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
            $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
            $myView = new View('profilmembre');
            $myView->renderView(array('modifmembre' => $modifmembre, 'success'=> $success, 'error'=> $error));

        } else {
            $_SESSION['error'] = 'Impossible de modifier votre compte !';
            $this->redirect('Location: index.php?action=boutonmodifpseudomdp' . "#endpage");
        }
    }
    public function modifEmail()
    {
        $nbcomments = $this->membreManager;
        $newemail = $this->membreManager;
        $modifmembre = $newemail->modifEmail();
        if ($modifmembre){
            $_SESSION['success'] = 'Votre email a bien été modifiée';
            $this->redirect('Location: index.php?action=boutonmodifiermail' . "#endpage");
        } else {
            $_SESSION['error'] = 'Impossible de modifier votre mail !';
	        $this->redirect('Location: index.php?action=boutonmodifiermail' . "#endpage");
        }
    }
    public function versInscription ()
    {
        $myView = new View('inscription');
        $myView->renderView(array());
    }
    public function profilMembre()
    {
        $membreManager = $this->membreManager;
        $membre=$membreManager->getMembre($_SESSION['id']);
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
	    $pseudo = (isset($_SESSION['pseudo'])?$_SESSION['pseudo']:null);
	    $email = (isset($_SESSION['email'])?$_SESSION['email']:null);
	    $myView = new View('profilmembre');
        $myView->renderView(array('membre' => $membre, 'success'=> $success, 'error'=> $error, 'pseudo'=>$pseudo,'email'=>$email ));
    }
    public function accueil()
    {
        $adminmanager = $this->adminManager;
        $admin = $adminmanager->profilAdmin('2');
        $chaptermanager = $this->chapterManager;
        $chapters = $chaptermanager->listChapters();
        $bookManager = $this->booksManager;
        $books = $bookManager->getBooks();
	    $user_is_connected = (isset($_SESSION['id']))?true:false;
	    $sessionId = (isset($_SESSION['id'])?$_SESSION['id']:null);
	    $sessionPseudo = (isset($_SESSION['pseudo'])?$_SESSION['pseudo']:null);
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $name = (isset($_SESSION['inputs']['name'])?$_SESSION['inputs']['name'] : '');
        $email = (isset($_SESSION['inputs']['email']) ? $_SESSION['inputs']['email'] : '');
        $message = (isset($_SESSION['inputs']['message']) ? $_SESSION['inputs']['message'] : '');
        $myView = new View('accueil');
	    $myView->renderView(array('admin' => $admin, 'chapters' => $chapters, 'books' =>$books,'success'=> $success, 'error'=> $error,
	                              'user_is_connected'=> $user_is_connected, 'sessionId'=> $sessionId, 'sessionPseudo' => $sessionPseudo,
		                            'name'=>$name, 'email'=>$email, 'message'=>$message));
    }
    public function mentionslegales ()
    {
        $myView = new View('mentionslegales');
        $myView->renderView(array());
    }
    public function charte ()
    {
        $myView = new View('charte');
        $myView->renderView(array());
    }
}