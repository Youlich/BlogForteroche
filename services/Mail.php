<?php

namespace services;


class Mail
{

    public function Contact()
    {
        $errors = array(); // on crée une vérif de champs
        if(!array_key_exists('name', $_POST) || $_POST['name'] == '') {// on verifie l'existence du champ et d'un contenu
            $errors ['name'] = "vous n'avez pas renseigné votre nom";
        }
        if(!array_key_exists('email', $_POST) || $_POST['email'] == '' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {// on verifie existence de la clé
            $errors ['mail'] = "vous n'avez pas renseigné votre email";
        }
        if(!array_key_exists('message', $_POST) || $_POST['message'] == '') {
            $errors ['message'] = "vous n'avez pas renseigné votre message";
        }
//On check les infos transmises lors de la validation
        if(!empty($errors)){ // si erreur on renvoie vers la page précédente
            $_SESSION['errors'] = $errors;//on stocke les erreurs
            $_SESSION['inputs'] = $_POST;
            header('Location: index.php?action=accueil#contact');
        }else{
            $_SESSION['success'] = 1;
            // utilisation de l'applicatif sendmail pour pouvoir envoyer les mails en local, modif php.ini et modif localhost sur wamp et sur phpstorm (deployment) pour prendre le bon php.ini
            ###$message = htmlspecialchars($_POST['message']);
// Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
            ###$message = wordwrap($message, 70, "\r\n");
            ###$destinataire = 'jforteroche44@gmail.com';
            ###$expediteur = htmlspecialchars($_POST['email']);
            ###$name = htmlspecialchars($_POST['name']);
            ###$headers  = 'MIME-Version: 1.0' . "\r\n";
            ###$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            ###$headers .= "From: Jean Forteroche . $destinataire\r\nReply-to: $expediteur";
            ###mail($destinataire, 'Formulaire de contact de ' . $name, $message, $headers);
            header('Location: index.php?action=accueil#contact');
        }
    }
}