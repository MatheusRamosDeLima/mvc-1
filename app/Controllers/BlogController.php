<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Utils\View;

use App\Models\Posts;

class BlogController extends Controller {
    public function __construct() {
        Posts::init();
    }

    public function index() {
        $categories = Posts::selectDistinctValuesByColumn('category');
        $posts = Posts::selectAll();

        $view = new View('Blog/index', 'All posts');
        $this->viewWithTemplate($view, [
            'categories' => $categories,
            'posts' => $posts
        ]);
    }

    public function category(string $category) {
        $postsByCategory = Posts::selectManyByColumn('category', $category);
        
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

    public function show(string $postId) {
        if (!is_numeric($postId)) {
            $this->error404();
            return;
        }
        $postId = (int) ($postId);

        $post = Posts::selectById($postId);

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
        $view = new View('Blog/create', "Create post");
        $this->viewWithTemplate($view);
    }

    public function store() {
        if (empty($_POST['store'])) {
            $this->error400("Post can't be created.");
            return;
        }
        if (empty($_POST['title']) || empty($_POST['content']) || empty($_POST['category'])) {
            $this->create();
            echo "<p>Complete as informações corretamente.</p>";
            return;
        }

        $title = $_POST['title'];
        $content = $_POST['content'];
        $category = $_POST['category'];

        $postCreated = Posts::insert($title, $content, $category);

        if (!$postCreated) {
            $this->error400("Post wasn't created. Some error happened :(");
            return;
        }

        header('Location: /blog');
    }

    public function edit(string $postId) {
        if (!is_numeric($postId)) {
            $this->error404();
            return;
        }
        $postId = (int) ($postId);

        $post = Posts::selectById($postId);

        if (!$post) {
            $this->error404();
            return;
        }

        $view = new View('Blog/edit', 'Edit post');
        $this->viewWithTemplate($view, ['post' => $post]);
    }

    public function update(string $postId) {
        if (empty($_POST['update'])) {
            $this->error400();
            return;
        }

        if (empty($_POST['title']) || empty($_POST['content']) || empty($_POST['category'])) {
            $this->edit($postId);
            echo "<p>Complete as informações corretamente.</p>";
            return;
        }

        if (!is_numeric($postId)) {
            $this->error400();
            return;
        }
        $postId = (int) ($postId);

        $title = $_POST['title'];
        $content = $_POST['content'];
        $category = $_POST['category'];

        $postEdited = Posts::update($postId, $title, $content, $category);

        if (!$postEdited) {
            $this->error400();
            return;
        }

        header("Location: /blog/post/$postId");
    }

    public function destroy(string $postId) {
        if (empty($_POST['destroy'])) {
            $this->error400();
            return;
        }
        
        if (!is_numeric($postId)) {
            $this->error404();
            return;
        }
        $postId = (int) ($postId);

        $postDeleted = Posts::delete($postId);

        if (!$postDeleted) {
            $this->error400();
            return;
        }

        header('Location: /blog');
    }
}