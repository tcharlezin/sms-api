<?php

namespace App\Service\SMS\PinpointAWS;

use App\Entity\Message;
use App\Exceptions\SendSMSException;
use App\Service\SMS\SendSMSAbstract;
use Aws\Pinpoint\Exception\PinpointException;
use Aws\Pinpoint\PinpointClient;

class SendSMS extends SendSMSAbstract
{
    const STATUS_SUCCESSFUL = "SUCCESSFUL";
    const CODE_SUCCESSFUL = 200;

    protected function sendSMS(Message $message): string
    {
        // TODO: Implement sendSMS() method.
    }
}
