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
    private $policy_number;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    #[Groups(['patient:read', 'patient:write'])]
    private $blood_type;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    #[Groups(['patient:read', 'patient:write'])]
    private $allergies;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    #[Groups(['patient:read', 'patient:write'])]
    private $chronic_conditions;

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

    public function getPolicyNumber(): ?string
    {
        return $this->policy_number;
    }

    public function setPolicyNumber(?string $policy_number): self
    {
        $this->policy_number = $policy_number;
        return $this;
    }

    public function getBloodType(): ?string
    {
        return $this->blood_type;
    }

    public function setBloodType(?string $blood_type): self
    {
        $this->blood_type = $blood_type;
        return $this;
    }

    public function getAllergies(): ?string {
        return $this->allergies;
    }
    
    public function setAllergies(?string $allergies): self {
        $this->allergies = $allergies;
        return $this;
    }

    public function getChronicConditions(): ?string {
        return $this->chronic_conditions;
    }
    
    public function setChronicConditions(?string $chronic_conditions): self {
        $this->chronic_conditions = $chronic_conditions;
        return $this;
    }
}
