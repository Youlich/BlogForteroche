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
        $req = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y / %HH%imin\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $req->execute(array($postId));
        while ($data = $req->fetch()) {
            $comment = new Comment();
            $comment->setAuthor($data['author']);
            $comment->setId($data['id']);
            $comment->setCommentDate($data['comment_date_fr']);
            $comment->setComment($data['comment']);

            $comments[] = $comment;

        }
        return $comments;
    }

    public function getComment ($numcomm) // affiche un commentaire pour pouvoir le modifier si besoin
    {
        $pdo = $this->dbConnect();
        $PDOStatement = $pdo->prepare('SELECT id, post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y / %HH%imin\') AS comment_date_fr FROM comments WHERE id = ? ORDER BY comment_date DESC');
        $PDOStatement->execute(array($numcomm));
        while ($data = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->setAuthor($data['author']);
            $comment->setId($data['id']);
            $comment->setCommentDate($data['comment_date_fr']);
            $comment->setComment($data['comment']);
            $comment->setPostId($data['post_id']);
        }
        return $comment;
    }

    public function PostComment ($postId, $author, $comment) // fonction qui permet de saisir un nouveau commentaire et l'enregistrer dans la BDD
    {
        $addcomment = array();
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(post_id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y / %HH%imin\') AS comment_date_fr) VALUES(?, ?, ?, NOW())');
        $req->execute(array($postId, $author, $comment));
        while ($data = $req->fetch()) {
            $comment = new Comment();
            $comment->setAuthor($data['author']);
            $comment->setId($data['id']);
            $comment->setCommentDate($data['comment_date_fr']);
            $comment->setComment($data['comment']);
            $addcomment[] = $comment;
        }
          return $addcomment;
    }


    public function ModifComment () // modifie le commentaire dans la BDD
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET author=:author, comment=:comment WHERE id=:num LIMIT 1');
        $comments->bindValue(':num', $_POST['numComm'], \PDO::PARAM_INT);
        $comments->bindValue(':author', $_POST['author'], \PDO::PARAM_STR);
        $comments->bindValue(':comment', $_POST['comment'], \PDO::PARAM_STR);
        $modifLines = $comments->execute();
        while ($data = $comments->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->setAuthor($data['author']);
            $comment->setId($data['id']);
            $comment->setCommentDate($data['comment_date_fr']);
            $comment->setComment($data['comment']);
            $comment->setPostId($data['post_id']);

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