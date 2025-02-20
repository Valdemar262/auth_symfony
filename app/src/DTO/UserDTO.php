<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class UserDTO
{
    #[Assert\NotBlank(message: "UserId should not be blank.")]
    public int $id;

    #[Assert\NotBlank(message: "Username should not be blank.")]
    #[Assert\Length(min: 3, max: 50, minMessage: "Username should be at least {{ limit }} characters.")]
    public string $name;

    #[Assert\NotBlank(message: "Email should not be blank.")]
    #[Assert\Email(message: "Please enter a valid email address.")]
    public string $email;

    #[Assert\Type(type: ["integer", "null"], message: "Age must be a number.")]
    #[Assert\Range(
        minMessage: "Age must be at least {{ limit }} years.",
        maxMessage: "Age cannot be greater than {{ limit }} years.",
        min: 18,
        max: 120
    )]
    public int|null $age;

    public function __construct(
        int $id,
        string $name,
        string $email,
        int|null $age
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->age = $age;
    }
}
