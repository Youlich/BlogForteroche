<?php
namespace services;
class Config
{
    public static function start() //static car appelée qu'une seule fois
    {
        $root = $_SERVER['DOCUMENT_ROOT'];
        $host = $_SERVER['HTTP_HOST'];
        define ('HOST','http://'.$host. '/BlogForteroche/');
        define('ROOT',$root);
        define ('CONTROLLER', ROOT . '/controller/');
        define ('VIEWFRONT', ROOT . '/view/frontend/');
        define ('VIEWBACK', ROOT . '/view/backend/');
        define ('MODEL', ROOT . '/model/');
        define ('ENTITY', ROOT . '/entity/');
        define ('ROUTER', ROOT . '/router/');
        define ('SERVICES', ROOT . '/services/');
        define ('CSS', HOST .'assets/css/');
        define ('JS', HOST .'assets/js/');
        define ('TINYMCE', HOST .'assets/js/tinymce/');
        define ('MP', HOST .'assets/magnific-popup/');
        define ('IMAGES', HOST . 'public/images');
    }
    public static function getRoutes()
    {
        return [
            /*Backend*/
            'addbook' => [
                'controller' => 'getControllerBackend',
                'action' => 'addBook',
            ],
            'addchapter' => [
                'controller' => 'getControllerBackend',
                'action' => 'addChapter',
            ],
            'deletechapter' => [
                'controller' => 'getControllerBackend',
                'action' => 'deleteChapter',
            ],
            'modifchapter' => [
                'controller' => 'getControllerBackend',
                'action' => 'modifChapter',
            ],
            'listComments' => [
                'controller' => 'getControllerBackend',
                'action' => 'listComments',
            ],
            'approved' => [
                'controller' => 'getControllerBackend',
                'action' => 'approvedComment',
            ],
            'refused' => [
                'controller' => 'getControllerBackend',
                'action' => 'refusedComment',
            ],
            'listmembres' => [
                'controller' => 'getControllerBackend',
                'action' => 'listMembres',
            ],
            'publier' => [
                'controller' => 'getControllerBackend',
                'action' => 'publier',
            ],
            'boutonaddbook' => [
                'controller' => 'getControllerBackend',
                'action' => 'boutonaddbook',
            ],
            'boutonmodifchapter' => [
                'controller' => 'getControllerBackend',
                'action' => 'boutonmodifchapter',
            ],
            'boutonaddchapter' => [
                'controller' => 'getControllerBackend',
                'action' => 'boutonaddchapter',
            ],
            'boutondeletechapter' => [
                'controller' => 'getControllerBackend',
                'action' => 'boutondeletechapter',
            ],
            'loginadmin' => [
                'controller' => 'getControllerBackend',
                'action' => 'loginadmin',
            ],
            'profiladmin' => [
                'controller' => 'getControllerBackend',
                'action' => 'profiladmin',
            ],
            'modifmessage' => [
                'controller' => 'getControllerBackend',
                'action' => 'modifmessage',
            ],
            'administration' => [
                'controller' => 'getControllerBackend',
                'action' => 'administration',
            ],
            'logoutadmin' => [
                'controller' => 'getControllerBackend',
                'action' => 'logoutadmin',
            ],
            /* Frontend*/
            'listChapters' => [
                'controller' => 'getControllerFrontend',
                'action' => 'listChapters',
            ],
            'lastchapter' => [
                'controller' => 'getControllerFrontend',
                'action' => 'lastChapter',
            ],
            'chapter' => [
                'controller' => 'getControllerFrontend',
                'action' => 'chapter',
            ],
            'addComment' => [
                'controller' => 'getControllerFrontend',
                'action' => 'addComment',
                'params' => $_GET['id'], $_SESSION['pseudo'], 0, $_POST['comment'], $_SESSION['id']
            ],
            'comment' => [
                'controller' => 'getControllerFrontend',
                'action' => 'comment',
            ],
            'listcomments' => [
                'controller' => 'getControllerFrontend',
                'action' => 'listcomments',
            ],
            'modifComment' => [
                'controller' => 'getControllerFrontend',
                'action' => 'modifComment',
            ],
            'deletecomment' => [
                'controller' => 'getControllerFrontend',
                'action' => 'deleteComment',
            ],$params = [$_SESSION['id']],

            'signaled' => [
                'controller' => 'getControllerFrontend',
                'action' => 'signaledComment',
            ],$params = [$_GET['id']],

            'accueil' => [
                'controller' => 'getControllerFrontend',
                'action' => 'accueil',
            ],
            'loginmembre' => [
                'controller' => 'getControllerFrontend',
                'action' => 'loginmembre',
            ],
            'logoutmembre' => [
                'controller' => 'getControllerFrontend',
                'action' => 'logoutmembre',
            ],
            'inscription' => [
                'controller' => 'getControllerFrontend',
                'action' => 'inscription',
            ],
            'deleteaccount' => [
                'controller' => 'getControllerFrontend',
                'action' => 'deleteaccount',
            ],
            'profilmembre' => [
                'controller' => 'getControllerFrontend',
                'action' => 'profilmembre',
            ],
            'versinscription' => [
                'controller' => 'getControllerFrontend',
                'action' => 'versInscription',
            ],
            'mentionslegales' => [
                'controller' => 'getControllerFrontend',
                'action' => 'mentionslegales',
            ],
            'charte' => [
                'controller' => 'getControllerFrontend',
                'action' => 'charte',
            ],
            'boutonmodifpseudomdp' => [
                'controller' => 'getControllerFrontend',
                'action' => 'boutonmodifpseudomdp',
            ],
            'boutonmodifiermail' => [
                'controller' => 'getControllerFrontend',
                'action' => 'boutonmodifiermail',
            ],
            'boutonafficherlescommentaires' => [
                'controller' => 'getControllerFrontend',
                'action' => 'boutonafficherlescommentaires',
            ],
            'boutonsupprimerprofil' => [
                'controller' => 'getControllerFrontend',
                'action' => 'boutonsupprimerprofil',
            ],
            'modifpseudomdp' => [
                'controller' => 'getControllerFrontend',
                'action' => 'modifPseudoMdp',
            ],
            'modifemail' => [
                'controller' => 'getControllerFrontend',
                'action' => 'modifEmail',
            ],
            'contact' => [
                'controller' => 'getControllerMail',
                'action' => 'contact',
            ]
        ];
    }
}


