<?php

namespace App\Models;

use stdClass;

class Posts extends Connection {
    public static function init() {
        self::getInstance('blog');
    }
    
    public static function selectAll():array|false {
        $query = self::$instance->query("SELECT * FROM posts");
        return $query->fetchAll();
    }
    public static function selectOneByColumn(string $column, string $row):\stdClass|null|false {
        $prepare = self::$instance->prepare("SELECT * FROM posts WHERE $column=:row");
        $prepare->execute([":row" => $row]);
        return $prepare->fetchObject();
    }
    public static function selectManyByColumn(string $column, string $row):array|false {
        $prepare = self::$instance->prepare("SELECT * FROM posts WHERE $column=:row");
        $prepare->execute([":row" => $row]);
        return $prepare->fetchAll();
    }
}