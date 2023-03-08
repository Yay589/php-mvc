<?php
class Post extends Model
{

    //private $table = "posts";
    // object properties
    public $id;
    public $user_id;
    public $title;
    public $slug;
    public $views;
    public $image;
    public $body;
    public $published;
    public $created_at;
    public $updated_at;
    public function __construct($id = null, $user_id = null, $title = null, $slug = null, $body = null, $published = null)
    {

        $this->id = $id;
        $this->user_id = $user_id;
        $this->title = $title;
        $this->slug = $slug;
        $this->body = $body;
        $this->published = $published;

        $this->getConnection();
        $this->table = "posts";
    }

    public function findBySlug(string $slug)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE slug=" . "'" . $slug . "'";

        $query = $this->_connexion->prepare($sql);
        $query->execute();
        $post = $query->fetch();
        return new Post($post['id'], $post['user_id'], $post['title'], $post['slug'], $post['body'], $post['published']);
    }
}
