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

    public function save($name, $description, $recipes)
    {
        $this->query("INSERT INTO `recipes` (`name`, `description`, `recipes`) VALUES ('$name', '$description', '$recipes')");
        return true;
    }

    public function delete($id)
    {
        $this->query("DELETE FROM `recipes` WHERE id='$id'");
        return true;

    }

    public function edit($id, $name, $description, $recipes)
    {
        $this->query("UPDATE `recipes` SET `name`='$name', `description`='$description', `recipes`='$recipes' WHERE `id`='$id'");
        return true;
    }

    public function getAll()
    {
        return $result = $this->query('SELECT `id`, `name`, `description` FROM `recipes`');
    }

    public function getItem($id)
    {
        return $result = $this->query("SELECT * FROM `recipes` WHERE id='$id'");
    }
}