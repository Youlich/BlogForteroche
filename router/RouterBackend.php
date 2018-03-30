<?php
// faire une classe Router, il a une methode diriger() en fonction de la route
// on execute $frontend->listPosts(); ou $frontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
// il a un attribute $routes c'est un tableau d'instances de Route.
namespace router;
use controler\Backend;
use controler\Frontend;
use services\Mail;


class RouterBackend
{

    public function dirigerBackend()
    {
        try {
            if (isset($_GET['action'])) {

                if ($_GET['action'] == 'listBooks') {
                    $backend = new Backend();
                    $backend->listBooks();

                }elseif ($_GET['action'] == 'bookSelect') {
                    $backend = new Backend();
                    $backend->bookSelect();

                }elseif ($_GET['action'] == 'addbook') {
                    if (!empty($_POST['titrelivre'])) {
                        $backend = new Backend();
                        $backend->addBook($_POST['titrelivre']);
                    } else {
                        throw new \Exception('Tous les champs ne sont pas remplis !');
                    }

                }elseif ($_GET['action'] == 'addchapter') {
                    if (!empty($_POST['titrechapitre'])) {
                        $backend = new Backend();
                        $backend->addChapter($_POST['bookSelect'], $_POST['titrechapitre'], $_POST['content'], $_FILES['image']);
                    }else {
                        throw new \Exception('Tous les champs ne sont pas remplis !');}

                }elseif ($_GET['action'] == 'deletechapter') {
                    if (!empty($_POST['titrechapter'])) {
                        $backend = new Backend();
                        $backend->deleteChapter();
                    } else {
                        throw new \Exception('Tous les champs ne sont pas remplis !');
                    }

                }elseif ($_GET['action'] == 'modifchapter') {
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        $backend = new Backend();
                        $backend->ModifChapter();

                    } else {
                        throw new \Exception('Aucun identifiant de chapitre envoyé');
                    }

                } elseif ($_GET['action'] == 'listComments') {
                    $backend = new Backend();
                    $backend->listComments();


                }elseif ($_GET['action'] == 'approved') {
                    $backend = new Backend();
                    $backend->approvedComments();

                }elseif ($_GET['action'] == 'refused') {
                    $backend = new Backend();
                    $backend->refusedComments();

                } elseif ($_GET['action'] == 'listmembres') {
                    $backend = new Backend();
                    $backend->listMembres();

                } elseif ($_GET['action'] == 'publier') {
                    $backend = new Backend();
                    $backend->Publier();

                } elseif ($_GET['action'] == 'authentificationAdmin') {
                    $backend = new Backend();
                    $backend->connectAdmin();
                }

                elseif ($_GET['action'] =='suppMembre'){
                    $backend = new Backend();
                    $backend->suppMembre();
                }

                elseif ($_GET['action'] == 'contact'){
                    $backend = new Mail();
                    $backend ->Contact();
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
                $frontend = new Frontend();
                $frontend->accueil(); // fonction par défaut détaillée dans frontend.php
            }
        }
        catch
        (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}