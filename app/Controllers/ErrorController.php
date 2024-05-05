<?php

namespace App\Controllers;

class ErrorController {
    public function error404() {
        echo "Page not found. Please back to <a href='/'>home page</a>";
    }
    public function error405() {
        echo "The requested method isn't allowed";
    }
}