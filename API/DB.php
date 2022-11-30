<?php

namespace API;

use API\APIInterface;

class DB implements APIInterface
{
    public const NAME = "DB";

    public function __construct(
        private string $host,
        private string $databaseName,
        private string $username,
        private string $password,
        private string $table = 'table',
        private $connection = null
    ) {
        $this->host = $host;
        $this->databaseName = $databaseName;
        $this->username = $username;
        $this->password = $password;
        $this->table = $table;
        $this->connection = $connection;
    }

    public function getConnection()
    {
        if (!isset($this->connection)) {
            try {
                $this->connection = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->databaseName, $this->username, $this->password);
            } catch (\PDOException $exception) {
                echo "Error occured: " . $exception->getMessage();
            }
        }
        return $this->connection;
    }

    /**
     * @return string|bool
     */
    public function get()
    {
        $sqlQuery = "SELECT id, name, description, price FROM " . $this->table . "";
        $stmt = $this->connection->prepare($sqlQuery);
        try {
            $stmt->execute();
        } catch (PDOException $exception) {
            echo "Error occured: " . $exception->getMessage();
            return false;
        }

        return $stmt;
    }

    public function getById($id)
    {
        //get data by specific id
    }

    public function create($data)
    {
        //create new record
    }

    public function update($data)
    {
        //update existing record
    }

    public function delete($id)
    {
        //delete data by id
    }
}
