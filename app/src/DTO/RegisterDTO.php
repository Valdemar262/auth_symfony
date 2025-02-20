<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class RegisterDTO
{
    #[Assert\NotBlank(message: "Username should not be blank.")]
    #[Assert\Length(min: 3, max: 50, minMessage: "Username should be at least {{ limit }} characters.")]
    private string $name;

    #[Assert\NotBlank(message: "Email should not be blank.")]
    #[Assert\Email(message: "Please enter a valid email address.")]
    private string $email;

    #[Assert\NotBlank(message: "Password should not be blank.")]
    #[Assert\Length(min: 8, minMessage: "Password should be at least {{ limit }} characters.")]
    #[Assert\Regex(pattern: '/[A-Z]/', message: "Password should contain at least one uppercase letter.")]
    #[Assert\Regex(pattern: '/[a-z]/', message: "Password should contain at least one lowercase letter.")]
    #[Assert\Regex(pattern: '/[0-9]/', message: "Password should contain at least one digit.")]
    private string $password;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
