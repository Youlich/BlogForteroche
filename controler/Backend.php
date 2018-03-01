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
        $authMembre = $authMembreManager->AuthMembre();
        require('view/frontend/AuthMembreView.php');
    }
    public function deconnectMembre()
    {
        session_destroy();
        header('Location: index.php');
        exit();
    }
    public function connectAdmin()
    {
        $authMembreManager = new AdminManager();
        $connAdmin = $authMembreManager->connectAdmin();
        require('view/frontend/AuthAdminView.php');
    }
    public function addMembre()
    {
        $newMembre = new MembreManager();
        $addMembre = $newMembre->InscrMembre();
        require ('view/frontend/InscriptionMembreView.php');

    }
    public function suppMembre()
    {
        $suppMembre = new MembreManager();
        $deleteMembre = $suppMembre->deleteMembre();
        if ($deleteMembre === false){
            throw new Exception('Impossible de supprimer le membre !');
        }
        else {
            session_destroy();
            header ('Location: index.php?action=connectMembre' . '&supp=ok');
            exit();
        }
    }
}