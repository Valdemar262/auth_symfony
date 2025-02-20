<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserDTO
{
    #[Assert\NotBlank(message: "Email should not be blank.")]
    #[Assert\Email(message: "Invalid email format.")]
    public string $email;

    #[Assert\NotBlank(message: "Username should not be blank.")]
    #[Assert\Length(min: 3, max: 50, minMessage: "Username should be at least {{ limit }} characters.")]
    public string $name;

    #[Assert\NotBlank(message: "Age should not be blank.")]
    #[Assert\Type(type: "integer", message: "Age must be a number.")]
    #[Assert\Range(
        notInRangeMessage: "The value must be between {{ min }} and {{ max }}.",
        min: 18,
        max: 120
    )]
    public int|null $age;

    public function __construct(
        string   $email,
        string   $name,
        int|null $age
    ) {
        $this->email = $email;
        $this->name = $name;
        $this->age = $age;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(string $age): void
    {
        $this->age = $age;
    }
}
