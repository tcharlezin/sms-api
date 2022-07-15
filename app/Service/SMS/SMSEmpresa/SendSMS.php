<?php

namespace App\Service\SMS\SMSEmpresa;

use App\Entity\Message;
use App\Exceptions\SendSMSException;
use App\Service\SMS\SendSMSAbstract;

class SendSMS extends SendSMSAbstract
{
    const URL = "https://api.smsempresa.com.br/v1/send";
    const STATUS_SUCCESSFUL = "OK";
    const CODE_SUCCESSFUL = "1";

    protected function sendSMS(Message $message) : string
    {
        try
        {
            $client = new \GuzzleHttp\Client();
            $options = [
                'json' => [
                    "out" => "json",
                    "type" => "9",
                    "number" => $message->getDestination(),
                    "key" => env("SMS_EMPRESA_KEY"),
                    "msg" => $message->getMessage()
                ]
            ];

            $response = $client->post(self::URL, $options);
            $responseBody = $response->getBody()->getContents();

            $data = json_decode($responseBody, true);

            $statusCode = $data["codigo"];
            $deliveryStatus = $data["situacao"];
            $message = $data["descricao"];

            if($deliveryStatus === self::STATUS_SUCCESSFUL && $statusCode == self::CODE_SUCCESSFUL)
            {;
                return $data["id"];
            }

            throw new SendSMSException(sprintf("Code: [%s] ERROR: [%s] ", $statusCode, $message));
        }
        catch (SendSMSException $ex)
        {
            throw $ex;
        }
        catch (\Exception $ex)
        {
            throw new SendSMSException($ex->getMessage());
        }
    }
}
