<?php

namespace App\Controllers;

use App\Core\Controller;

class ErrorController extends Controller {
    public function error404() {
        $this->viewTitle = 'Error 404';
        $this->view('Error/error404');
    }
    public function error405() {
        $this->viewTitle = 'Error 405';
        $this->view('Error/error405');
    }
}