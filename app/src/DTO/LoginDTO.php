<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class LoginDTO
{
    #[Assert\NotBlank(message: "Email should not be blank.")]
    #[Assert\Email(message: "Please enter a valid email address.")]
    public string $email;

    #[Assert\NotBlank(message: "Password should not be blank.")]
    #[Assert\Length(min: 8, minMessage: "Password should be at least {{ limit }} characters.")]
    #[Assert\Regex(pattern: "/[A-Z]/", message: "Password should contain at least one uppercase letter.")]
    #[Assert\Regex(pattern: "/[a-z]/", message: "Password should contain at least one lowercase letter.")]
    #[Assert\Regex(pattern: "/[0-9]/", message: "Password should contain at least one digit.")]
    public string $password;

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
