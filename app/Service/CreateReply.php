<?php

namespace App\Service;

use App\Entity\Message;
use App\Repository\MessageRepository;

class CreateReply
{
    private Message $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function run() : void
    {
        MessageRepository::createReply($this->message);
    }
}
