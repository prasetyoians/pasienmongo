<?php


namespace App\Config;

use MongoDB\Client;

class MongoDBConfig
{
    private $client;
    private $database;

    public function __construct()
    {
        // Ganti sesuai koneksi MongoDB-mu
        $this->client = new Client("mongodb://localhost:27017"); 
        $this->database = $this->client->your_database_name; // Ganti dengan nama database-mu
    }

    public function getDB()
    {
        return $this->database;
    }
}