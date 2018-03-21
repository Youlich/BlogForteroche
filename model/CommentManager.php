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
        $req = $db->prepare('SELECT * FROM comments ORDER BY etat DESC');
        $req->execute(array());
        while ($data = $req->fetch()) {
            $comment = new Comment();
            $comment->hydrate($data);
            $comments[] = $comment;
        }
        return $comments;
    }

    public function getCommentsMembre($membreId) // affiche tous les commentaires d'un membre
    {
        $commentsMembre = array();
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM comments WHERE membreId = ? ORDER BY etat DESC');
        $req->execute(array($membreId));
        while ($data = $req->fetch()) {
            $comment = new Comment();
            $comment->hydrate($data);
            $commentsMembre[] = $comment;
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

    public function AddComment ($chapterId, $membrePseudo, $etat, $comment, $membreId) // fonction qui permet de saisir un nouveau commentaire et l'enregistrer dans la BDD
    {
        $addcomment = array();
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(chapterId, membrePseudo, etat, comment, commentDate, membreId) VALUES (?, ?, ?, ?, NOW(), ?)');
        $Addcomment = $req->execute(array($chapterId, $membrePseudo, $etat = 'En attente',  $comment, $membreId));
        while ($data = $req->fetch()) {
            $commentadd = new Comment();
            $commentadd->hydrate($data);
            $addcomment[] = $commentadd;
        }
          if ($Addcomment == "success") {
            $_SESSION['success'] = "Votre commentaire a été bien reçu et apparaitra dans les plus brefs délais";
            return $_SESSION['success'];
          } else {
            $_SESSION['error'] = "votre commentaire n'a pas pu être ajouté, retentez plus tard";
            return $_SESSION['error'];
          }
    }

    public function ModifComment () // modifie le commentaire dans la BDD
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET membrePseudo=:membrePseudo, membreId=:membreId, comment=:comment, etat=:etat WHERE id=:num LIMIT 1');
        $comments->bindValue(':num', $_POST['numComm'], \PDO::PARAM_INT);
        $comments->bindValue(':membreId', $_SESSION['id'], \PDO::PARAM_STR);
        $comments->bindValue(':membrePseudo', $_SESSION['pseudo'], \PDO::PARAM_STR);
        $comments->bindValue(':comment', $_POST['comment'], \PDO::PARAM_STR);
        $comments->bindValue(':etat', 'En attente', \PDO::PARAM_STR);
        $modifLines = $comments->execute();
        while ($data = $comments->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->hydrate($data);
        }
        if ($modifLines == "success") {
            header('location: Location: index.php?action=profilMembre&amp;afficher_commentaires=1');
            $_SESSION['success'] = "Votre commentaire a bien été modifié";
            return $_SESSION['success'];
        }else {
            header('location: Location: index.php?action=profilMembre&amp;afficher_commentaires=1');
            $_SESSION['error'] = "Votre commentaire n'a pas pu être modifié";
            return $_SESSION['error'];
        }
    }

    public function ApprovedComment($id) // modifie l'état du commentaire après approbation de celui-ci
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET etat=:etat WHERE id=:num LIMIT 1');
        $comments->bindValue(':num', $_GET['id'], \PDO::PARAM_INT);
        $comments->bindValue(':etat', 'Validé', \PDO::PARAM_STR);
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
        $comments = $db->prepare('UPDATE comments SET etat=:etat WHERE id=:num LIMIT 1');
        $comments->bindValue(':num', $_GET['id'], \PDO::PARAM_INT);
        $comments->bindValue(':etat', 'Refusé', \PDO::PARAM_STR);
        $modifEtat = $comments->execute();
        while ($data = $comments->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->hydrate($data);
        }
        return $modifEtat;
    }

    public function DeleteComment()
    {
        $db = $this->dbConnect();
        $req = $db->prepare("DELETE FROM comments WHERE id = :id");
        $supp = $req->execute(array(':id' => $_GET['id']));
        if ($supp == "success") {
            header('location: Location: index.php?action=profilMembre&amp;afficher_commentaires=1');
            $_SESSION['success'] = "Votre commentaire a bien été supprimé";
            return $_SESSION['success'];
        }else {
            header('location: Location: index.php?action=profilMembre&amp;afficher_commentaires=1');
            $_SESSION['error'] = "Votre commentaire n'a pas pu être supprimé";
            return $_SESSION['error'];
        }
    }

    public function SignaledComment()
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET etat=:etat WHERE id=:num LIMIT 1');
        $comments->bindValue(':num', $_GET['id'], \PDO::PARAM_INT);
        $comments->bindValue(':etat', 'Signalé', \PDO::PARAM_STR);
        $modifEtat = $comments->execute();
        while ($data = $comments->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->hydrate($data);
        }
        if ($modifEtat == "success") {
            header('location: Location: index.php?action=profilMembre&amp;afficher_commentaires=1');
            $_SESSION['success'] = "Votre commentaire a bien été signalé à Jean Forteroche";
            return $_SESSION['success'];
        }else {
            header('location: Location: index.php?action=profilMembre&amp;afficher_commentaires=1');
            $_SESSION['error'] = "Votre commentaire n'a pas pu être signalé, veuillez retenter plus tard";
            return $_SESSION['error'];
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

    public function CountCommentsChapterApproved($chapterId)
    {
        $pdo = $this->dbConnect();
        $PDOStatement = $pdo->prepare('SELECT COUNT(*) as total FROM comments WHERE chapterId = ? AND etat = "Validé"');
        $PDOStatement->execute(array($chapterId));
        $data = $PDOStatement->fetch();
        return $data['total'];
    }


}