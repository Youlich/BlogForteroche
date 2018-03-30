<?php
// faire une classe Router, il a une methode diriger() en fonction de la route
// on execute $frontend->listPosts(); ou $frontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
// il a un attribute $routes c'est un tableau d'instances de Route.
namespace router;
use controler\Backend;
use controler\Frontend;
use services\Mail;

session_start();
class Router
{
    private $routes;
    public function diriger ()
    {
        try {
            if (isset($_GET['action'])) {

                if ($_GET['action'] == 'listBooks') {
                    $backend = new Backend();
                    $backend->listBooks();

                }elseif ($_GET['action'] == 'listChapters') { // c'est l'action par défaut , la fonction qui affiche tous les chapitres et qui est détaillée dans le frontend.php
                    $frontend = new \controler\Frontend();
                    $frontend->listChapters();

                } elseif ($_GET['action'] == 'chapter') { // action qui se réalise quand on clique sur le lien "lire la suite"
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $frontend = new \controler\Frontend();
                        $frontend->chapter();
                    } else {
                        throw new \Exception('Aucun identifiant de chapitre envoyé');
                    }

                } elseif ($_GET['action'] == 'addComment') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        if (!empty($_SESSION['pseudo']) && !empty($_POST['comment'])) {
                            $frontend = new \controler\Frontend();
                            $frontend->addComment($_GET['id'], $_SESSION['pseudo'], 0, $_POST['comment'], $_SESSION['id']);
                        } else {
                            throw new \Exception('Tous les champs ne sont pas remplis !');
                        }
                    } else {
                        throw new \Exception('Aucun identifiant de billet envoyé');
                    }

                }elseif ($_GET['action'] == 'addbook') {
                    if (!empty($_POST['titrelivre'])) {
                        $backend = new \controler\Backend();
                        $backend->addBook($_POST['titrelivre']);
                    }else {
                        throw new \Exception('Tous les champs ne sont pas remplis !');}

                }elseif ($_GET['action'] == 'addchapter') {
                    if (!empty($_POST['titrechapitre'])) {
                        $backend = new \controler\Backend();
                        $backend->addChapter($_POST['bookSelect'], $_POST['titrechapitre'], $_POST['content'], $_FILES['image']);
                    }else {
                        throw new \Exception('Tous les champs ne sont pas remplis !');}

                }elseif ($_GET['action'] == 'deletechapter') {
                    if (!empty($_POST['titrechapter'])) {
                        $backend = new \controler\Backend();
                        $backend->deleteChapter();
                    } else {
                        throw new \Exception('Tous les champs ne sont pas remplis !');
                    }

                }elseif ($_GET['action'] == 'modifchapter') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $backend = new \controler\Backend();
                        $backend->ModifChapter();

                    } else {
                        throw new \Exception('Aucun identifiant de chapitre envoyé');
                    }


                } elseif ($_GET['action'] == 'Comment') {
                    if (isset($_GET['numComm']) && $_GET['numComm'] > 0) {
                        $frontend = new \controler\Frontend();
                        $frontend->comment();
                    } else {
                        throw new \Exception('Aucun identifiant de commentaire envoyé');
                    }

                } elseif ($_GET['action'] == 'listComments') {
                    $backend = new \controler\Backend();
                    $backend->listComments();

                } elseif ($_GET['action'] == 'listcommentsmembre') {
                    $frontend = new \controler\Frontend();
                    $frontend->listCommentsMembre();


                } elseif ($_GET['action'] == 'ModifComment') {
                    if (isset($_GET['numComm']) && $_GET['numComm'] > 0) {
                        if (!empty($_SESSION['pseudo']) && !empty($_POST['comment'])) {
                            $frontend = new \controler\Frontend();
                            $frontend->ModifComment();
                        } else {
                            throw new \Exception('Tous les champs ne sont pas remplis !');
                        }
                    } else {
                        throw new \Exception('Aucun identifiant de billet envoyé');
                    }

                }elseif ($_GET['action'] == 'approved') {
                    $backend = new Backend();
                    $backend->approvedComments();

                }elseif ($_GET['action'] == 'refused') {
                    $backend = new Backend();
                    $backend->refusedComments();

                }elseif ($_GET['action'] == 'deletecomment') {
                    $frontend = new Frontend();
                    $frontend->deleteComment();

                }elseif ($_GET['action'] == 'signaled') {
                    $frontend = new Frontend();
                    $frontend->SignaledComment($_GET['id']);


                } elseif ($_GET['action'] == 'listmembres') {
                    $backend = new \controler\Backend();
                    $backend->listMembres();

                } elseif ($_GET['action'] == 'publier') {
                    $backend = new Backend();
                    $backend->Publier();

                }elseif ($_GET['action'] == 'selectbook') {
                    $backend = new Backend();
                    $backend->selectbook();

                } elseif ($_GET['action'] == 'accueil') {
                    $frontend = new \controler\Frontend();
                    $frontend->accueil();


                }   elseif ($_GET['action'] == 'connectMembre') {
                    $frontend = new \controler\Frontend();
                    $frontend->connectMembre();
                }

                elseif ($_GET['action'] == 'deconnectMembre') {
                    $frontend = new \controler\Frontend();
                    $frontend->deconnectMembre();
                }

                elseif ($_GET['action'] == 'authentificationAdmin') {
                    $backend = new \controler\Backend();
                    $backend->connectAdmin();
                }

                elseif ($_GET['action'] == 'addMembre') {
                    $frontend = new \controler\Frontend();
                    $frontend->addMembre();
                }

                elseif ($_GET['action'] =='suppMembre'){
                    $backend = new Backend();
                    $backend->suppMembre();
                }

                elseif ($_GET['action']=='profilMembre')
                {
                    $frontend = new Frontend();
                    $frontend->profilMembre();
                }

                elseif ($_GET['action'] == 'inscripMembre')
                {
                        $frontend = new \controler\Frontend();
                        $frontend->inscripMembre();
                }

                elseif ($_GET['action'] == 'mentionslegales') {
                    $frontend = new \controler\Frontend();
                    $frontend->mentionslegales();
                }

                elseif ($_GET['action'] == 'charte') {
                    $frontend = new \controler\Frontend();
                    $frontend->charte();
                }

                elseif ($_GET['action'] == 'contact'){
                    $backend = new Mail();
                    $backend ->Contact();
                }

                elseif ($_GET['action'] == 'modifpseudo_mdp'){
                    $frontend = new \controler\Frontend();
                    $frontend->modifPseudoMdp();
                }

                elseif ($_GET['action'] == 'modifemail'){
                    $frontend = new \controler\Frontend();
                    $frontend->modifEmail();
                }

                elseif ($_GET['action'] == 'connectAdmin'){
                    $backend = new Backend();
                    $backend->connectAdmin();
                }

                elseif ($_GET['action'] == 'administration'){
                    $backend = new Backend();
                    $backend->administration();
                }

                elseif ($_GET['action'] == 'deconnectAdmin'){
                    $backend = new Backend();
                    $backend->deconnectAdmin();
                }

            } else {
                $frontend = new \controler\Frontend();
                $frontend->accueil(); // fonction par défaut détaillée dans frontend.php
            }
        }
        catch
        (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}