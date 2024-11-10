<?php 

// src/Entity/Patient.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
#[ORM\Table(name: 'pacient')]
class Patient
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private $patientId;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'user_id')]
    #[Groups(['patient:read', 'patient:write'])]
    private $user;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    #[Groups(['patient:read', 'patient:write'])]
    private $fio;

    public function getPatientId(): ?int
    {
        return $this->patientId;
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

    public function getFio(): ?string
    {
        return $this->fio;
    }

    public function setFio(?string $fio): self
    {
        $this->fio = $fio;
        return $this;
    }
}
