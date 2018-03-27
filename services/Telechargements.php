<?php

namespace services;

use model\DbConnect;

class Telechargements extends DbConnect
{

    function upload ()

    {
        $file = $_FILES ['image']['name'];
        $error = $_FILES ['image']['error'];
        $destination = 'public/images/' . $file;
        $extension = strtolower(strrchr($file, "."));
        $extensions = array('.png', '.jpg', '.jpeg', '.gif', '.bmp');
        $reptemp = $_FILES ['image']['tmp_name'];

        if (in_array($extension, $extensions)) {
            if (isset($_FILES) OR $error < 0) {
                if (move_uploaded_file($reptemp, $destination)) {
                    $db = $this->dbConnect();
                    $req = $db->prepare('INSERT INTO images (name,fileUrl) VALUES(?,?)');
                    $upload = $req->execute(array($file, $destination));
                    if ($upload == "success") {
                        $_SESSION['success'] = "Votre image a été téléchargée avec succès";
                        return $_SESSION['success'];
                    } else {
                        $_SESSION['error'] = "Un problème s'est produit pendant le téléchargement";
                        return $_SESSION['error'];
                    }
                }
            } else {
                $_SESSION['error'] = "Une erreur s'est produite";
                return $_SESSION['error'];
            }
        } else {
            $_SESSION['error'] = "Votre fichier n'est pas une image";
            return $_SESSION['error'];
        }
    }
}










