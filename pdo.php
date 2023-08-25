<?php

// Load composer
require __DIR__ . '/vendor/autoload.php';

function getConnection()
{
    return \Scdewt\Hackathon0823\Connection\Connection::getConnection();
}