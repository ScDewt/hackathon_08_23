<?php


// Load composer
require __DIR__ . '/vendor/autoload.php';

$bot_api_key = '6363703996:AAF8bq4NQ8yd3PVO-7vFC1_LfvaNUmKRpTc';
$bot_username = 'ga_hackathon_bot';

$logger = new \Scdewt\Hackathon0823\Logger();

try {
    \Longman\TelegramBot\TelegramLog::initialize($logger, $logger);
    $logger->info("telegram: new message");


    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    $telegram->addCommandClass(\Scdewt\Hackathon0823\Command\StartCommand::class);
    $telegram->addCommandClass(\Scdewt\Hackathon0823\Command\NameCommand::class);
    $telegram->addCommandClass(\Scdewt\Hackathon0823\Command\TeamCommand::class);
    $telegram->addCommandClass(\Scdewt\Hackathon0823\Command\LocationCommand::class);


    // Handle telegram webhook request
    $telegram->handle();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Silence is golden!
    // log telegram errors
    $logger->error($e->getMessage());
}