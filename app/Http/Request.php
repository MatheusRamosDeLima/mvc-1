<?php

namespace App\Http;

class Request {
    public static function uri(): string {
        return $_SERVER['REQUEST_URI'];
    }
    public static function method(): string {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}