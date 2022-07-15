<?php

namespace App\Service\SMS;

use App\Entity\Message;

abstract class SendSMSAbstract
{
    protected Message $message;
    protected string $reference;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    /***
     * @param Message $message
     * @return string
     */
    protected abstract function sendSMS(Message $message) : string;

    public function run() : void
    {
        $this->reference = $this->sendSMS($this->message);
        $this->updateReference();
    }

    protected function updateReference() : void
    {
        $this->message->setReference($this->reference);
    }
}
