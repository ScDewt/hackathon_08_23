<?php
function getConnection()
{
    /** @var string $host - Hostname */
    $host = 'localhost';
    /** @var string $user - Database username */
    $user = 'hackathon';
    /** @var string $pass - Database password */
    $pass = 'hackathon';
    /** @var string $name - Database name */
    $name = 'hackathon_08_23';

    /** @var string $dsn - Connection string */
    $dsn = "mysql:host=$host;dbname=$name;charset=utf8";

    // Create a new PDO connection
    $connection = new \PDO($dsn, $user, $pass);
    $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

    // Return the connection
    return $connection;
}