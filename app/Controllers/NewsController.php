<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Utils\View;

class NewsController extends Controller {
    public function index() {
        $view = new View('News/index', 'All news', 'News/index');
        $this->viewWithTemplate($view);
    }

    public function category(string $categoryName) {
        $categoryName = str_replace('-', ' ', $categoryName);

        $view = new View('News/category', "News about $categoryName");
        $this->viewWithTemplate($view, ['categoryName' => $categoryName]);
    }

    public function get(string $newsId) {
        $newsName = str_replace('-', ' ', ucfirst($newsId));

        $view = new View('News/get', "$newsName");
        $this->viewWithTemplate($view, ['newsName' => $newsName]);
    }
}