<?php

namespace App\Service\SMS\PinpointAWS;

use App\Entity\Message;
use App\Repository\MessageRepository;
use App\Service\SMS\InputReceiveSMS;
use Carbon\Carbon;

class Input implements InputReceiveSMS
{
    public static function payloadToEntity(array $payload) : Message
    {
        $message = new Message();
        $message->setOrigin($payload["originationNumber"]);
        $message->setDestination($payload["destinationNumber"]);
        $message->setMessage($payload["messageBody"]);
        $message->setCreatedAt(Carbon::now());
        $message->setReference($payload["inboundMessageId"]);

        $parent = MessageRepository::findByReference($payload["previousPublishedMessageId"]);
        $message->setParent($parent);

        return $message;
    }
}
