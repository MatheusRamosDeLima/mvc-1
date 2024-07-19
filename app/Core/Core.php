<?php

namespace App\Core;

use App\Http\Request;
use App\Core\Controller;

class Core {
    private static string $controller;
    private static string $method;
    private static array $params;

    public static function dispath(array $routes): void {
        $url = self::parseUrl(Request::uri());

        $isRouteFound = false;

        foreach ($routes as $route) {
            $pattern = '#^'.preg_replace('/{id}/', '([\w-]+)', trim($route['path'], '/')).'$#';
            if (preg_match($pattern, $url, $matches)) {
                $isRouteFound = true;

                array_shift($matches);

                $isMethodAllowed = self::isMethodAllowed($route);

                if (!$isMethodAllowed) {
                    self::invalidHttpMethod();
                } else {
                    list(self::$controller, self::$method) = $route['action'];
                    self::$params = $matches;
                }
            }
        }
        if (!$isRouteFound) self::invalidRoute();
        call_user_func_array([new self::$controller, self::$method], self::$params);
    }
    private static function parseUrl(string $uri): string {
        $url = trim($uri, '/');
        if (str_contains($url, '?')) $url = substr($url, 0, strpos($url, '?'));
        if ($url === 'index.php') $url = '';
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return $url;
    }
    private static function isMethodAllowed(array $route): bool {
        $isMethodAllowed = false;

        if (is_string($route['method']) && $route['method'] === Request::method()) {
            $isMethodAllowed = true;
        } else if (is_array($route['method'])) {
            foreach ($route['method'] as $method) {
                if ($method === Request::method()) $isMethodAllowed = true;
            }
        }

        return $isMethodAllowed;
    }
    private static function invalidRoute(): void {
        self::$controller = Controller::class;
        self::$method = 'error404';
        self::$params = [];
    }
    private static function invalidHttpMethod(): void {
        self::$controller = Controller::class;
        self::$method = 'error405';
        self::$params = [];
    }
}