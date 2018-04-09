<?php
namespace entity;
class Chapter
{
    private $id;
    private $chapterDate;
    private $title;
    private $content;
    private $resum;
    private $nbcomms;
    private $bookId;
    private $imageId;


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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getChapterDate()
    {
        return $this->chapterDate;
    }

    /**
     * @param mixed $chapterDate
     */
    public function setChapterDate($chapterDate)
    {
        $this->chapterDate = $chapterDate;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getResum()
    {
        return $this->resum;
    }

    /**
     * @param mixed $resum
     */
    public function setResum($resum)
    {
        $this->resum = $resum;
    }

    /**
     * @return mixed
     */
    public function getNbcomms()
    {
        return $this->nbcomms;
    }

    /**
     * @param mixed $nbcomms
     */
    public function setNbcomms($nbcomms)
    {
        $this->nbcomms = $nbcomms;
    }

    /**
     * @return mixed
     */
    public function getBookId()
    {
        return $this->bookId;
    }

    /**
     * @param mixed $bookId
     */
    public function setBookId($bookId)
    {
        $this->bookId = $bookId;
    }

    /**
     * @return mixed
     */
    public function getImageId()
    {
        return $this->imageId;
    }

    /**
     * @param mixed $imageId
     */
    public function setImageId($imageId)
    {
        $this->imageId = $imageId;
    }

}