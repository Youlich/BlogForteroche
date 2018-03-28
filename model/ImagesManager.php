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
    public function getImage ($id) // affiche un commentaire pour pouvoir le modifier si besoin
    {
        $pdo = $this->dbConnect();
        $PDOStatement = $pdo->prepare('SELECT * FROM images WHERE id = ?');
        $PDOStatement->execute(array($id));
        while ($data = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
            $image = new Images();
            $image->hydrate($data);
        }
        return $image;

    }

}

