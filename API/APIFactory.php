<?php

namespace API;
use API\APIInterface;
class APIFactory
{
    public function create($type, $data, $format = APIInterface::FORMAT_JSON)
    {
        if ($type == DB::NAME) {
            $host = isset($data["host"]) ? $data["host"] : null;
            $databaseName = isset($data["databaseName"]) ? $data["databaseName"] : null;
            $username = isset($data["username"]) ? $data["username"] : null;
            $password = isset($data["password"]) ? $data["password"] : null;
            return new DB($host, $databaseName, $username, $password, $format);
        } else if ($type == GoogleAnalitycs::NAME) {
            $appName = isset($data["appName"]) ? $data["appName"] : null;
            $scope = isset($data["scope"]) ? $data["scope"] : [];
            return new GoogleAnalitycs($appName, $scope, $format);
        } else if ($type == MongoDB::NAME) {
            $user = isset($data["user"]) ? $data["user"] : null;
            $password = isset($data["password"]) ? $data["password"] : null;
            $cluster = isset($data["cluster"]) ? $data["cluster"] : null;
            return new MongoDB($user, $password, $cluster, $format);
        }
    }
}
