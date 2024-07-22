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
    public static function selectById(int $id) {
        $query = self::$instance->prepare("SELECT rowid, * FROM posts WHERE rowid=:id");
        $query->execute([':id' => $id]);
        return $query->fetchObject();
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
    public static function insert(string $title, string $content, string $category): bool {
        $query = self::$instance->prepare("INSERT INTO posts ('title', 'content', 'category') VALUES (:title, :main, :category)");
        $exec = $query->execute([
            ':title' => $title,
            ':main' => $content,
            ':category' => $category
        ]);
        return $exec;
    }
    public static function update(int $id, string $title, string $content, string $category) {
        $query = self::$instance->prepare("UPDATE posts SET title = :title, content = :content, category = :category WHERE rowid = :id");
        $exec = $query->execute([
            ':id' => $id,
            ':title' => $title,
            ':content' => $content,
            ':category' => $category
        ]);
        return $exec;
    }
    public static function delete(int $id): bool {
        $query = self::$instance->prepare("DELETE FROM posts WHERE rowid = :id");
        $exec = $query->execute([':id' => $id]);
        return $exec;
    }
}