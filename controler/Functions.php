<?php
// toutes les fonctions utiles de vérifications, d'erreur,hachage mdp

class Functions
{

//message d'erreur par défaut

    public function DefaultError($err='')
    {
        $mess=($err!='')? $err:'Une erreur inconnue s\'est produite';

        exit ('<p>'.$mess.'</p>
        <p>Cliquez <a href="index.php?action=accueil">ici</a> pour revenir à la page d\'accueil)</p>');
    
    }
}
