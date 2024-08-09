<?php

namespace App\Core;

use App\Database\Connection;

use App\Helpers\PdoQuery;

abstract class Model {
    private static \PDO $connection;

    protected static string $table;
    protected static array $fields;

    protected static function init(string $table, array $fields): void {
        self::$connection = Connection::getInstance('blog');

        self::$table = $table;
        self::$fields = $fields;
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
    public static function selectOneByField(string $field, string $value): \stdClass|null|false {
        $query = self::$connection->prepare("SELECT rowid, * FROM ".self::$table." WHERE $field=:value");
        $query->execute([":value" => $value]);
        return $query->fetchObject();
    }
    public static function selectManyByField(string $field, string $value): array|false {
        $query = self::$connection->prepare("SELECT rowid, * FROM ".self::$table." WHERE $field=:value");
        $query->execute([":value" => $value]);
        return $query->fetchAll();
    }
    public static function selectColumn(string $field): array|false {
        $query = self::$connection->query("SELECT DISTINCT $field FROM ".self::$table);
        $column = $query->fetchAll();

        if (!$column) return false;

        $newColumn = [];
        foreach ($column as $value) $newColumn[] = $value->$field;

        return $newColumn;
    }
    public static function insert(array $values): bool {
        $fieldsSet = PdoQuery::insertFieldsSet(self::$fields);
        $valuesSet = PdoQuery::insertValuesSet(self::$fields);
        $execArray = PdoQuery::execArray(self::$fields, $values);

        $query = self::$connection->prepare("INSERT INTO ".self::$table." $fieldsSet VALUES $valuesSet");
        $exec = $query->execute($execArray);
        return $exec;
    }
    public static function update(string $id, array $values) {
        $updateSet = PdoQuery::updateSet(self::$fields);
        $execArray = PdoQuery::execArray(self::$fields, $values);
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