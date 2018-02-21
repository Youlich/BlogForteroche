<?php
namespace entity;
class Post
{
    private $id;
    private $post_date;
    private $title;
    private $content;
    private $resum;
    private $image;
    private $nbcomms;

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
    public function getPostDate()
    {
        return $this->post_date;
    }
    /**
     * @param mixed $post_date
     */
    public function setPostDate($post_date)
    {
        $this->post_date = $post_date;
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
    public function getImage()
    {
        return $this->image;
    }
    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }
}