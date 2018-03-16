<?php

namespace entity;


class Admin
{
    private $id;
    private $pseudo;
    private $pass;


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