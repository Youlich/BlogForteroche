<?php
namespace services;


use model\Manager;

class Verifications
{
    private $pseudo;
    private $pass;
    private $newpass;
    private $email;
    private $login;
    private $mdp;


    public function connectDb()
    {
        $container = new Container([]);
        $pdo = $container->getPDO();
        $manager = new Manager($pdo);
        $db = $manager->dbConnect();
        return $db;
    }


    public function verifPseudo($pseudo)
    {
        $this->pseudo = htmlspecialchars($pseudo);
        if (strlen($this->pseudo) > 3 AND strlen($this->pseudo) < 255) {
            return 'success';
        } else {
            $_SESSION['error'] = "Votre pseudo doit être compris entre 3 et 255 caractères";
            return $_SESSION['error'];
        }
    }

    public function verifLoginAdmin($login)
    {
        $this->pseudo = htmlspecialchars($login);
        if (strlen($this->login) > 3 AND strlen($this->login) < 255) {
            return 'success';
        } else {
            $_SESSION['error'] = "Votre login doit être compris entre 3 et 255 caractères";
            return $_SESSION['error'];
        }
    }

    /**
     * @return string
     */
    public function verifPass ($pass)
    {
        $this->pass = htmlspecialchars($pass);
        if (strlen($this->pass) > 6 AND strlen($this->pass) < 255) {
            return 'success';
        } else {
            $_SESSION['error'] = "Votre mot de passe doit être compris entre 6 et 255 caractères";
            return $_SESSION['error'];
        }
    }

    public function verifadminPass($mdp)
    {
        $this->mdp = htmlspecialchars($mdp);
        if (strlen($this->mdp) > 6 AND strlen($this->mdp) < 255) {
            return 'success';
        } else {
            $_SESSION['error'] = "Votre mot de passe doit être compris entre 6 et 255 caractères";
            return $_SESSION['error'];
        }
    }

    public function identiquePass ($newpass)
    {
        $this->newpass = htmlspecialchars($newpass);
        if ($this->pass == $this->newpass) {
            return 'success';
        } else {
            $_SESSION['error'] = "Vos mots de passe sont différents";
            return $_SESSION['error'];
        }
    }

    public function verifHachPass()
    {
        $db = $this->connectDb();
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
            return $_SESSION['error'];
        }
    }

    public function verifadminHachPass()
    {
        $db = $this->connectDb();
        $req = $db->prepare('SELECT * FROM admin WHERE login = :login');
        $req->execute(array('login' => $_POST['login']));
        $authadmin = $req->fetch();
        $_SESSION['id'] = $authadmin['id'];
        $_SESSION['login'] = $authadmin['login'];
        $_SESSION['mdp'] = $authadmin['mdp'];
        $pass_hache_dans_bdd = $authadmin['mdp'];
        $resultat = password_verify($_POST['mdp'], $pass_hache_dans_bdd);
        if ($resultat) {
            return 'success';
        } else {
            $_SESSION['error'] = "Erreur dans votre mot de passe";
            return $_SESSION['error'];
        }
    }

    public function verifEmail ($email)
    {
        $this->email = htmlspecialchars($email);
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return "success";
        } else {
            $_SESSION['error'] = "Votre adresse mail n'est pas valide";
            return $_SESSION['error'];
        }
    }

    public function pseudoExist($pseudo)
    {
        $this->pseudo = $pseudo;
        $db = $this->connectDb();
        $req = $db->prepare('SELECT * FROM membres WHERE pseudo = :pseudo');
        $req->execute(array('pseudo' => $_POST['pseudo']));
        $resultat = $req->fetch();
        if ($resultat){
            return 'success';
        } else {
        $_SESSION['error'] = "Votre pseudo n'existe pas";
        return $_SESSION['error'];
        }
    }

    public function loginadminExist($login)
    {
        $this->login = $login;
        $db = $this->connectDb();
        $req = $db->prepare('SELECT * FROM admin WHERE login = :login');
        $req->execute(array('login' => $_POST['login']));
        $resultat = $req->fetch();
        if ($resultat){
            return 'success';
        } else {
            $_SESSION['error'] = "Votre login administrateur n'existe pas";
            return $_SESSION['error'];
        }
    }

    public function session()
    {
        $db = $this->connectDb();
        $req = $db->prepare('SELECT id, dateInscription, email, nbcomms FROM membres WHERE pseudo = :pseudo');
        $req->execute(array('pseudo' => $this->pseudo));
        $req = $req->fetch();
        $_SESSION['id'] = $req['id'];
        $_SESSION['pseudo'] = $this->pseudo;
        $_SESSION['dateInscription'] = $req['dateInscription'];
        $_SESSION['email'] = $req['email'];
        $_SESSION['nbcomms'] = $req['nbcomms'];

        return 'success';
    }

    public function sessionAdmin()
    {
        $db = $this->connectDb();
        $req = $db->prepare('SELECT id, login, mdp FROM admin WHERE login = :login');
        $req->execute(array('login' => $this->login));
        $req = $req->fetch();
        $_SESSION['id'] = $req['id'];
        $_SESSION['login'] = $this->login;

        return 'success';
    }


}