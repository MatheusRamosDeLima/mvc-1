<?php

namespace App\Core;

use App\Utils\View;
use PDO;
use mysqli;

class Controller {
    protected array|PDO|mysqli $modelData;
    protected View $view;

    protected function view(string $viewName, array|PDO|mysqli $modelData = []):void {
        $this->modelData = $modelData;
        extract($modelData);
        require_once __DIR__."/../Views/$viewName.php";
    }
    protected function viewWithTemplate(View $view, array|PDO|mysqli $modelData = []):void {
        $this->view = $view;
        require_once __DIR__."/../Views/template.php";
    }
}