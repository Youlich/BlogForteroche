<?php
namespace services;


use model\Manager;

class Verifications extends Manager
{
	private $pseudo;
	private $pass;
	private $newpass;
	private $email;
	private $login;
	private $mdp;



// Vérifications admin

	/**
	 * Fonction qui permet de vérifier si le nb de caractères dans le login saisit est correct
	 * @param $login
	 * @return string : le mot 'success' ou le message d'erreur
	 */

	public function verifLoginAdmin($login)
	{
		$this->pseudo = htmlspecialchars($login);
		if (strlen($this->login) > 3 AND strlen($this->login) < 255) {
			return 'success';
		} else {
			$_SESSION['error'] = "Votre login doit être compris entre 3 et 255 caractères";
			return $_SESSION['error'];
		}
	}

	/**
	 * Fonction qui permet de vérifier si le nb de caractères dans le mot de passe est correct
	 * @param $mdp
	 * @return string : 'success' ou message d'erreur
	 */

	public function verifadminPass($mdp)
	{
		$this->mdp = htmlspecialchars($mdp);
		if (strlen($this->mdp) > 6 AND strlen($this->mdp) < 255) {
			return 'success';
		} else {
			$_SESSION['error'] = "Votre mot de passe doit être compris entre 6 et 255 caractères";
			return $_SESSION['error'];
		}
	}

	/**
	 * Fonction qui permet de comparer le mot de passe saisit au mot de passe haché dans la BDD
	 * @return string : 'success' ou message d'erreur
	 */

	public function verifadminHachPass()
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM admin WHERE login = :login');
		$req->execute(array('login' => $_POST['login']));
		$authadmin = $req->fetch();
		$_SESSION['id'] = $authadmin['id'];
		$_SESSION['login'] = $authadmin['login'];
		$_SESSION['mdp'] = $authadmin['mdp'];
		$pass_hache_dans_bdd = $authadmin['mdp'];
		$resultat = password_verify($_POST['mdp'], $pass_hache_dans_bdd);
		if ($resultat) {
			return 'success';
		} else {
			$_SESSION['error'] = "Erreur dans votre mot de passe";
			return $_SESSION['error'];
		}
	}

	/**
	 * Fonction qui permet de vérifier si le login saisit existe dans la BDD
	 * @param $login
	 * @return string : 'success' ou message d'erreur
	 */

	public function loginadminExist($login)
	{
		$this->login = $login;
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM admin WHERE login = :login');
		$req->execute(array('login' => $_POST['login']));
		$resultat = $req->fetch();
		if ($resultat){
			return 'success';
		} else {
			$_SESSION['error'] = "Votre login administrateur n'existe pas";
			return $_SESSION['error'];
		}
	}

	/**
	 * Fonction qui permet de donner au valeur de session les infos BDD
	 * @return string : 'success' ou message d'erreur
	 */

	public function sessionAdmin()
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, login, mdp FROM admin WHERE login = :login');
		$req->execute(array('login' => $this->login));
		$req = $req->fetch();
		$_SESSION['id'] = $req['id'];
		$_SESSION['login'] = $this->login;

		return 'success';
	}


// Vérifications membre

	/**
	 * Fonction qui permet de vérifier si le nb de caractères dans le pseudo saisit est correct
	 * @param $pseudo
	 * @return string : 'success' ou message d'erreur
	 */

	public function verifPseudo($pseudo)
	{
		$this->pseudo = htmlspecialchars($pseudo);
		if (strlen($this->pseudo) > 3 AND strlen($this->pseudo) < 255) {
			return 'success';
		} else {
			$_SESSION['error'] = "Votre pseudo doit être compris entre 3 et 255 caractères";
			return $_SESSION['error'];
		}
	}

	/**
	 * Fonction qui permet de vérifier si le nb de caractères dans le mot de passe saisit est correct
	 * @return string : 'success' ou message d'erreur
	 */
	public function verifPass ($pass)
	{
		$this->pass = htmlspecialchars($pass);
		if (strlen($this->pass) > 6 AND strlen($this->pass) < 255) {
			return 'success';
		} else {
			$_SESSION['error'] = "Votre mot de passe doit être compris entre 6 et 255 caractères";
			return $_SESSION['error'];
		}
	}

	/**
	 * Fonction qui permet de vérifier si le newpass saisit est identique au premier mot de passe saisit
	 * @param $newpass
	 * @return string : 'success' ou message d'erreur
	 */

	public function identiquePass ($newpass)
	{
		$this->newpass = htmlspecialchars($newpass);
		if ($this->pass == $this->newpass) {
			return 'success';
		} else {
			$_SESSION['error'] = "Vos mots de passe sont différents";
			return $_SESSION['error'];
		}
	}

	/**
	 * Fonction qui permet de vérifier si le mot de passe saisit est identique au mot de pass de la BDD
	 * @return string : 'success' ou message d'erreur
	 */

	public function verifHachPass()
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM membres WHERE pseudo = :pseudo');
		$req->execute(array('pseudo' => $_POST['pseudo']));
		$authMembre = $req->fetch();
		$_SESSION['id'] = $authMembre['id'];
		$_SESSION['pseudo'] = $authMembre['pseudo'];
		$_SESSION['pass'] = $authMembre['pass'];
		$pass_hache_dans_bdd = $authMembre['pass'];
		$resultat = password_verify($_POST['pass'], $pass_hache_dans_bdd);
		if ($resultat) {
			return 'success';
		} else {
			$_SESSION['error'] = "Erreur dans votre mot de passe";
			return $_SESSION['error'];
		}
	}

	/**
	 * Fonction qui permet de vérifier si l'adresse mail est valide
	 * @param $email
	 * @return string : 'success' ou message d'erreur
	 */

	public function verifEmail ($email)
	{
		$this->email = htmlspecialchars($email);
		if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
			return "success";
		} else {
			$_SESSION['error'] = "Votre adresse mail n'est pas valide";
			return $_SESSION['error'];
		}
	}

	/**
	 * Fonction qui permet de vérifier si le pseudo existe dans la BDD
	 * @param $pseudo
	 * @return string : 'success' ou message d'erreur
	 */

	public function pseudoExist($pseudo)
	{
		$this->pseudo = $pseudo;
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT * FROM membres WHERE pseudo = :pseudo');
		$req->execute(array('pseudo' => $_POST['pseudo']));
		$resultat = $req->fetch();
		if ($resultat){
			return 'success';
		} else {
			$_SESSION['error'] = "Votre pseudo n'existe pas";
			return $_SESSION['error'];
		}
	}

	/**
	 * Fonction qui permet de données à la session du membre les valeurs de la BDD
	 * @return string : 'success'
	 */

	public function session()
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, dateInscription, email FROM membres WHERE pseudo = :pseudo');
		$req->execute(array('pseudo' => $this->pseudo));
		$req = $req->fetch();
		$_SESSION['id'] = $req['id'];
		$_SESSION['pseudo'] = $this->pseudo;
		$_SESSION['dateInscription'] = $req['dateInscription'];
		$_SESSION['email'] = $req['email'];

		return 'success';
	}

	/**
	 * @return bool
	 */


}