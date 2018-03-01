<?php
namespace controler;
use model\CommentManager;
use model\PostManager;
require_once('Autoload.php'); // Chargement des class
\Autoload::register();
Class Frontend
{
    public function listPosts() // affiche l'ensemble des posts
    {
        $postManager = new PostManager();
        $posts = $postManager->getPosts(); // fonction qui affiche tous les posts
        require('view/frontend/listPostsView.php');
    }
    public function post() // action qui se réalise quand on clique sur le lien "commentaires du post". On obtient le post sélectionné et ses commentaires rattachés
    {
        $postManager = new PostManager(); // lieu où se trouve la fonction getPost
        $commentManager = new CommentManager(); // lieu où se trouve la fonction getComments
        $post = $postManager->getPost($_GET['id']); // affiche le post en question grâce à la fonction getPost se trouvant dans PostManager
        $comments = $commentManager->getComments($_GET['id']); // affiche les commentaires qui lui sont associés
        $nbComms = $commentManager->CountComments($_GET['id']);// affiche le nb de commentaires par post
        require('view/frontend/postView.php'); //page qui gère l'affichage associé
    }
    public function comment() // fonction utiliser lors du clic sur "modifier" le commentaire
    {
        $commentManager = new CommentManager();
        $comment = $commentManager->getComment($_GET['numComm']); // c'est l'id numComm qui est envoyé
        require('view/frontend/commentView.php');
    }
    public function addComment($postId, $author, $comment)
    {
        $CommentManager = new \model\CommentManager();
        $addcomment = $CommentManager->PostComment($postId, $author, $comment);
        if ($addcomment === false) {
            throw new Exception('Impossible d\'ajouter le commentaire !');
        }
        else {
            header('Location: index.php?action=post&id=' . $postId . '&success=ok' );
        }
    }
    public function ModifComment()
    {
        $ModifManager = new CommentManager();
        $modifLines = $ModifManager->ModifComment();
        if ($modifLines === false) {
            throw new Exception('Impossible de modifier le commentaire !');
        }
        else {
            header('Location: index.php?action=Comment&numComm=' . $_POST['numComm'] . '&success=ok');
        }
    }
    public function inscripMembre()
    {
        require('view/frontend/InscriptionMembreView.php');
    }
    public function accesMembre()
    {
        require('view/frontend/AuthMembreView.php');
    }
    public function suppressionMembre()
    {
        require('view/frontend/SuppressionMembre.php');
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
}