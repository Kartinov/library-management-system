<?php

use PDO;
use PDOException;

abstract class Connection
{
    protected $connection;

    public function __construct()
    {
        try {
            global $config;

            $db = $config['database'];

            $this->connection = new PDO(
                $db['connection'] . ';dbname=' . $db['name'],
                $db['username'],
                $db['password'],
                // $config['options']
            );
        } catch (PDOException $e) {
            die('Connection failed.');
        }
    }
}
