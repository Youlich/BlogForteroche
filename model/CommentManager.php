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
    public function getCommentsChapter ($chapterId) // affiche tous les commentaires d'un post
    {
        $comments = array();
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, membrePseudo, membreId, comment, DATE_FORMAT(commentDate, \'%d/%m/%Y / %HH%imin\') AS commentDatefr FROM comments WHERE chapterId = ? ORDER BY commentDate DESC');
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
        $req = $db->prepare('SELECT id, membrePseudo, membreId, comment, DATE_FORMAT(commentDate, \'%d/%m/%Y / %HH%imin\') AS commentDatefr FROM comments ORDER BY commentDate DESC');
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
        $req = $db->prepare('SELECT id, membrePseudo, membreId, comment, DATE_FORMAT(commentDate, \'%d/%m/%Y / %HH%imin\') AS commentDatefr FROM comments WHERE membreId = ? ORDER BY commentDate DESC');
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
        $PDOStatement = $pdo->prepare('SELECT id, chapterId, membrePseudo, membreId, comment, DATE_FORMAT(commentDate, \'%d/%m/%Y / %HH%imin\') AS commentDatefr FROM comments WHERE id = ? ORDER BY commentDate DESC');
        $PDOStatement->execute(array($numcomm));
        while ($data = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->hydrate($data);
        }
        return $comment;
    }

    public function ChapterComment ($chapterId, $membrePseudo, $comment, $membreId) // fonction qui permet de saisir un nouveau commentaire et l'enregistrer dans la BDD
    {
        $addcomment = array();
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(chapterId, membrePseudo, comment, commentDate, membreId) VALUES (?, ?, ?, NOW(), ?)');
        $req->execute(array($chapterId, $membrePseudo, $comment, $membreId));
        while ($data = $req->fetch()) {
            $commentadd = new Comment();
            $commentadd->hydrate($data);

            $addcomment[] = $commentadd;
        }
          return $addcomment;
    }

    public function ModifComment () // modifie le commentaire dans la BDD
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET membrePseudo=:membrePseudo, membreId=:membreId, comment=:comment WHERE id=:num LIMIT 1');
        $comments->bindValue(':num', $_POST['numComm'], \PDO::PARAM_INT);
        $comments->bindValue(':membreId', $_SESSION['id'], \PDO::PARAM_STR);
        $comments->bindValue(':membrePseudo', $_SESSION['pseudo'], \PDO::PARAM_STR);
        $comments->bindValue(':comment', $_POST['comment'], \PDO::PARAM_STR);
        $modifLines = $comments->execute();
        while ($data = $comments->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->hydrate($data);

        }
        return $modifLines;
    }
    
    public function CountComments($chapterId)
    {
        $pdo = $this->dbConnect();
        $PDOStatement = $pdo->prepare('SELECT COUNT(*) as total FROM comments WHERE chapterId = ?');
        $PDOStatement->execute(array($chapterId));
        $data = $PDOStatement->fetch();
        return $data['total'];
    }

}