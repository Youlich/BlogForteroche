<?php
namespace model;
use entity\Chapter;

/**
 * Class ChapterManager
 * @package model
 * Class qui permet la gestion des chapitres : la modification, la lecture et l'écriture dans la table chapters
 */
class ChapterManager extends Manager
{
    /**
     * @var : variable utilisée pour l'injection de dépendance entre cette classe ChapterManager et ImageManager
     */
    private $imagesManager;

    /**
     * @param $imagesManager: injection de dépendance avec cette classe ImageManager
     */

    public function setImagesManager($imagesManager)
    {
        $this->imagesManager = $imagesManager;
    }


    /**
     * @return array : tableau qui affiche tous les chapitres
     */
    public function listChapters()
    {
        $imageManager = $this->imagesManager;
        $chapters = array();
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, resum, bookId, content, imageId, nbcomms, DATE_FORMAT(chapterDate, \'%d/%m/%Y / %HH%imin\') AS chapterDatefr FROM chapters ORDER BY id ASC LIMIT 0, 10');
        while ($data = $req->fetch()) {
            $chapter = new Chapter();
            $chapter->hydrate($data);
            $image = $imageManager->getImageById($chapter->getImageId());
            $chapter->setImage($image);
            $chapters[] = $chapter;
        }
        return $chapters;
    }

    /**
     * @param $chapterId
     * @return Chapter : donne le chapitre selon l'id entré en paramètre
     */
    public function getChapter ($chapterId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, resum, bookId, content, imageId,  DATE_FORMAT(chapterDate, \'%d/%m/%Y / %HH%imin\') AS chapterDatefr FROM chapters WHERE id = ?');
        $req->execute(array($chapterId));
        while ($data = $req->fetch()) {
            $chapterselect = new Chapter();
            $chapterselect->hydrate($data);
        }
        return $chapterselect;
    }

    /**
     * @param $content
     * @return bool|string : retourne le résumé du chapitre
     */
    public function resumContent($content)
    {
        $nbr_caracteres_max = 200;
        $nbr_caracteres = strlen($content);
        if($nbr_caracteres >= $nbr_caracteres_max)
        {
            return substr($content, 0, $nbr_caracteres_max);
        }
        else
        {
            return $content;
        }
    }

    /**
     * @return Chapter : donne le dernier chapitre saisi par l'éditeur
     */
    public function getLastChapter()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, resum, bookId, content, imageId,  DATE_FORMAT(chapterDate, \'%d/%m/%Y / %HH%imin\') AS chapterDatefr FROM chapters ORDER BY chapterDate DESC LIMIT 1');
        $req->execute(array());
        while ($data = $req->fetch()) {
            $lastchapter = new Chapter();
            $lastchapter->hydrate($data);
        }
        return $lastchapter;
    }

    /**
     * @param $bookId
     * @param $title
     * @param $content
     * @param $resum
     * @param $imageId
     * @return bool|string : ajoute un chapitre dans la table chapitre. Si c'est un succès on obtient son id créé, sinon on retourne false
     */
    public function addChapter($bookId, $title, $content, $resum, $imageId)
    {
        $ChapterAdd = array();
        $db = $this->dbConnect();
        $req = $db->prepare("INSERT INTO chapters (bookId, chapterDate, title, content, resum, imageId) VALUES (?,NOW(),?,?,?,?)");
        $Addchapter = $req->execute(array($bookId, $title, $content,$resum, $imageId));
        while ($data = $req->fetch()) {
            $chapteradd = new Chapter();
            $chapteradd->hydrate($data);
            $ChapterAdd[] = $chapteradd;
        }
        if ($Addchapter) {
            return $db->lastInsertId();
        }else {
            return false;
        }
    }

    /**
     * @param $chapter_id
     * @return bool : suppression d'un chapitre. Si c'est un succès on retourne true sinon false
     */

    public function deleteChapter($chapter_id)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("DELETE FROM chapters WHERE id = :id");
        $deletechapter= $req->execute(array(':id' => $chapter_id));
        if ($deletechapter) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $id
     * @param $title
     * @param $content
     * @param $resum
     * @param $imageId
     * @return bool : modification du chapitre.Si c'est un succès on retourne true sinon false
     */
    public function modifChapter($id, $title, $content, $resum, $imageId)
    {
        $db = $this->dbConnect();
        $chapters = $db->prepare('UPDATE chapters SET chapterDate=NOW(), title=:titrechapter, content=:content, resum=:resum, imageId=:imageId WHERE id=:id LIMIT 1');
        $chapters->bindValue(':titrechapter', $title, \PDO::PARAM_STR);
        $chapters->bindValue(':content', $content, \PDO::PARAM_STR);
        $chapters->bindValue(':resum', $resum, \PDO::PARAM_STR);
        $chapters->bindValue(':id', $id, \PDO::PARAM_INT);
        $chapters->bindValue(':imageId', $imageId, \PDO::PARAM_INT);
        $modifLines = $chapters->execute();
        while ($data = $chapters->fetch(\PDO::FETCH_ASSOC)) {
            $chapter = new Chapter();
            $chapter->hydrate($data);
        }
        if ($modifLines) {
            return true;
        }else {
            return false;
        }
    }

    /**
     * @param $id
     * @param $title
     * @param $content
     * @param $resum
     * @return bool : modification du chapitre dans le cas où il n'y a pas d'image. Si c'est un succès on retourne true sinon false
     */

    public function modifChaptersansUpload($id, $title, $content,$resum)
    {
        $db = $this->dbConnect();
        $chapters = $db->prepare('UPDATE chapters SET chapterDate=NOW(), title=:titrechapter, content=:content, resum=:resum WHERE id=:id LIMIT 1');
        $chapters->bindValue(':titrechapter', $title, \PDO::PARAM_STR);
        $chapters->bindValue(':content', $content, \PDO::PARAM_STR);
        $chapters->bindValue(':resum', $resum, \PDO::PARAM_STR);
        $chapters->bindValue(':id', $id, \PDO::PARAM_INT);

        $modifLines = $chapters->execute();
        while ($data = $chapters->fetch(\PDO::FETCH_ASSOC)) {
            $chapter = new Chapter();
            $chapter->hydrate($data);
        }
        if ($modifLines) {
            return true;
        }else {
            return false;
        }
    }
}