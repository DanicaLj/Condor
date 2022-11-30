<?php

use API\APIFactory;
use API\GoogleAnalitycs;
use API\DB;
use API\MongoDB;

$DBData = [
    "host" => "hostName",
    "databaseName" => "databaseName",
    "username" => "username",
    "password" => "*****"
];
$apiFactory = new APIFactory();
$getData = $apiFactory->create(DB::NAME, $DBData)->getConnection()->get();
print_r($getData);

$googleAnalitycsData = [
    "appName" => "App Name",
    "scope" => [
        "'https://www.googleapis.com/auth/analytics.readonly'"
    ]
];
$getData = $apiFactory->create(GoogleAnalitycs::NAME, $googleAnalitycsData)->getConnection()->get();
print_r($getData);

$mobgoDBData = [
    "user" => "user",
    "password" => "*****",
    "cluster" => "mycluster.mongodb.net"
];
$getData = $apiFactory->create(MongoDB::NAME, $mobgoDBData)->getConnection()->getById();
print_r($getData);
