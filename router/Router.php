<?php
namespace router;


use services\Mail;

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
                    $backend = $backend->approvedComment();
                } elseif ($_GET['action'] == 'refused') {
                    $backend = $backend->refusedComment();
                } elseif ($_GET['action'] == 'listmembres') {
                    $backend = $backend->listMembres();
                } elseif ($_GET['action'] == 'publier') {
                    $backend = $backend->publier();
                } elseif ($_GET['action'] == 'boutonaddbook') {
                    $backend = $backend->boutonaddbook();
                } elseif ($_GET['action'] == 'boutonmodifchapter') {
                    $backend = $backend->boutonmodifchapter();
                } elseif ($_GET['action'] == 'boutonaddchapter') {
                    $backend = $backend->boutonaddchapter();
                } elseif ($_GET['action'] == 'boutondeletechapter') {
                    $backend = $backend->boutondeletechapter();
                } elseif ($_GET['action'] == 'authentification') {
                    $backend = $backend->authentification();
                } elseif ($_GET['action'] == 'profiladmin') {
                    $backend = $backend->profiladmin();
                } elseif ($_GET['action'] == 'modifmessage') {
                    $backend = $backend->modifmessage();
                } elseif ($_GET['action'] == 'loginadmin') {
                    $backend = $backend->loginadmin();
                } elseif ($_GET['action'] == 'administration') {
                    $backend = $backend->administration();
                } elseif ($_GET['action'] == 'logoutadmin') {
                    $backend = $backend->logoutadmin();
    /* services */
                } elseif ($_GET['action'] == 'contact') {
                    $service = new Mail();
                    $service->contact();
     /* Frontend */
                } elseif ($_GET['action'] == 'listChapters') {
                    $frontend = $frontend->listChapters();
                }elseif ($_GET['action'] == 'lastchapter') {
                    $frontend = $frontend->lastChapter();
                } elseif ($_GET['action'] == 'chapter') { // action qui se réalise quand on clique sur le lien "lire la suite"
                    $frontend = $frontend->chapter();
                } elseif ($_GET['action'] == 'addComment') {
                    $frontend = $frontend->addComment($_GET['id'], $_SESSION['pseudo'], 0, $_POST['comment'], $_SESSION['id']);
                } elseif ($_GET['action'] == 'comment') {
                    $frontend = $frontend->comment();
                } elseif ($_GET['action'] == 'listcomments') {
                    $frontend = $frontend->listcomments();
                } elseif ($_GET['action'] == 'modifComment') {
                    $frontend =  $frontend->modifComment();
                } elseif ($_GET['action'] == 'deletecomment') {
                    $frontend = $frontend->deleteComment($_SESSION['id']);
                } elseif ($_GET['action'] == 'signaled') {
                    $frontend = $frontend->signaledComment($_GET['id']);
                } elseif ($_GET['action'] == 'accueil') {
                    $frontend = $frontend->accueil();
                } elseif ($_GET['action'] == 'loginmembre') {
                    $frontend = $frontend->loginmembre();
                } elseif ($_GET['action'] == 'logoutmembre') {
                    $frontend = $frontend->logoutmembre();
                } elseif ($_GET['action'] == 'inscription') {
                    $frontend = $frontend->inscription();
                } elseif ($_GET['action'] == 'deleteaccount') {
                    $frontend = $frontend->deleteaccount();
                } elseif ($_GET['action'] == 'profilmembre') {
                    $frontend = $frontend->profilmembre();
                } elseif ($_GET['action'] == 'versinscription') {
                    $frontend = $frontend->versInscription();
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
                } elseif ($_GET['action'] == 'modifpseudomdp'){
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