<?php
namespace model;

class Validator
{
    private $datas = [];
    private $errors = [];



    public function __construct($datas){
        $this->datas = $datas;
    }

    public function validate_required($name){
        return array_key_exists($name, $this->datas) && $this->datas[$name] != '';
    }

    public function errors(){
        return $this->errors;
    }

    public function verifPseudo($pseudo)
    {
        $pseudo = $_POST['pseudo'];
    if (strlen($pseudo) < 3)
        {
            return 'Votre pseudo doit être supérieur à 3 caractères';
        }
        else if(strlen($pseudo) > 255)
        {
            return 'Votre pseudo doit être inférieur à 255 caractères';
        }

    }

    public function verifPass($pass)
    {
        $pass = $_POST['pass'];
        {
           if(strlen($pass) < 6)
            {
                return 'Votre mot de passe doit comporter au moins 6 caractères';
            }
            else if(strlen($pass) > 255)
            {
                return 'Votre mot de passe doit être inférieur à 255 caractères';
            }
            else if (!preg_match('#[0-9]{1,}#', $pass))
            {
                return'Votre mot de passe doit contenir au moins un chiffre';
            }
            else if(!preg_match('#[A-Z]{1,}#', $pass))
            {
                return 'Votre mot de passe doit contenir au moins une lettre majuscule';
            }
        }
    }

    public function verifNewPass($pass, $newpass)
    {
        $pass = $_POST['pass'];
        $newpass = $_POST['newpass'];
        if($pass != $newpass && $pass != '' && $newpass != '')
        {
            return 'Vos 2 mots de passe saisis sont différents';
        }
    }

    public function verifmail($email)
    {
        $email = $_POST['email'];

        if (!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#is', $email))
        {
            return 'Votre adresse mail n\'est pas correcte';
        }

    }
}
