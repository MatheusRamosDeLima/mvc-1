<?php

namespace App\Core;

class Controller {
    protected $modelData;
    protected string $viewTitle;

    protected function view(string $viewName, $modelData = []):void {
        $this->modelData = $modelData;
        require_once __DIR__."/../Views/$viewName.php";
    }
    protected function viewWithTemplate(string $viewName, $modelData = []):void {
        require_once __DIR__."/../Views/template.php";
    }
}