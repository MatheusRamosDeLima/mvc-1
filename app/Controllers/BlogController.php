<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;

use App\Models\Posts;

class BlogController extends Controller {
    private $posts;

    public function __construct() {
        $this->posts = new Posts;
    }

    public function index() {
        $categories = $this->posts::selectColumn('category');
        $posts = $this->posts::selectAll();

        $view = new View('Blog/index', 'All posts');
        $this->viewWithTemplate($view, [
            'categories' => $categories,
            'posts' => $posts
        ]);
    }

    public function category(string $category) {
        $postsByCategory = $this->posts::selectManyByField('category', $category);
        
        if (!$postsByCategory) {
            $this->error404();
            return;
        }
        
        $view = new View('Blog/category', "Posts about $category");
        $this->viewWithTemplate($view, [
            'category' => $category,
            'posts' => $postsByCategory
        ]);
    }

    public function show(string $id) {
        if (!is_numeric($id)) {
            $this->error404();
            return;
        }

        $post = $this->posts::selectById($id);

        if (!$post) {
            $this->error404();
            return;
        }
        
        $view = new View('Blog/show', "$post->title");
        $this->viewWithTemplate($view, [
            'postTitle' => $post->title,
            'postContent' => $post->content,
            'postCategory' => $post->category
        ]);
    }

    public function create() {
        $view = new View('Blog/create', "Create post", null, 'Blog/_form');
        $this->viewWithTemplate($view);
    }

    public function store() {
        if (empty($_POST['title']) || empty($_POST['content']) || empty($_POST['category'])) {
            header('Location: /blog/create');
            return;
        }

        $title = $_POST['title'];
        $content = $_POST['content'];
        $category = $_POST['category'];

        $postCreated = $this->posts::insert([$title, $content, $category]);

        if (!$postCreated) {
            $this->error400("Post wasn't created. Some error happened :(");
            return;
        }

        header('Location: /blog');
    }

    public function edit(string $id) {
        if (!is_numeric($id)) {
            $this->error404();
            return;
        }

        $post = $this->posts::selectById($id);

        if (!$post) {
            $this->error404();
            return;
        }

        $view = new View('Blog/edit', 'Edit post', null, 'Blog/_form');
        $this->viewWithTemplate($view, ['post' => $post]);
    }

    public function update(string $id) {
        if (!is_numeric($id)) {
            $this->error400();
            return;
        }

        if (empty($_POST['title']) || empty($_POST['content']) || empty($_POST['category'])) {
            header('Location: /blog/edit');
            return;
        }

        $title = $_POST['title'];
        $content = $_POST['content'];
        $category = $_POST['category'];

        $postEdited = $this->posts::update($id, [$title, $content, $category]);

        if (!$postEdited) {
            $this->error400();
            return;
        }

        header("Location: /blog");
    }

    public function destroy(string $id) {
        if (empty($_POST['destroy']) || !is_numeric($id)) {
            $this->error400();
            return;
        }

        $postDeleted = $this->posts::delete($id);

        if (!$postDeleted) {
            $this->error400();
            return;
        }

        header('Location: /blog');
    }
}