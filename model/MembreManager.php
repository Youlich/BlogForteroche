<?php
namespace model;

use entity\Membres;
use services\Verifications;

require("DbConnect.php");

class MembreManager extends DbConnect
{

    public function getMembres() {

        $membres = array();
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM membres ORDER BY pseudo');
        while ($data = $req->fetch()) {
            $membre = new Membres();
            $membre->hydrate($data);
            $membres[] = $membre;
        }
        return $membres;
    }

    public function getMembre($id) {


        $db = $this->dbConnect();
        $PDOStatement = $db->prepare('SELECT * FROM membres WHERE id= ? ');
        $PDOStatement->execute(array($id));
        while ($data = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
            $membre = new Membres();
            $membre->hydrate($data);
        }
        return $membre;
    }


    public function AuthMembre ()
    {
        // toutes les vérifications
        if (isset($_POST['submit'])) {
            // vérification que tous les champs sont remplis
            if (!empty($_POST['pseudo'] AND !empty($_POST['pass']))) {
                $verifmembre = new Verifications();
                $verif = $verifmembre->verifPseudo($_POST['pseudo']);
                if ($verif == "success") { //on continue
                    $verif = $verifmembre->pseudoExist($_POST['pseudo']); //verif si le pseudo existe
                    if ($verif == "success") { // il existe, on continue
                        $verif = $verifmembre->verifPass($_POST['pass']);
                        if ($verif == "success") {
                            $verif = $verifmembre->verifHachPass();
                            if ($verif == "success") {
                                if ($verifmembre->session()) {
                                    header('Location: index.php?action=accueil');
                                    exit();
                                }
                            } else {
                                $_SESSION['error'] = $verif;
                            }
                            } else {
                                $_SESSION['error'] = $verif;
                            }
                        } else {
                            $_SESSION['error'] = "Votre pseudo n'existe pas";
                        }
                    } else {
                        $_SESSION['error'] = $verif;
                    }
                } else {
                    $_SESSION['error'] = "Merci de remplir tous les champs";
                    return $_SESSION['error'];
                }
            }
     }


        public function InscrMembre () //ne plus toucher
        {
            if (isset($_POST['submit'])) {
                // vérification que tous les champs sont remplis
                if (!empty($_POST['pseudo'] AND !empty($_POST['pass'] AND !empty($_POST['newpass'] AND !empty($_POST['email']))))) {
                    $verifmembre = new Verifications();
                    $verif = $verifmembre->verifPseudo($_POST['pseudo']); // verif pseudo compris entre 3 et 255 caractères
                    if ($verif == "success") {
                        //on vérifie s'il n'est pas déjà existant dans la BDD
                        $verif = $verifmembre->pseudoExist($_POST['pseudo']);
                        if ($verif != "success") { // si le pseudo n'existe pas
                            $verif = $verifmembre->verifPass($_POST['pass']); // verif mdp compris entre 6 et 255 caractères
                            if ($verif == "success") { //on continue
                                $verif = $verifmembre->identiquePass($_POST['newpass']); // verif que les 2 mdp saisis identiques
                                if ($verif == "success") { //on continue
                                    $verif = $verifmembre->verifEmail($_POST['email']); // verif de la synthaxe du mail
                                    if ($verif == "success") { //on continue
                                        // Hachage du mot de passe
                                        $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                                        // Insertion
                                        $db = $this->Dbconnect();
                                        $req = $db->prepare('INSERT INTO membres(pseudo, pass, email, dateInscription) VALUES (:pseudo, :pass, :email, CURDATE())');
                                        $req->execute(array(
                                            'pseudo' => $_POST['pseudo'],
                                            'pass' => $pass_hache,
                                            'email' => $_POST['email']));
                                        header('location: index.php?action=connectMembre');
                                        $_SESSION['success'] = "Bravo ! Vous êtes bien inscrit, merci de vous connecter.";
                                        return $_SESSION['success'];

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
                            $_SESSION['error'] = "Votre pseudo existe déjà, merci d'en saisir un nouveau";
                        }
                    } else {
                        $_SESSION['error'] = $verif;
                    }
                } else {
                    $_SESSION['error'] = "Merci de remplir tous les champs";
                    session_destroy();
                    return $_SESSION['error'];
                }
            }
        }


        public function deleteMembre () // ne pas toucher
        {
            $db = $this->dbConnect();
            $req = $db->prepare("DELETE FROM membres WHERE id = :id");
            $supp = $req->execute(array(':id' => $_GET['id']));
            if ($supp== "success") {
                header('location: index.php?action=accueil');
                session_destroy();
            }else {
                header('location: index.php?action=profilMembre');
                $_SESSION['error'] = "Votre compte n'a pas pu être supprimé";
                return $_SESSION['error'];
            }
         }


    public function modifPseudoMDP()
    {
        if (isset($_POST['submit'])) {
            $verification = new Verifications();
            $verif = $verification->verifPseudo($_POST['pseudo']); // verif pseudo compris entre 3 et 255 caractères
            if ($verif == "success") {
                $verif = $verification->verifPass($_POST['pass']); // verif mdp compris entre 6 et 255 caractères
                if ($verif == "success") { //on continue
                    $verif = $verification->identiquePass($_POST['newpass']); // verif que les 2 mdp saisis identiques
                    if ($verif == "success") {

                            $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                            $db = $this->dbConnect();
                            $modif = $db->prepare('UPDATE membres SET pseudo=:pseudo, pass=:pass WHERE id=:idmembre');
                            $modif->bindValue(':idmembre', $_POST['idmembre'], \PDO::PARAM_INT);
                            $modif->bindValue(':pseudo', $_POST['pseudo'], \PDO::PARAM_STR);
                            $modif->bindValue(':pass', $pass_hache, \PDO::PARAM_STR);
                            $modif->execute();
                            while ($data = $modif->fetch(\PDO::FETCH_ASSOC)) {
                                $newmodif = new Membres();
                                $newmodif->hydrate($data);

                            }
                            header('location: index.php?action=connectMembre');
                            $_SESSION['success'] = "Bravo ! Vos informations de connexion sont modifiées, merci de vous connecter.";
                            return $_SESSION['success'];

                    } else {
                        $_SESSION['error'] = $verif;
                    }
                } else {
                    $_SESSION['error'] = $verif;
                }
            } else {
                $_SESSION['error'] = $verif;
            }
        }
    }

    public function modifmail() //ne plus toucher
    {
        if (isset($_POST['submit'])) {
            $verification = new Verifications();
            $verif = $verification->verifEmail($_POST['email']); // verif de la synthaxe du mail
            if ($verif == "success") {
                $db = $this->dbConnect();
                $modif = $db->prepare('UPDATE membres SET email=:email WHERE id=:idmembre');
                $modif->bindValue(':idmembre', $_POST['idmembre'], \PDO::PARAM_INT);
                $modif->bindValue(':email', $_POST['email'], \PDO::PARAM_STR);
                $modif->execute();
                while ($data = $modif->fetch(\PDO::FETCH_ASSOC)) {
                    $newmodif = new Membres();
                    $newmodif->hydrate($data);

                }
               header ('location:index.php?action=profilMembre');
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['success'] = "Bravo ! Votre email est modifié";
                return $_SESSION['success'];
            } else {
                $_SESSION['error'] = $verif;
            }
            }
    }

        public function CountCommentsMembre($membreId)
        {
            $pdo = $this->dbConnect();
            $PDOStatement = $pdo->prepare('SELECT COUNT(*) AS total FROM comments WHERE membreId = ?');
            $PDOStatement->execute(array($membreId));
            $data = $PDOStatement->fetch();
            return $data['total'];
        }


}

