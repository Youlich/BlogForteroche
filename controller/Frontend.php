<?php
namespace controller;

use services\View;

\Autoload::register();

/**
 * Class Frontend
 * @package controller Frontend
 */

Class Frontend
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


    public function chapter () //affichage d'un chapitre : Chapter.php
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
        $chapterManager = $this->chapterManager;
        $commentManager = $this->commentManager;

        $chapter = $chapterManager->getChapter($_GET['id']);
        $imageexist = $chapter->getImageId();
            if ($imageexist != '0') {
                $imageManager = $this->imagesManager;
                $imagechapter = $imageManager->getImage($_GET['id']);
                $image = $imagechapter->getFileUrl();
            } else {
                $image = ''; }
        $comments = $commentManager->getCommentsChapter($_GET['id']);
        $nbComms = $commentManager->countCommentsChapter($_GET['id']);
        $myView = new View('chapter');
        $myView->renderViewFront(array('chapter' => $chapter,'comments'=> $comments,'nbComms'=>$nbComms,'image'=>$image));
        } else {
            $_SESSION['error'] = 'Aucun identifiant de chapitre envoyé';
        }
    }

    public function comment () // pour "modifier" un commentaire : comment.php
    {
        if (isset($_GET['numComm']) && $_GET['numComm'] > 0) {
        $commentManager = $this->commentManager;
        $comment = $commentManager->getComment($_GET['numComm']); // c'est l'id numComm qui est envoyé
            $myView = new View('comment');
            $myView->renderViewFront(array('comment' => $comment));
        } else {
            $_SESSION['error'] = 'Aucun identifiant de commentaire envoyé';
        }
    }

    public function listChapters () // affiche l'ensemble des chapitres
    {
        $chapterManager = $this->chapterManager;
        $chapters = $chapterManager->listChapters();
        $myView = new View('listchapters');
        $myView->renderViewFront(array('chapters' => $chapters));
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
        $myView = new View('lastchapter');
        $myView->renderViewFront(array('lastchapter' => $lastchapter,
            'idlastchapter' => $idlastchapter, 'comments'=>$comments,'imagechapter' => $imagechapter,
            'image' => $image, 'nbComms' => $nbComms));
    }

    public function listComments () // tableau des commentaires dans le profil du membre
    {
        $commentManager = $this->commentManager;
        $commentsMembre = $commentManager->listcomments($_SESSION['id']);
        $nbComms = $commentManager->countCommentsChapter($_GET['id']);// affiche le nb de commentaires par chapitre
        $myView = new View('profilmembre');
        $myView->renderViewFront(array('nbComms' => $nbComms, 'commentsMembre' => $commentsMembre));
    }

    public function addComment ($chapterId, $pseudo, $etat, $comment, $membreId) //ajout d'un commentaire dans un chapitre
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_SESSION['pseudo']) && !empty($_POST['comment'])) {
        $CommentManager = $this->commentManager;
        $CommentManager->addComment($chapterId, $pseudo, $etat, $comment, $membreId);
            } else {
                $_SESSION['error'] = 'Tous les champs ne sont pas remplis !';
                header('Location: index.php?action=chapter&id=' . $chapterId . "#nbcomments");
                exit();
            }
        } else {
            $_SESSION['error'] = 'Aucun identifiant de billet envoyé';
            header('Location: index.php?action=chapter&id=' . $chapterId . "#nbcomments");
            exit();
        }
    }

    public function modifComment () // modification d'un commentaire dans le tableau des commentaires du profil du membre
    {
        if (isset($_GET['numComm']) && $_GET['numComm'] > 0) {
            if (!empty($_SESSION['pseudo']) && !empty($_POST['comment'])) {
        $ModifManager = $this->commentManager;
        $ModifManager->modifComment();
            } else {
                $_SESSION['error'] = 'Tous les champs ne sont pas remplis !';
                header('Location: index.php?action=boutonafficherlescommentaires' . "#endpage");
                exit();
            }
        } else {
            $_SESSION['error'] = 'Aucun identifiant de billet envoyé';
            header('Location: index.php?action=boutonafficherlescommentaires' . "#endpage");
            exit();
        }
    }

    public function deleteComment ($membreId) // suppression d'un commentaire dans le tableau des commentaires du profil du membre
    {
        $deleteManager = $this->commentManager;
        $deleteComment = $deleteManager->deleteComment($membreId);
        $nbComms = $deleteManager->countCommentsChapter($_GET['id']);

    }

    public function signaledComment($commentid) //signaler un commentaire abusif
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
        $myView = new View('chapter');
        $myView->renderViewFront(array('signaledComment' => $signaledComment,'imagechapter' => $imagechapter, 'chapter' => $chapter,'comments'=> $comments,'nbComms'=>$nbComms,'image'=>$image));
    }

    /*Partie Membre*/

    public function loginmembre()
    {
        $authMembreManager = $this->membreManager;
        $authMembre = $authMembreManager->loginmembre();
        $myView = new View('loginmembre');
        $myView->renderViewFront(array('authMembre' => $authMembre));
    }
    public function logoutmembre()
    {
        session_destroy();
        header('Location: index.php');
        exit();
    }

    public function inscription()
    {
        $newMembre = $this->membreManager;
        $addMembre = $newMembre->inscription();
        if ($addMembre === false) {
            $_SESSION['error'] = "Impossible d'ajouter le membre";
            return $_SESSION['error'];
        } else {
            $myView = new View('inscription');
            $myView->renderViewFront(array('addMembre' => $addMembre));
        }
    }

    public function deleteaccount()
    {
        $suppMembre = $this->membreManager;
        $suppMembre->deleteaccount();
        $nbcomments = $this->membreManager;
    }

    public function boutonmodifpseudomdp()
    {
        $membreManager = $this->membreManager;
        $membre = $membreManager->getMembre($_SESSION['id']);
        $myView = new View('boutonmodifpseudomdp');
        $myView->renderViewFront(array('membre' => $membre));
    }

    public function boutonmodifiermail()
    {
        $membreManager = $this->membreManager;
        $membre = $membreManager->getMembre($_SESSION['id']);
        $myView = new View('boutonmodifiermail');
        $myView->renderViewFront(array('membre' => $membre));
    }
    public function boutonafficherlescommentaires()
    {
        $membreManager = $this->membreManager;
        $membre = $membreManager->getMembre($_SESSION['id']);
        $commentManager = $this->commentManager;
        $commentsMembre = $commentManager->listcomments($_SESSION['id']);
        $myView = new View('boutonafficherlescommentaires');
        $myView->renderViewFront(array('membre' => $membre, 'commentsMembre' => $commentsMembre));
    }
    public function boutonsupprimerprofil()
    {
        $membreManager = $this->membreManager;
        $membre = $membreManager->getMembre($_SESSION['id']);
        $myView = new View('boutonsupprimerprofil');
        $myView->renderViewFront(array('membre' => $membre));
    }

    public function modifPseudoMdp()
    {
        $nbcomments = $this->membreManager;
        $newpseudo = $this->membreManager;
        $modifmembre = $newpseudo->modifPseudoMdp();
        if ($modifmembre === false) {
            $_SESSION['error'] = 'Impossible de supprimer votre commentaire !';
            header('Location: index.php?action=boutonmodifpseudomdp' . "#endpage");
        } else {
            $myView = new View('profilmembre');
            $myView->renderViewFront(array('modifmembre' => $modifmembre));
        }
    }
    public function modifEmail()
    {
        $nbcomments = $this->membreManager;
        $newemail = $this->membreManager;
        $modifmembre = $newemail->modifEmail();
        if ($modifmembre){
            $_SESSION['success'] = 'Votre email a bien été modifiée';
            header('Location: index.php?action=boutonmodifiermail' . "#endpage");
        } else {
            $_SESSION['error'] = 'Impossible de modifier votre mail !';
            header('Location: index.php?action=boutonmodifiermail' . "#endpage");
        }
    }

    public function versInscription ()
    {
        $myView = new View('inscription');
        $myView->renderViewFront(array());
    }

    public function profilmembre()
    {
        $membreManager = $this->membreManager;
        $membre=$membreManager->getMembre($_SESSION['id']);
        $commentManager = $this->commentManager;
        $commentsMembre = $commentManager->listcomments($_SESSION['id']);
        $myView = new View('profilmembre');
        $myView->renderViewFront(array('membre' => $membre, 'commentsMembre' => $commentsMembre));
    }

    public function accueil()
    {
        $adminmanager = $this->adminManager;
        $admin = $adminmanager->profiladmin('2');
        $chaptermanager = $this->chapterManager;
        $chapters = $chaptermanager->listChapters();
        $bookManager = $this->booksManager;
        $books = $bookManager->getBooks();
        $myView = new View('accueil');
        $myView->renderViewFront(array('admin' => $admin, 'chapters' => $chapters, 'books' =>$books));
    }

    public function mentionslegales ()
    {
        $myView = new View('mentionslegales');
        $myView->renderViewFront(array());
    }

    public function charte ()
    {
        $myView = new View('charte');
        $myView->renderViewFront(array());
    }

}