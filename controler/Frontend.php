<?php
namespace controler;
use model\CommentManager;
use model\MembreManager;
use model\ChapterManager;
require_once('Autoload.php'); // Chargement des class
\Autoload::register();
Class Frontend
{
    public function chapter() //affichage d'un chapitre
    {
        $postManager = new ChapterManager(); // lieu où se trouve la fonction getPost
        $commentManager = new CommentManager(); // lieu où se trouve la fonction getComments
        $chapter = $postManager->getChapter($_GET['id']); // affiche le post en question grâce à la fonction getPost se trouvant dans PostManager
        $comments = $commentManager->getCommentsChapter ($_GET['id']); // affiche les commentaires qui lui sont associés
        $nbComms = $commentManager->CountComments($_GET['id']);// affiche le nb de commentaires par chapitre
        require('view/frontend/chapterView.php'); //page qui gère l'affichage associé
    }

    public function comment() // pour "modifier" un commentaire
    {
        $commentManager = new CommentManager();
        $comment = $commentManager->getCommentsChapter($_GET['numComm']); // c'est l'id numComm qui est envoyé
        require('view/frontend/commentView.php');
    }
    public function membres()
    {
        $membre = new MembreManager();
        $profil = $membre->getMembres();
        require ('view/frontend/ProfilMembresView.php');
    }

    public function listChapters() // affiche l'ensemble des chapitres
    {
        $chapterManager = new ChapterManager();
        $chapters = $chapterManager->getChapters(); // fonction qui affiche tous les chapitres
        require('view/frontend/listChaptersView.php');
    }

    public function listComments()
    {
        $commentManager = new CommentManager();
        $commentsMembre = $commentManager->getComments();
        require('view/frontend/listCommentsView.php');
    }

    public function listCommentsMembre()
    {
        $commentManager = new CommentManager();
        $commentsMembre = $commentManager->getCommentsMembre($_SESSION['id']);
        require('view/frontend/ProfilMembreView.php');
    }

    public function listMembres()
    {
        $membreManager = new MembreManager();
        $membres = $membreManager->getMembres();
        require ('view/frontend/listMembresView.php');
    }

    public function addComment($chapterId, $pseudo, $comment, $membreId) //ajout d'un commentaire dans un chapitre
    {
        $CommentManager = new \model\CommentManager();
        $addcomment = $CommentManager->ChapterComment($chapterId, $pseudo, $comment, $membreId);
        if ($addcomment === false) {
            throw new \Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=chapter&id=' . $chapterId . "#nbcomments" );
            exit();
        }
    }

    public function ModifComment()
    {
        $ModifManager = new CommentManager();
        $modifLines = $ModifManager->ModifComment();
        if ($modifLines === false) {
            throw new \Exception('Impossible de modifier le commentaire !');
        }
        else {
            header('Location: index.php?action=Comment&numComm=' . $_POST['numComm']);
            exit();
        }
    }

    public function inscripMembre()
    {
        require('view/frontend/InscriptionMembreView.php');
    }

    public function profilMembre()
    {
        $membreManager = new MembreManager();
        $nbComms = $membreManager->CountComments($_SESSION['id']);
        require('view/frontend/ProfilMembreView.php');
    }

    public function accueil()
    {
        require('view/frontend/accueil.php');
    }

    public function mentionslegales()
    {
        require('view/frontend/MentionsLegales.php');
    }

    public function charte()
    {
        require('view/frontend/charte.php');
    }

    public function connectAdmin()
    {
        require('view/frontend/AuthAdminView.php');
    }

    public function administration()
    {
        require('view/frontend/AdministrationView.php');
    }


}