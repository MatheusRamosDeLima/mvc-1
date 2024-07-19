<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Utils\View;

use App\Models\Categories;
use App\Models\Posts;

class BlogController extends Controller {
    public function __construct() {
        Categories::init();
        Posts::init();
    }

    public function index() {
        $categories = Categories::selectAll();
        $posts = Posts::selectAll();

        $view = new View('Blog/index', 'All posts');
        $this->viewWithTemplate($view, [
            'categories' => $categories,
            'posts' => $posts,
            'postCategory' => function($post) {
                return Categories::selectOneByColumn('id', $post->categoryid)->name;
            }
        ]);
    }

    public function category(string $categoryName) {
        $category = Categories::selectOneByColumn('name', $categoryName);

        if (!$category) {
            $this->error404();
            return;
        }

        $allPostsByCategory = Posts::selectManyByColumn('categoryid', $category->id);

        $view = new View('Blog/category', "Posts about $categoryName");
        $this->viewWithTemplate($view, [
            'categoryName' => $categoryName,
            'posts' => $allPostsByCategory
        ]);
    }

    public function get(string $postId) {
        $post = Posts::selectOneByColumn('id', $postId);

        if (!$post) {
            $this->error404();
            return;
        }
        
        $view = new View('Blog/get', "$post->name");
        $this->viewWithTemplate($view, [
            'postName' => $post->name,
            'postContent' => $post->content,
            'postCategory' => Categories::selectOneByColumn('id', $post->categoryid)->name
        ]);
    }

    public function create() {
        
    }
}