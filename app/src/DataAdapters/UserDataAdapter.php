<?php

namespace App\DataAdapters;

use App\DTO\UserDTO;
use App\DTO\UpdateUserDTO;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

class UserDataAdapter
{
    public function createUserDTO(User|UserInterface $user): UserDTO
    {
        return new UserDTO(
            id: $user->getId(),
            name: $user->getName(),
            email: $user->getEmail(),
            age: $user->getAge()
        );
    }

    public function createUpdateUserDTO(Request $user): UpdateUserDTO
    {
        return new UpdateUserDTO(
            email: $user->get('email'),
            name: $user->get('name'),
            age: $user->get('age') ?? null
        );
    }
}
