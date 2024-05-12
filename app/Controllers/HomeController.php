<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Utils\View;

class HomeController extends Controller {
    public function index() {
        $view = new View('home', 'Home', 'home');
        $this->viewWithTemplate($view);
    }
}