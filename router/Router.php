<?php
namespace router;

use services\Mail;


class Router
{
    private $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function diriger()
    {
        try {
            /* Backend */
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'addbook') {
                    $backend = $this->container->getControllerBackend();
                    $backend->addBook($_POST['titrelivre']);
                } elseif ($_GET['action'] == 'addchapter') {
                    $backend = $this->container->getControllerBackend();
                    $backend->addChapter();
                } elseif ($_GET['action'] == 'deletechapter') {
                    $backend = $this->container->getControllerBackend();
                    $backend->deleteChapter();
                } elseif ($_GET['action'] == 'modifchapter') {
                    $backend = $this->container->getControllerBackend();
                    $backend->modifChapter();
                } elseif ($_GET['action'] == 'listComments') {
                    $backend = $this->container->getControllerBackend();
                    $backend->listComments();
                } elseif ($_GET['action'] == 'approved') {
                    $backend = $this->container->getControllerBackend();
                    $backend->approvedComments();
                } elseif ($_GET['action'] == 'refused') {
                    $backend = $this->container->getControllerBackend();
                    $backend->refusedComments();
                } elseif ($_GET['action'] == 'listmembres') {
                    $backend = $this->container->getControllerBackend();
                    $backend->listMembres();
                } elseif ($_GET['action'] == 'publier') {
                    $backend = $this->container->getControllerBackend();
                    $backend->Publier();
                } elseif ($_GET['action'] == 'boutonaddbook') {
                    $backend = $this->container->getControllerBackend();
                    $backend->boutonaddbook();
                } elseif ($_GET['action'] == 'boutonmodifchapter') {
                    $backend = $this->container->getControllerBackend();
                    $backend->boutonmodifchapter();
                } elseif ($_GET['action'] == 'boutonaddchapter') {
                    $backend = $this->container->getControllerBackend();
                    $backend->boutonaddchapter();
                } elseif ($_GET['action'] == 'boutondeletechapter') {
                    $backend = $this->container->getControllerBackend();
                    $backend->boutondeletechapter();
                } elseif ($_GET['action'] == 'authentificationAdmin') {
                    $backend = $this->container->getControllerBackend();
                    $backend->connectAdmin();
                } elseif ($_GET['action'] == 'profilAdmin') {
                    $backend = $this->container->getControllerBackend();
                    $backend->profilAdmin();
                } elseif ($_GET['action'] == 'modifmessageAdmin') {
                    $backend = $this->container->getControllerBackend();
                    $backend->modifmessageAdmin();
                } elseif ($_GET['action'] == 'connectAdmin') {
                    $backend = $this->container->getControllerBackend();
                    $backend->connectAdmin();
                } elseif ($_GET['action'] == 'administration') {
                    $backend = $this->container->getControllerBackend();
                    $backend->administration();
                } elseif ($_GET['action'] == 'deconnectAdmin') {
                    $backend = $this->container->getControllerBackend();
                    $backend->deconnectAdmin();
                    /* services */
                } elseif ($_GET['action'] == 'contact') {
                    $backend = new Mail();
                    $backend->Contact();
                    /* Frontend */
                } elseif ($_GET['action'] == 'listChapters') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->listChapters();
                }elseif ($_GET['action'] == 'lastchapter') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->lastChapter();
                } elseif ($_GET['action'] == 'chapter') { // action qui se réalise quand on clique sur le lien "lire la suite"
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->chapter();
                } elseif ($_GET['action'] == 'addComment') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->addComment($_GET['id'], $_SESSION['pseudo'], 0, $_POST['comment'], $_SESSION['id']);
                } elseif ($_GET['action'] == 'Comment') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->comment();
                } elseif ($_GET['action'] == 'listcommentsmembre') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->listCommentsMembre();
                } elseif ($_GET['action'] == 'ModifComment') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->ModifComment();
                } elseif ($_GET['action'] == 'deletecomment') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->deleteComment($_SESSION['id']);
                } elseif ($_GET['action'] == 'signaled') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->SignaledComment($_GET['id']);
                } elseif ($_GET['action'] == 'accueil') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->accueil();
                } elseif ($_GET['action'] == 'connectMembre') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->connectMembre();
                } elseif ($_GET['action'] == 'deconnectMembre') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->deconnectMembre();
                } elseif ($_GET['action'] == 'addMembre') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->addMembre();
                } elseif ($_GET['action'] == 'suppMembre') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->suppMembre();
                } elseif ($_GET['action'] == 'profilMembre') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->profilMembre();
                } elseif ($_GET['action'] == 'inscripMembre') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->inscripMembre();
                } elseif ($_GET['action'] == 'mentionslegales') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->mentionslegales();
                } elseif ($_GET['action'] == 'charte') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->charte();
                } elseif ($_GET['action'] == 'boutonmodifpseudomdp') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->boutonmodifpseudomdp();
                } elseif ($_GET['action'] == 'boutonmodifiermail') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->boutonmodifiermail();
                } elseif ($_GET['action'] == 'boutonafficherlescommentaires') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->boutonafficherlescommentaires();
                } elseif ($_GET['action'] == 'boutonsupprimerprofil') {
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->boutonsupprimerprofil();
                } elseif ($_GET['action'] == 'modifpseudo_mdp'){
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->modifPseudoMdp();
                } elseif ($_GET['action'] == 'modifemail'){
                    $frontend = $this->container->getControllerFrontend();
                    $frontend->modifEmail();
                }
            } else {
                $frontend = $this->container->getControllerFrontend();
                $frontend->accueil();
            }

        }
        catch
        (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}