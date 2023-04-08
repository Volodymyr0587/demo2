<?php

namespace Core;

use PDO;

// connect to our MySQL database and execute a query.
class Database
{
    public PDO $connection;
    public array $opt;
    public $statement;

    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:' . http_build_query($config, '', ';');
        
        $this->opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];

        $this->connection = new PDO($dsn, $username, $password, $this->opt);
    }

    public function query($query, $params = []): static
    {
        $this->statement = $this->connection->prepare($query, $this->opt);

        $this->statement->execute($params);

        return $this;

    }

    public function get() 
    {
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function findOrFail()
    {
        $result = $this->find();

        if (! $result) {
            abort();
        }

        return $result;
    }
}