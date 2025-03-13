<?php


// src/Entity/Chat.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity]
#[ORM\Table(name: 'chats')]
class Chat
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private $chatsId;

    #[ORM\ManyToOne(targetEntity: Patient::class)]
    #[ORM\JoinColumn(name: 'patient_id', referencedColumnName: 'patient_id', nullable: false)]
    #[Groups(['chat:read', 'chat:write'])]
    private $patient;

    #[ORM\ManyToOne(targetEntity: Doctor::class)]
    #[ORM\JoinColumn(name: 'doctor_id', referencedColumnName: 'doctor_id', nullable: false)]
    #[Groups(['chat:read', 'chat:write'])]
    private $doctor;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['chat:read', 'chat:write'])]
    private $createdAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['chat:read', 'chat:write'])]
    private $updatedAt;

    #[ORM\Column(type: 'boolean', nullable: true)]
    #[Groups(['chat:read', 'chat:write'])]
    private $statusChats;

    public function getChatsId(): ?int
    {
        return $this->chatsId;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;
        return $this;
    }

    public function getDoctor(): ?Doctor
    {
        return $this->doctor;
    }

    public function setDoctor(?Doctor $doctor): self
    {
        $this->doctor = $doctor;
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
