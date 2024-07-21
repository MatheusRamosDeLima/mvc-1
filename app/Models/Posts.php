<?php

namespace App\Models;

class Posts extends Connection {
    public static function init(): void {
        self::getInstance('blog');
    }
    
    public static function selectAll(): array|false {
        $query = self::$instance->query("SELECT rowid, * FROM posts");
        return $query->fetchAll();
    }
    public static function selectOneByColumn(string $column, string $row): \stdClass|null|false {
        $query = self::$instance->prepare("SELECT rowid, * FROM posts WHERE $column=:row");
        $query->execute([":row" => $row]);
        return $query->fetchObject();
    }
    public static function selectManyByColumn(string $column, string $row): array|false {
        $query = self::$instance->prepare("SELECT rowid, * FROM posts WHERE $column=:row");
        $query->execute([":row" => $row]);
        return $query->fetchAll();
    }
    public static function selectDistinctValuesByColumn(string $column): array|false {
        $query = self::$instance->query("SELECT DISTINCT $column FROM posts");
        $values = $query->fetchAll();

        if (!$values) return false;

        $newValues = [];
        foreach ($values as $value) $newValues[] = $value->$column;

        return $newValues;
    }
}