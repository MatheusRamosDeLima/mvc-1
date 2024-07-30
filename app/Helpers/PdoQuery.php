<?php

namespace App\Helpers;

class PdoQuery {
    public static function insertColumnsSet(array $columns): string {
        /*
        query = "INSERT INTO Table
        ('column1', 'column2', 'column3', 'column4' ...)
        VALUES
        (:column1, :column2, :column3, :column4, ...)"

        after help:

        query = "INSERT INTO Table
        $columnsSet
        VALUES
        (:column1, :column2, :column3, :column4, ...)"
        */

        $columnsSet = '(';
        for ($i = 0; $i < count($columns); $i++) {
            if ($i === 0) $columnsSet .= "'{$columns[$i]}'";
            else $columnsSet .= ", '{$columns[$i]}'";
        }
        $columnsSet .= ')';
        return $columnsSet;
        
        // $columnsSet = " ('column1', 'column2', ...) "
    }
    public static function insertRowsSet(array $columns): string {
        /*
        query = "INSERT INTO Table 
        ('column1', 'column2', 'column3', 'column4', ...)
        VALUES
        (:column1, :column2, :column3, :column4, ...)"

        after help:

        query = "INSERT INTO Table
        ('column1', 'column2', 'column3', 'column4', ...)
        VALUES
        $rowsSet"
        */
        
        $rowsSet = '(';
        for ($i = 0; $i < count($columns); $i++) {
            if ($i === 0) $rowsSet .= ":{$columns[$i]}";
            else $rowsSet .= ", :{$columns[$i]}";
        }
        $rowsSet .= ')';
        return $rowsSet;

        // $rowsSet = " (:column1, :column2, ...) "
    }
    public static function updateSet(array $columns): string {
        /*
        query = "UPDATE Table SET
        column1 = :column1,
        column2 = :column2,
        column3 = :column3
        ...
        WHERE ..."
        
        after code:
        
        query = "UPDATE Table SET
        $columnsSet
        WHERE ..."
        */

        $updateSet = '';
        for ($i = 0; $i < count($columns); $i++) {
            if ($i === 0) $updateSet .= "{$columns[$i]} = :{$columns[$i]}";
            else $updateSet .= ", {$columns[$i]} = :{$columns[$i]}";
        }
        return $updateSet;

        // $updateSet = " column1 = :column1, column2 = :column2, ... "
    }
    public static function execArray(array $columns, array $rows): array {
        /*
        $query->execute([
            ':column1' => $row1,
            ':column2' => $row2,
            ':column3' => $row3,
            ':column4' => $row4,
            ...
        ])

        after help:

        $query->execute($execArray)
        */

        $execArray = [];
        for ($i = 0; $i < count($columns); $i++) {
            $execArray[":{$columns[$i]}"] = $rows[$i];
        }
        return $execArray;

        /*
        $execArray = [
            ':column1' => $row1,
            ':column2' => $row2,
            ':column3' => $row3,
            ':column4' => $row4,
            ...
        ]
        */
    }
}