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
    /**
     * @var : variable utilisée pour l'injection de dépendance entre cette classe  CommentManager et entre ChapterManager et BooksManager
     */
    private $chapterManager;
    private $booksManager;

    /**
     * CommentManager constructor : avec injection de dépendance
     * @param $chapterManager
     * @param $booksManager
     */

    public function __construct($chapterManager, $booksManager) {
        $this->chapterManager = $chapterManager;
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

    public function getComments()
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

    /**
     * @param $membreId
     * @return array : permet d'obtenir tous les commentaires d'un membre selon le chapitre et le livre sélectionné
     */
    public function getCommentsMembre($membreId)
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

    /**
     * fonction qui permet la modification du commentaire dans la table commentaire
     */

    public function ModifComment ()
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

    /**
     * @param $id
     * @return bool
     * fonction qui modifie l'état du commentaire après approbation de celui-ci par l'administrateur en statut "valide"
     */
    public function ApprovedComment($id)
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

    /**
     * @param $id
     * @return bool
     * fonction qui modifie l'état du commentaire après refus de celui-ci par l'administrateur en statut "Refus"
     */

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

    /**
     * @param $membreId
     * fonction qui supprime le commentaire du membre par le membre
     */
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

    /**
     * @param $chapterid
     * fonction qui modifie l'état du commentaire après signalement d'un membre, en statut "Alerte"
     */
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

    /**
     * @param $chapterId
     * @return mixed : le nombre de commentaires par chapitre
     */
    
    public function CountCommentsChapter($chapterId)
    {
        $pdo = $this->dbConnect();
        $PDOStatement = $pdo->prepare('SELECT COUNT(*) as total FROM comments WHERE chapterId = ?');
        $PDOStatement->execute(array($chapterId));
        $data = $PDOStatement->fetch();
        return $count = $data['total'];

    }

}