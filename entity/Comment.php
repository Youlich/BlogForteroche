<?php

namespace entity;


class Comment
{
    private $id;
    private $comment;
    private $comment_date;
    private $post_id;
    private $membre_id;
    private $membre_pseudo;

    /**
     * @return mixed
     */
    public function getMembrePseudo ()
    {
        return $this->membre_pseudo;
    }

    /**
     * @param mixed $membre_pseudo
     */
    public function setMembrePseudo ($membre_pseudo)
    {
        $this->membre_pseudo = $membre_pseudo;
    }

    /**
     * @return mixed
     */
    public function getMembreId ()
    {
        return $this->membre_id;
    }

    /**
     * @param mixed $membre_id
     */
    public function setMembreId ($membre_id)
    {
        $this->membre_id = $membre_id;
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
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getCommentDate()
    {
        return $this->comment_date;
    }

    /**
     * @param mixed $comment_date
     */
    public function setCommentDate($comment_date)
    {
        $this->comment_date = $comment_date;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->post_id;
    }

    /**
     * @param mixed $post_id
     */
    public function setPostId($post_id)
    {
        $this->post_id = $post_id;
    }


}