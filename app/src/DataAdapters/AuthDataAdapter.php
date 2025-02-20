<?php

namespace App\DataAdapters;

use App\DTO\LoginDTO;
use App\DTO\RegisterDTO;
use Symfony\Component\HttpFoundation\Request;

readonly class AuthDataAdapter
{
    public function createRegisterDTO(Request $request): RegisterDTO
    {
        $registerDTO = new RegisterDTO;
        $registerDTO->setEmail($request->request->get('email'));
        $registerDTO->setPassword($request->request->get('password'));
        $registerDTO->setName($request->request->get('name'));

        return $registerDTO;
    }

    public function createLoginDTO(Request $request): LoginDTO
    {
        $loginDTO = new LoginDTO;
        $loginDTO->setEmail($request->get('email'));
        $loginDTO->setPassword($request->get('password'));

        return $loginDTO;
    }
}
