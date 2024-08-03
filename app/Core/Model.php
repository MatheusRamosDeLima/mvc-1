<?php

namespace App\Core;

use App\Database\Connection;

use App\Helpers\PdoQuery;

abstract class Model {
    private static \PDO $connection;

    protected static string $table;
    protected static array $columns;

    protected static function init(string $table, array $columns): void {
        self::$connection = Connection::getInstance('blog');

        self::$table = $table;
        self::$columns = $columns;
    }

    public static function selectAll(): array|false {
        $query = self::$connection->query("SELECT rowid, * FROM ".self::$table);
        return $query->fetchAll();
    }
    public static function selectById(string $id) {
        $query = self::$connection->prepare("SELECT rowid, * FROM ".self::$table." WHERE rowid=:id");
        $query->execute([':id' => $id]);
        return $query->fetchObject();
    }
    public static function selectOneByColumn(string $column, string $row): \stdClass|null|false {
        $query = self::$connection->prepare("SELECT rowid, * FROM ".self::$table." WHERE $column=:row");
        $query->execute([":row" => $row]);
        return $query->fetchObject();
    }
    public static function selectManyByColumn(string $column, string $row): array|false {
        $query = self::$connection->prepare("SELECT rowid, * FROM ".self::$table." WHERE $column=:row");
        $query->execute([":row" => $row]);
        return $query->fetchAll();
    }
    public static function selectDistinctValuesByColumn(string $column): array|false {
        $query = self::$connection->query("SELECT DISTINCT $column FROM ".self::$table);
        $values = $query->fetchAll();

        if (!$values) return false;

        $newValues = [];
        foreach ($values as $value) $newValues[] = $value->$column;

        return $newValues;
    }
    public static function insert(array $rows): bool {
        $columnsSet = PdoQuery::insertColumnsSet(self::$columns);
        $rowsSet = PdoQuery::insertRowsSet(self::$columns);
        $execArray = PdoQuery::execArray(self::$columns, $rows);

        $query = self::$connection->prepare("INSERT INTO ".self::$table." $columnsSet VALUES $rowsSet");
        $exec = $query->execute($execArray);
        return $exec;
    }
    public static function update(string $id, array $rows) {
        $updateSet = PdoQuery::updateSet(self::$columns);
        $execArray = PdoQuery::execArray(self::$columns, $rows);
        $execArray[':id'] = $id;
        
        $query = self::$connection->prepare("UPDATE ".self::$table." SET $updateSet WHERE rowid = :id");
        $exec = $query->execute($execArray);
        return $exec;
    }
    public static function delete(string $id): bool {
        $query = self::$connection->prepare("DELETE FROM ".self::$table." WHERE rowid = :id");
        $exec = $query->execute([':id' => $id]);
        return $exec;
    }
}