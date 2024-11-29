<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
#[ORM\Table(name: 'reviews')]
class Reviews
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private int $reviewsId;

    #[ORM\ManyToOne(targetEntity: Doctor::class)]
    #[ORM\JoinColumn(name: 'doctor_id', referencedColumnName: 'doctor_id', onDelete: 'SET NULL')]
    #[Groups(['reviews:read', 'reviews:write'])]
    private ?Doctor $doctor = null;

    #[ORM\ManyToOne(targetEntity: Patient::class)]
    #[ORM\JoinColumn(name: 'patient_id', referencedColumnName: 'patient_id', onDelete: 'SET NULL')]
    #[Groups(['reviews:read', 'reviews:write'])]
    private ?Patient $patient = null;

    #[ORM\Column(type: 'integer')]
    #[Groups(['reviews:read', 'reviews:write'])]
    private $rating;


    // Getters and Setters
    public function getreviewsId(): ?int
    {
        return $this->reviewsId;
    }


    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;
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


    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;
        return $this;
    }



}
