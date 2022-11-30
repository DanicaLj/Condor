<?php

namespace API;

use API\APIInterface;

class GoogleAnalitycs implements APIInterface
{
    public const KEY_FILE_LOCATION = __DIR__ . '/service-account-credentials.json'; //example
    public const NAME = "GoogleAnalitycs";

    public function __construct(
        private string $appName,
        private array $scope,
        private $analytics = null
    ) {
        $this->appName = $appName;
        $this->scope = $scope;
        $this->analytics = $analytics;
    }

    public function getConnection()
    {
        if (!isset($this->analytics)) {
            try {
                // Create and configure a new client object.
                $client = new Google_Client();
                $client->setApplicationName($this->appName);
                $client->setAuthConfig(self::KEY_FILE_LOCATION);
                $client->setScopes($this->scope);
                $this->analytics = new Google_Service_Analytics($client);
            } catch (\PDOException $exception) {
                echo "Error occured: " . $exception->getMessage();
            }
        }

        return $this->analytics;
    }
    public function get()
    {
        // Get the list of accounts for the authorized user.
        $accounts = $this->analytics->management_accounts->listManagementAccounts();
        return $accounts;
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
