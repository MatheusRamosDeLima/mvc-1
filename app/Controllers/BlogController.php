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

    public function get(string $postId) {
        $post = Posts::selectOneByColumn('rowid', $postId);

        if (!$post) {
            $this->error404();
            return;
        }
        
        $view = new View('Blog/get', "$post->title");
        $this->viewWithTemplate($view, [
            'postTitle' => $post->title,
            'postContent' => $post->main,
            'postCategory' => $post->category
        ]);
    }

    public function create() {
        
    }
}