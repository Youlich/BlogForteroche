<?php
namespace model;
use entity\Chapter;

require_once("DbConnect.php");

/**
 * Class PostManager
 * @package model
 * Class qui permet la gestion des posts (des billets) : la modification, la lecture et l'écriture dans la table posts
 */
class ChapterManager extends DbConnect
{
    public function getChapters () // Affiche tous les billets (posts)
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
        $req = $db->prepare('SELECT id, title, resum,bookId, content, image,  DATE_FORMAT(chapterDate, \'%d/%m/%Y / %HH%imin\') AS chapterDatefr FROM chapters WHERE id = ?');
        $req->execute(array($chapterId));
        while ($data = $req->fetch()) {
            $chapter = new Chapter();
            $chapter->hydrate($data);
        }
        return $chapter;
    }

}