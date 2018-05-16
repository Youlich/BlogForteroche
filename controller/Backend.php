<?php
namespace controller;
use entity\Books;
use entity\Chapter;
use services\View;


\Autoload::register();
/**
 * Class Backend
 * @package controller Backend
 */
Class Backend extends Controller {
	/**
	 * @var
	 */
	private $membreManager;
	private $adminManager;
	private $commentManager;
	private $chapterManager;
	private $booksManager;
	private $imagesManager;

	/** injection de dépendances : appelle de tous les modèles */
	public function __construct( $membreManager, $adminManager, $commentManager, $chapterManager, $booksManager, $imagesManager ) {
		$this->membreManager  = $membreManager;
		$this->adminManager   = $adminManager;
		$this->commentManager = $commentManager;
		$this->chapterManager = $chapterManager;
		$this->booksManager   = $booksManager;
		$this->imagesManager  = $imagesManager;
	}

// connexion et déconnexion de l'administrateur

	/**
	 * Fonction loginAdmin qui permet d'appeler la fonction loginAdmin du model AdminManager et d'afficher la vue loginadmin
	 */
	public function loginAdmin() {
		$authMembreManager = $this->adminManager;
		$authMembreManager->loginAdmin();
		$success = ( isset( $_SESSION['success'] ) ? $_SESSION['success'] : null );
		$error   = ( isset( $_SESSION['error'] ) ? $_SESSION['error'] : null );
		$myView  = new View( 'loginadmin' );
		$myView->renderView( array( 'success' => $success, 'error' => $error ) );
	}

	/**
	 * Fonction qui détruit la session administrateur en cas de déconnexion de celui-ci
	 */

	public function logoutAdmin() {
		session_destroy();
		$this->redirect( 'Location: index.php' );
		exit();
	}
// page comprenant les 4 images : publications, membres, commentaires et profil

	/**
	 * appel du template administration
	 */
	public function administration() {
		$success = ( isset( $_SESSION['success'] ) ? $_SESSION['success'] : null );
		$error   = ( isset( $_SESSION['error'] ) ? $_SESSION['error'] : null );
		$login   = ( isset( $_SESSION['login'] ) ? $_SESSION['login'] : null );
		$myView  = new View( 'administration' );
		$myView->renderView( array( 'success' => $success, 'error' => $error, 'login' => $login ) );
	}


// gestion des  publications

	/**
	 * permet l'affichage du template publier
	 */
	public function publier() {
		$success = ( isset( $_SESSION['success'] ) ? $_SESSION['success'] : null );
		$error   = ( isset( $_SESSION['error'] ) ? $_SESSION['error'] : null );
		$myView  = new View( 'publier' );
		$myView->renderView( array( 'success' => $success, 'error' => $error ) );
	}

	/**
	 * permet l'affichage du contenu du bouton avec le template boutonaddbook
	 */
	public function boutonaddbook() {
		$success = ( isset( $_SESSION['success'] ) ? $_SESSION['success'] : null );
		$error   = ( isset( $_SESSION['error'] ) ? $_SESSION['error'] : null );
		$myView  = new View( 'boutonaddbook' );
		$myView->renderView( array( 'success' => $success, 'error' => $error ) );
	}

	/**
	 * @param $title
	 * appel de la fonction addBook de bookManager et affiche le template boutonaddbook
	 */
	public function addBook( $title ) {
		$BookManager = $this->booksManager;
		$book        = new Books();
		$book->setTitle( $title );
		$addbook = $BookManager->addBook( $book );
		if ( $addbook === false ) {
			$_SESSION['error'] = 'Impossible d\'ajouter le livre !';
			$this->redirect( 'Location: index.php?action=boutonaddbook' . "#endpage" );
		} else {
			$_SESSION['success'] = 'Votre nouveau livre a bien été ajouté';
			$this->redirect( 'Location: index.php?action=boutonaddbook' . "#endpage" );
		}
	}

	/**
	 * permet l'affichage du contenu du bouton avec le template boutonaddchapter
	 */
	public function boutonaddchapter() {
		$bookManager = $this->booksManager;
		$books       = $bookManager->getBooks();
		if ( isset( $_POST['bookSelect'] ) ) {
			$bookSelect   = $bookManager->getBook( $_POST['bookSelect'] );
			$bookId       = $bookManager->getBook( $_POST['bookSelect'] )->getId();
			$selectedbook = $bookSelect->getTitle();
		} else {
			$selectedbook = "Choisissez votre livre";
		}
		$success    = ( isset( $_SESSION['success'] ) ? $_SESSION['success'] : null );
		$error      = ( isset( $_SESSION['error'] ) ? $_SESSION['error'] : null );
		$bookId     = ( isset( $bookId ) ? $bookId : null );
		$bookSelect = ( isset( $_POST['bookSelect'] ) ? $_POST['bookSelect'] : null );
		$myView     = new View( 'boutonaddchapter' );
		$myView->renderView( array(
			'books'        => $books,
			'bookId'       => $bookId,
			'selectedbook' => $selectedbook,
			'success'      => $success,
			'error'        => $error,
			'bookSelect'   => $bookSelect
		) );
	}

	/**
	 * permet l'ajout d'un nouveau chapitre
	 */
	public function addChapter() {
		$chaptermanager = $this->chapterManager;
		$chapter        = new Chapter();
		$chapter->setBookId( $_POST['bookSelect'] );
		$chapter->setTitle( $_POST['titrechapitre'] );
		$chapter->setContent( $_POST['content'] );
		$resum = $chaptermanager->resumContent( $_POST['content'] );
		$chapter->getResum( $resum );
		$chapter->setImageId( '0' );
		if ( $_FILES['image']['name'] == '' ) {
			$Chaptersansimage    = $this->chapterManager;
			$addchaptersansimage = $Chaptersansimage->addChapter( $chapter );
			if ( $addchaptersansimage === false ) {
				$_SESSION['error'] = 'Impossible d\'ajouter votre chapitre !';
				$this->redirect( 'Location: index.php?action=boutonaddchapter' . "#endpage" );
			} else {
				$_SESSION['success'] = 'Votre chapitre a bien été ajouté';
				$this->redirect( 'Location: index.php?action=boutonaddchapter' . "#endpage" );
			}
		} else {
			$imagemanager = $this->imagesManager;
			$uploadResult = $imagemanager->upload();
			$chapter->setImageId( $uploadResult['imageId'] );
			if ( $uploadResult['result'] ) {
				$ChapterManager = $this->chapterManager;
				$Addchapter     = $ChapterManager->addChapter( $chapter );
				if ( $Addchapter === false ) {
					$_SESSION['error'] = 'Votre chapitre n\'a pas pu être ajouté';
					$this->redirect( 'Location: index.php?action=boutonaddchapter' . "#endpage" );
				} else {
					$chapterId  = $Addchapter;
					$modifimage = $imagemanager->modifChapterImage( $chapterId );
					if ( $modifimage === false ) {
						$_SESSION['error'] = 'Votre image n\'a pas pu être ajoutée au chapitre';
						$this->redirect( 'Location: index.php?action=boutonaddchapter' . "#endpage" );
					} else {
						$_SESSION['success'] = 'Votre chapitre a bien été ajouté avec son image';
						$this->redirect( 'Location: index.php?action=boutonaddchapter' . "#endpage" );
					}
				}
			} else {
				$_SESSION['error'] = 'Votre image n\'a pas pu être téléchargée';
				$this->redirect( 'Location: index.php?action=boutonaddchapter' . "#endpage" );
			}
		}
	}

	/**
	 * permet l'affichage du contenu du bouton avec le template boutonaddbook boutonmodifchapter
	 */

	public function boutonmodifchapter() {
		$chapterManager = $this->chapterManager;
		$chapters       = $chapterManager->listChapters();
		if ( isset( $_POST['chapterselect'] ) ) {
			$chapterselect   = $chapterManager->getChapter( $_POST['chapterselect'] );
			$selectedchapter = $chapterselect->getTitle();
			$imageexist      = $chapterselect->getImageId();
			if ( $imageexist != '0' ) {
				$imageManager = $this->imagesManager;
				$imageselect  = $imageManager->getImage( $_POST['chapterselect'] );
				$image        = $imageselect->getFileUrl();
				$message      = '';
			} else {
				$image   = '';
				$message = "Vous n'avez pas encore inséré d'image pour ce chapitre";
			}
		} else {
			$selectedchapter = "Choisissez votre chapitre";
		}
		$chapterselect = ( isset( $chapterselect ) ? $chapterselect : null );
		$image         = ( isset( $image ) ? $image : null );
		$message       = ( isset( $message ) ? $message : null );
		$success       = ( isset( $_SESSION['success'] ) ? $_SESSION['success'] : null );
		$error         = ( isset( $_SESSION['error'] ) ? $_SESSION['error'] : null );
		$myView        = new View( 'boutonmodifchapter' );
		$myView->renderView( array(
			'chapters'        => $chapters,
			'selectedchapter' => $selectedchapter,
			'chapterselect'   => $chapterselect,
			'message'         => $message,
			'image'           => $image,
			'success'         => $success,
			'error'           => $error
		) );
	}


	public function modifChapter() {
		$chaptermanager = $this->chapterManager;
		$resum          = $chaptermanager->resumContent( $_POST['content'] );
		if ( $_FILES['image']['name'] == '' ) {
			$ModifManager = $this->chapterManager;
			$chapter      = $ModifManager->getChapter( $_POST['chapterselect'] );
			$chapter->setTitle( $_POST['titrechapter'] );
			$chapter->setContent( $_POST['content'] );
			$chapter->setResum( $resum );
			$modifLines = $ModifManager->modifChaptersansUpload( $chapter );
			if ( $modifLines === false ) {
				$_SESSION['error'] = 'Impossible de modifier le chapitre !';
				$this->redirect( 'Location: index.php?action=boutonmodifchapter' . "#endpage" );
			} else {
				$_SESSION['success'] = 'Votre chapitre a bien été modifié';
				$this->redirect( 'Location: index.php?action=boutonmodifchapter' . "#endpage" );
			}
		} else {
			$imagemanager = $this->imagesManager;
			$uploadResult = $imagemanager->upload();
			if ( $uploadResult['result'] ) {
				$ModifManager = $this->chapterManager;
				$chapter      = $ModifManager->getChapter( $_POST['chapterselect'] );
				$chapter->setTitle( $_POST['titrechapter'] );
				$chapter->setContent( $_POST['content'] );
				$chapter->setResum( $resum );
				$chapter->setImageId( $uploadResult['imageId'] );
				$modifLines          = $ModifManager->modifChapter( $chapter );
				$_SESSION['success'] = 'Votre chapitre a bien été modifié';
				$this->redirect( 'Location: index.php?action=boutonmodifchapter' . "#endpage" );
				if ( $modifLines === false ) {
					$_SESSION['error'] = 'Impossible de modifier le chapitre !';
					$this->redirect( 'Location: index.php?action=boutonmodifchapter' . "#endpage" );
				} else {
					$chapterId  = $_POST['chapterselect'];
					$modifimage = $imagemanager->modifChapterImage( $chapterId );
					if ( $modifimage === false ) {
						$_SESSION['error'] = 'Impossible de modifier l\'image dans le chapitre';
						$this->redirect( 'Location: index.php?action=boutonmodifchapter' . "#endpage" );
					} else {
						$_SESSION['success'] = 'Votre chapitre a bien été modifié avec son image';
						$this->redirect( 'Location: index.php?action=boutonmodifchapter' . "#endpage" );
					}
				}
			} else {
				$_SESSION['error'] = 'Votre image n\'a pas pu être téléchargée';
				$this->redirect( 'Location: index.php?action=boutonmodifchapter' . "#endpage" );
			}
		}
	}
	/**
	 * permet l'affichage du contenu du bouton avec le template boutondeletechapter
	 */
	public function boutondeletechapter() {
		$chapterManager = $this->chapterManager;
		$chapters       = $chapterManager->listChapters();
		if ( isset( $_POST['chapterselect'] ) ) {
			$chapterselect   = $chapterManager->getChapter( $_POST['chapterselect'] );
			$selectedchapter = $chapterselect->getTitle();
			$imageexist      = $chapterselect->getImageId();
			if ( $imageexist != '0' ) {
				$imageManager = $this->imagesManager;
				$imageselect  = $imageManager->getImage( $_POST['chapterselect'] );
				$image        = $imageselect->getFileUrl();
				$message      = '';
			} else {
				$image   = '';
				$message = "Pas d'image pour ce chapitre";
			}
		} else {
			$selectedchapter = "Choisissez votre chapitre";
		}
		$chapterselect = ( isset( $chapterselect ) ? $chapterselect : null );
		$image         = ( isset( $image ) ? $image : null );
		$message       = ( isset( $message ) ? $message : null );
		$success       = ( isset( $_SESSION['success'] ) ? $_SESSION['success'] : null );
		$error         = ( isset( $_SESSION['error'] ) ? $_SESSION['error'] : null );
		$myView        = new View( 'boutondeletechapter' );
		$myView->renderView( array(
			'chapters'        => $chapters,
			'selectedchapter' => $selectedchapter,
			'chapterselect'   => $chapterselect,
			'message'         => $message,
			'image'           => $image,
			'success'         => $success,
			'error'           => $error
		) );
	}

	public function deleteChapter($chapterselect) {
		$chapterManager = $this->chapterManager;
		$chapter        = $chapterManager->getChapter($chapterselect);
		$supp           = $chapterManager->deleteChapter($chapter);
		if ( $supp === true ) {
			$imageManager        = $this->imagesManager;
			$deleteImageassoc    = $imageManager->deleteImage($_POST['chapterselect'] );
			$_SESSION['success'] = "Votre chapitre a bien été supprimé";
		} else {
			$_SESSION['error'] = "Votre chapitre n'a pas pu être supprimé";
		}
		$this->redirect( 'Location: index.php?action=boutondeletechapter' . "#endpage" );
	}

//gestion des Commentaires

	/**
	 * affichage de la liste des commentaires
	 */
	public function listComments() {
		$commentManager = $this->commentManager;
		$comments       = $commentManager->listComments();
		$success        = ( isset( $_SESSION['success'] ) ? $_SESSION['success'] : null );
		$error          = ( isset( $_SESSION['error'] ) ? $_SESSION['error'] : null );
		$myView         = new View( 'listcomments' );
		$myView->renderView( array( 'comments' => $comments, 'success' => $success, 'error' => $error ) );
	}

	/**
	 * permet à l'administrateur de valider les commentaires de ses membres grâce à la fonction approvedComment
	 * puis affiche de nouveau la liste des commentaires corrigée
	 */
	public function approvedComment() {
		$approved = $this->commentManager;
		$comment  = $approved->getComment( $_GET['id'] );
		$comment->setStatut( 'Valide' );
		$commentapproved = $approved->approvedComment( $comment );
		$comments        = $approved->listComments();
		$success         = ( isset( $_SESSION['success'] ) ? $_SESSION['success'] : null );
		$error           = ( isset( $_SESSION['error'] ) ? $_SESSION['error'] : null );
		$myView          = new View( 'listcomments' );
		$myView->renderView( array( 'comments' => $comments, 'success' => $success, 'error' => $error ) );
	}

	/**
	 * permet à l'administrateur de refuser les commentaires de ses membres grâce à la fonction refusedComment
	 * puis affiche de nouveau la liste des commentaires corrigée
	 */

	public function refusedComment() {
		$refused = $this->commentManager;
		$comment = $refused->getComment( $_GET['id'] );
		$comment->setStatut( 'Refus' );
		$commentrefused = $refused->refusedComment( $comment );
		$comments       = $refused->listComments();
		$success        = ( isset( $_SESSION['success'] ) ? $_SESSION['success'] : null );
		$error          = ( isset( $_SESSION['error'] ) ? $_SESSION['error'] : null );
		$myView         = new View( 'listcomments' );
		$myView->renderView( array( 'comments' => $comments, 'success' => $success, 'error' => $error ) );
	}

// gestion des membres

	/**
	 * affichage de la liste des membres
	 */
	public function listMembres() {
		$membreManager = $this->membreManager;
		$membres       = $membreManager->listMembres();
		$success       = ( isset( $_SESSION['success'] ) ? $_SESSION['success'] : null );
		$error         = ( isset( $_SESSION['error'] ) ? $_SESSION['error'] : null );
		$myView        = new View( 'listmembres' );
		$myView->renderView( array( 'membres' => $membres, 'success' => $success, 'error' => $error ) );
	}

// gestion du Profil

	/**
	 * Fonction profilAdmin qui permet d'appeler la fonction profilAdmin du model AdminManager et d'afficher la vue profiladmin
	 */
	public function profilAdmin() {
		$adminmanager = $this->adminManager;
		$admin        = $adminmanager->profilAdmin( $_SESSION['id'] );
		$success      = ( isset( $_SESSION['success'] ) ? $_SESSION['success'] : null );
		$error        = ( isset( $_SESSION['error'] ) ? $_SESSION['error'] : null );
		$myView       = new View( 'profiladmin' );
		$myView->renderView( array( 'admin' => $admin, 'success' => $success, 'error' => $error ) );
	}

	/**
	 * appel de le fonction modifmessage et qui affiche la vue profiladmin avec le message corrigé
	 */
	public function modifmessage() {
		$adminmanager = $this->adminManager;
		$admin        = $adminmanager->profilAdmin( $_SESSION['id'] );
		$adminmessage = $adminmanager->modifMessage();
		$success      = ( isset( $_SESSION['success'] ) ? $_SESSION['success'] : null );
		$error        = ( isset( $_SESSION['error'] ) ? $_SESSION['error'] : null );
		$myView       = new View( 'profiladmin' );
		$myView->renderView( array( 'admin'        => $admin,
		                            'adminmessage' => $adminmessage,
		                            'success'      => $success,
		                            'error'        => $error
		) );
	}
}
