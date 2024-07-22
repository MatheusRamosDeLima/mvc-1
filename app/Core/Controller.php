<?php

namespace App\Core;

use App\Utils\View;
use App\Http\Response;

class Controller {
    protected array $modelData;
    protected View $view;

    protected function view(string $viewPath, array $modelData = []): void {
        $this->modelData = $modelData;
        extract($modelData);
        require_once __DIR__."/../Views/$viewPath.php";
    }
    protected function viewWithTemplate(View $view, array $modelData = []): void {
        $this->view = $view;
        require_once __DIR__."/../Views/_template.php";
    }

    protected function error400(?string $msg = null): void {
        Response::json([], 400);
        $this->view('Error/error400', ['msg' => $msg]);
    }
    public function error404(): void {
        Response::json([], 404);
        $this->view('Error/error404');
    }
    public function error405(): void {
        Response::json([], 405);
        $this->view('Error/error405');
    }
}