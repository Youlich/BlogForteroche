<?php

namespace model;
use entity\Membres;

require ("DbConnect.php");

class AuthMembreManager extends DbConnect
{
    public function AuthMembre()
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
                $resultat = $req->fetch();

                if ($resultat) { // Le pseudo existe
                    // Dans la requete précédente qui consistait à savoir si le pseudo existe on a récupéré le pass haché
                    // le pass haché a été simulé avec la commande $mdp=password_hash('mdp',PASSWORD_DEFAULT); puis récupéré par un var_dump ($mdp)
                    // et copié en haché dans la bdd. Cette commande a ensuite été supprimée
                    $pass_hache_dans_bdd = $resultat['pass'];

                    // Super on a le mot de passe haché de la personne dont le pseudo est $pseudo
                    // Maintenant on peut vérifier si le pass saisi correspond au pass de la base de donnée
                    // Si ca correspond, on peut faire se connecter la personne
                    // On le fait avec la fonction password_verify()
                    session_start();
                    if (password_verify($pass, $pass_hache_dans_bdd)) {
                        $_SESSION['id'] = $resultat['id'];
                        $_SESSION['pseudo'] = $resultat['pseudo'];
                        $_SESSION['pass'] = $resultat['pass'];
                        header('Location: index.php?action=accueil');

                    } else {
                        $error_message = 'Erreur dans le mot de passe';
                    }
                } else { // Le pseudo n'existe pas en base de données
                    $error_message = 'Pseudo non reconnu';
                }
            } else {
                $error_message = 'Merci de remplir tous les champs';
            }
        }
    }
}

