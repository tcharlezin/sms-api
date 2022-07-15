<?php

namespace App\Service;

use App\Entity\Message;
use App\Repository\MessageRepository;
use App\Service\SMS\SMSEmpresa\SendSMS;

class CreateSMS
{
    private Message $message;

    public function __construct(Message $message, ISendSMS)
    {
        $this->message = $message;
    }

    public function run() : void
    {
        $this->storeMessage();
        $this->send();
    }

    private function storeMessage()
    {
        MessageRepository::createMessage($this->message);
    }

    private function send()
    {
        $service = new SendSMS($this->message);
        $service->run();

        MessageRepository::updateReference($this->message);
    }
}
