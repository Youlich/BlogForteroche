<?php
namespace model;
use entity\Chapter;
use entity\Comment;

require_once("DbConnect.php");

/**
 * Class CommentManager
 * @package model
 * Class qui permet la gestion des commentaires : la modification, la lecture et l'écriture dans la table comments
 */
class CommentManager extends DbConnect
{

    private $chapterManager;
    private $booksManager;

    public function __construct($chapterManager, $booksManager) {
        $this->chapterManager = $chapterManager;
        $this->booksManager = $booksManager;
    }

    public function getCommentsChapter ($chapterId) // affiche tous les commentaires d'un chapitre
    {
        $comments = array();
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM comments WHERE chapterId = ? ORDER BY commentDate DESC');
        $req->execute(array($chapterId));
        while ($data = $req->fetch()) {
            $comment = new Comment();
            $comment->hydrate($data);

            $comments[] = $comment;

        }
        return $comments;
    }

    public function getComments() // affiche tous les commentaires
    {
        $comments = array();
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM comments ORDER BY statut DESC');
        $req->execute(array());
        while ($data = $req->fetch()) {
            $comment = new Comment();
            $comment->hydrate($data);
            $comments[] = $comment;

            $chapterManager = $this->chapterManager;
            $chapter = $chapterManager->getChapter($comment->getChapterId());

            $bookManager = $this->booksManager;
            $book = $bookManager->getBook($chapter->getBookId());

            $comment->setChapter($chapter);
            $comment->setBook($book);
        }
        return $comments;
    }

    public function getCommentsMembre($membreId) // affiche tous les commentaires d'un membre
    {
        $commentsMembre = array();
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM comments WHERE membreId = ? ORDER BY statut DESC');
        $req->execute(array($membreId));
        while ($data = $req->fetch()) {
            $comment = new Comment();
            $comment->hydrate($data);
            $commentsMembre[] = $comment;
            $chapterManager = $this->chapterManager;
            $chapter = $chapterManager->getChapter($comment->getChapterId());
            $bookManager = $this->booksManager;
            $book = $bookManager->getBook($chapter->getBookId());
            $comment->setChapter($chapter);
            $comment->setBook($book);

        }
        return $commentsMembre;
    }


    public function getComment ($numcomm) // affiche un commentaire pour pouvoir le modifier si besoin
    {
        $pdo = $this->dbConnect();
        $PDOStatement = $pdo->prepare('SELECT * FROM comments WHERE id = ? ORDER BY commentDate DESC');
        $PDOStatement->execute(array($numcomm));
        while ($data = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->hydrate($data);
        }
        return $comment;

    }

    public function AddComment ($chapterId, $membrePseudo, $statut, $comment, $membreId) // fonction qui permet de saisir un nouveau commentaire et l'enregistrer dans la BDD
    {
        $addcomment = array();
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(chapterId, membrePseudo, statut, comment, commentDate, membreId) VALUES (?, ?, ?, ?, NOW(), ?)');
        $Addcomment = $req->execute(array($chapterId, $membrePseudo, $statut = 'En attente',  htmlspecialchars($comment), $membreId));
        while ($data = $req->fetch()) {
            $commentadd = new Comment();
            $commentadd->hydrate($data);
            $addcomment[] = $commentadd;
        }
        if ($Addcomment == "success") {
            $db = $this->dbConnect();
            $newreq = $db->prepare('UPDATE membres SET nbcomms=nbcomms+1 WHERE id=:idmembre');
            $newreq->bindValue(':idmembre',$membreId,\PDO::PARAM_INT);
            $newreq->execute();
            $_SESSION['success'] = "Votre commentaire a bien été ajouté";
            header('Location: index.php?action=chapter&id=' . $chapterId . "#nbcomments");
            exit();
        } else {
            $_SESSION['error'] = "votre commentaire n'a pas pu être ajouté";
            header('Location: index.php?action=chapter&id=' . $chapterId . "#nbcomments");
            exit();
        }
    }

    public function ModifComment () // modifie le commentaire dans la BDD
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET membrePseudo=:membrePseudo, membreId=:membreId, comment=:comment, statut=:statut WHERE id=:num LIMIT 1');
        $comments->bindValue(':num', $_POST['numComm'], \PDO::PARAM_INT);
        $comments->bindValue(':membreId', $_SESSION['id'], \PDO::PARAM_STR);
        $comments->bindValue(':membrePseudo', $_SESSION['pseudo'], \PDO::PARAM_STR);
        $comments->bindValue(':comment', htmlspecialchars($_POST['comment']), \PDO::PARAM_STR);
        $comments->bindValue(':statut', 'En attente', \PDO::PARAM_STR);
        $modifLines = $comments->execute();
        while ($data = $comments->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->hydrate($data);
        }
        if ($modifLines) {
            $_SESSION['success'] = "Votre commentaire a bien été modifié";
            header('Location: index.php?action=profilMembre&amp;afficher_commentaires'. "#endpage");
            exit();
        }else {
            $_SESSION['error'] = "votre commentaire n'a pas pu être modifié";
            header('Location: index.php?action=profilMembre&amp;afficher_commentaires'. "#endpage");
            exit();
        }
    }

    public function ApprovedComment($id) // modifie l'état du commentaire après approbation de celui-ci
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET statut=:statut WHERE id=:num LIMIT 1');
        $comments->bindValue(':num', $_GET['id'], \PDO::PARAM_INT);
        $comments->bindValue(':statut', 'Valide', \PDO::PARAM_STR);
        $modifEtat = $comments->execute();
        while ($data = $comments->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->hydrate($data);
        }
        return $modifEtat;
    }

    public function RefusedComment($id)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET statut=:statut WHERE id=:num LIMIT 1');
        $comments->bindValue(':num', $_GET['id'], \PDO::PARAM_INT);
        $comments->bindValue(':statut', 'Refus', \PDO::PARAM_STR);
        $modifEtat = $comments->execute();
        while ($data = $comments->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->hydrate($data);
        }
        return $modifEtat;
    }

    public function DeleteComment($membreId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("DELETE FROM comments WHERE id = :id");
        $supp = $req->execute(array(':id' => $_GET['id']));
        if ($supp == "success") {
            $db = $this->dbConnect();
            $newreq = $db->prepare('UPDATE membres SET nbcomms=nbcomms-1 WHERE id=:idmembre');
            $newreq->bindValue(':idmembre',$membreId,\PDO::PARAM_INT);
            $newreq->execute();
            $_SESSION['success'] = "Votre commentaire a bien été supprimé";
            header('Location: index.php?action=profilMembre&amp;afficher_commentaires');
        }else {
            header('Location: index.php?action=profilMembre&amp;afficher_commentaires');
            $_SESSION['error'] = "Votre commentaire n'a pas pu être supprimé";

        }
    }

    public function SignaledComment($chapterid)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET statut=:statut WHERE chapterId=:num LIMIT 1');
        $comments->bindValue(':num', $chapterid, \PDO::PARAM_INT);
        $comments->bindValue(':statut', 'Alerte', \PDO::PARAM_STR);
        $modifEtat = $comments->execute();
        while ($data = $comments->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->hydrate($data);
        }
        if ($modifEtat) {
            $_SESSION['success'] = "Ce commentaire a bien été signalé à Jean Forteroche";
        }else {
            $_SESSION['error'] = "Impossible de signaler ce commentaire";
        }
    }
    
    public function CountCommentsChapter($chapterId)
    {
        $pdo = $this->dbConnect();
        $PDOStatement = $pdo->prepare('SELECT COUNT(*) as total FROM comments WHERE chapterId = ?');
        $PDOStatement->execute(array($chapterId));
        $data = $PDOStatement->fetch();
        return $count = $data['total'];

    }



}