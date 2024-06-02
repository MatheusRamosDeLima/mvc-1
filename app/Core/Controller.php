<?php

namespace App\Core;

use App\Utils\View;

class Controller {
    protected array $modelData;
    protected View $view;

    protected function view(string $viewName, array $modelData = []):void {
        $this->modelData = $modelData;
        extract($modelData);
        require_once __DIR__."/../Views/$viewName.php";
    }
    protected function viewWithTemplate(View $view, array $modelData = []):void {
        $this->view = $view;
        require_once __DIR__."/../Views/_template.php";
    }

    public function error404():void {
        $this->view('Error/error404');
    }
    public function error405():void {
        $this->view('Error/error405');
    }
}