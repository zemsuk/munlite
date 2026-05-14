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
    protected static $groupBy = null;
    protected static $limit = null;
    protected static $offset = null;
    protected static $joins = [];

    public static function query()
    {
        static::$conditions = [];
        static::$selectColumns = ['*'];
        static::$orderBy = null;
        static::$orderDirection = 'ASC';
        static::$groupBy = null;
        static::$limit = null;
        static::$offset = null;
        static::$joins = [];
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

    public static function groupBy($column)
    {
        static::$groupBy = $column;
        return new static;
    }

    public static function join($table, $first, $operator, $second, $type = 'INNER')
    {
        static::$joins[] = [
            'type' => $type,
            'table' => $table,
            'first' => $first,
            'operator' => $operator,
            'second' => $second
        ];
        return new static;
    }

    public static function leftJoin($table, $first, $operator, $second)
    {
        return static::join($table, $first, $operator, $second, 'LEFT');
    }

    public static function rightJoin($table, $first, $operator, $second)
    {
        return static::join($table, $first, $operator, $second, 'RIGHT');
    }

    public static function limit($value)
    {
        static::$limit = $value;
        return new static;
    }

    public static function offset($value)
    {
        static::$offset = $value;
        return new static;
    }

    public static function count($column = '*')
    {
        $table = static::getTable();
        $db = self::getInstance();
        $where = '';
        $values = [];

        if (!empty(static::$conditions)) {
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
            $where = " WHERE " . $where;
        }

        $sql = "SELECT COUNT($column) as result FROM $table$where";
        $stmt = $db->conn->prepare($sql);
        $stmt->execute($values);
        static::query();
        return $stmt->fetch(\PDO::FETCH_ASSOC)['result'];
    }

    public static function max($column)
    {
        $table = static::getTable();
        $db = self::getInstance();
        $where = '';
        $values = [];

        if (!empty(static::$conditions)) {
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
            $where = " WHERE " . $where;
        }

        $sql = "SELECT MAX($column) as result FROM $table$where";
        $stmt = $db->conn->prepare($sql);
        $stmt->execute($values);
        static::query();
        return $stmt->fetch(\PDO::FETCH_ASSOC)['result'];
    }

    public static function min($column)
    {
        $table = static::getTable();
        $db = self::getInstance();
        $where = '';
        $values = [];

        if (!empty(static::$conditions)) {
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
            $where = " WHERE " . $where;
        }

        $sql = "SELECT MIN($column) as result FROM $table$where";
        $stmt = $db->conn->prepare($sql);
        $stmt->execute($values);
        static::query();
        return $stmt->fetch(\PDO::FETCH_ASSOC)['result'];
    }

    public static function avg($column)
    {
        $table = static::getTable();
        $db = self::getInstance();
        $where = '';
        $values = [];

        if (!empty(static::$conditions)) {
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
            $where = " WHERE " . $where;
        }

        $sql = "SELECT AVG($column) as result FROM $table$where";
        $stmt = $db->conn->prepare($sql);
        $stmt->execute($values);
        static::query();
        return $stmt->fetch(\PDO::FETCH_ASSOC)['result'];
    }

    public static function sum($column)
    {
        $table = static::getTable();
        $db = self::getInstance();
        $where = '';
        $values = [];

        if (!empty(static::$conditions)) {
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
            $where = " WHERE " . $where;
        }

        $sql = "SELECT SUM($column) as result FROM $table$where";
        $stmt = $db->conn->prepare($sql);
        $stmt->execute($values);
        static::query();
        return $stmt->fetch(\PDO::FETCH_ASSOC)['result'];
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
        $group = static::$groupBy ? " GROUP BY " . static::$groupBy : '';
        $limit = static::$limit ? " LIMIT " . static::$limit : '';
        $offset = static::$offset ? " OFFSET " . static::$offset : '';

        $joins = '';
        foreach (static::$joins as $join) {
            $joins .= " {$join['type']} JOIN {$join['table']} ON {$join['first']} {$join['operator']} {$join['second']}";
        }

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
            $sql = "SELECT $columns FROM $table$joins WHERE $where$group$order$limit$offset";
            $stmt = $db->conn->prepare($sql);
            $stmt->execute($values);
        } else {
            $sql = "SELECT $columns FROM $table$joins$group$order$limit$offset";
            $stmt = $db->conn->prepare($sql);
            $stmt->execute();
        }

        static::$conditions = [];
        static::$selectColumns = ['*'];
        static::$orderBy = null;
        static::$orderDirection = 'ASC';
        static::$groupBy = null;
        static::$limit = null;
        static::$offset = null;
        static::$joins = [];
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function first()
    {
        $table = static::getTable();
        $db = self::getInstance();
        $columns = implode(', ', static::$selectColumns);
        $order = static::$orderBy ? " ORDER BY " . static::$orderBy . " " . static::$orderDirection : '';
        $group = static::$groupBy ? " GROUP BY " . static::$groupBy : '';
        $offset = static::$offset ? " OFFSET " . static::$offset : '';

        $joins = '';
        foreach (static::$joins as $join) {
            $joins .= " {$join['type']} JOIN {$join['table']} ON {$join['first']} {$join['operator']} {$join['second']}";
        }

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
            $sql = "SELECT $columns FROM $table$joins WHERE $where$group$order LIMIT 1$offset";
            $stmt = $db->conn->prepare($sql);
            $stmt->execute($values);
        } else {
            $sql = "SELECT $columns FROM $table$joins$group$order LIMIT 1$offset";
            $stmt = $db->conn->prepare($sql);
            $stmt->execute();
        }

        static::$conditions = [];
        static::$selectColumns = ['*'];
        static::$orderBy = null;
        static::$orderDirection = 'ASC';
        static::$groupBy = null;
        static::$limit = null;
        static::$offset = null;
        static::$joins = [];
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

    public static function update(array $data)
    {
        $table = static::getTable();
        $set = implode(' = ?, ', array_keys($data)) . ' = ?';
        $db = self::getInstance();
        $values = array_values($data);

        if (!empty(static::$conditions)) {
            $where = '';
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
            $sql = "UPDATE $table SET $set WHERE $where";
        } else {
            $sql = "UPDATE $table SET $set";
        }

        $stmt = $db->conn->prepare($sql);
        $stmt->execute($values);
        $count = $stmt->rowCount();
        static::query();
        return $count;
    }

    public static function delete()
    {
        $table = static::getTable();
        $db = self::getInstance();
        $values = [];

        if (!empty(static::$conditions)) {
            $where = '';
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
            $sql = "DELETE FROM $table WHERE $where";
        } else {
            $sql = "DELETE FROM $table";
        }

        $stmt = $db->conn->prepare($sql);
        $stmt->execute($values);
        $count = $stmt->rowCount();
        static::query();
        return $count;
    }
}