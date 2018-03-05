<?php

//gestion des erreurs

$errors = [];

$validator = new \model\Validator($_POST);
$validator->check('name', 'required');
$validator->check('email', 'required');
$validator->check('email', 'email');
$validator->check('message', 'required');
$errors = $validator->errors();

if(!empty($errors)){
    $_SESSION['errors'] = $errors;
    header('Location: index.php?action=accueil&amp#contact');
    } else {
    // utilisation de l'applicatif sendmail pour pouvoir envoyer les mails en local, modif php.ini et modif localhost sur wamp et sur phpstorm (deployment) pour prendre le bon php.ini
    $message = htmlspecialchars($_POST['message']);
// Dans le cas où nos lignes comportent plus de 70 caractères, nous les coupons en utilisant wordwrap()
    $message = wordwrap($message, 70, "\r\n");
    $destinataire = 'jforteroche44@gmail.com';
    $expediteur = htmlspecialchars($_POST['email']);
    $name = htmlspecialchars($_POST['name']);
    $_SESSION['success'] = 1;
    $headers = 'MIME-Version: 1.0' . "\r\n";
    // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= "From: Jean Forteroche . $destinataire\r\nReply-to: $expediteur";

    mail($destinataire, 'Formulaire de contact de ' . $name, $message, $headers);
    header('Location: index.php?action=accueil&amp#contact');
    }
    
