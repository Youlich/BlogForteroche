<?php
namespace model;
use entity\Chapter;
use entity\Comment;
use entity\Membres;


/**
 * Class CommentManager
 * @package model
 * Class qui permet la gestion des commentaires : la modification, la lecture et l'écriture dans la table comments
 */
class CommentManager extends Manager
{
    /**
     * @var : variable utilisée pour l'injection de dépendance entre cette classe  CommentManager et entre ChapterManager et BooksManager
     */
    private $chapterManager;
    private $booksManager;

    /**
     * CommentManager setter : avec injection de dépendance
     * @param $chapterManager
     */
    public function setChapterManager($chapterManager)
    {
        $this->chapterManager = $chapterManager;
    }
    /**
     * CommentManager setter : avec injection de dépendance
     * @param $booksManager
     */
    public function setBooksManager($booksManager)
    {
        $this->booksManager = $booksManager;
    }

    /**
     * @param $chapterId
     * @return array : permet d'obtenir tous les commentaires d'un chapitre spécifié en paramètre
     */
    public function getCommentsChapter($chapterId)
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

    /**
     * @return array : permet d'obtenir tous les commentaires de la table commentaires selon le chapitre et le livre sélectionné
     */

    public function listComments()
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

            $booksManager = $this->booksManager;
            $book = $booksManager->getBook($chapter->getBookId());

            $comment->setChapter($chapter);
            $comment->setBook($book);

        }
        return $comments;
    }

    /**
     * @param $membreId
     * @return array : permet d'obtenir tous les commentaires d'un membre selon le chapitre et le livre sélectionné
     */
    public function listCommentsMembre(Membres $membre)
    {
        $comments = array();
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM comments WHERE membreId = ? ORDER BY statut DESC');
        $req->execute(array($membre->getId()));
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


    /**
     * @param $numcomm
     * @return Comment: retourne le commentaire pour pouvoir le modifier
     */
    public function getComment ($numcomm)
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

    /**
     * @param $chapterId
     * @param $membrePseudo
     * @param $statut
     * @param $comment
     * @param $membreId
     * ajout d'un commentaire dans la table commentaire avec le statut "en attante" puis si c'est un succès, on rajoute +1 dans nbcomms de la table membre
     */
    public function addComment (Comment $comment) // fonction qui permet de saisir un nouveau commentaire et l'enregistrer dans la BDD
    {
        $addcomment = array();
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO comments(chapterId, membrePseudo, statut, comment, commentDate, membreId) VALUES (?, ?, ?, ?, NOW(), ?)');
        $Addcomment = $req->execute(array($comment->getChapterId(), $comment->getMembrePseudo(), $comment->getStatut(), htmlspecialchars($comment->getComment()), $comment->getMembreId()));
        while ($data = $req->fetch()) {
            $commentadd = new Comment();
            $commentadd->hydrate($data);
            $addcomment[] = $commentadd;
        }
        if ($Addcomment == "success") {
            $db = $this->dbConnect();
            $newreq = $db->prepare('UPDATE membres SET nbcomms=nbcomms+1 WHERE id=:idmembre');
            $newreq->bindValue(':idmembre',$comment->getMembreId(),\PDO::PARAM_INT);
            $newreq->execute();
            $_SESSION['success'] = "Votre commentaire a bien été ajouté";
            $this->redirect('Location: index.php?action=chapter&id=' . $comment->getChapterId() . "#nbcomments");
            exit();
        } else {
            $_SESSION['error'] = "votre commentaire n'a pas pu être ajouté";
	        $this->redirect('Location: index.php?action=chapter&id=' . $comment->getChapterId() . "#nbcomments");
            exit();
        }
    }

    /**
     * @param : Comment $comment
     * fonction qui permet la modification du commentaire dans la table commentaire
     */

    public function modifComment (Comment $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET membrePseudo=:membrePseudo, membreId=:membreId, comment=:comment, statut=:statut WHERE id=:num LIMIT 1');
        $comments->bindValue(':num', $comment->getId(), \PDO::PARAM_INT);
        $comments->bindValue(':membreId', $comment->getMembreId(), \PDO::PARAM_STR);
        $comments->bindValue(':membrePseudo', $comment->getMembrePseudo(), \PDO::PARAM_STR);
        $comments->bindValue(':comment', htmlspecialchars($comment->getComment()), \PDO::PARAM_STR);
        $comments->bindValue(':statut', $comment->getStatut(), \PDO::PARAM_STR);
        $modifLines = $comments->execute();
        while ($data = $comments->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->hydrate($data);
        }
        if ($modifLines) {
            $_SESSION['success'] = "Votre commentaire a bien été modifié";
            $this->redirect('Location: index.php?action=boutonafficherlescommentaires' . "#endpage");
            exit();
        }else {
            $_SESSION['error'] = "votre commentaire n'a pas pu être modifié";
	        $this->redirect('Location: index.php?action=boutonafficherlescommentaires' . "#endpage");
            exit();
        }
    }

    /**
     * @param Comment $comment
     * @return bool
     * fonction qui modifie l'état du commentaire après approbation de celui-ci par l'administrateur en statut "valide"
     */
    public function approvedComment(Comment $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET statut=:statut WHERE id=:num LIMIT 1');
        $comments->bindValue(':num', $comment->getId(), \PDO::PARAM_INT);
        $comments->bindValue(':statut', $comment->getStatut(), \PDO::PARAM_STR);
        $modifEtat = $comments->execute();
        while ($data = $comments->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->hydrate($data);
        }
        return $modifEtat;
    }

    /**
     * @param Comment $comment
     * @return bool
     * fonction qui modifie l'état du commentaire après refus de celui-ci par l'administrateur en statut "Refus"
     */

    public function refusedComment(Comment $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE comments SET statut=:statut WHERE id=:num LIMIT 1');
        $comments->bindValue(':num', $comment->getId(), \PDO::PARAM_INT);
        $comments->bindValue(':statut', $comment->getStatut(), \PDO::PARAM_STR);
        $modifEtat = $comments->execute();
        while ($data = $comments->fetch(\PDO::FETCH_ASSOC)) {
            $comment = new Comment();
            $comment->hydrate($data);
        }
        return $modifEtat;
    }

    /**
     * @param Membres $membre
     * fonction qui supprime le commentaire du membre par le membre
     */
    public function deleteComment(Membres $membre)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("DELETE FROM comments WHERE id = :id");
        $supp = $req->execute(array(':id' => $_GET['id']));
        if ($supp == "success") {
            $db = $this->dbConnect();
            $newreq = $db->prepare('UPDATE membres SET nbcomms=nbcomms-1 WHERE id=:idmembre');
            $newreq->bindValue(':idmembre',$membre->getId(),\PDO::PARAM_INT);
            $newreq->execute();
            $_SESSION['success'] = "Votre commentaire a bien été supprimé";
	        $this->redirect('Location: index.php?action=boutonafficherlescommentaires' . "#endpage");
        }else {
	        $this->redirect('Location: index.php?action=boutonafficherlescommentaires' . "#endpage");
            $_SESSION['error'] = "Votre commentaire n'a pas pu être supprimé";

        }
    }

    /**
     * @param $chapterid
     * fonction qui modifie l'état du commentaire après signalement d'un membre, en statut "Alerte"
     */
	public function signaledComment(Comment $comment)
	{
		$db = $this->dbConnect();
		$comments = $db->prepare('UPDATE comments SET statut=:statut WHERE chapterId=:num LIMIT 1');
		$comments->bindValue(':num', $comment->getChapterId(), \PDO::PARAM_INT);
		$comments->bindValue(':statut', $comment->getStatut(), \PDO::PARAM_STR);
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

    /**
     * @param $chapterId
     * @return mixed : le nombre de commentaires par chapitre
     */
    
    public function countCommentsChapter($chapterId)
    {
        $pdo = $this->dbConnect();
        $PDOStatement = $pdo->prepare('SELECT COUNT(*) as total FROM comments WHERE chapterId = ?');
        $PDOStatement->execute(array($chapterId));
        $data = $PDOStatement->fetch();
        return $count = $data['total'];

    }

}