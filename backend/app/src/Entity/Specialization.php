<?php 

// src/Entity/Specialization.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
#[ORM\Table(name: 'specialization')]
class Specialization
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private $specializationId;

    #[ORM\Column(type: 'string', length: 255)]
    #[Groups(['specialization:read', 'specialization:write'])]
    private $nameSpecialization;

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
}