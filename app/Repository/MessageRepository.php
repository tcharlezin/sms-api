<?php

namespace App\Repository;

use App\Entity\Message;
use App\Transformer\MessageTransformer;

class MessageRepository
{
    public static function findByUuid(string $uuid) : Message
    {
        $model = \App\Models\Message::where(["uuid" => $uuid])->firstOrFail();
        $message = MessageTransformer::modelToEntity($model);
        return $message;
    }

    public static function findByReference(string $reference) : Message
    {
        $model = \App\Models\Message::where(["reference" => $reference])->firstOrFail();
        $message = MessageTransformer::modelToEntity($model);
        return $message;
    }

    public static function createMessage(Message $message): void
    {
        $model = new \App\Models\Message();
        $model->uuid = $message->getUuid();
        $model->origin = $message->getOrigin();
        $model->destination = $message->getDestination();
        $model->message = $message->getMessage();

        $model->save();
    }

    public static function updateReference(Message $message): void
    {
        $model = \App\Models\Message::where(["uuid" => $message->getUuid()])->firstOrFail();
        $model->reference = $message->getReference();
        $model->save();
    }

    public static function createReply(Message $message)
    {
        $model = new \App\Models\Message();
        $model->uuid = $message->getUuid();
        $model->origin = $message->getOrigin();
        $model->destination = $message->getDestination();
        $model->message = $message->getMessage();
        $model->reference = $message->getReference();
        $model->parent = $message->getParent()->getReference();

        $model->save();
    }

    public static function findRepliesTo(Message $message) : array
    {
        $replies = \App\Models\Message::where(["parent" => $message->getReference()])->get();

        $messages = [];

        foreach ($replies as $reply) {
            $messages[] = MessageTransformer::modelToEntity($reply);
        }

        return $messages;
    }
}
