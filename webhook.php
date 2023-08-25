<?php


// Load composer
require __DIR__ . '/vendor/autoload.php';

$bot_api_key = 'your:bot_api_key';
$bot_username = 'username_bot';

try {
    error_log("telegram: new message");
    \Longman\TelegramBot\TelegramLog::initialize();

    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    $telegram->addCommandClass(\Scdewt\Hackathon0823\Command\StartCommand::class);
    $telegram->addCommandClass(\Scdewt\Hackathon0823\Command\NameCommand::class);
    $telegram->addCommandClass(\Scdewt\Hackathon0823\Command\TeamCommand::class);


    // Handle telegram webhook request
    $telegram->handle();


} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Silence is golden!
    // log telegram errors
    error_log($e->getMessage());
}