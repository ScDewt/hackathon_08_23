<?php

namespace Scdewt\Hackathon0823\Command;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\TelegramLog;
use Scdewt\Hackathon0823\DB\Connection;

class TeamCommand extends UserCommand
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

        if (!$team) {
            $data = ['chat_id' => $chat_id];
            $data["parse_mode"] = 'Markdown';
            $data["text"] = "Пожалуйста уточните имя команды. Пример: `/team facebook`";

            return Request::sendMessage($data);
        }

        $conn = Connection::getConnection();

        $sql = "UPDATE main SET team=:team where person_id=:person_id";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':person_id', $user_id);
        $stmt->bindParam(':team', $team);
        if (!$stmt->execute()) {
            TelegramLog::error($stmt->errorInfo()[0]);
        }

        $data = ['chat_id' => $chat_id];
        $data["text"] = "Вы приняты в " . $team. "\nСсылка на карту https://hackathon0823.scdewt.ru/index.html?team=" . urlencode($team);

        return Request::sendMessage($data);
    }
}