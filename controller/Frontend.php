<?php
namespace controller;

use entity\Chapter;
use entity\Comment;
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

	/**
	 * gestion de la page d'accueil
	 */
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

// gestion des chapitres
	/**
	 * @param $id
	 * permet l'affichage d'un chapitre et affiche la vue Chapter.php
	 */
    public function chapter($id)
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
	        $user_is_connected = (isset($_SESSION['id']))?true:false;
            $myView = new View('chapter');
            $myView->renderView(array('chapter' => $chapter,'comments'=> $comments,'nbComms'=>$nbComms,'image'=>$image, 'success'=> $success,
                                      'error'=> $error, 'pseudo'=>$pseudo, 'user_is_connected'=>$user_is_connected));
        } else {
            $_SESSION['error'] = 'Aucun identifiant de chapitre envoyé';
        }
    }

	/**
	 * affiche l'ensemble des chapitres
	 */
    public function listChapters()
    {
        $chapterManager = $this->chapterManager;
        $chapters = $chapterManager->listChapters();
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('listChapters');
        $myView->renderView(array('chapters' => $chapters, 'success'=> $success, 'error'=> $error));
    }

	/**
	 * affiche le dernier chapitre créé par l'auteur
	 */
    public function lastChapter()
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

// gestion des commentaires
	/**
	 * @param $numComm
	 * pour "modifier" un commentaire : comment.php
	 */

	public function comment ($numComm)
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

	/**
	 * tableau des commentaires dans le profil du membre
	 */
    public function listCommentsMembre()
    {
        $commentManager = $this->commentManager;
        $comments = $commentManager->listCommentsMembre($_SESSION['id']);
        $success = (isset($_SESSION['success'])?$_SESSION['success']:null);
        $error = (isset($_SESSION['error'])?$_SESSION['error']:null);
        $myView = new View('profilmembre');
        $myView->renderView(array('comments' => $comments, 'success'=> $success, 'error'=> $error));
    }

	/**
	 * @param $chapterId
	 * ajout d'un commentaire dans un chapitre
	 */
    public function addComment($chapterId)
    {
    	$comment = new Comment();
	    $comment->setChapterId($chapterId);
	    $comment->setMembrePseudo($_SESSION['pseudo']);
	    $comment->setComment($_POST['comment']);
	    $comment->setMembreId($_SESSION['id']);
    	$comment->setStatut('En attente');
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_SESSION['pseudo']) && !empty($_POST['comment'])) {
                $CommentManager = $this->commentManager;
                $CommentManager->addComment($comment);
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

	/**
	 * modification d'un commentaire dans le tableau des commentaires du profil du membre
	 */

    public function modifComment()
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

	/**
	 * @param $membreId
	 * suppression d'un commentaire dans le tableau des commentaires du profil du membre
	 */
    public function deleteComment($membreId)
    {
        $deleteManager = $this->commentManager;
        $membremanager = $this->membreManager;
        $membre = $membremanager->getMembre($_SESSION['id']);
        $membre->setId($_SESSION['id']);
        $deleteComment = $deleteManager->deleteComment($membre);

    }

	/**
	 * signaler un commentaire abusif
	 */

	public function signaledComment()
	{
		$signaleManager = $this->commentManager;
		$comment = $signaleManager->getComment($_GET['numcomm']);
		$comment->setChapterId($_GET['id']);
		$comment->setStatut('Alerte');
		$signaledComment = $signaleManager->signaledComment($comment);
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
		$user_is_connected = (isset($_SESSION['id']))?true:false;
		$pseudo = (isset($_SESSION['pseudo'])?$_SESSION['pseudo']:null);
		$myView = new View('chapter');
		$myView->renderView(array('signaledComment' => $signaledComment,'imagechapter' => $imagechapter, 'chapter' => $chapter,'comments'=> $comments,'nbComms'=>$nbComms,'image'=>$image,
		                          'success'=> $success, 'error'=> $error, 'user_is_connected' => $user_is_connected, 'pseudo' =>$pseudo));
	}

//gestion des membres

	/**
	 * lien qui redirige vers la page inscription après validation de la charte
	 */

	public function versInscription ()
	{
		$myView = new View('inscription');
		$myView->renderView(array());
	}

	/**
	 * permet l'inscription du membre
	 */

	public function inscription()
	{
		$newMembre = $this->membreManager;
		$addMembre = $newMembre->inscription();
		$success = (isset($_SESSION['success'])?$_SESSION['success']:null);
		$error = (isset($_SESSION['error'])?$_SESSION['error']:null);
		$myView = new View('inscription');
		$myView->renderView(array('addMembre' => $addMembre, 'success'=> $success, 'error'=> $error));
	}

	/**
	 * permet la connexion du membre
	 */
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

	/**
	 * permet la déconnexion du membre
	 */
    public function logoutMembre()
    {
        session_destroy();
        $this->redirect('Location: index.php');
        exit();
    }

	/**
	 * gère la suppression du membre
	 */
	public function deleteAccount($id_membre)
	{
		{
			$suppMembre = $this->membreManager;
			$suppMembre->deleteAccount();
			$membre = $suppMembre->getMembre($id_membre);
			$suppMembre->deleteAccount($membre);
			$nbcomments = $this->membreManager;
		}
	}

	/**
	 * permet l'affichage du profil du membre et ses données
	 */
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


	/**
	 * affiche le contenu du bouton
	 */

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

	/**
	 * affiche le contenu du bouton
	 */
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

	/**
	 * affiche le contenu du bouton
	 */
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

	/**
	 * affiche le contenu du bouton
	 */
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

	/**
	 * permet la modification du pseudo et du mdp
	 */
    public function modifPseudoMdp()
    {

        $nbcomments = $this->membreManager;
        $newpseudo = $this->membreManager;
	    $membreManager = $this->membreManager;
	    $membre = $membreManager->getMembre($_SESSION['id']);
	        $membre->setId($_POST['idmembre']);
	        $membre->setPseudo($_POST['pseudo']);
	    $modifmembre = $newpseudo->modifPseudoMdp($membre);
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

	/**
	 * permet la modification de l'email du membre
	 */
    public function modifEmail()
    {
        $nbcomments = $this->membreManager;
        $newemail = $this->membreManager;
	    $membreManager = $this->membreManager;
	    $membre = $membreManager->getMembre($_SESSION['id']);
	    $membre->setId($_POST['idmembre']);
	    $membre->setEmail($_POST['email']);
        $modifmembre = $newemail->modifEmail($membre);
        if ($modifmembre){
            $_SESSION['success'] = 'Votre email a bien été modifiée';
            $this->redirect('Location: index.php?action=boutonmodifiermail' . "#endpage");
        } else {
            $_SESSION['error'] = 'Impossible de modifier votre mail !';
	        $this->redirect('Location: index.php?action=boutonmodifiermail' . "#endpage");
        }
    }
// autres pages

	/**
	 * page
	 */
    public function mentionslegales ()
    {
        $myView = new View('mentionslegales');
        $myView->renderView(array());
    }

	/**
	 * page
	 */
    public function charte ()
    {
        $myView = new View('charte');
        $myView->renderView(array());
    }
}