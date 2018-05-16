# BlogForteroche  

## Connexion à la BDD 

Dans un premier temps, veuillez créer une nouvelle base de données sur votre application.
Vous devez importer la base de données projetblog.sql fournie dans votre dossier de BDD.
Ensuite, pour vous connecter à la base de données, veuillez rentrer vos informations de connexion dans le fichier Config.php.dist, au niveau de la méthode getConfigBDD(). Ce fichier se trouve dans le répertoire "services". 
Vous devez ensuite le renommer en Config.php

## Enoncé du projet3 : création d'un Blog pour un écrivain

Vous développerez une application de blog simple en PHP avec une base de données MySQL. Elle doit fournir une interface frontend (lecture des billets) et une interface backend (administration des billets pour l'écriture). On doit y retrouver tous les éléments d'un CRUD :

    Create : Création de billets
    Read : Lecture de billets
    Update : Mise à jour de billets
    Delete : Suppression de billets

Chaque billet doit permettre l'ajout de commentaires, qui pourront être modérés dans l'interface d'administration au besoin. Les lecteurs doivent pouvoir "signaler" les commentaires pour ceux-ci remontent plus facilement dans l'interface d'administration pour être modérés.

L'interface d'administration sera protégé par mot de passe.

La rédaction de billets se fera dans une interface WYSIWYG basée sur TinyMCE pour que le client n'ait pas besoin de rédiger son histoire en HTML.

Le développement se fera en PHP sans utiliser de framework pour vous familiariser avec les concepts de base de la programmation. Le code sera construit sur une architecture MVC (Model View Controller). Vous développerez autant que possible en orienté objet (au minimum, le modèle doit être construit sous forme d'objet).
