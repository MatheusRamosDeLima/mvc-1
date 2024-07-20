<?php

namespace App\Models;

class Categories extends Connection {
    public static function init(): void {
        self::getInstance('blog');
    }
    
    public static function selectAll(): array|false {
        $query = self::$instance->query("SELECT * FROM categories");
        return $query->fetchAll();
    }
    public static function selectOneByColumn(string $column, string $row): \stdClass|null|false {
        $prepare = self::$instance->prepare("SELECT * FROM categories WHERE $column=:row");
        $prepare->execute([":row" => $row]);
        return $prepare->fetchObject();
    }
}