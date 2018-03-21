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
        $req = $db->query('SELECT id, title, resum, bookId, content, image, nbcomms, DATE_FORMAT(chapterDate, \'%d/%m/%Y / %HH%imin\') AS chapterDatefr FROM chapters ORDER BY chapterDate DESC LIMIT 0, 5');
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
            $chapter = new Chapter();
            $chapter->hydrate($data);
        }
        return $chapter;
    }

    public function AddChapter($title, $content, $image)
    {
        $ChapterAdd = array();
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO chapters (title, content, image) VALUES (NOW(),?,?,?)');
        $Addchapter = $req->execute(array($title, $content, $image));
        while ($data = $req->fetch()) {
            $chapteradd= new Chapter();
            $chapteradd->hydrate($data);
            $ChapterAdd[] = $chapteradd;
        }
        if ($Addchapter == "success") {
            $_SESSION['success'] = "Votre nouveau titre de livre est bien créé";
            return $_SESSION['success'];
        } else {
            $_SESSION['error'] = "Votre nouveau titre de livre n'a pas pu être créé, retentez plus tard";
            return $_SESSION['error'];
        }
    }
}