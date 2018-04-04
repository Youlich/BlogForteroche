<?php
// faire une classe Router, il a une methode diriger() en fonction de la route
// on execute $frontend->listPosts(); ou $frontend->addComment($_GET['id'], $_POST['author'], $_POST['comment']);
// il a un attribute $routes c'est un tableau d'instances de Route.
namespace router;
use controler\Backend;
use controler\Frontend;
use services\Mail;
class Router
{
    public function diriger()
    {
        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'addbook') {
                    $backend = new Backend();
                    $backend->addBook($_POST['titrelivre']);

                } elseif ($_GET['action'] == 'addchapter') {
                    $backend = new Backend();
                    $backend->addChapter($_POST['bookSelect'], $_POST['titrechapitre'], $_POST['content'], $_FILES['image']);

                } elseif ($_GET['action'] == 'deletechapter') {
                    $backend = new Backend();
                    $backend->deleteChapter();

                } elseif ($_GET['action'] == 'modifchapter') {
                    $backend = new Backend();
                    $backend->ModifChapter();

                } elseif ($_GET['action'] == 'listComments') {
                    $backend = new Backend();
                    $backend->listComments();

                } elseif ($_GET['action'] == 'approved') {
                    $backend = new Backend();
                    $backend->approvedComments();

                } elseif ($_GET['action'] == 'refused') {
                    $backend = new Backend();
                    $backend->refusedComments();

                } elseif ($_GET['action'] == 'listmembres') {
                    $backend = new Backend();
                    $backend->listMembres();

                } elseif ($_GET['action'] == 'publier') {
                    $backend = new Backend();
                    $backend->Publier();

                } elseif ($_GET['action'] == 'boutonaddbook') {
                    $backend = new Backend();
                    $backend->boutonaddbook();

                } elseif ($_GET['action'] == 'boutonmodifchapter') {
                    $backend = new Backend();
                    $backend->boutonmodifchapter();

                } elseif ($_GET['action'] == 'boutonaddchapter') {
                    $backend = new Backend();
                    $backend->boutonaddchapter();

                } elseif ($_GET['action'] == 'boutondeletechapter') {
                    $backend = new Backend();
                    $backend->boutondeletechapter();

                } elseif ($_GET['action'] == 'authentificationAdmin') {
                    $backend = new Backend();
                    $backend->connectAdmin();

                } elseif ($_GET['action'] == 'profilAdmin') {
                    $backend = new Backend();
                    $backend->profilAdmin();
                } elseif ($_GET['action'] == 'modifAdmin') {
                    $backend = new Backend();
                    $backend->modifAdmin();
                } elseif ($_GET['action'] == 'suppMembre') {
                    $backend = new Backend();
                    $backend->suppMembre();
                } elseif ($_GET['action'] == 'contact') {
                    $backend = new Mail();
                    $backend->Contact();
                } elseif ($_GET['action'] == 'connectAdmin') {
                    $backend = new Backend();
                    $backend->connectAdmin();
                } elseif ($_GET['action'] == 'administration') {
                    $backend = new Backend();
                    $backend->administration();
                } elseif ($_GET['action'] == 'deconnectAdmin') {
                    $backend = new Backend();
                    $backend->deconnectAdmin();
                } elseif ($_GET['action'] == 'listChapters') { // c'est l'action par défaut , la fonction qui affiche tous les chapitres et qui est détaillée dans le frontend.php
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
                } elseif ($_GET['action'] == 'deletecomment') {
                    $frontend = new Frontend();
                    $frontend->deleteComment();

                } elseif ($_GET['action'] == 'signaled') {
                    $frontend = new Frontend();
                    $frontend->SignaledComment($_GET['id']);

                } elseif ($_GET['action'] == 'accueil') {
                    $frontend = new Frontend();
                    $frontend->accueil();


                } elseif ($_GET['action'] == 'connectMembre') {
                    $frontend = new Frontend();
                    $frontend->connectMembre();
                } elseif ($_GET['action'] == 'deconnectMembre') {
                    $frontend = new Frontend();
                    $frontend->deconnectMembre();
                } elseif ($_GET['action'] == 'addMembre') {
                    $frontend = new Frontend();
                    $frontend->addMembre();
                } elseif ($_GET['action'] == 'profilMembre') {
                    $frontend = new Frontend();
                    $frontend->profilMembre();
                } elseif ($_GET['action'] == 'inscripMembre') {
                    $frontend = new Frontend();
                    $frontend->inscripMembre();
                } elseif ($_GET['action'] == 'mentionslegales') {
                    $frontend = new Frontend();
                    $frontend->mentionslegales();
                } elseif ($_GET['action'] == 'charte') {
                    $frontend = new Frontend();
                    $frontend->charte();
                } elseif ($_GET['action'] == 'boutonmodifpseudomdp') {
                    $frontend = new Frontend();
                    $frontend->boutonmodifpseudomdp();
                } elseif ($_GET['action'] == 'boutonmodifiermail') {
                    $frontend = new Frontend();
                    $frontend->boutonmodifiermail();
                }
                elseif ($_GET['action'] == 'boutonafficherlescommentaires') {
                    $frontend = new Frontend();
                    $frontend->boutonafficherlescommentaires();
                }
                elseif ($_GET['action'] == 'boutonsupprimerprofil') {
                    $frontend = new Frontend();
                    $frontend->boutonsupprimerprofil();
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
            
        }
        catch
        (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}