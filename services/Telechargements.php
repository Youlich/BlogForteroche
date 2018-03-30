<?php

namespace services;

use model\DbConnect;

class Telechargements extends DbConnect
{

    function upload ()

    {
        $file = $_FILES ['image']['name'];
        $error = $_FILES ['image']['error'];
        $size = $_FILES['image']['size'];
        $extension = strtolower(substr(strrchr($file, "."), 1));
        $destination = 'public/images/' . 'image' . $file. '.'. $extension;
        $extensions = array('png', 'jpg', 'jpeg', 'gif');
        $reptemp = $_FILES ['image']['tmp_name'];
        $maxSize = 2097152;

        if( preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $file)){
            echo "Nom de fichier non valide";
        } else if ($size <= $maxSize) {
            if (in_array($extension, $extensions)) {
                if (move_uploaded_file($reptemp, $destination)) {
                    $db = $this->dbConnect();
                    $req = $db->prepare('INSERT INTO images (name,fileUrl) VALUES(?,?)');
                    $upload = $req->execute(array($file, $destination));
                    if ($upload == "success") {
                        echo "Votre image a été téléchargée avec succès";
                        return $file;
                    } else {
                        echo "Un problème s'est produit pendant le téléchargement";
                    }
                }else {
                    echo "Impossible d'enregistrer l'image dans le répertoire";
                }
                } else {
                    echo "Votre image doit être au format png, jpg, jpeg ou gif";
                }
            } else {
                echo "Votre imagene doit pas dépasser 2Mo";
            }
    }
}











