<?php
namespace entity;

use model\DbConnect;

class Inscription extends DbConnect
{
    private $id;
    private $pseudo;
    private $pass;
    private $newpass;
    private $email;
    private $pass_hache;



    public function __construct($pseudo, $pass, $newpass, $email){
        $pseudo = htmlspecialchars($pseudo);
        $email = htmlspecialchars($email) ;
        $pass = htmlspecialchars($pass);
        $newpass = htmlspecialchars($newpass);
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->pass = $pass;
        $this->newpass = $newpass;

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

    /**
     * @return string
     */
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

    public function identiquePass()
    {
        if ($this->pass == $this->newpass) {
            return 'success';
        } else {
            $_SESSION['error'] = "Vos mots de passe sont différents";
            session_destroy();
            return $_SESSION['error'];
        }
    }

    public function verifEmail(){
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            return "success";
        }else{
            $_SESSION['error'] = "Votre adresse mail n'est pas valide";
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
            $_SESSION['error'] = "Votre pseudo existe déjà";
            session_destroy();
            return $_SESSION['error'];
        } else {
            return 'success';
        }
    }
}
