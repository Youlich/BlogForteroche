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

    public function InscrMembre()
    {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $pass = htmlspecialchars($_POST['pass']);
        $newpass = htmlspecialchars($_POST['newpass']);
        $email = htmlspecialchars($_POST['email']);

        // Hachage du mot de passe
        $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);

          // Insertion
         $db = $this->Dbconnect();
         $req = $db->prepare('INSERT INTO membres(pseudo, pass, email, date_inscription) VALUES (:pseudo, :pass, :email, CURDATE())');
         $resultat=$req->execute(array(
         'pseudo' => $pseudo,
         'pass' => $pass_hache,
         'email' => $email));

        }

     public function deleteMembre()
     {
          //  $pseudo = htmlspecialchars($_GET['pseudo']);
             $db = $this->dbConnect();
         //    $req = $db->prepare('DELETE FROM membres WHERE pseudo= :pseudo');
         $req = $db->prepare("DELETE FROM membres WHERE pseudo = :pseudo");
         foreach($_GET['pseudo'] as $valeur) {
             $resultat = $req->execute(array(':pseudo'=>$valeur));
         }
          // $resultat=$req->execute(array(':pseudo'=>$pseudo));
           //  $resultat=$req->execute();
     }
         //    $req->bindValue(':pseudo' , $_GET['pseudo'], \PDO::PARAM_INT);
         //    $executeIsOk = $req->execute(array($pseudo,$id));
         //       if ($executeIsOk) {
          //       $req = $db->prepare('DELETE FROM comments WHERE membre_id=$id');
         //        $req->execute();
          //       $message = "Le membre a été supprimé";
          //      } else {
           //          $message = "Echec de la suppression du membre";
          //       }

}
