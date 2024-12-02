<?php

namespace App\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class EditUserRequest
{
    #[Assert\NotBlank]
    public ?string $fio = null;

    #[Assert\NotBlank]
    public ?string $username = null;

    #[Assert\NotBlank]
    public ?string $gender = null;

    #[Assert\Date]
    public ?\DateTimeInterface $birthdate = null;

    #[Assert\File(
        maxSize: "2M",
        mimeTypes: ["image/jpeg", "image/png"]
    )]
    public $photo_user = null;
}
