<?php

namespace entity;

/**
 * Class Admin
 * @package entity
 */

class Admin
{
    /**
     * @var : colonnes de la table admin
     */
    private $id;
    private $pseudo;
    private $pass;
    private $photo;
    private $message;

    /**
     * @param array $donnees : appel des setters
     */

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set'.ucfirst($key);
            // Si le setter correspondant existe.
            if (method_exists($this, $method))
            {
                // On appelle le setter.
                $this->$method($value);
            }
        }
    }
    /**
     * @return mixed
     */
    public function getId ()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId ($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getPseudo ()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo ($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }


    /**
     * @return mixed
     */
    public function getPass ()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass ($pass)
    {
        $this->pass = $pass;
    }



}