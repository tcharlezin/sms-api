<?php

namespace App\Presenter;

use App\Entity\Message;

class MessagePresenter
{
    public static function toView(Message $message) : array
    {
        $replies = collect();
        foreach($message->getReplies() as $reply)
        {
            $replies->push([
                "mensagem" => $reply->getMessage(),
                "data" => $reply->getCreatedAt()
            ]);
        }

        return [
            "uuid" => $message->getUuid()->toString(),
            "referencia" => $message->getReference(),
            "origem" => $message->getOrigin(),
            "destino" => $message->getDestination(),
            "mensagem" => $message->getMessage(),
            "respostas" => $replies
        ];
    }

    public static function toStore(Message $message) : array
    {
        return [
            "uuid" => $message->getUuid(),
            "origem" => $message->getOrigin(),
            "destino" => $message->getDestination(),
            "mensagem" => $message->getMessage(),
            "referencia" => $message->getReference()
        ];
    }
}
