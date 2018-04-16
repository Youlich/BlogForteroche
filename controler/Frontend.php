<?php
namespace controler;

require_once('Autoload.php'); // Chargement des classes
\Autoload::register();

/**
 * Class Frontend
 * @package controler Frontend
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


    public function chapter () //affichage d'un chapitre : ChapterView.php
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
        $nbComms = $commentManager->CountCommentsChapter($_GET['id']);
        require('view/frontend/ChapterView.php');
        } else {
            $_SESSION['error'] = 'Aucun identifiant de chapitre envoyé';
        }
    }

    public function comment () // pour "modifier" un commentaire : CommentView.php
    {
        if (isset($_GET['numComm']) && $_GET['numComm'] > 0) {
        $commentManager = $this->commentManager;
        $comment = $commentManager->getComment($_GET['numComm']); // c'est l'id numComm qui est envoyé
        require('view/frontend/CommentView.php');
        } else {
            $_SESSION['error'] = 'Aucun identifiant de commentaire envoyé';
        }
    }

    public function listChapters () // affiche l'ensemble des chapitres
    {
        $chapterManager = $this->chapterManager;
        $chapters = $chapterManager->getChapters();
        require('view/frontend/listChaptersView.php');
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
        $nbComms = $commentManager->CountCommentsChapter($idlastchapter);
        require ('view/frontend/lastChapter.php');
    }

    public function listCommentsMembre () // tableau des commentaires dans le profil du membre
    {
        $commentManager = $this->commentManager;
        $commentsMembre = $commentManager->getCommentsMembre($_SESSION['id']);
        $nbComms = $commentManager->CountCommentsChapter($_GET['id']);// affiche le nb de commentaires par chapitre
        require('view/frontend/ProfilMembre.php');
    }

    public function addComment ($chapterId, $pseudo, $etat, $comment, $membreId) //ajout d'un commentaire dans un chapitre
    {
        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_SESSION['pseudo']) && !empty($_POST['comment'])) {
        $CommentManager = $this->commentManager;
        $CommentManager->AddComment($chapterId, $pseudo, $etat, $comment, $membreId);
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

    public function ModifComment () // modification d'un commentaire dans le tableau des commentaires du profil du membre
    {
        if (isset($_GET['numComm']) && $_GET['numComm'] > 0) {
            if (!empty($_SESSION['pseudo']) && !empty($_POST['comment'])) {
        $ModifManager = $this->commentManager;
        $ModifManager->ModifComment();
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
        $deleteComment = $deleteManager->DeleteComment($membreId);
        $nbComms = $deleteManager->CountCommentsChapter($_GET['id']);

    }

    public function SignaledComment($commentid) //signaler un commentaire abusif
    {
        $signaleManager = $this->commentManager;
        $signaledComment = $signaleManager->SignaledComment($_GET['id']);
        $chapterManager = $this->chapterManager;
        $commentManager = $this->commentManager;
        $imageManager = $this->imagesManager;
        $chapter = $chapterManager->getChapter($_GET['id']);
        $comments = $commentManager->getCommentsChapter($_GET['id']);
        $imagechapter = $imageManager->getImage($_GET['id']);
        $image = $imagechapter->getFileUrl();
        $nbComms = $commentManager->CountCommentsChapter($_GET['id']);
        require ('view/frontend/ChapterView.php');
    }

    /*Partie Membre*/

    public function connectMembre()
    {
        $authMembreManager = $this->membreManager;
        $authMembre = $authMembreManager->AuthMembre();
        require('view/frontend/AuthMembreView.php');
    }
    public function deconnectMembre()
    {
        session_destroy();
        header('Location: index.php');
        exit();
    }

    public function addMembre()
    {
        $newMembre = $this->membreManager;
        $addMembre = $newMembre->InscrMembre();
        if ($addMembre === false) {
            $_SESSION['error'] = "Impossible d'ajouter le membre";
            return $_SESSION['error'];
        } else {
            require('view/frontend/InscriptionMembreView.php');
        }
    }

    public function suppMembre()
    {
        $suppMembre = $this->membreManager;
        $suppMembre->deleteMembre();
        $nbcomments = $this->membreManager;
    }

    public function boutonmodifpseudomdp()
    {
        $membreManager = $this->membreManager;
        $membre = $membreManager->getMembre($_SESSION['id']);
        require ('view/frontend/boutonmodifpseudomdp.php');
    }

    public function boutonmodifiermail()
    {
        $membreManager = $this->membreManager;
        $membre = $membreManager->getMembre($_SESSION['id']);
        require ('view/frontend/boutonmodifiermail.php');
    }
    public function boutonafficherlescommentaires()
    {
        $membreManager = $this->membreManager;
        $membre = $membreManager->getMembre($_SESSION['id']);
        $commentManager = $this->commentManager;
        $commentsMembre = $commentManager->getCommentsMembre($_SESSION['id']);
        require ('view/frontend/boutonafficherlescommentaires.php');
    }
    public function boutonsupprimerprofil()
    {
        $membreManager = $this->membreManager;
        $membre = $membreManager->getMembre($_SESSION['id']);
        require ('view/frontend/boutonsupprimerprofil.php');
    }

    public function modifPseudoMdp()
    {
        $nbcomments = $this->membreManager;
        $newpseudo = $this->membreManager;
        $modifmembre = $newpseudo->modifPseudoMDP();
        if ($modifmembre === false) {
            $_SESSION['error'] = 'Impossible de supprimer votre commentaire !';
            header('Location: index.php?action=boutonmodifpseudomdp' . "#endpage");
        } else {
            require('view/frontend/ProfilMembre.php');
        }
    }
    public function modifEmail()
    {
        $nbcomments = $this->membreManager;
        $newemail = $this->membreManager;
        $modifmembre = $newemail->modifmail();
        if ($modifmembre){
            $_SESSION['success'] = 'Votre email a bien été modifiée';
            header('Location: index.php?action=boutonmodifiermail' . "#endpage");
        } else {
            $_SESSION['error'] = 'Impossible de modifier votre mail !';
            header('Location: index.php?action=boutonmodifiermail' . "#endpage");
        }
    }

    public function inscripMembre ()
    {
        require('view/frontend/InscriptionMembreView.php');
    }

    public function profilMembre ()
    {
        $membreManager = $this->membreManager;

        $membre=$membreManager->getMembre($_SESSION['id']);
        $commentManager = $this->commentManager;
        $commentsMembre = $commentManager->getCommentsMembre($_SESSION['id']);
        require('view/frontend/ProfilMembre.php');
    }

    public function accueil()
    {
        $adminmanager = $this->adminManager;
        $admin = $adminmanager->getAdmin('2');
        $chaptermanager = $this->chapterManager;
        $chapters = $chaptermanager->getChapters();
        $bookManager = $this->booksManager;
        $books = $bookManager->getBooks();
        require('view/frontend/accueil.php');
    }

    public function mentionslegales ()
    {
        require('view/frontend/MentionsLegales.php');
    }

    public function charte ()
    {
        require('view/frontend/charte.php');
    }

}