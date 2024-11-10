<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
#[ORM\Table(name: 'diseases')]
class Diseases
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private int $diseasesId;

    #[ORM\ManyToOne(targetEntity: Doctor::class)]
    #[ORM\JoinColumn(name: 'doctor_id', referencedColumnName: 'doctor_id', onDelete: 'SET NULL')]
    #[Groups(['diseases:read', 'diseases:write'])]
    private ?Doctor $doctor = null;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['diseases:read', 'diseases:write'])]
    private ?string $typeDiseases = null;

    // Getters and Setters
    public function getDiseasesId(): ?int
    {
        return $this->diseasesId;
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

    public function getTypeDiseases(): ?string
    {
        return $this->typeDiseases;
    }

    public function setTypeDiseases(?string $typeDiseases): self
    {
        $this->typeDiseases = $typeDiseases;
        return $this;
    }
}
