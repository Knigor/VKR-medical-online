<?php

// src/Entity/User.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private $userId;

    #[ORM\Column(type: 'string', length: 200)]
    #[Groups(['user:read', 'user:write'])]
    private $fio;

    #[ORM\Column(type: 'string', length: 200)]
    #[Groups(['user:read', 'user:write'])]
    private $login;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    #[Groups(['user:read'])]
    private $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $hashPassword;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    #[Groups(['user:read'])]
    private $role;

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function getFio(): ?string
    {
        return $this->fio;
    }

    public function setFio(string $fio): self
    {
        $this->fio = $fio;
        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): self
    {
        $this->login = $login;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getHashPassword(): ?string
    {
        return $this->hashPassword;
    }

    public function setHashPassword(?string $hashPassword): self
    {
        $this->hashPassword = $hashPassword;
        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(?string $role): self
    {
        $this->role = $role;
        return $this;
    }
}
