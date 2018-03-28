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

}

