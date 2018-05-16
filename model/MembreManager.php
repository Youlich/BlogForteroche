<?php
namespace model;

use entity\Membres;
use services\Verifications;

/**
 * Class MembreManager
 * @package model
 */

class MembreManager extends Manager
{

    /**
     * @return array : tableau listant les membres inscrits
     */
    public function listMembres() {

        $membres = array();
        $db = $this->dbConnect();
        $req = $db->query('SELECT * FROM membres ORDER BY pseudo');
        while ($data = $req->fetch()) {
            $membre = new Membres();
            $membre->hydrate($data);
            $membres[] = $membre;
        }
        return $membres;
    }

    /**
     * @param $id
     * @return Membres
     * permet d'obtenir un membre selon son id
     */
    public function getMembre($id) {


        $db = $this->dbConnect();
        $PDOStatement = $db->prepare('SELECT * FROM membres WHERE id= ? ');
        $PDOStatement->execute(array($id));
        while ($data = $PDOStatement->fetch(\PDO::FETCH_ASSOC)) {
            $membre = new Membres();
            $membre->hydrate($data);
        }
        return $membre;
    }

    /**
     * @return string
     */

	public function loginMembre()
	{
		// toutes les vérifications
		if (isset($_POST['submit'])) {
			// vérification que tous les champs sont remplis
			if (!empty($_POST['pseudo'] AND !empty($_POST['pass']))) {
				$verifmembre = new Verifications($this->dbConnect());
				$verif = $verifmembre->verifPseudo($_POST['pseudo']);
				if ($verif == "success") { //on continue
					$verif = $verifmembre->pseudoExist($_POST['pseudo']); //verif si le pseudo existe
					if ($verif == "success") { // il existe, on continue
						$verif = $verifmembre->verifPass($_POST['pass']);
						if ($verif == "success") {
							$verif = $verifmembre->verifHachPass();
							if ($verif == "success") {
								if ($verifmembre->session()) {
									$this->redirect('Location: index.php?action=accueil');
									exit();
								}
							} else {
								$_SESSION['error'] = $verif;
							}
						} else {
							$_SESSION['error'] = $verif;
						}
					} else {
						$_SESSION['error'] = "Votre pseudo n'existe pas";
					}
				} else {
					$_SESSION['error'] = $verif;
				}
			} else {
				$_SESSION['error'] = "Merci de remplir tous les champs";
				return $_SESSION['error'];
			}
		}
	}

    /**
     * @return string
     */

	public function inscription ()
	{
		if (isset($_POST['submit'])) {
			// vérification que tous les champs sont remplis
			if (!empty($_POST['pseudo'] AND !empty($_POST['pass'] AND !empty($_POST['newpass'] AND !empty($_POST['email']))))) {
				$verifmembre = new Verifications($this->dbConnect());
				$verif = $verifmembre->verifPseudo($_POST['pseudo']); // verif pseudo compris entre 3 et 255 caractères
				if ($verif == "success") {
					//on vérifie s'il n'est pas déjà existant dans la BDD
					$verif = $verifmembre->pseudoExist($_POST['pseudo']);
					if ($verif != "success") { // si le pseudo n'existe pas
						$verif = $verifmembre->verifPass($_POST['pass']); // verif mdp compris entre 6 et 255 caractères
						if ($verif == "success") { //on continue
							$verif = $verifmembre->identiquePass($_POST['newpass']); // verif que les 2 mdp saisis identiques
							if ($verif == "success") { //on continue
								$verif = $verifmembre->verifEmail($_POST['email']); // verif de la synthaxe du mail
								if ($verif == "success") { //on continue
									// Hachage du mot de passe
									$pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
									// Insertion
									$db = $this->Dbconnect();
									$req = $db->prepare('INSERT INTO membres(pseudo, pass, email, dateInscription, nbcomms) VALUES (:pseudo, :pass, :email, CURDATE(),0)');
									$insert = $req->execute(array(
										'pseudo' => $_POST['pseudo'],
										'pass' => $pass_hache,
										'email' => $_POST['email']));
									$this->redirect('Location: index.php?action=loginmembre');
									$_SESSION['success'] = "Bravo ! Votre compte est créé, merci de vous connecter.";
									return $_SESSION['success'];
								} else {
									$_SESSION['error'] = $verif;
								}
							} else {
								$_SESSION['error'] = $verif;
							}
						} else {
							$_SESSION['error'] = $verif;
						}
					} else {
						$_SESSION['error'] = "Votre pseudo existe déjà, merci d'en saisir un nouveau";
					}
				} else {
					$_SESSION['error'] = $verif;
				}
			} else {
				$_SESSION['error'] = "Merci de remplir tous les champs";
				session_destroy();
				return $_SESSION['error'];
			}
		}
	}

	/**
	 * @param Membres $membre
	 *
	 * @return mixed
	 */

        public function deleteAccount(Membres $membre)
        {
            $db = $this->dbConnect();
            $req = $db->prepare("DELETE FROM membres WHERE id = :id");
            $supp = $req->execute(array(':id' => $membre->getId()));
	        if ($supp) {
		        $db = $this->dbConnect();
		        $newreq = $db->prepare('DELETE FROM comments WHERE membreId=:idmembre');
		        $newreq->bindValue(':idmembre',$membre->getId(),\PDO::PARAM_INT);
		        $newreq->execute();
		        $this->redirect('Location: index.php?action=accueil');
		        session_destroy();
	        }else {
		        $this->redirect('Location: index.php?action=profilmembre');
		        $_SESSION['error'] = "Votre compte n'a pas pu être supprimé";
		        return $_SESSION['error'];
	        }
         }

    /**
     * @param Membres $membre
     * @return string
     */

    public function modifPseudoMdp(Membres $membre)
    {
        if (isset($_POST['submit'])) {
            $verification = new Verifications($this->dbConnect());
            $verif = $verification->verifPseudo($_POST['pseudo']); // verif pseudo compris entre 3 et 255 caractères
            if ($verif == "success") {
                $verif = $verification->verifPass($_POST['pass']); // verif mdp compris entre 6 et 255 caractères
                if ($verif == "success") { //on continue
                    $verif = $verification->identiquePass($_POST['newpass']); // verif que les 2 mdp saisis identiques
                    if ($verif == "success") {
                            $pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                            $db = $this->dbConnect();
                            $modif = $db->prepare('UPDATE membres SET pseudo=:pseudo, pass=:pass WHERE id=:idmembre');
                            $modif->bindValue(':idmembre', $membre->getId(), \PDO::PARAM_INT);
                            $modif->bindValue(':pseudo', $membre->getPseudo(), \PDO::PARAM_STR);
                            $modif->bindValue(':pass', $pass_hache, \PDO::PARAM_STR);
                            $modif->execute();
                            while ($data = $modif->fetch(\PDO::FETCH_ASSOC)) {
                                $newmodif = new Membres();
                                $newmodif->hydrate($data);

                            }
                            $this->redirect('Location: index.php?action=loginmembre');
                            $_SESSION['success'] = "Bravo ! Vos informations de connexion sont modifiées, merci de vous connecter.";
                            return $_SESSION['success'];

                    } else {
                        $_SESSION['error'] = $verif;
                    }
                } else {
                    $_SESSION['error'] = $verif;
                }
            } else {
                $_SESSION['error'] = $verif;
            }
        }
    }

    /**
     * @param Membres $membre
     * @return string
     */
    public function modifEmail(Membres $membre)
    {
        if (isset($_POST['submit'])) {
            $verification = new Verifications($this->dbConnect());
            $verif = $verification->verifEmail($_POST['email']); // verif de la synthaxe du mail
            if ($verif == "success") {
                $db = $this->dbConnect();
                $modif = $db->prepare('UPDATE membres SET email=:email WHERE id=:idmembre');
                $modif->bindValue(':idmembre', $membre->getId(), \PDO::PARAM_INT);
                $modif->bindValue(':email', $membre->getEmail(), \PDO::PARAM_STR);
                $modif->execute();
                while ($data = $modif->fetch(\PDO::FETCH_ASSOC)) {
                    $newmodif = new Membres();
                    $newmodif->hydrate($data);

                }
                $this->redirect('Location:index.php?action=profilmembre');
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['success'] = "Bravo ! Votre email est modifié";
                return $_SESSION['success'];
            } else {
                $_SESSION['error'] = $verif;
            }
            }
    }



}

