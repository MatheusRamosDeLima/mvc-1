<?php

namespace App\Core;

use App\Database\Connection;

use App\Helpers\PdoQuery;

abstract class Model {
    private static \PDO $connection;

    protected string $table;
    protected array $columns;

    protected function init(string $table, array $columns): void {
        self::$connection = Connection::getInstance('blog');

        $this->table = $table;
        $this->columns = $columns;
    }

    public function selectAll(): array|false {
        $query = self::$connection->query("SELECT rowid, * FROM {$this->table}");
        return $query->fetchAll();
    }
    public function selectById(string $id) {
        $query = self::$connection->prepare("SELECT rowid, * FROM {$this->table} WHERE rowid=:id");
        $query->execute([':id' => $id]);
        return $query->fetchObject();
    }
    public function selectOneByColumn(string $column, string $row): \stdClass|null|false {
        $query = self::$connection->prepare("SELECT rowid, * FROM {$this->table} WHERE $column=:row");
        $query->execute([":row" => $row]);
        return $query->fetchObject();
    }
    public function selectManyByColumn(string $column, string $row): array|false {
        $query = self::$connection->prepare("SELECT rowid, * FROM {$this->table} WHERE $column=:row");
        $query->execute([":row" => $row]);
        return $query->fetchAll();
    }
    public function selectDistinctValuesByColumn(string $column): array|false {
        $query = self::$connection->query("SELECT DISTINCT $column FROM {$this->table}");
        $values = $query->fetchAll();

        if (!$values) return false;

        $newValues = [];
        foreach ($values as $value) $newValues[] = $value->$column;

        return $newValues;
    }
    public function insert(array $rows): bool {
        $columnsSet = PdoQuery::insertColumnsSet($this->columns);
        $rowsSet = PdoQuery::insertRowsSet($this->columns);
        $execArray = PdoQuery::execArray($this->columns, $rows);

        $query = self::$connection->prepare("INSERT INTO {$this->table} $columnsSet VALUES $rowsSet");
        $exec = $query->execute($execArray);
        return $exec;
    }
    public function update(string $id, array $rows) {
        $updateSet = PdoQuery::updateSet($this->columns);
        $execArray = PdoQuery::execArray($this->columns, $rows);
        $execArray[':id'] = $id;
        
        $query = self::$connection->prepare("UPDATE {$this->table} SET $updateSet WHERE rowid = :id");
        $exec = $query->execute($execArray);
        return $exec;
    }
    public function delete(string $id): bool {
        $query = self::$connection->prepare("DELETE FROM {$this->table} WHERE rowid = :id");
        $exec = $query->execute([':id' => $id]);
        return $exec;
    }
}