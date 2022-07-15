<?php

namespace App\Service\SMS;

use App\Entity\Message;

interface InputReceiveSMS
{
    public static function payloadToEntity(array $payload) : Message;
}
