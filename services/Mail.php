<?php

namespace services;

/**
 * Class Mail
 * @package services
 */

class Mail
{

	/**
	 * Fonction qui permet l'envoi de mail depuis le site vers jforteroche44@gmail.com
	 * elle comprend un ensemble de vérifications
	 */
    public function contact()
    {
        $error = array(); // on crée une vérif de champs
        if(!array_key_exists('name', $_POST) || $_POST['name'] == '') {// on verifie l'existence du champ et d'un contenu
            $error ['name'] = "vous n'avez pas renseigné votre nom";
        }
        if(!array_key_exists('email', $_POST) || $_POST['email'] == '' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {// on verifie existence de la clé
            $error ['mail'] = "vous n'avez pas renseigné votre email";
        }
        if(!array_key_exists('message', $_POST) || $_POST['message'] == '') {
            $error ['message'] = "vous n'avez pas renseigné votre message";
        }
        //On check les infos transmises lors de la validation
        if(!empty($error)){ // si erreur on renvoie vers la page précédente
            $_SESSION['error'] = $error;//on stocke les erreurs
            $_SESSION['inputs'] = $_POST;
            header('Location: index.php?action=accueil#contact');
        }else{
            $_SESSION['success'] = "Votre mail a bien été envoyé !";
            $message = htmlspecialchars($_POST['message']);
            // Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
            $message = wordwrap($message, 70, "\r\n");
            $destinataire = 'jforteroche44@gmail.com';
            $expediteur = htmlspecialchars($_POST['email']);
            $name = htmlspecialchars($_POST['name']);
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            $headers .= "From: Jean Forteroche . $destinataire\r\nReply-to: $expediteur";
            mail($destinataire, 'Formulaire de contact de ' . $name, $message, $headers);
            header('Location: index.php?action=accueil#contact');
        }
    }
}