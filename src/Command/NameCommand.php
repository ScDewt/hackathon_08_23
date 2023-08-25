<?php

namespace Scdewt\Hackathon0823\Command;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\TelegramLog;
use Scdewt\Hackathon0823\DB\Connection;

class NameCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'name';

    /**
     * @var string
     */
    protected $description = 'Set your name';

    /**
     * @var string
     */
    protected $usage = '/name <your name>';

    public function execute(): ServerResponse
    {
        $message = $this->getMessage();

        $chat_id = $message->getChat()->getId();
        $user_id = $message->getFrom()->getId();
        $name    = trim($message->getText(true));

        if (!$name) {
            $name = $message->getFrom()->getFirstName() . " " . $message->getFrom()->getLastName() ;
        }

        $conn = Connection::getConnection();

        $sql = "UPDATE main SET person_name=:person_name where person_id=:person_id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':person_id', $user_id);
        $stmt->bindParam(':person_name', $name);
        if (!$stmt->execute()) {
            TelegramLog::error($stmt->errorInfo()[0]);
        }

        $data = ['chat_id' => $chat_id];
        $data["text"] = "Добро пожаловать, " . $name;

        return Request::sendMessage($data);
    }
}