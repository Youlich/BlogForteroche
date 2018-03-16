<?php
namespace model;


use services\Verifications;

require_once("DbConnect.php");

class AdminManager extends DbConnect
{

    public function authAdmin()
    {
        // toutes les vérifications
        if (isset($_POST['submit'])) {
            if (!empty($_POST['login'] AND !empty($_POST['mdp']))) {
                $verifadmin = new Verifications();
                    $verif = $verifadmin->loginadminExist($_POST['login']); //verif si le pseudo existe
                    if ($verif == "success") { // il existe, on continue
                        $verif = $verifadmin->verifadminPass($_POST['mdp']);
                        if ($verif == "success") {
                            $verif = $verifadmin->verifadminHachPass();
                            if ($verif == "success") {
                                if ($verifadmin->sessionAdmin()) {
                                    header('Location: index.php?action=administration');
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
}