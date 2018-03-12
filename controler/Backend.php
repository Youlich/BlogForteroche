<?php
namespace controler;
use entity\Membres;
use model\AdminManager;
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
        if ($addMembre === false){
            throw new \Exception('Impossible de supprimer le membre !');
        }
        else {
            require('view/frontend/InscriptionMembreView.php');
        }
    }
    public function suppMembre()
    {
        $suppMembre = new MembreManager();
        $suppMembre->deleteMembre();
    }

    public function modifPseudoMdp()
    {
        $newpseudo = new MembreManager();
        $modifmembre = $newpseudo->modifPseudoMDP();
        if ($modifmembre === false){
            throw new \Exception('Impossible de modifier vos informations pseudo ou mot de passe !');
        }
        else {
            require('view/frontend/ProfilMembreView.php');
        }

    }

    public function modifEmail()
    {
        $newemail = new MembreManager();
        $modifmembre = $newemail->modifmail();
        if ($modifmembre === false){
            throw new \Exception('Impossible de modifier votre email !');
        }
        else {
            require('view/frontend/ProfilMembreView.php');
        }
    }


}