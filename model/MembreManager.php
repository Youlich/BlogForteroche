<?php
namespace model;
use entity\Membres;
require("DbConnect.php");
class MembreManager extends DbConnect
{
    public function AuthMembre ()
    {
        // toutes les vérifications
        if (isset($_POST['submit'])) {
            if (!empty($_POST['pseudo'] AND !empty($_POST['pass']))) {
                $pass = htmlspecialchars($_POST['pass']);
                $pseudo = htmlspecialchars($_POST['pseudo']);
                // On vérifie si le pseudo existe en base de données
                $db = $this->dbConnect();
                $req = $db->prepare('SELECT * FROM membres WHERE pseudo = :pseudo');
                $req->execute(array('pseudo' => $pseudo));
                $authMembre = $req->fetch();
                if ($authMembre) { // Le pseudo existe
                    // Dans la requete précédente qui consistait à savoir si le pseudo existe on a récupéré le pass haché
                    // le pass haché a été simulé avec la commande $mdp=password_hash('mdp',PASSWORD_DEFAULT); puis récupéré par un var_dump ($mdp)
                    // et copié en haché dans la bdd. Cette commande a ensuite été supprimée
                    $pass_hache_dans_bdd = $authMembre['pass'];
                    // Super on a le mot de passe haché de la personne dont le pseudo est $pseudo
                    // Maintenant on peut vérifier si le pass saisi correspond au pass de la base de donnée
                    // Si ca correspond, on peut faire se connecter la personne
                    // On le fait avec la fonction password_verify()
                    if (password_verify($pass, $pass_hache_dans_bdd)) {
                        $_SESSION['id'] = $authMembre['id'];
                        $_SESSION['pseudo'] = $authMembre['pseudo'];
                        $_SESSION['pass'] = $authMembre['pass'];
                        header('Location: index.php?action=accueil');
                    } else {
                        return 'Erreur dans le mot de passe';
                    }
                } else { // Le pseudo n'existe pas en base de données
                    return 'Pseudo non reconnu';
                }
            } else {
                return 'Merci de remplir tous les champs';
            }
        }
    }

    public function InscrMembre ()
    {
        if (isset($_POST['submit'])) {
            // vérification que tous les champs sont remplis
            if (!empty($_POST['pseudo'] AND !empty($_POST['pass'] AND !empty($_POST['newpass'] AND !empty($_POST['email']))))) {
                $pseudo = htmlspecialchars($_POST['pseudo']);
                $pass = htmlspecialchars($_POST['pass']);
                $newpass = htmlspecialchars($_POST['newpass']);
                $email = htmlspecialchars($_POST['email']);


                if (strlen($pseudo) < 255) {
                    if (strlen($pseudo) > 3) {
                        if ($pass == $newpass) {
                            if (strlen($pass) > 6) {
                                if (strlen($pass) < 255) {


                                    // Hachage du mot de passe

                                    $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);

                                    // Insertion
                                    $db = $this->Dbconnect();
                                    $req = $db->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES (:pseudo, :pass, :email, CURDATE())');
                                    $resultat=$req->execute(array(
                                        'pseudo' => $pseudo,
                                        'pass' => $pass_hache,
                                        'email' => $email));

                                    header ('location: index.php?action=accesMembre&amp;' . '$success');
                                    exit();


                                } else {
                                    return 'Votre mot de passe doit être inférieur à 255 caractères';
                                }
                            } else {
                                return 'Votre mot de passe doit être supérieur à 6 caractères';
                            }

                        } else {
                            return 'Vos mots de passe sont différents';
                        }
                    } else {
                        return 'Votre pseudo doit faire plus de 3 caractères';
                    }
                } else {
                    return'Votre pseudo doit faire moins de 255 caractères';
                }
            } else {
                return 'Merci de remplir tous les champs';
            }
        }
    }


        public function deleteMembre ()
        {
            $db = $this->dbConnect();
            $req = $db->prepare("DELETE FROM membres WHERE id = :id");
            return $req->execute(array(':id' => $_GET['id']));

        }

}