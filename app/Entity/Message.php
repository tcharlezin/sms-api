<?php

namespace App\Entity;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Ramsey\Uuid\UuidInterface;

class Message
{
    private UuidInterface $uuid;
    private string $origin;
    private string $destination;
    private string $message;
    private Carbon $createdAt;
    private ?string $reference;
    private Message $parent;

    /**
     * @var Message[]
     */
    private array $replies;

    public function __construct()
    {
        $this->uuid = Str::uuid();
        $this->replies = [];
    }

    /**
     * @return UuidInterface
     */
    public function getUuid(): UuidInterface
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(UuidInterface $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function getOrigin(): string
    {
        return $this->origin;
    }

    /**
     * @param string $origin
     */
    public function setOrigin(string $origin): void
    {
        $this->origin = $origin;
    }

    /**
     * @return string
     */
    public function getDestination(): string
    {
        return $this->destination;
    }

    /**
     * @param string $destination
     */
    public function setDestination(string $destination): void
    {
        $this->destination = $destination;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->createdAt;
    }

    /**
     * @param Carbon $createdAt
     */
    public function setCreatedAt(Carbon $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return ?string
     */
    public function getReference(): ?string
    {
        return $this->reference;
    }

    /**
     * @param ?string $reference
     */
    public function setReference(?string $reference): void
    {
        $this->reference = $reference;
    }

    /**
     * @return Message
     */
    public function getParent(): Message
    {
        return $this->parent;
    }

    /**
     * @param Message $parent
     */
    public function setParent(Message $parent): void
    {
        $this->parent = $parent;
    }

    /**
     * @return Message[]
     */
    public function getReplies(): array
    {
        return $this->replies;
    }

    /**
     * @param Message $message
     */
    public function addReply(Message $message): void
    {
        $this->replies[] = $message;
    }
}
