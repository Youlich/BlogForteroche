<?php

namespace model;

class Validator
{
    private $datas = [];
    private $errors = [];



    public function __construct($datas){
        $this->datas = $datas;
    }

    public function check($name, $rule, $options = false){
        $validator = "validate_$rule";
        if(!$this->$validator($name, $options)){
            $this->errors[$name] = "Le champs $name n'a pas été rempli correctement";
        }
    }

    public function validate_required($name){
        return array_key_exists($name, $this->datas) && $this->datas[$name] != '';
    }

    public function validate_email($name){
        return array_key_exists($name, $this->datas) && filter_var($this->datas[$name], FILTER_VALIDATE_EMAIL);
    }



    public function errors(){
        return $this->errors;
    }

    public function verifPseudo($pseudo)
    {
        $pseudo = $_POST['pseudo'];
    if (strlen($pseudo) < 3)
        {
            echo 'Votre pseudo doit être supérieur à 3 caractères';
        }
        else if(strlen($pseudo) > 255)
        {
            echo 'Votre pseudo doit être inférieur à 255 caractères';
        }

    }

    public function verifPass($pass)
    {
        $pass = $_POST['pass'];
        {
           if(strlen($pass) < 6)
            {
                echo 'Votre mot de passe doit comporter au moins 6 caractères';
            }
            else if(strlen($pass) > 255)
            {
                echo 'Votre mot de passe doit être inférieur à 255 caractères';
            }
            else if (!preg_match('#[0-9]{1,}#', $pass))
            {
                echo 'Votre mot de passe doit contenir au moins un chiffre';
            }
            else if(!preg_match('#[A-Z]{1,}#', $pass))
            {
                echo 'Votre mot de passe doit contenir au moins une lettre majuscule';
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
            echo 'Votre adresse mail n\'est pas correcte';
        }

    }
}
