<?php


// Load composer
require __DIR__ . '/vendor/autoload.php';

$bot_api_key = '6363703996:AAF8bq4NQ8yd3PVO-7vFC1_LfvaNUmKRpTc';
$bot_username = 'ga_hackathon_bot';
$hook_url = 'https://hackathon0823.scdewt.ru/webhook.php';

try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);

    // Set webhook
    $result = $telegram->setWebhook($hook_url);
    if ($result->isOk()) {
        echo $result->getDescription();
    }
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // log telegram errors
     echo $e->getMessage();
}