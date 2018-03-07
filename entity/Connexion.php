<?php
namespace entity;

use model\DbConnect;

class Connexion extends DbConnect
{

    private $pseudo;
    private $pass;

    public function __construct($pseudo, $pass){
        $pseudo = htmlspecialchars($pseudo);
        $pass = htmlspecialchars($pass);
        $this->pseudo = $pseudo;
        $this->pass = $pass;
    }

    public function verifPseudo()
    {
        if (strlen($this->pseudo) > 3 AND strlen($this->pseudo) < 255) {
            return 'success';
        } else {
            $_SESSION['error'] = "Votre pseudo doit être compris entre 3 et 255 caractères";
            session_destroy();
            return $_SESSION['error'];
        }
    }

    public function verifPass()
    {
        if(strlen($this->pass) > 6 AND strlen($this->pass) < 255) {
                return 'success';
        }else{
            $_SESSION['error'] = "Votre mot de passe doit être compris entre 6 et 255 caractères";
            session_destroy();
            return $_SESSION['error'];
        }
    }

    public function pseudoExist()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM membres WHERE pseudo = :pseudo');
        $req->execute(array('pseudo' => $_POST['pseudo']));
        $authMembre = $req->fetch();

        if ($authMembre) {
            return 'success';
        } else {
            $_SESSION['error'] = "Votre pseudo n'existe pas";
            session_destroy();
            return $_SESSION['error'];
        }
    }

    public function verifHachPass()
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM membres WHERE pseudo = :pseudo');
        $req->execute(array('pseudo' => $_POST['pseudo']));
        $authMembre = $req->fetch();
        $_SESSION['id'] = $authMembre['id'];
        $_SESSION['pseudo'] = $authMembre['pseudo'];
        $_SESSION['pass'] = $authMembre['pass'];

        $pass_hache_dans_bdd = $authMembre['pass'];
        $resultat = password_verify($_POST['pass'], $pass_hache_dans_bdd);
        if ($resultat) {
            return 'success';
         } else {
            $_SESSION['error'] = "Erreur dans votre mot de passe";
            session_destroy();
            return $_SESSION['error'];
            }
    }

}