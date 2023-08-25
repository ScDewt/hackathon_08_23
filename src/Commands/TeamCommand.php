<?php

namespace Scdewt\Hackathon0823\Command;

use Longman\TelegramBot\Commands\Command;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Scdewt\Hackathon0823\Connection\Connection;

class TeamCommand extends Command
{
    /**
     * @var string
     */
    protected $name = 'team';

    /**
     * @var string
     */
    protected $description = 'Set your team';

    /**
     * @var string
     */
    protected $usage = '/team <your team>';

    public function execute(): ServerResponse
    {
        $message = $this->getMessage();

        $chat_id = $message->getChat()->getId();
        $user_id = $message->getFrom()->getId();
        $team    = trim($message->getText(true));

        $conn = Connection::getConnection();

        $sql = "UPDATE main SET team=:team where person_id=:person_id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':person_id', $user_id);
        $stmt->bindParam(':team', $team);
        $stmt->execute();

        $data = ['chat_id' => $chat_id];
        $data["text"] = "Вы приняты в " . $team;

        return Request::sendMessage($data);
    }
}