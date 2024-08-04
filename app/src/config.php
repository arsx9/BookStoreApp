<?php

class Config
{
    private $dbSettings;
    private $errorSettings;
    public function __construct()
    {
        $this->dbSettings = [
            'dbname' => 'book-app-slimpp',
            'user' => 'root',
            'password' => '',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        ];
    }
    public function getConfig()
    {
        return $this->dbSettings;
    }
}
