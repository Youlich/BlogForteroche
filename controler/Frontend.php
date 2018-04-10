<?php
namespace controler;
use entity\Chapter;
use entity\Images;
use model\AdminManager;
use model\BooksManager;
use model\CommentManager;
use model\ImagesManager;
use model\MembreManager;
use model\ChapterManager;
use services\Telechargements;

require_once('Autoload.php'); // Chargement des class
\Autoload::register();
Class Frontend
{
    public function chapter () //affichage d'un chapitre
    {
        $chapterManager = new ChapterManager();
        $commentManager = new CommentManager();
        $imageManager = new ImagesManager();
        $chapter = $chapterManager->getChapter($_GET['id']);
        $comments = $commentManager->getCommentsChapter($_GET['id']);
        $imagechapter = $imageManager->getImage($_GET['id']);
        $image = $imagechapter->getFileUrl();
        $nbComms = $commentManager->CountCommentsChapter($_GET['id']);
        require('view/frontend/ChapterView.php');
    }

    public function comment () // pour "modifier" un commentaire
    {
        $commentManager = new CommentManager();
        $comment = $commentManager->getComment($_GET['numComm']); // c'est l'id numComm qui est envoyé
        require('view/frontend/CommentView.php');
    }

    public function membres ()
    {
        $membre = new MembreManager();
        $profil = $membre->getMembres();
        require('view/frontend/ProfilMembre.php');
    }

    public function listChapters () // affiche l'ensemble des chapitres
    {
        $chapterManager = new ChapterManager();
        $chapters = $chapterManager->getChapters();// fonction qui affiche tous les chapitres
        require('view/frontend/listChaptersView.php');
    }

    public function lastChapter()
    {
        $chapterManager = new ChapterManager();
        $lastchapter = $chapterManager->getLastChapter();
        $idlastchapter = $lastchapter->getId();
        $commentManager = new CommentManager();
        $comments = $commentManager->getCommentsChapter($idlastchapter);
        $imageManager = new ImagesManager();
        $imagechapter = $imageManager->getImage($idlastchapter);
        $image = $imagechapter->getFileUrl();
        $nbComms = $commentManager->CountCommentsChapter($idlastchapter);
        require ('view/frontend/lastChapter.php');
    }

    public function listCommentsMembre ()
    {
        $commentManager = new CommentManager();
        $commentsMembre = $commentManager->getCommentsMembre($_SESSION['id']);
        $nbComms = $commentManager->CountCommentsChapter($_GET['id']);// affiche le nb de commentaires par chapitre
        require('view/frontend/ProfilMembre.php');
    }



    public function addComment ($chapterId, $pseudo, $etat, $comment, $membreId) //ajout d'un commentaire dans un chapitre
    {
        $CommentManager = new \model\CommentManager();
        $addcomment = $CommentManager->AddComment($chapterId, $pseudo, $etat, $comment, $membreId);
        if ($addcomment === false) {
            throw new \Exception('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: index.php?action=chapter&id=' . $chapterId . "#nbcomments");
            exit();
        }
    }

    public function ModifComment ()
    {
        $ModifManager = new CommentManager();
        $modifLines = $ModifManager->ModifComment();
        if ($modifLines === false) {
            throw new \Exception('Impossible de modifier le commentaire !');
        } else {
            header('Location: index.php?action=profilMembre&amp;afficher_commentaires=1');
            exit();
        }
    }

    public function deleteComment ()
    {
        $deleteManager = new CommentManager();
        $deleteComment = $deleteManager->DeleteComment();
        $nbComms = $deleteManager->CountCommentsChapter($_GET['id']);
        if ($deleteComment === false) {
            throw new \Exception('Impossible de supprimer le commentaire !');
        } else {
            header('Location: index.php?action=profilMembre&amp;afficher_commentaires=1');
            exit();
        }
    }

    public function SignaledComment ($commentId)
    {
        $signaleManager = new CommentManager();
        $signaledComment = $signaleManager->SignaledComment();
        if ($signaledComment === false) {
            throw new \Exception('Impossible de signaler votre commentaire à Jean Forteroche, merci de retenter plus tard!');
        } else {
            header('Location: index.php?action=chapter&id=' . $commentId . "#nbcomments");
            exit();
        }

    }

    /*Partie Membre*/

    public function connectMembre()
    {
        $authMembreManager = new MembreManager();
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
        $newMembre = new MembreManager();
        $addMembre = $newMembre->InscrMembre();
        if ($addMembre === false) {
            throw new \Exception('Impossible d\'ajouter le membre !');
        } else {
            require('view/frontend/InscriptionMembreView.php');
        }

    }
    public function boutonmodifpseudomdp()
    {
        $membreManager = new MembreManager();
        $membre = $membreManager->getMembre($_SESSION['id']);
        $nbComms = $membreManager->CountCommentsMembre($_SESSION['id']);
        require ('view/frontend/boutonmodifpseudomdp.php');
    }

    public function boutonmodifiermail()
    {
        $membreManager = new MembreManager();
        $membre = $membreManager->getMembre($_SESSION['id']);
        $nbComms = $membreManager->CountCommentsMembre($_SESSION['id']);
        require ('view/frontend/boutonmodifiermail.php');
    }
    public function boutonafficherlescommentaires()
    {
        $membreManager = new MembreManager();
        $membre = $membreManager->getMembre($_SESSION['id']);
        $commentManager = new CommentManager();
        $commentsMembre = $commentManager->getCommentsMembre($_SESSION['id']);
        $nbComms = $membreManager->CountCommentsMembre($_SESSION['id']);
        require ('view/frontend/boutonafficherlescommentaires.php');
    }
    public function boutonsupprimerprofil()
    {
        $membreManager = new MembreManager();
        $membre = $membreManager->getMembre($_SESSION['id']);
        $nbComms = $membreManager->CountCommentsMembre($_SESSION['id']);
        require ('view/frontend/boutonsupprimerprofil.php');
    }



    public function modifPseudoMdp()
    {
        $nbcomments = new MembreManager();
        $nbComms = $nbcomments->CountCommentsMembre($_SESSION['id']);
        $newpseudo = new MembreManager();
        $modifmembre = $newpseudo->modifPseudoMDP();
        if ($modifmembre === false){
            throw new \Exception('Impossible de modifier vos informations pseudo ou mot de passe !');
        }
        else {
            require('view/frontend/ProfilMembre.php');
        }
    }
    public function modifEmail()
    {
        $nbcomments = new MembreManager();
        $nbComms = $nbcomments->CountCommentsMembre($_SESSION['id']);
        $newemail = new MembreManager();
        $modifmembre = $newemail->modifmail();
        if ($modifmembre === false){
            throw new \Exception('Impossible de modifier votre email !');
        }
        else {
            require('view/frontend/ProfilMembre.php');
        }
    }

    public function inscripMembre ()
    {
        require('view/frontend/InscriptionMembreView.php');
    }

    public function profilMembre ()
    {
        $membreManager = new MembreManager();
        $nbComms = $membreManager->CountCommentsMembre($_SESSION['id']);
        $membre=$membreManager->getMembre($_SESSION['id']);
        $commentManager = new CommentManager();
        $commentsMembre = $commentManager->getCommentsMembre($_SESSION['id']);
        require('view/frontend/ProfilMembre.php');
    }

    public function accueil()
    {
        $adminmanager = new AdminManager();
        $admin = $adminmanager->getAdmin('2');
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