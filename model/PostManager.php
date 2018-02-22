<?php
namespace model;
use entity\Post;

require_once("DbConnect.php");



/**
 * Class PostManager
 * @package model
 * Class qui permet la gestion des posts (des billets) : la modification, la lecture et l'écriture dans la table posts
 */
class PostManager extends DbConnect
{
    public function getPosts() // Affiche tous les billets (posts)
    {
        $posts = array();
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, resum, content, image, nbcomms, DATE_FORMAT(post_date, \'%d/%m/%Y / %HH%imin\') AS post_date_fr FROM posts ORDER BY post_date DESC LIMIT 0, 5');
        while ($data = $req->fetch())
        {
            $post = new Post();
            $post->setTitle($data['title']);
            $post->setImage($data['image']);
            $post->setId($data['id']);
            $post->setPostDate($data['post_date_fr']);
            $post->setResum($data['resum']);
            $post->setNbcomms($data['nbcomms']);
            $posts[] = $post;
        }
        return $posts;
    }
    public function getPost($postId) // Permet de sélectionner un billet
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, resum, content, image,  DATE_FORMAT(post_date, \'%d/%m/%Y / %HH%imin\') AS post_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        while ($data = $req->fetch())
        {
            $post = new Post();
            $post->setId($data['id']);
            $post->setImage($data['image']);
            $post->setPostDate($data['post_date_fr']);
            $post->setTitle($data['title']);
            $post->setContent($data['content']);

        }
        return $post;
    }
}