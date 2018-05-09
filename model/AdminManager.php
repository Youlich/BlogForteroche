<?php
namespace model;

use services\Verifications;
use entity\Admin;


/**
 * Class AdminManager
 * @package model
 */

class AdminManager extends Manager
{

    /**
     * @return string
     */
    public function loginAdmin()
    {
        // toutes les vérifications
        if (isset($_POST['submit'])) {
            if (!empty($_POST['login'] AND !empty($_POST['mdp']))) {
                $verifadmin = new Verifications($this->dbConnect());
                $verif = $verifadmin->loginadminExist($_POST['login']); //verif si le pseudo existe
                if ($verif == "success") { // il existe, on continue
                    $verif = $verifadmin->verifadminPass($_POST['mdp']);
                    if ($verif == "success") {
                        $verif = $verifadmin->verifadminHachPass();
                        if ($verif == "success") {
                            if ($verifadmin->sessionAdmin()) {
                            	$this->redirect("Location:index.php?action=administration");
                                exit();
                            }
                        } else {
                            $_SESSION['error'] = $verif;
                        }
                    } else {
                        $_SESSION['error'] = $verif;
                    }
                } else {
                    $_SESSION['error'] = $verif;
                }

            } else {
                return 'Merci de remplir tous les champs';
            }
        }
    }

    /**
     * @param $id : identifiant de l'admin
     * @return Admin
     */

    public function profilAdmin($id)
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM admin WHERE id=2');
        while ($data = $req->fetch()) {
            $admin = new Admin();
            $admin->hydrate($data);
        }
        return $admin;
    }

    /**
     * @return string
     */

    public function modifMessage()
    {
        $db = $this->dbConnect();
        $modif = $db->prepare('UPDATE admin SET message=:message WHERE id=:id');
        $modif->bindValue(':message', $_POST['message'], \PDO::PARAM_STR);
        $modif->bindValue(':id', $_SESSION['id'], \PDO::PARAM_INT);
        $res = $modif->execute();
        while ($data = $modif->fetch(\PDO::FETCH_ASSOC)) {
            $newmodif = new Admin();
            $newmodif->hydrate($data);
        }
        if ('$res == true') {
            $_SESSION['success'] = "Bravo ! Votre message a bien été modifié";
            return $_SESSION['success'];
        } else {
            $_SESSSION['error'] = "Désolé ! votre message n'a pas pu être modifié";
            return $_SESSION['error'];
        }
    }
}
