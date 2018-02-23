<?php
namespace controler;

use model\AuthAdminManager;
use model\AuthAdminManagerOld;
use model\AuthMembreManager;

require_once('Autoload.php'); // Chargement des class
\Autoload::register();

Class Backend
{
    public function connectMembre()
    {
        $authMembreManager = new AuthMembreManager();
        $connMembre = $authMembreManager->AuthMembre();


        require('view/frontend/AuthMembreView.php');
    }
    public function connectAdmin()
    {
        $authMembreManager = new AuthAdminManager();
        $connMembre = $authMembreManager->connectAdmin();


        require('view/frontend/AuthAdminView.php');
    }

}