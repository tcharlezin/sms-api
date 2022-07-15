<?php

namespace App\Service\SMS\SMSEmpresa;

use App\Entity\Message;
use App\Repository\MessageRepository;
use App\Service\SMS\InputReceiveSMS;
use Carbon\Carbon;

class Input implements InputReceiveSMS
{
    public static function payloadToEntity(array $payload) : Message
    {
        $message = new Message();
        $message->setOrigin($payload["from"]);
        $message->setDestination("");
        $message->setMessage($payload["message"]);
        $message->setCreatedAt(Carbon::now());
        $message->setReference($payload["id"]);

        $parent = MessageRepository::findByReference($payload["id_sent"]);
        $message->setParent($parent);

        return $message;
    }
}
