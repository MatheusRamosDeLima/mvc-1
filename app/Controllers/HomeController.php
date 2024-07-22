<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Utils\View;

use App\Models\Posts;

class HomeController extends Controller {
    public function __construct() {
        Posts::init();
    }

    public function index() {
        $posts = Posts::selectAll();

        $view = new View('home', 'Home');
        $this->viewWithTemplate($view, ['posts' => $posts]);
    }
}