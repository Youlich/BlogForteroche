<?php
namespace model;
use entity\Comment;

require_once("DbConnect.php");

/**
 * Class CommentManager
 * @package model
 * Class qui permet la gestion des commentaires : la modification, la lecture et l'écriture dans la table comments
 */
class CommentManager extends DbConnect
{
    public function getComments ($postId) // affiche tous les commentaires d'un post
    {
        $comments = array();
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, membre_pseudo, membre_id, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y / %HH%imin\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $req->execute(array($postId));
        while ($data = $req->fetch()) {
            $comment = new Comment();
            $comment->setId($data['id']);
            $comment->setCommentDate($data['comment_date_fr']);
            $comment->setComment($data['comment']);
            $comment->setMembreId($data['membre_id']);
            $comment->setMembrePseudo($data['membre_pseudo']);

            $comments[] = $comment;

        }
        return $comments;
    }

    public function getComment ($numcomm) // affiche un commentaire pour pouvoir le modifier si besoin
    {
        $pdo = $this->dbConnect();
        $PDOStatement = $pdo->prepare('SELECT id, post_id, membre_pseudo, membre_id, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y / %HH%imin\') AS comment_date_fr FROM comments WHERE id = ? ORDER BY comment_date DESC');
        $PDOStatement->execute(array($numcomm));
        while ($data = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->setId($data['id']);
            $comment->setCommentDate($data['comment_date_fr']);
            $comment->setComment($data['comment']);
            $comment->setPostId($data['post_id']);
            $comment->setMembreId($data['membre_id']);
            $comment->setMembrePseudo(($data['membre_pseudo']));
        }
        return $comment;
    }

    public function PostComment ($postId, $membre_pseudo, $comment, $membre_id) // fonction qui permet de saisir un nouveau commentaire et l'enregistrer dans la BDD
    {
        $addcomment = array();
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(post_id, membre_pseudo, comment, comment_date, membre_id) VALUES (?, ?, ?, NOW(), ?)');
        $req->execute(array($postId, $membre_pseudo, $comment, $membre_id));
        while ($data = $req->fetch()) {
            $commentadd = new Comment();
            $commentadd->setPostId($data['post_id']);
            $commentadd->setComment($data['comment']);
            $commentadd->setMembreId($data['membre_id']);
            $commentadd->setMembrePseudo($data['membre_pseudo']);

            $addcomment[] = $commentadd;
        }
          return $addcomment;
    }

    public function ModifComment () // modifie le commentaire dans la BDD
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET membre_pseudo=:membre_pseudo, membre_id=:membre_id, comment=:comment WHERE id=:num LIMIT 1');
        $comments->bindValue(':num', $_POST['numComm'], \PDO::PARAM_INT);
        $comments->bindValue(':membre_id', $_SESSION['id'], \PDO::PARAM_STR);
        $comments->bindValue(':membre_pseudo', $_SESSION['pseudo'], \PDO::PARAM_STR);
        $comments->bindValue(':comment', $_POST['comment'], \PDO::PARAM_STR);
        $modifLines = $comments->execute();
        while ($data = $comments->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->setId($data['id']);
            $comment->setCommentDate($data['comment_date_fr']);
            $comment->setComment($data['comment']);
            $comment->setPostId($data['post_id']);
            $comment->setMembreId($data['membre_id']);
            $comment->setMembreId($data['membre_pseudo']);

        }
        return $modifLines;
    }
    
    public function CountComments($post_id)
    {
        $pdo = $this->dbConnect();
        $PDOStatement = $pdo->prepare('SELECT COUNT(*) as total FROM comments WHERE post_id = ?');
        $PDOStatement->execute(array($post_id));
        $data = $PDOStatement->fetch();
        return $data['total'];
    }

}