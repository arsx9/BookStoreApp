<?php

use Doctrine\DBAL\DriverManager as DriverManager;

class DB
{
    private $querybuilder;
    private $connection;
    private $connectionParams;
    public function __construct(Config $config)
    {
        $this->connectionParams = $config->getConfig();
        $this->connection = DriverManager::getConnection($this->connectionParams);
        $this->querybuilder = $this->connection->createQueryBuilder();
    }
    public function getQueryBuilder()
    {
        return $this->querybuilder;
    }
}
