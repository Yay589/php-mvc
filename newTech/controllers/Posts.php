<?php

class Posts extends \App\Controller
{
    /**
     * read all posts
     *
     * @param void
     * @return void
     */
    public function show()
    {
        $this->loadModel("Post");
        $posts = $this->Post->getAll();
        $this->render('show', ['posts' => $posts]);
    }

    /**
     * find a post by slug
     *
     * @param string $slug
     * @return void
     */
    public function find_by_slug(string $slug)
    {

        $this->loadModel("Post");
        $post = $this->Post->findBySlug($slug);
        $this->render('read', ['post' => $post]);
    }
}
