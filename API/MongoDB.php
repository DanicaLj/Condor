<?php

namespace API;

use API\APIInterface;
use API\Helper;
class MongoDB extends Helper implements APIInterface
{
    public const NAME = "MongoDB";

    public function __construct(
        private string $user,
        private string $password,
        private string $cluster,
        private string $format,
        private $connection = null
    ) {
        if (!isset($this->connection)) {
            try {
                $this->connection = new \MongoDB\Client(
                    'mongodb+srv://' . $user . ':' . $password . '@' . $cluster . '/test'
                );
            } catch (\PDOException $exception) {
                echo "Error occured: " . $exception->getMessage();
            }
        }
        $this->format = $format;
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

        if ($this->format == APIInterface::FORMAT_XML) { //this should be added in all API methods
            return $this->arrayToXml($result);
        }

        //check if result is already json
        return $this->isJSON($result) ? $this->isJSON($result) : json_encode($result);
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
