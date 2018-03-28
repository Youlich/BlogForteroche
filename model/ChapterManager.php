<?php
namespace model;
use entity\Chapter;

require_once("DbConnect.php");

/**
 * Class ChapterManager
 * @package model
 * Class qui permet la gestion des chapitres : la modification, la lecture et l'écriture dans la table chapters
 */
class ChapterManager extends DbConnect
{
    public function getChapters () // Affiche tous les chapitres
    {
        $chapters = array();
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, resum, bookId, content, image, nbcomms, DATE_FORMAT(chapterDate, \'%d/%m/%Y / %HH%imin\') AS chapterDatefr FROM chapters ORDER BY id ASC LIMIT 0, 10');
        while ($data = $req->fetch()) {
            $chapter = new Chapter();
            $chapter->hydrate($data);
            $chapters[] = $chapter;
        }
        return $chapters;
    }

    public function getChapter ($chapterId) // affiche un chapitre selon son Id
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, resum, bookId, content, image,  DATE_FORMAT(chapterDate, \'%d/%m/%Y / %HH%imin\') AS chapterDatefr FROM chapters WHERE id = ?');
        $req->execute(array($chapterId));
        while ($data = $req->fetch()) {
            $chapterselect = new Chapter();
            $chapterselect->hydrate($data);
        }
        return $chapterselect;
    }

    public function AddChapter($title, $content, $file)
    {
        $ChapterAdd = array();
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO chapters (chapterDate, title, content, image) VALUES (NOW(),?,?,?)');
        $Addchapter = $req->execute(array($title, $content, $file));
        while ($data = $req->fetch()) {
            $chapteradd= new Chapter();
            $chapteradd->hydrate($data);
            $ChapterAdd[] = $chapteradd;
        }
        if ($Addchapter == "success") {
            $_SESSION['success'] = "Votre nouveau chapitre a bien été créé";
            return $_SESSION['success'];
        } else {
            $_SESSION['error'] = "Votre nouveau chapitre n'a pas pu être créé, retentez plus tard";
            return $_SESSION['error'];
        }
    }

    public function DeleteChapter()
    {
        $db = $this->dbConnect();
        $req = $db->prepare("DELETE FROM chapters WHERE id = :id");
        $supp = $req->execute(array(':id' => $_POST['ImageId']));
        if ($supp == "success") {
            header('location: Location: index.php?action=publier');
            $_SESSION['success'] = "Votre chapitre a bien été supprimé";
            return $_SESSION['success'];
        }else {
            header('location: Location: index.php?action=publier');
            $_SESSION['error'] = "Votre chapitre n'a pas pu être supprimé";
            return $_SESSION['error'];
        }
    }

    public function ModifChapter()
    {
            $db = $this->dbConnect();
            $chapters = $db->prepare('UPDATE chapters SET chapterDate=NOW(), title=:titrechapter, content=:content, imageId=:imageId WHERE id=:id LIMIT 1');
            $chapters->bindValue(':titrechapter', $_POST['titrechapter'], \PDO::PARAM_STR);
            $chapters->bindValue(':content', $_POST['content'], \PDO::PARAM_STR);
            $chapters->bindValue(':imageId', $_POST['ImageId'], \PDO::PARAM_STR);
            $modifLines = $chapters->execute();
            while ($data = $chapters->fetch(\PDO::FETCH_ASSOC)) {
                $chapter = new Chapter();
                $chapter->hydrate($data);
            }
            if ($modifLines == "success") {
                header('location: Location: index.php?action=publier');
                $_SESSION['success'] = "Votre chapitre a bien été modifié";
                return $_SESSION['success'];
            }else {
                header('location: Location: index.php?action=publier');
                $_SESSION['error'] = "Votre chapitre n'a pas pu être modifié";
                return $_SESSION['error'];
            }

    }
}