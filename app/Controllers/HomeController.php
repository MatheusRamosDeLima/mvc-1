<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;

use App\Models\Posts;

class HomeController extends Controller {
    private $posts;

    public function __construct() {
        $this->posts = new Posts;
    }

    public function index() {
        $posts = $this->posts->selectAll();

        $view = new View('home', 'Home');
        $this->viewWithTemplate($view, ['posts' => $posts]);
    }
}