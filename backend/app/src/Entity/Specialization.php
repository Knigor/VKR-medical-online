<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
#[ORM\Table(name: 'specializations')]
class Specialization
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(name: 'specialization_id', type: 'integer')]
    private $specializationId;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['specialization:read', 'specialization:write'])]
    private $nameSpecialization;


    #[ORM\ManyToOne(targetEntity: Doctor::class)]
    #[ORM\JoinColumn(name: 'doctor_id', referencedColumnName: 'doctor_id', onDelete: 'SET NULL')]
    #[Groups(['specialization:read', 'specialization:write'])]
    private ?Doctor $doctor = null;

    public function getSpecializationId(): ?int
    {
        return $this->specializationId;
    }

    public function getNameSpecialization(): ?string
    {
        return $this->nameSpecialization;
    }

    public function setNameSpecialization(string $nameSpecialization): self
    {
        $this->nameSpecialization = $nameSpecialization;
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
}
