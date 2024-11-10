<?php
// src/Entity/Chat.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
#[ORM\Table(name: 'chats')]
class Chat
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private $chatsId;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'user_id')]
    #[Groups(['chat:read', 'chat:write'])]
    private $user;

    #[ORM\Column(type: 'date', nullable: true)]
    #[Groups(['chat:read', 'chat:write'])]
    private $createdAt;

    #[ORM\Column(type: 'date', nullable: true)]
    #[Groups(['chat:read', 'chat:write'])]
    private $updatedAt;

    #[ORM\Column(type: 'boolean', nullable: true)]
    #[Groups(['chat:read', 'chat:write'])]
    private $statusChats;

    public function getChatsId(): ?int
    {
        return $this->chatsId;
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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    public function getStatusChats(): ?bool
    {
        return $this->statusChats;
    }

    public function setStatusChats(?bool $statusChats): self
    {
        $this->statusChats = $statusChats;
        return $this;
    }
}
