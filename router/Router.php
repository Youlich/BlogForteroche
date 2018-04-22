<?php
namespace router;


class Router
{
    private $container;

    public function __construct($container) {
        $this->container = $container;
    }

    public function resolve()
    {

        $backend = $this->container->getControllerBackend();
        $frontend = $this->container->getControllerFrontend();
        $services = $this->container->getControllerServices();

        try {
    /* Backend */
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'addbook') {
                    $backend = $backend->addBook($_POST['titrelivre']);
                } elseif ($_GET['action'] == 'addchapter') {
                    $backend = $backend->addChapter();
                } elseif ($_GET['action'] == 'deletechapter') {
                    $backend = $backend->deleteChapter();
                } elseif ($_GET['action'] == 'modifchapter') {
                    $backend = $backend->modifChapter();
                } elseif ($_GET['action'] == 'listComments') {
                    $backend = $backend->listComments();
                } elseif ($_GET['action'] == 'approved') {
                    $backend = $backend->approvedComments();
                } elseif ($_GET['action'] == 'refused') {
                    $backend = $backend->refusedComments();
                } elseif ($_GET['action'] == 'listmembres') {
                    $backend = $backend->listMembres();
                } elseif ($_GET['action'] == 'publier') {
                    $backend = $backend->Publier();
                } elseif ($_GET['action'] == 'boutonaddbook') {
                    $backend = $backend->boutonaddbook();
                } elseif ($_GET['action'] == 'boutonmodifchapter') {
                    $backend = $backend->boutonmodifchapter();
                } elseif ($_GET['action'] == 'boutonaddchapter') {
                    $backend = $backend->boutonaddchapter();
                } elseif ($_GET['action'] == 'boutondeletechapter') {
                    $backend = $backend->boutondeletechapter();
                } elseif ($_GET['action'] == 'authentificationAdmin') {
                    $backend = $backend->connectAdmin();
                } elseif ($_GET['action'] == 'profilAdmin') {
                    $backend = $backend->profilAdmin();
                } elseif ($_GET['action'] == 'modifmessageAdmin') {
                    $backend = $backend->modifmessageAdmin();
                } elseif ($_GET['action'] == 'connectAdmin') {
                    $backend = $backend->connectAdmin();
                } elseif ($_GET['action'] == 'administration') {
                    $backend = $backend->administration();
                } elseif ($_GET['action'] == 'deconnectAdmin') {
                    $backend = $backend->deconnectAdmin();
    /* services */
                } elseif ($_GET['action'] == 'contact') {
                    $services = $services->Contact();
     /* Frontend */
                } elseif ($_GET['action'] == 'listChapters') {
                    $frontend = $frontend->listChapters();
                }elseif ($_GET['action'] == 'lastchapter') {
                    $frontend = $frontend->lastChapter();
                } elseif ($_GET['action'] == 'chapter') { // action qui se réalise quand on clique sur le lien "lire la suite"
                    $frontend = $frontend->chapter();
                } elseif ($_GET['action'] == 'addComment') {
                    $frontend = $frontend->addComment($_GET['id'], $_SESSION['pseudo'], 0, $_POST['comment'], $_SESSION['id']);
                } elseif ($_GET['action'] == 'Comment') {
                    $frontend = $frontend->comment();
                } elseif ($_GET['action'] == 'listcommentsmembre') {
                    $frontend = $frontend->listCommentsMembre();
                } elseif ($_GET['action'] == 'ModifComment') {
                    $frontend =  $frontend->ModifComment();
                } elseif ($_GET['action'] == 'deletecomment') {
                    $frontend = $frontend->deleteComment($_SESSION['id']);
                } elseif ($_GET['action'] == 'signaled') {
                    $frontend = $frontend->SignaledComment($_GET['id']);
                } elseif ($_GET['action'] == 'accueil') {
                    $frontend = $frontend->accueil();
                } elseif ($_GET['action'] == 'connectMembre') {
                    $frontend = $frontend->connectMembre();
                } elseif ($_GET['action'] == 'deconnectMembre') {
                    $frontend = $frontend->deconnectMembre();
                } elseif ($_GET['action'] == 'addMembre') {
                    $frontend = $frontend->addMembre();
                } elseif ($_GET['action'] == 'suppMembre') {
                    $frontend = $frontend->suppMembre();
                } elseif ($_GET['action'] == 'profilMembre') {
                    $frontend = $frontend->profilMembre();
                } elseif ($_GET['action'] == 'inscripMembre') {
                    $frontend = $frontend->inscripMembre();
                } elseif ($_GET['action'] == 'mentionslegales') {
                    $frontend = $frontend->mentionslegales();
                } elseif ($_GET['action'] == 'charte') {
                    $frontend = $frontend->charte();
                } elseif ($_GET['action'] == 'boutonmodifpseudomdp') {
                    $frontend = $frontend->boutonmodifpseudomdp();
                } elseif ($_GET['action'] == 'boutonmodifiermail') {
                    $frontend = $frontend->boutonmodifiermail();
                } elseif ($_GET['action'] == 'boutonafficherlescommentaires') {
                    $frontend = $frontend->boutonafficherlescommentaires();
                } elseif ($_GET['action'] == 'boutonsupprimerprofil') {
                    $frontend = $frontend->boutonsupprimerprofil();
                } elseif ($_GET['action'] == 'modifpseudo_mdp'){
                    $frontend = $frontend->modifPseudoMdp();
                } elseif ($_GET['action'] == 'modifemail'){
                    $frontend = $frontend->modifEmail();
                }
            } else {
                $frontend = $frontend->accueil();
            }

        }
        catch
        (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}