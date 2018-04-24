<?php

namespace Tests\Feature;


use Jenssegers\Mongodb\Connection;

abstract class TestCase extends \Tests\TestCase
{

    protected function setUp()
    {
        parent::setUp();

        $this->recreateMongoDb();
    }

    private function recreateMongoDb()
    {
        $host   = env('MONGO_DB_HOST');
        $port   = env('MONGO_DB_PORT');
        $dbName = env('MONGO_DB_DATABASE');

        $connection = new Connection([
            'host'     => $host,
            'port'     => $port,
            'database' => $dbName,
        ]);
        $connection->getMongoClient()->dropDatabase($dbName);
    }

}
