<?php

namespace API;

use API\APIInterface;
use API\Helper;

class DB extends Helper implements APIInterface
{
    public const NAME = "DB";

    public function __construct(
        private string $host,
        private string $databaseName,
        private string $username,
        private string $password,
        private string $format,
        private string $table = 'table',
        private $connection = null
    ) {
        if (!isset($this->connection)) {
            try {
                $this->connection = new \PDO("mysql:host=" . $host . ";dbname=" . $databaseName, $username, $password);
            } catch (\PDOException $exception) {
                echo "Error occured: " . $exception->getMessage();
            }
        }
        $this->format = $format;
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
            $result = $stmt->fetchAll();
        } catch (\PDOException $exception) {
            echo "Error occured: " . $exception->getMessage();
            return false;
        }

        if ($this->format == APIInterface::FORMAT_XML) { //this should be added in all API methods
            return $this->arrayToXml($result);
        }
        return json_encode($result);
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
