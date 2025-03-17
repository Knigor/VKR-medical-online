<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity]
#[ORM\Table(name: 'users')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    #[ORM\Column(type: 'integer')]
    private $userId;

    #[ORM\Column(type: 'string', length: 200)]
    #[Groups(['user:read', 'user:write'])]
    private $fio;

    #[ORM\Column(type: 'string', length: 200, nullable: false)]
    #[Groups(['user:read', 'user:write'])]
    private $gender;

    #[ORM\Column(type: 'string', length: 200, unique: true)]
    #[Groups(['user:read', 'user:write'])]
    private $username;

    #[ORM\Column(type: 'string', length: 200, nullable: false)]
    #[Groups(['user:read'])]
    private $email;

    #[ORM\Column(type: 'string', length: 255)]
    private $password;

    #[ORM\Column(type: 'json', nullable: true)]
    #[Groups(['user:read', 'user:write'])]
    private $role;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    #[Groups(['user:read', 'user:write'])]
    private $photo_user;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    #[Groups(['user:read', 'user:write'])]
    private ?\DateTimeInterface $birthdate = null;

    #[ORM\OneToMany(mappedBy: 'patient', targetEntity: Chat::class)]
    private Collection $chatsAsPatient;

    #[ORM\OneToMany(mappedBy: 'doctor', targetEntity: Chat::class)]
    private Collection $chatsAsDoctor;

    public function __construct()
    {
        $this->chatsAsPatient = new ArrayCollection();
        $this->chatsAsDoctor = new ArrayCollection();
    }

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

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;
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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getRole(): ?array
    {
        return $this->role;
    }

    public function setRole(?array $role): self
    {
        $this->role = $role;
        return $this;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    public function getPhotoUser(): ?string
    {
        return $this->photo_user;
    }

    public function setPhotoUser(?string $photo_user): self
    {
        $this->photo_user = $photo_user;
        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;
        return $this;
    }

    public function getRoles(): array
    {
        return [$this->role ?? 'ROLE_USER'];
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
        // Очищайте временные данные пользователя, если нужно
    }

    public function getUserIdentifier(): string
    {
        return $this->username;
    }

    public function getChatsAsPatient(): Collection
    {
        return $this->chatsAsPatient;
    }

    public function getChatsAsDoctor(): Collection
    {
        return $this->chatsAsDoctor;
    }
}
