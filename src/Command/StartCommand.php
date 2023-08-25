<?php

namespace Scdewt\Hackathon0823\Command;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\TelegramLog;
use Scdewt\Hackathon0823\DB\Connection;

class StartCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'start';

    /**
     * @var string
     */
    protected $description = 'Start command';

    /**
     * @var string
     */
    protected $usage = '/start';

    public function execute(): ServerResponse
    {
        $message = $this->getMessage();

        $chat_id = $message->getChat()->getId();
        $user_id = $message->getFrom()->getId();
        $name = $message->getFrom()->getFirstName() . " " . $message->getFrom()->getLastName() ;

        $conn = Connection::getConnection();


        $sql = "INSERT INTO main (person_id, person_name) VALUES(:person_id, :person_name) ON DUPLICATE KEY UPDATE person_name = :person_name";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':person_id', $user_id);
        $stmt->bindParam(':person_name', $name);
        if (!$stmt->execute()) {
            TelegramLog::error($stmt->errorInfo()[0]);
        }

        $data = ['chat_id' => $chat_id];
        $data['text'] = "Приветствую, " . $name . "!\nИспользуй /team чтобы присоединитья к команде. Пример: `/team facebook`";

        return Request::sendMessage($data);
    }
}