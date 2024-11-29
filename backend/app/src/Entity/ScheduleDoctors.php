<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity]
#[ORM\Table(name: 'ScheduleDoctors')]
class ScheduleDoctors
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private int $scheduleDoctorsId;

    #[ORM\ManyToOne(targetEntity: Doctor::class)]
    #[ORM\JoinColumn(name: 'doctor_id', referencedColumnName: 'doctor_id', onDelete: 'SET NULL')]
    #[Groups(['ScheduleDoctors:read', 'ScheduleDoctors:write'])]
    private ?Doctor $doctor = null;

    
    
    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['scheduleDoctors:read', 'scheduleDoctors:write'])]
    private ?\DateTimeInterface $time_schedule = null;

    // Getters and Setters
    public function getscheduleDoctorsId(): ?int
    {
        return $this->scheduleDoctorsId;
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

    public function getTimeSchedule(): ?\DateTimeInterface
    {
        return $this->time_schedule;
    }

    public function setTimeSchedule(\DateTimeInterface $time_schedule): static
    {
        $this->time_schedule = $time_schedule;

        return $this;
    }

}
