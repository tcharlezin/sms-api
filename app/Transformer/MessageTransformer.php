<?php

namespace App\Transformer;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Carbon\Carbon;
use Ramsey\Uuid\Uuid;

class MessageTransformer
{
    public static function arrayToEntity(array $data) : Message
    {
        $message = new Message();
        $message->setOrigin($data["origem"]);
        $message->setDestination($data["destino"]);
        $message->setMessage($data["mensagem"]);
        $message->setCreatedAt(Carbon::now());

        return $message;
    }

    public static function modelToEntity(\App\Models\Message $model) : Message
    {
        $message = new Message();
        $message->setUuid(Uuid::fromString($model->uuid));
        $message->setOrigin($model->origin);
        $message->setDestination($model->destination);
        $message->setMessage($model->message);
        $message->setCreatedAt($model->created_at);
        $message->setReference($model->reference);

        self::addReplies($message);

        return $message;
    }

    private static function addReplies(Message $message) : void
    {
        $replies = MessageRepository::findRepliesTo($message);

        if(empty($replies))
        {
            return;
        }

        foreach($replies as $reply)
        {
            $message->addReply($reply);
        }
    }
}
