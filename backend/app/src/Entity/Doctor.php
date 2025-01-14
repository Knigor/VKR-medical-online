<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity]
#[ORM\Table(name: 'doctors')]
class Doctor
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(name: 'doctor_id', type: 'integer')]
    private $doctorId;

    #[ORM\OneToMany(mappedBy: 'doctor', targetEntity: Specialization::class, cascade: ['persist', 'remove'])]
    #[Groups(['doctor:read', 'doctor:write'])]
    private $specializations;

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

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    #[Groups(['doctor:read', 'doctor:write'])]
    private $qualification;

    #[ORM\Column(type: 'integer', options: ['default' => 0])]
    #[Groups(['doctor:read', 'doctor:write'])]
    private $experience;

    #[ORM\Column(type: 'integer', options: ['default' => 0])]
    #[Groups(['doctor:read', 'doctor:write'])]
    private $complete_consultation;


    public function __construct()
    {
        $this->specializations = new ArrayCollection();
    }

    public function getExperience(): ?int
    {
        return $this->experience;
    }

    public function setExperience(int $experience): self
    {
        $this->experience = $experience;
        return $this;
    }

    public function getDoctorId(): ?int
    {
        return $this->doctorId;
    }

    public function getSpecializations(): Collection
    {
        return $this->specializations;
    }

    public function addSpecialization(Specialization $specialization): self
    {
        if (!$this->specializations->contains($specialization)) {
            $this->specializations[] = $specialization;
            $specialization->setDoctor($this);
        }
        return $this;
    }

    public function removeSpecialization(Specialization $specialization): self
    {
        if ($this->specializations->removeElement($specialization)) {
            if ($specialization->getDoctor() === $this) {
                $specialization->setDoctor(null);
            }
        }
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

    public function getQualification(): ?string
    {
        return $this->qualification;
    }

    public function setQualification(?string $qualification): self
    {
        $this->qualification = $qualification;
        return $this;
    }

    public function getCompleteConsultation(): ?int
    {
        return $this->complete_consultation;
    }

    public function setCompleteConsultation(int $complete_consultation): self
    {
        $this->complete_consultation = $complete_consultation;
        return $this;
    }


}
