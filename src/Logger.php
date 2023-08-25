<?php

namespace Scdewt\Hackathon0823;
use Psr\Log\AbstractLogger;

class Logger extends AbstractLogger
{
    public function log($level, \Stringable|string $message, array $context = []): void
    {
        file_put_contents("/var/log/hackathon.log", $level.": ".((string)$message)."\n", FILE_APPEND);
    }
}