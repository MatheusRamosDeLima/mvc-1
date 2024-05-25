<?php

namespace App\Http;

class Route {
    private static array $routes;

    public static function get(string $path, array $action):void {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => 'GET'
        ];
    }
    public static function post(string $path, array $action):void {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => 'POST'
        ];
    }
    public static function put(string $path, array $action):void {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => 'PUT'
        ];
    }
    public static function delete(string $path, array $action):void {
        self::$routes[] = [
            'path' => $path,
            'action' => $action,
            'method' => 'DELETE'
        ];
    }

    public static function routes():array {
        return self::$routes;
    }
}