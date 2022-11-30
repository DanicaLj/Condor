<?php

use API\APIFactory;
use API\GoogleAnalitycs;
use API\DB;
use API\MongoDB;
use API\APIInterface;

$DBData = [
    "host" => "hostName",
    "databaseName" => "databaseName",
    "username" => "username",
    "password" => "*****"
];
$apiFactory = new APIFactory();
$getDBData = $apiFactory->create(DB::NAME, $DBData)->get();
print_r($getDBData);

$googleAnalitycsData = [
    "appName" => "App Name",
    "scope" => [
        "'https://www.googleapis.com/auth/analytics.readonly'"
    ]
];
$getAnalitycsData = $apiFactory->create(GoogleAnalitycs::NAME, $googleAnalitycsData, APIInterface::FORMAT_XML)->get(); //set return to be in xml format
print_r($getAnalitycsData);

$mobgoDBData = [
    "user" => "user",
    "password" => "*****",
    "cluster" => "mycluster.mongodb.net"
];
$id = 1;
$getMongoData = $apiFactory->create(MongoDB::NAME, $mobgoDBData)->getById($id);
print_r($getMongoData);
