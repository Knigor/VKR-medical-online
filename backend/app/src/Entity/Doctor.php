<?php 

// src/Entity/Doctor.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
#[ORM\Table(name: 'doctors')]
class Doctor
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private $doctorId;

    #[ORM\ManyToOne(targetEntity: Specialization::class)]
    #[ORM\JoinColumn(name: 'specialization_id', referencedColumnName: 'specialization_id')]
    #[Groups(['doctor:read', 'doctor:write'])]
    private $specialization;

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'user_id')]
    #[Groups(['doctor:read', 'doctor:write'])]
    private $user;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups(['doctor:read', 'doctor:write'])]
    private $bio;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    #[Groups(['doctor:read', 'doctor:write'])]
    private $education;

    #[ORM\Column(type: 'date', nullable: true)]
    #[Groups(['doctor:read', 'doctor:write'])]
    private $shchedule;

    public function getDoctorId(): ?int
    {
        return $this->doctorId;
    }

    public function getSpecialization(): ?Specialization
    {
        return $this->specialization;
    }

    public function setSpecialization(?Specialization $specialization): self
    {
        $this->specialization = $specialization;
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

    public function getBio(): ?string
    {
        return $this->bio;
    }

    public function setBio(?string $bio): self
    {
        $this->bio = $bio;
        return $this;
    }

    public function getEducation(): ?string
    {
        return $this->education;
    }

    public function setEducation(?string $education): self
    {
        $this->education = $education;
        return $this;
    }

    public function getShchedule(): ?\DateTimeInterface
    {
        return $this->shchedule;
    }

    public function setShchedule(?\DateTimeInterface $shchedule): self
    {
        $this->shchedule = $shchedule;
        return $this;
    }
}
