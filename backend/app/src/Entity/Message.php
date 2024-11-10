<?php 

// src/Entity/Message.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
#[ORM\Table(name: 'messages')]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private $messagesId;

    #[ORM\ManyToOne(targetEntity: Chat::class)]
    #[ORM\JoinColumn(name: 'chats_id', referencedColumnName: 'chats_id')]
    #[Groups(['message:read', 'message:write'])]
    private $chat;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'user_id')]
    #[Groups(['message:read', 'message:write'])]
    private $user;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['message:read', 'message:write'])]
    private $message;

    #[ORM\Column(type: 'date', nullable: true)]
    #[Groups(['message:read', 'message:write'])]
    private $timestamp;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    #[Groups(['message:read', 'message:write'])]
    private $messagesImage;

    public function getMessagesId(): ?int
    {
        return $this->messagesId;
    }

    public function getChat(): ?Chat
    {
        return $this->chat;
    }

    public function setChat(?Chat $chat): self
    {
        $this->chat = $chat;
        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function getTimestamp(): ?\DateTimeInterface
    {
        return $this->timestamp;
    }

    public function setTimestamp(?\DateTimeInterface $timestamp): self
    {
        $this->timestamp = $timestamp;
        return $this;
    }

    public function getMessagesImage(): ?string
    {
        return $this->messagesImage;
    }

    public function setMessagesImage(?string $messagesImage): self
    {
        $this->messagesImage = $messagesImage;
        return $this;
    }
}
