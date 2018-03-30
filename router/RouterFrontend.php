<?php

namespace router;

use controler\Frontend;

class RouterFrontend
{
    public function dirigerFrontend()
    {
        try {
            if (isset($_GET['action'])) {

                if ($_GET['action'] == 'listChapters') { // c'est l'action par défaut , la fonction qui affiche tous les chapitres et qui est détaillée dans le frontend.php
                    $frontend = new Frontend();
                    $frontend->listChapters();

                } elseif ($_GET['action'] == 'chapter') { // action qui se réalise quand on clique sur le lien "lire la suite"
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $frontend = new Frontend();
                        $frontend->chapter();
                    } else {
                        throw new \Exception('Aucun identifiant de chapitre envoyé');
                    }

                } elseif ($_GET['action'] == 'addComment') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        if (!empty($_SESSION['pseudo']) && !empty($_POST['comment'])) {
                            $frontend = new Frontend();
                            $frontend->addComment($_GET['id'], $_SESSION['pseudo'], 0, $_POST['comment'], $_SESSION['id']);
                        } else {
                            throw new \Exception('Tous les champs ne sont pas remplis !');
                        }
                    } else {
                        throw new \Exception('Aucun identifiant de billet envoyé');
                    }
                } elseif ($_GET['action'] == 'Comment') {
                    if (isset($_GET['numComm']) && $_GET['numComm'] > 0) {
                        $frontend = new Frontend();
                        $frontend->comment();
                    } else {
                        throw new \Exception('Aucun identifiant de commentaire envoyé');
                    }

                } elseif ($_GET['action'] == 'listcommentsmembre') {
                    $frontend = new Frontend();
                    $frontend->listCommentsMembre();


                } elseif ($_GET['action'] == 'ModifComment') {
                    if (isset($_GET['numComm']) && $_GET['numComm'] > 0) {
                        if (!empty($_SESSION['pseudo']) && !empty($_POST['comment'])) {
                            $frontend = new Frontend();
                            $frontend->ModifComment();
                        } else {
                            throw new \Exception('Tous les champs ne sont pas remplis !');
                        }
                    } else {
                        throw new \Exception('Aucun identifiant de billet envoyé');
                    }
                }elseif ($_GET['action'] == 'deletecomment') {
                    $frontend = new Frontend();
                    $frontend->deleteComment();

                }elseif ($_GET['action'] == 'signaled') {
                    $frontend = new Frontend();
                    $frontend->SignaledComment($_GET['id']);

                } elseif ($_GET['action'] == 'accueil') {
                    $frontend = new Frontend();
                    $frontend->accueil();


                }   elseif ($_GET['action'] == 'connectMembre') {
                    $frontend = new Frontend();
                    $frontend->connectMembre();
                }

                elseif ($_GET['action'] == 'deconnectMembre') {
                    $frontend = new Frontend();
                    $frontend->deconnectMembre();
                }

                elseif ($_GET['action'] == 'addMembre') {
                    $frontend = new Frontend();
                    $frontend->addMembre();
                }
                elseif ($_GET['action']=='profilMembre')
                {
                    $frontend = new Frontend();
                    $frontend->profilMembre();
                }

                elseif ($_GET['action'] == 'inscripMembre')
                {
                    $frontend = new Frontend();
                    $frontend->inscripMembre();
                }

                elseif ($_GET['action'] == 'mentionslegales') {
                    $frontend = new Frontend();
                    $frontend->mentionslegales();
                }

                elseif ($_GET['action'] == 'charte') {
                    $frontend = new Frontend();
                    $frontend->charte();
                }
                elseif ($_GET['action'] == 'modifpseudo_mdp'){
                    $frontend = new Frontend();
                    $frontend->modifPseudoMdp();
                }

                elseif ($_GET['action'] == 'modifemail'){
                    $frontend = new Frontend();
                    $frontend->modifEmail();
                }

                } else {
                $frontend = new Frontend();
                $frontend->accueil();
            }
        } catch
            (\Exception $e) {
                echo 'Erreur : ' . $e->getMessage();
            }

    }
}