<?php

class Connection
{
    protected static $instance;
    protected $pdo;

    protected function __construct()
    {
        $dsn = 'mysql:dbname=book;host=localhost;charset=utf8';
        $login = 'root';
        $password = '';
        $this->pdo = new PDO($dsn, $login, $password);
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    public function query($sql, $param = array())
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute((array)$param);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($query)
    {
        $this->query("$query");
        return true;
    }

    public function delete($table, $id)
    {
        $this->query("DELETE FROM `$table` WHERE id='$id'");
        return true;

    }

    public function edit($query)
    {
        $this->query("$query");
        return true;
    }

    public function getAll($table)
    {
        return $result = $this->query("SELECT * FROM `$table`");
    }

    public function getItem($table, $id)
    {
        return $result = $this->query("SELECT * FROM `$table` WHERE id='$id'");
    }
}