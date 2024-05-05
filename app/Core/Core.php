<?php

namespace App\Core;

use App\Http\Request;
use App\Http\Response;
use App\Controllers\ErrorController;

class Core {
    public static function dispath(array $routes) {
        $url = self::parseUrl();
        $isRouteFound = false;
        foreach($routes as $route) {
            $pattern = '#^'.preg_replace('/{id}/', '([\w-]+)', trim($route['path'], '/')).'$#';
            if(preg_match($pattern, $url, $matches)) {
                $isRouteFound = true;   
                array_shift($matches);
                if($route['method'] !== Request::method()) {
                    Response::json([], 405);
                    $controller = ErrorController::class;
                    $method = 'error405';
                    $matches = [];
                }
                else list($controller, $method) = $route['action'];
            }
        }
        if (!$isRouteFound) {
            Response::json([], 404);
            $controller = ErrorController::class;
            $method = 'error404';
            $matches = [];
        }
        $extendController = new $controller();
        $extendController->$method($matches);
    }
    private static function parseUrl() : string {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        if (str_contains($url, '?')) $url = substr($url, 0, strpos($url, '?'));
        return $url;
    }
}