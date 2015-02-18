<?php

/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 29-1-2015
 * Time: 9:25
 */
class DB implements Database
{

    private static $_instance = null;
    private $_pdo,
        $_errors = false,
        $_query,
        $_count = 0,
        $_results;

    public function __construct()
    {
        try {
            $this->_pdo = new PDO('mysql:host=' . Config::get('mysql/host') . ';dbname=' . Config::get('mysql/dbname'), Config::get('mysql/username'), Config::get('mysql/password'));
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function getInstance()
    {
        if ( ! isset(self::$_instance)) {
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params = array())
    {
        $this->_errors = false;
        if ($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            if (count($params)) {
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            if ($this->_query->execute()) {
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            } else {
                $this->_errors = true;
            }
        }
        return $this;

    }

    public function action($action, $table, $where = array(), $order = '')
    {
        if (count($where) === 3) {
            $operators = array('=', '<', '>', '<=', '>=', 'LIKE');

            $field = $where[0];
            $operator = $where[1];
            $value = $where[2];

            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ? {$order}";
                if ( ! $this->query($sql, array($value))->error()) {
                    return $this;
                }
            }
        }
        return false;
    }

    public function match($table)
    {
        $deze = DB::getInstance()->query("SELECT * FROM $table");
        return $deze->results();
    }

    public function get($table, $where = array(), $order = '')
    {
        return $this->action('SELECT *', $table, $where, $order);
    }

    public function delete($table, $where = array())
    {
        return $this->action('DELETE', $table, $where);
    }

    public function insert($table, $fields = array())
    {

        $keys = array_keys($fields);
        $values = null;
        $x = 1;


        foreach ($fields as $field) {
            $values .= "'$field'";
            if ($x < count($fields)) {
                $values .= ', ';
            }
            $x++;
        }
        $sql = "INSERT INTO $table (" . implode(', ', $keys) . ") VALUE ({$values})";
        if ( ! $this->query($sql, $fields)->error()) {
            return true;
        }
        return false;
    }

    public function update($table, $id, $fields)
    {
        $set = '';
        $x = 1;

        foreach ($fields as $name => $value) {
            $set .= "{$name} = '{$value}'";
            if ($x < count($fields)) {
                $set .= ', ';
            }
            $x++;
        }
        $sql = "UPDATE {$table} SET {$set} WHERE idusers= {$id}";
        if ( ! $this->query($sql, $fields)->error()) {
            return true;
        }
        return false;
    }

    public function error()
    {
        return $this->_errors;
    }

    public function count()
    {
        return $this->_count;
    }

    public function results()
    {
        return $this->_results;
    }

    public function first()
    {
        return $this->_results[0];
    }
}

?>