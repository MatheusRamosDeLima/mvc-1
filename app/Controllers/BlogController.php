<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Utils\View;

class BlogController extends Controller {
    public function index() {
        $view = new View('Blog/index', 'All posts', 'Blog/index');
        $this->viewWithTemplate($view);
    }

    public function category(string $categoryName) {
        $categoryName = str_replace('-', ' ', $categoryName);

        $view = new View('Blog/category', "Posts about $categoryName");
        $this->viewWithTemplate($view, ['categoryName' => $categoryName]);
    }

    public function get(string $postId) {
        $postName = str_replace('-', ' ', ucfirst($postId));

        $view = new View('Blog/get', "$postName");
        $this->viewWithTemplate($view, ['postName' => $postName]);
    }
}