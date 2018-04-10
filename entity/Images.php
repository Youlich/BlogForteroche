<?php

namespace entity;


class Images
{
    private $id;
    private $name;
    private $fileUrl;
    private $chapterId;

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getFileUrl()
    {
        return $this->fileUrl;
    }

    /**
     * @param mixed $fileUrl
     */
    public function setFileUrl ($fileUrl)
    {
        $this->fileUrl = $fileUrl;
    }

    /**
     * @return mixed
     */
    public function getChapterId()
    {
        return $this->chapterId;
    }

    /**
     * @param mixed $chapterId
     */
    public function setChapterId($chapterId)
    {
        $this->chapterId = $chapterId;
    }


}