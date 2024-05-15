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
    public function getArray(string $table, string $row, string $column):array|false {
        $query = self::$instance->query("SELECT * FROM $table WHERE $column='$row'");
        return $query->fetchAll();
    }
    public function getObject(string $table, string $row, string $column = 'id'):stdClass|null|false {
        $query = self::$instance->query("SELECT * FROM $table WHERE $column='$row'");
        return $query->fetchObject();
    }
}