<?php
namespace model;
use entity\Images;
require_once("DbConnect.php");
/**
 * Class ImagesManager
 * @package model
 * Class qui permet la gestion des images : l'affichage des images et la suppression d'image dans la table Images
 */
class ImagesManager extends DbConnect
{
    public function getImage($chapterId) // affiche l'image associé à un chapitre
    {
        $pdo = $this->dbConnect();
        $PDOStatement = $pdo->prepare('SELECT * FROM images WHERE chapterId = ?');
        $PDOStatement->execute(array($chapterId));
        while ($data = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
            $image = new Images();
            $image->hydrate($data);
        }
        return $image;
    }
    public function addImage()
    {
        $file = $_FILES ['image']['name'];
        $destination = 'public/images/'. $file;
        if (isset($_POST['chapterselect'])){
            $chapterId = $_POST['chapterselect'];
        }
        else{
        $chapterId = '0' ;}
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO images (name,fileUrl,chapterId) VALUES(?,?,?)');
        $upload = $req->execute(array($file, $destination, $chapterId));
        if ($upload) {
            return $db->lastInsertId();
        } else {
            return false;
        }
    }
    private function moveFile()
    {
        $file = $_FILES ['image']['name'];
        $size = $_FILES['image']['size'];
        $extension = strtolower(substr(strrchr($file, "."), 1));
        $destination = 'public/images/'. $file;
        $extensions = array('png', 'jpg', 'jpeg', 'gif');
        $reptemp = $_FILES ['image']['tmp_name'];
        $maxSize = 2097152;
        if( preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $file)){
            $string = "Nom de fichier non valide";
        } else if ($size <= $maxSize) {
            if (in_array($extension, $extensions)) {
                if (move_uploaded_file($reptemp, $destination)) {
                    $upload = true;
                }else {
                    $upload = false;
                    $string = "Impossible d'enregistrer l'image dans le répertoire";
                }
            } else {
                $string = "Votre image doit être au format png, jpg, jpeg ou gif";
            }
        } else {
            $string = "Votre image ne doit pas dépasser 2Mo";
        }
        return [
            'error' => $string,
            'upload' => $upload,
        ];
    }

        public function upload()
    {
        $file = $_FILES['image'];
        $imageId = null;
        $moveFile['upload'] = true;
        $moveFile['error'] = null;
        $moveFile = $this->moveFile();
        if ($moveFile['upload']) {
            $addImage = $this->addImage();
            $imageId = $addImage;
            return [
                'result' => $moveFile['upload'], // boolean
                'error' => $moveFile['error'],
                'imageId' => $imageId,
            ];
        }
    }

    public function ModifchapterImage($chapterId)
    {
        $file = $_FILES['image']['name'];
        $destination = 'public/images/'. $file;
        $db = $this->dbConnect();
        $modifimage = $db->prepare('UPDATE images SET chapterId=:chapterId WHERE name=:name ');
        $modifimage->bindValue(':name', $file, \PDO::PARAM_STR);
        $modifimage->bindValue(':chapterId', $chapterId, \PDO::PARAM_INT);
        $modifLines = $modifimage->execute();
        while ($data = $modifimage->fetch(\PDO::FETCH_ASSOC)) {
            $image = new Images();
            $image->hydrate($data);
        }
        if ($modifLines) {
            return true;
        }else {
            return false;
        }
    }

    public function DeleteImage($chapterId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM images WHERE chapterId = :id');
        $deleteimage= $req->execute(array(':id' => $chapterId));
        if ($deleteimage) {
            return true;
        } else {
            return false;
        }
    }
}
