<?php

namespace App\Controllers;

use App\Core\Controller;

class NewsController extends Controller {
    public function index() {
        $this->viewTitle = 'All news';
        $this->viewWithTemplate('News/index');
    }
    public function category(string $categoryName) {
        $this->viewTitle = "News about $categoryName";
        $this->viewWithTemplate('News/category', ['categoryName' => $categoryName]);
    }
    public function get(string $newsId) {
        $newsName = ucfirst($newsId);
        $this->viewTitle = "$newsName";
        $this->viewWithTemplate('News/get', ['newsName' => $newsName]);
    }
}