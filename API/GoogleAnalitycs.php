<?php

namespace API;

use API\APIInterface;
use API\Helper;

class GoogleAnalitycs extends Helper implements APIInterface
{
    public const KEY_FILE_LOCATION = __DIR__ . '/service-account-credentials.json'; //example
    public const NAME = "GoogleAnalitycs";

    public function __construct(
        private string $appName,
        private array $scope,
        private string $format,
        private $analytics = null        
    ) {
        if (!isset($this->analytics)) {
            try {
                // Create and configure a new client object.
                $client = new Google_Client();
                $client->setApplicationName($appName);
                $client->setAuthConfig(self::KEY_FILE_LOCATION);
                $client->setScopes($scope);
                $this->analytics = new Google_Service_Analytics($client);
            } catch (\PDOException $exception) {
                echo "Error occured: " . $exception->getMessage();
            }
        }
        $this->format = $format;
    }

    public function get()
    {
        // Get the list of accounts for the authorized user.
        $accounts = $this->analytics->management_accounts->listManagementAccounts()->getItems();

        if ($this->format == APIInterface::FORMAT_XML) { //this should be added in all API methods
            return $this->arrayToXml($accounts);
        }
        return json_encode($accounts);
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
