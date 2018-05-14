<?php
namespace model;
use entity\Images;

/**
 * Class ImagesManager
 * @package model
 * Class qui permet la gestion des images : l'affichage des images et la suppression d'image dans la table Images
 */
class ImagesManager extends Manager
{
    /**
     * @param $chapterId
     * @return Images
     * fonction qui permet d'afficher l'image du chapitre entré en paramètre
     */
    public function getImage($chapterId)
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

    /**
     * @param Images $image
     *
     * @return bool|Images
     * retourne l'image si elle existe
     */
    public function getImageById(Images $image)
    {
        if ($image->getId() == 0) {
            return false;
        } else {
            $db = $this->dbConnect();
            $PDOStatement = $db->prepare('SELECT * FROM images WHERE id = :id');
            $PDOStatement->execute(array(':id' => $image->getId()));
            while ($data = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
                $image = new Images();
                $image->hydrate($data);
            }
            return $image;
        }
    }

    /**
     * @return bool|string
     * permet d'ajouter une image dans la table image en lui associant un chapitre s'il a été sélectionné.
     * On retourne l'id de cette image ajoutée ou false si celà s'est mal passé.
     */

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

    /**
     * @return array
     * permet d'enregistrer l'image sur le serveur
     */
    public function moveFile()
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

    /**
     * @return array : tableau contenant le résultat de l'enregistrement sur le serveur, le résultat de cet upload et l'id de l'image
     * si l'enregistrement sur le serveur retourne true, on utilise la fonction addImage pour ajouter l'image dans la BDD.
     *
     */
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

    /**
     * @param $chapterId
     * @return bool
     * permet de donner une valeur à la colonne chapterId de la table images
     */

    public function modifChapterImage($chapterId)
    {
        $file = $_FILES['image']['name'];
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

    /**
     * @param $chapterId
     * @return bool
     * permet la suppression de l'image associée au chapitre
     */
    public function deleteImage($chapterId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('DELETE FROM images WHERE chapterId = :id');
        $deleteimage = $req->execute(array(':id' => $chapterId));
        if ($deleteimage) {
            return true;
        } else {
            return false;
        }
    }
}
