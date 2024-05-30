<?php

namespace App\Core;

use App\Http\Request;
use App\Http\Response;
use App\Core\Controller;

class Core {
    private static string $controller;
    private static string $method;
    private static array $params;

    public static function dispath(array $routes):void {
        $url = self::parseUrl(Request::uri());
        $isRouteFound = false;
        foreach ($routes as $route) {
            $pattern = '#^'.preg_replace('/{id}/', '([\w-]+)', trim($route['path'], '/')).'$#';
            if (preg_match($pattern, $url, $matches)) {
                $isRouteFound = true;
                array_shift($matches);
                if ($route['method'] !== Request::method()) self::invalidHttpMethod();
                else {
                    list(self::$controller, self::$method) = $route['action'];
                    self::$params = $matches;
                }
            }
        }
        if (!$isRouteFound) self::invalidRoute();
        call_user_func_array([new self::$controller, self::$method], self::$params);
    }
    private static function parseUrl(string $uri):string {
        $url = trim($uri, '/');
        if (str_contains($url, '?')) $url = substr($url, 0, strpos($url, '?'));
        if ($url === 'index.php') $url = '';
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return $url;
    }
    private static function invalidHttpMethod():void {
        Response::json([], 405);
        self::$controller = Controller::class;
        self::$method = 'error405';
        self::$params = [];
    }
    private static function invalidRoute():void {
        Response::json([], 404);
        self::$controller = Controller::class;
        self::$method = 'error404';
        self::$params = [];
    }
}