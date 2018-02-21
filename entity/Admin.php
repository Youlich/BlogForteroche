<?php

namespace entity;


class Admin
{
    private $id;
    private $pseudo;
    private $pass;

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