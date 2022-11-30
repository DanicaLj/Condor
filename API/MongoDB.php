<?php

namespace API;

use API\APIInterface;

class MongoDB implements APIInterface
{
    public const NAME = "MongoDB";

    public function __construct(
        private string $user,
        private string $password,
        private string $cluster,
        private $connection = null
    ) {
        $this->user = $user;
        $this->password = $password;
        $this->cluster = $cluster;
        $this->connection = $connection;
    }

    public function getConnection()
    {
        if (!isset($this->connection)) {
            try {
                $this->connection = new \MongoDB\Client(
                    'mongodb+srv://' . $this->user . ':' . $this->password . '@' . $this->cluster . '/test'
                );
            } catch (\PDOException $exception) {
                echo "Error occured: " . $exception->getMessage();
            }
        }

        return $this->connection;
    }

    public function get()
    {
        //get data
    }

    public function getById($id)
    {
        $collection = $this->connection->test->users;

        $result = $collection->find([
            'id' => $id,
            'email' => 'admin@example.com',
            'name' => 'Admin User',
        ]);
        return $result;
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
