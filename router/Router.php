<?php
namespace router;
use controler\Backend;
use controler\Frontend;
use model\AdminManager;
use model\BooksManager;
use model\ChapterManager;
use model\CommentManager;
use model\ImagesManager;
use model\MembreManager;
use services\Mail;

class Router
{
    public function diriger()
    {
        try {

/* Backend */
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'addbook') {
                    $backend = new Backend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $backend->addBook($_POST['titrelivre']);

                } elseif ($_GET['action'] == 'addchapter') {
                    $backend = new Backend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $backend->addChapter();

                } elseif ($_GET['action'] == 'deletechapter') {
                    $backend = new Backend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $backend->deleteChapter();

                } elseif ($_GET['action'] == 'modifchapter') {
                    $backend = new Backend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $backend->modifChapter();

                } elseif ($_GET['action'] == 'listComments') {
                    $backend = new Backend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $backend->listComments();

                } elseif ($_GET['action'] == 'approved') {
                    $backend = new Backend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $backend->approvedComments();

                } elseif ($_GET['action'] == 'refused') {
                    $backend = new Backend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $backend->refusedComments();

                } elseif ($_GET['action'] == 'listmembres') {
                    $backend = new Backend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $backend->listMembres();

                } elseif ($_GET['action'] == 'publier') {
                    $backend = new Backend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $backend->Publier();

                } elseif ($_GET['action'] == 'boutonaddbook') {
                    $backend = new Backend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $backend->boutonaddbook();

                } elseif ($_GET['action'] == 'boutonmodifchapter') {
                    $backend = new Backend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $backend->boutonmodifchapter();

                } elseif ($_GET['action'] == 'boutonaddchapter') {
                    $backend = new Backend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $backend->boutonaddchapter();

                } elseif ($_GET['action'] == 'boutondeletechapter') {
                    $backend = new Backend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $backend->boutondeletechapter();

                } elseif ($_GET['action'] == 'authentificationAdmin') {
                    $backend = new Backend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $backend->connectAdmin();

                } elseif ($_GET['action'] == 'profilAdmin') {
                    $backend = new Backend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $backend->profilAdmin();

                } elseif ($_GET['action'] == 'modifmessageAdmin') {
                    $backend = new Backend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $backend->modifmessageAdmin();


                } elseif ($_GET['action'] == 'connectAdmin') {
                    $backend = new Backend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $backend->connectAdmin();

                } elseif ($_GET['action'] == 'administration') {
                    $backend = new Backend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $backend->administration();
                } elseif ($_GET['action'] == 'deconnectAdmin') {
                    $backend = new Backend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $backend->deconnectAdmin();

 /* services */
                } elseif ($_GET['action'] == 'contact') {
                    $backend = new Mail();
                    $backend->Contact();

/* Frontend */

                } elseif ($_GET['action'] == 'listChapters') {
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->listChapters();

                }elseif ($_GET['action'] == 'lastchapter') {
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->lastChapter();

                } elseif ($_GET['action'] == 'chapter') { // action qui se réalise quand on clique sur le lien "lire la suite"
                     $frontend = new Frontend(new MembreManager(),
                         new AdminManager(),
                         new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                         new ChapterManager(new ImagesManager()),
                         new BooksManager(),
                         new ImagesManager());
                     $frontend->chapter();

                } elseif ($_GET['action'] == 'addComment') {
                     $frontend = new Frontend(new MembreManager(),
                         new AdminManager(),
                         new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                         new ChapterManager(new ImagesManager()),
                         new BooksManager(),
                         new ImagesManager());
                     $frontend->addComment($_GET['id'], $_SESSION['pseudo'], 0, $_POST['comment'], $_SESSION['id']);

                } elseif ($_GET['action'] == 'Comment') {
                   $frontend = new Frontend(new MembreManager(),
                       new AdminManager(),
                       new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                       new ChapterManager(new ImagesManager()),
                       new BooksManager(),
                       new ImagesManager());
                   $frontend->comment();

                } elseif ($_GET['action'] == 'listcommentsmembre') {
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->listCommentsMembre();

                } elseif ($_GET['action'] == 'ModifComment') {
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->ModifComment();

                } elseif ($_GET['action'] == 'deletecomment') {
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->deleteComment($_SESSION['id']);

                } elseif ($_GET['action'] == 'signaled') {
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->SignaledComment($_GET['id']);

                } elseif ($_GET['action'] == 'accueil') {
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->accueil();

                } elseif ($_GET['action'] == 'connectMembre') {
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->connectMembre();

                } elseif ($_GET['action'] == 'deconnectMembre') {
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->deconnectMembre();

                } elseif ($_GET['action'] == 'addMembre') {
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->addMembre();

                } elseif ($_GET['action'] == 'suppMembre') {
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->suppMembre();

                } elseif ($_GET['action'] == 'profilMembre') {
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->profilMembre();

                } elseif ($_GET['action'] == 'inscripMembre') {
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->inscripMembre();

                } elseif ($_GET['action'] == 'mentionslegales') {
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->mentionslegales();

                } elseif ($_GET['action'] == 'charte') {
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->charte();

                } elseif ($_GET['action'] == 'boutonmodifpseudomdp') {
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->boutonmodifpseudomdp();

                } elseif ($_GET['action'] == 'boutonmodifiermail') {
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->boutonmodifiermail();

                } elseif ($_GET['action'] == 'boutonafficherlescommentaires') {
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->boutonafficherlescommentaires();

                } elseif ($_GET['action'] == 'boutonsupprimerprofil') {
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->boutonsupprimerprofil();

                } elseif ($_GET['action'] == 'modifpseudo_mdp'){
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->modifPseudoMdp();

                } elseif ($_GET['action'] == 'modifemail'){
                    $frontend = new Frontend(new MembreManager(),
                        new AdminManager(),
                        new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                        new ChapterManager(new ImagesManager()),
                        new BooksManager(),
                        new ImagesManager());
                    $frontend->modifEmail();
                }

                } else {
                $frontend = new Frontend(new MembreManager(),
                    new AdminManager(),
                    new CommentManager(new ChapterManager(new ImagesManager()), new BooksManager()),
                    new ChapterManager(new ImagesManager()),
                    new BooksManager(),
                    new ImagesManager());
                $frontend->accueil();
            }
            
        }
        catch
        (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }
}