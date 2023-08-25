<?php

namespace Scdewt\Hackathon0823\Command;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\KeyboardButton;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Scdewt\Hackathon0823\DB\Connection;

class LocationCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'location';

    /**
     * @var string
     */
    protected $description = 'Share your location';

    /**
     * @var string
     */
    protected $usage = '/location';

    public function execute(): ServerResponse
    {
        $message = $this->getMessage();

        $chat_id = $message->getChat()->getId();

        $data = ['chat_id' => $chat_id];

        $data['reply_markup'] = (new Keyboard(
            (new KeyboardButton('Share Location'))->setRequestLocation(true)
        ))
            ->setOneTimeKeyboard(true)
            ->setResizeKeyboard(true)
            ->setSelective(true);

        $data['text'] = 'Share your location:';

        return Request::sendMessage($data);
    }
}