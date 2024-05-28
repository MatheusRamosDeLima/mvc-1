<?php

namespace App\Models;

use stdClass;

class BlogModel extends Connection {
    public function __construct() {
        self::getInstance('blog');
    }
    
    public function getAll(string $table):array|false {
        $query = self::$instance->query("SELECT * FROM $table");
        return $query->fetchAll();
    }
    public function getArray(string $table, string $column, string $row):array|false {
        $prepare = self::$instance->prepare("SELECT * FROM $table WHERE $column=:row");
        $prepare->execute([":row" => $row]);
        return $prepare->fetchAll();
    }
    public function getObject(string $table, string $column, string $row):stdClass|null|false {
        $prepare = self::$instance->prepare("SELECT * FROM $table WHERE $column=:row");
        $prepare->execute([":row" => $row]);
        return $prepare->fetchObject();
    }
}