<?php

namespace model;

class ErrorManager
{
    private $error_message;

    public function verifPseudo($pseudo)
    {
        if ($pseudo == '')
        {
            echo "Votre Pseudo est obligatoire";
        }
        else if (strlen($pseudo) < 3)
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
        {
            if($pass == '')
            {
                echo 'Votre mot de passe est obligatoire';
            }
            else if(strlen($pass) < 6)
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
        if($pass != $newpass && $pass != '' && $newpass != '')
        {
            return 'Vos 2 mots de passe saisis sont différents';
        }
    }

    public function verifmail($email)
    {
        if ($email == '')
        {
            echo 'Votre adresse mail est obligatoire';
        }
        else if (!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#is', $email))
        {
            echo 'Votre adresse mail n\'est pas correcte';
        }
    }
}
