<?php

namespace Scdewt\Hackathon0823\Command;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Entities\KeyboardButton;
use Longman\TelegramBot\Entities\Location;
use Longman\TelegramBot\Entities\ServerResponse;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\TelegramLog;
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
        $user_id = $message->getFrom()->getId();

        $data = ['chat_id' => $chat_id];

        $text = $message->getText(true);
        $location = $message->getLocation();

        if (preg_match("~^(\d+(?:.\d+)?),? (\d+(?:.\d+)?)$~", $text, $matches)) {
            $location = new Location(["longitude" => (float)  $matches[1], "latitude" => (float) $matches[2]]);
        }

        if ($location !== null) {
            $conn = Connection::getConnection();
            $sql = "UPDATE main SET coords=:coords where person_id=:person_id";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':person_id', $user_id);
            $coords = json_encode([
                $location->getLongitude(),
                $location->getLatitude(),
            ]);
            $stmt->bindParam(':coords', $coords);
            if (!$stmt->execute()) {
                TelegramLog::error($stmt->errorInfo()[0]);
            }

            $data['text'] = 'Ваше местоположение принято';

            return Request::sendMessage($data);
        }

        $data['reply_markup'] = (new Keyboard(
            (new KeyboardButton('Share Location'))->setRequestLocation(true)
        ))
            ->setOneTimeKeyboard(true)
            ->setResizeKeyboard(true)
            ->setSelective(true);

        $data['text'] = 'Пришлите ваше местоположение:';

        return Request::sendMessage($data);
    }
}