<?php
namespace controler;

use model\AdminManager;
use model\AuthAdminManagerOld;
use model\ErrorManager;
use model\MembreManager;

require_once('Autoload.php'); // Chargement des class
\Autoload::register();

Class Backend
{
    public function connectMembre()
    {
        $authMembreManager = new MembreManager();
        $connMembre = $authMembreManager->AuthMembre();
        require('view/frontend/AuthMembreView.php');
    }

    public function connectAdmin()
    {
        $authMembreManager = new AdminManager();
        $connMembre = $authMembreManager->connectAdmin();
        require('view/frontend/AuthAdminView.php');
    }

    public function addMembre()
    {
        $newMembre = new MembreManager();
        $inscripMembre = $newMembre->InscrMembre();
        if ($inscripMembre === false) {
            throw new \Exception('Impossible d\'ajouter le membre !');
        }
        else {
            header ('Location: index.php?action=connectMembre' . '&success=ok');
        }
    }



   // public function msg_error($error_message)
  //  {
        // Affiche un message d'erreur
        //    $msgerrorManager = new ErrorManager();
         //   $msg = $msgerrorManager->verifPseudo($error_message);
          //  $msg = $msgerrorManager->verifPass($error_message);
           // $msg = $msgerrorManager->verifNewPass($error_message);
           // $msg = $msgerrorManager->verifmail($error_message);
          //  require ('view/frontend/ErrorView.php');
  //  }


}
