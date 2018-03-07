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
 //   public function verif($_POST)
 //   {
  //      $verif = new Validator($_POST);
 //       $veriferror = $verif->verifPseudo($pseudo);
  //      $veriferror = $verif->verifPass($pass);
  //      $veriferror = $verif->verifmail($email);
  //      $veriferror = $verif->verifNewPass($pass, $newpass);
  //      $veriferror = $verif->errors();
   //     $veriferror = $verif->validate_required($name);
  //  }
    public function Contact()
    {
        require('view/backend/Contact_me.php');
    }

    public function loggedOnly(){ // fonction qui gère les droits d'accès aux commentaires, seules les personnes connectés peuvent saisir un commentaire
        $autoris = new MembreManager();
        $autoris->Autoris();

    }
    function membre_est_connecte() {

        return !empty($_SESSION['id']);
    }
}