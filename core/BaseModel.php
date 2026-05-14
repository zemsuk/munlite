<?php
namespace Zems;

class BaseModel extends Database
{
    protected static $table;
    protected static $query;
    protected static $conditions = [];
    protected static $selectColumns = ['*'];
    protected static $orderBy = null;
    protected static $orderDirection = 'ASC';

    public static function query()
    {
        static::$conditions = [];
        static::$selectColumns = ['*'];
        static::$orderBy = null;
        static::$orderDirection = 'ASC';
        return new static;
    }

    protected static function getTable()
    {
        return static::$table ?: strtolower(basename(str_replace('\\', '/', static::class)));
    }

    public static function select(...$columns)
    {
        static::$selectColumns = $columns;
        return new static;
    }

    public static function orderBy($column, $direction = 'ASC')
    {
        static::$orderBy = $column;
        static::$orderDirection = strtoupper($direction);
        return new static;
    }

    public static function where($column, $operator = null, $value = null)
    {
        if ($value === null) {
            $value = $operator;
            $operator = '=';
        }
        static::$conditions[] = ['type' => 'AND', 'column' => $column, 'operator' => $operator, 'value' => $value];
        return new static;
    }

    public static function orWhere($column, $operator = null, $value = null)
    {
        if ($value === null) {
            $value = $operator;
            $operator = '=';
        }
        static::$conditions[] = ['type' => 'OR', 'column' => $column, 'operator' => $operator, 'value' => $value];
        return new static;
    }

    public static function whereIn($column, array $values)
    {
        $placeholders = implode(', ', array_fill(0, count($values), '?'));
        static::$conditions[] = [
            'type' => 'AND',
            'column' => $column,
            'operator' => 'IN',
            'value' => $values,
            'raw' => "{$column} IN ({$placeholders})"
        ];
        return new static;
    }

    public static function orWhereIn($column, array $values)
    {
        $placeholders = implode(', ', array_fill(0, count($values), '?'));
        static::$conditions[] = [
            'type' => 'OR',
            'column' => $column,
            'operator' => 'IN',
            'value' => $values,
            'raw' => "{$column} IN ({$placeholders})"
        ];
        return new static;
    }

    public static function whereBetween($column, array $range)
    {
        static::$conditions[] = [
            'type' => 'AND',
            'column' => $column,
            'operator' => 'BETWEEN',
            'value' => $range,
            'raw' => "{$column} BETWEEN ? AND ?"
        ];
        return new static;
    }

    public static function orWhereBetween($column, array $range)
    {
        static::$conditions[] = [
            'type' => 'OR',
            'column' => $column,
            'operator' => 'BETWEEN',
            'value' => $range,
            'raw' => "{$column} BETWEEN ? AND ?"
        ];
        return new static;
    }

    public static function get()
    {
        $table = static::getTable();
        $db = self::getInstance();
        $columns = implode(', ', static::$selectColumns);
        $order = static::$orderBy ? " ORDER BY " . static::$orderBy . " " . static::$orderDirection : '';

        if (!empty(static::$conditions)) {
            $where = '';
            $values = [];
            foreach (static::$conditions as $i => $cond) {
                $connector = ($i > 0) ? $cond['type'] . ' ' : '';
                if (isset($cond['raw'])) {
                    $where .= $connector . $cond['raw'];
                    $values = array_merge($values, $cond['value']);
                } else {
                    $where .= $connector . "{$cond['column']} {$cond['operator']} ?";
                    $values[] = $cond['value'];
                }
            }
            $sql = "SELECT $columns FROM $table WHERE $where$order";
            $stmt = $db->conn->prepare($sql);
            $stmt->execute($values);
        } else {
            $sql = "SELECT $columns FROM $table$order";
            $stmt = $db->conn->prepare($sql);
            $stmt->execute();
        }

        static::$conditions = [];
        static::$selectColumns = ['*'];
        static::$orderBy = null;
        static::$orderDirection = 'ASC';
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function first()
    {
        $table = static::getTable();
        $db = self::getInstance();
        $columns = implode(', ', static::$selectColumns);
        $order = static::$orderBy ? " ORDER BY " . static::$orderBy . " " . static::$orderDirection : '';

        if (!empty(static::$conditions)) {
            $where = '';
            $values = [];
            foreach (static::$conditions as $i => $cond) {
                $connector = ($i > 0) ? $cond['type'] . ' ' : '';
                if (isset($cond['raw'])) {
                    $where .= $connector . $cond['raw'];
                    $values = array_merge($values, $cond['value']);
                } else {
                    $where .= $connector . "{$cond['column']} {$cond['operator']} ?";
                    $values[] = $cond['value'];
                }
            }
            $sql = "SELECT $columns FROM $table WHERE $where$order LIMIT 1";
            $stmt = $db->conn->prepare($sql);
            $stmt->execute($values);
        } else {
            $sql = "SELECT $columns FROM $table$order LIMIT 1";
            $stmt = $db->conn->prepare($sql);
            $stmt->execute();
        }

        static::$conditions = [];
        static::$selectColumns = ['*'];
        static::$orderBy = null;
        static::$orderDirection = 'ASC';
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        return static::where('id', $id)->first();
    }

    public static function create(array $data)
    {
        $table = static::getTable();
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));
        $db = self::getInstance();
        $stmt = $db->conn->prepare("INSERT INTO $table ($columns) VALUES ($placeholders)");
        $stmt->execute(array_values($data));
        return $db->conn->lastInsertId();
    }

    public static function update($id, array $data)
    {
        $table = static::getTable();
        $set = implode(' = ?, ', array_keys($data)) . ' = ?';
        $db = self::getInstance();
        $stmt = $db->conn->prepare("UPDATE $table SET $set WHERE id = ?");
        $values = array_values($data);
        $values[] = $id;
        $stmt->execute($values);
        return $stmt->rowCount();
    }

    public static function delete($id)
    {
        $table = static::getTable();
        $db = self::getInstance();
        $stmt = $db->conn->prepare("DELETE FROM $table WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
}