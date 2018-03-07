<?php
namespace model;
use entity\Connexion;
use entity\Membres;
use entity\Inscription;
require("DbConnect.php");

class MembreManager extends DbConnect
{

    public function AuthMembre ()
    {
        // toutes les vérifications
        if (isset($_POST['submit'])) {
            $connexion = new Connexion($_POST['pseudo'], $_POST['pass']);
            $verif = $connexion->verifPseudo();
            if ($verif == "success") { //on continue
                $verif = $connexion->verifPass();
                if ($verif == "success") { //on continue
                    // On vérifie si le pseudo existe en base de données
                    $verif = $connexion->pseudoExist();
                    if ($verif == "success") { //on continue
                        $verif = $connexion->verifHachPass();
                        if ($verif == "success") {
                            header('Location: index.php?action=accueil');
                            exit();
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
                        $_SESSION['error'] = $verif;
                    }
                }
            }


        public function InscrMembre ()
        {
            if (isset($_POST['submit'])) {
                $inscription = new Inscription($_POST['pseudo'], $_POST['pass'], $_POST['newpass'], $_POST['email']);
                $verif = $inscription->verifPseudo();
                if ($verif == "success") {
                    //on vérifie s'il n'est pas déjà existant
                    $verif = $inscription->pseudoExist();
                    if ($verif == "success") { // si le pseudo n'existe pas, on continue
                        $verif = $inscription->verifPass();
                        if ($verif == "success") { //on continue
                            $verif = $inscription->identiquePass();
                            if ($verif == "success") { //on continue
                                $verif = $inscription->verifEmail();
                                if ($verif == "success") { //on continue

                                    // Hachage du mot de passe
                                    $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                                    // Insertion
                                    $db = $this->Dbconnect();
                                    $req = $db->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES (:pseudo, :pass, :email, CURDATE())');
                                    $resultat = $req->execute(array(
                                        'pseudo' => $_POST['pseudo'],
                                        'pass' => $pass_hache,
                                        'email' => $_POST['email']));
                                    header('location: index.php?action=accesMembre&amp;' . '$success');

                                    exit();
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
                        $_SESSION['error'] = $verif;
                    }
                } else {
                    $_SESSION['error'] = $verif;
                }
            }
        }


        public function deleteMembre ()
        {
            $db = $this->dbConnect();
            $req = $db->prepare("DELETE FROM membres WHERE id = :id");
            return $req->execute(array(':id' => $_GET['id']));

        }

        public function CountComments ($membre_id)
        {
            $pdo = $this->dbConnect();
            $PDOStatement = $pdo->prepare('SELECT COUNT(*) AS total FROM comments WHERE membre_id = ?');
            $PDOStatement->execute(array($membre_id));
            $data = $PDOStatement->fetch();
            return $data['total'];
        }

        public function getMembre ($membreId) // affiche un membre
        {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT * FROM membres WHERE id = ?');
            $req->execute(array($membreId));
            while ($data = $req->fetch()) {
                $membre = new Membres();
                $membre->setId($data['id']);
                $membre->setPseudo($data['pseudo']);
                $membre->setDateInscription($data['date_inscription']);
                $membre->setEmail($data['email']);
                $membre->setNbcomms($data['nbcomms']);

            }
            return $membre;
        }

        public function Autoris ()
        {
            if (!isset($_SESSION['id'])) {
                echo "Merci de vous connecter";
                header('Location : index.php?action=connectMembre');
            }
        }

}

