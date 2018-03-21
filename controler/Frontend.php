<?php
namespace controler;
use model\BooksManager;
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
        $nbCommsApproved = $commentManager->CountCommentsChapterApproved($_GET['id']);// affiche le nb de commentaires par chapitre
        require('view/frontend/ChapterView.php'); //page qui gère l'affichage associé
    }

    public function comment() // pour "modifier" un commentaire
    {
        $commentManager = new CommentManager();
        $comment = $commentManager->getComment($_GET['numComm']); // c'est l'id numComm qui est envoyé
        require('view/frontend/CommentView.php');
    }
    public function membres()
    {
        $membre = new MembreManager();
        $profil = $membre->getMembres();
        require ('view/frontend/ProfilMembreView.php');
    }

    public function listChapters() // affiche l'ensemble des chapitres
    {
        $chapterManager = new ChapterManager();
        $chapters = $chapterManager->getChapters(); // fonction qui affiche tous les chapitres
        require('view/frontend/listChaptersView.php');
    }

    public function listBooks()
    {
        $bookManager = new BooksManager();
        $books = $bookManager->getBooks();
        require('view/frontend/Publications.php');
    }

    public function listComments()
    {
        $commentManager = new CommentManager();
        $comments = $commentManager->getComments();
        //$bookManager = new BooksManager();
        //$book = $bookManager->getBook();
        //$chapterManager = new ChapterManager();
        //$chapter = $chapterManager->getChapter();
        require('view/frontend/listCommentsView.php');
    }

    public function listCommentsMembre()
    {
        $commentManager = new CommentManager();
        $commentsMembre = $commentManager->getCommentsMembre($_SESSION['id']);
        $nbComms = $commentManager->CountCommentsChapter($_GET['id']);// affiche le nb de commentaires par chapitre
        require('view/frontend/ProfilMembreView.php');
    }

    public function listMembres()
    {
        $membreManager = new MembreManager();
        $membres = $membreManager->getMembres();
        require ('view/frontend/listMembresView.php');
    }

    public function addBook($title)
    {
        $BookManager = new BooksManager();
        $addbook = $BookManager->AddBook($title);
        if ($addbook === false) {
            throw new \Exception('Impossible d\'ajouter le livre !');
        }
        else {
            header('Location: index.php?action=publier' . "#endpage" );
            exit();
        }
    }

    public function addChapter($title, $content, $image) {
        $ChapterManager = new ChapterManager();
        $addchapter = $ChapterManager->AddChapter($title, $content, $image);
        if ($addchapter === false) {
            throw new \Exception('Impossible d\'ajouter le chapitre !');
        }
        else {
            header('Location: index.php?action=publier' . "#endpage" );
            exit();
        }
    }


    public function addComment($chapterId, $pseudo, $etat, $comment, $membreId) //ajout d'un commentaire dans un chapitre
    {
        $CommentManager = new \model\CommentManager();
        $addcomment = $CommentManager->AddComment($chapterId, $pseudo, $etat, $comment, $membreId);
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
            header('Location: index.php?action=profilMembre&amp;afficher_commentaires=1');
            exit();
        }
    }

    public function deleteComment()
    {
        $deleteManager = new CommentManager();
        $deleteComment = $deleteManager->DeleteComment();
        $nbComms = $deleteManager->CountCommentsChapter($_GET['id']);
        if ($deleteComment === false) {
            throw new \Exception('Impossible de supprimer le commentaire !');
        }
        else {
            header('Location: index.php?action=profilMembre&amp;afficher_commentaires=1');
            exit();
        }
    }

    public function SignaledComment()
    {
        $signaleManager = new CommentManager();
        $signaledComment = $signaleManager->SignaledComment();
        $signaleComment = new CommentManager();
        $nbComms = $signaleComment->CountCommentsChapter($_GET['id']);
        if ($signaleComment === false) {
            throw new \Exception('Impossible de signaler votre commentaire à Jean Forteroche, merci de retenter plus tard!');
        }
        else {
            header('Location: index.php?action=profilMembre&amp;afficher_commentaires=1');
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
        $nbComms = $membreManager->CountCommentsMembre($_SESSION['id']);
        $commentManager = new CommentManager();
        $commentsMembre = $commentManager->getCommentsMembre($_SESSION['id']);
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

    public function Publier()
    {
        require('view/frontend/Publications.php');
    }

}