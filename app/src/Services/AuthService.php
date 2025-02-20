<?php

namespace App\Services;

use App\DataAdapters\UserDataAdapter;
use App\DTO\LoginDTO;
use App\DTO\RegisterDTO;
use App\DTO\UserDTO;
use App\Enums\Message;
use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

readonly class AuthService
{
    public function __construct(
        private ValidationService        $validationService,
        private UserRepository           $userRepository,
        private UserDataAdapter          $userDataAdapters,
        private JWTTokenManagerInterface $JWTManager
    ) {}

    public function register(RegisterDTO $registerDTO): array|string|UserDTO
    {
        try {
            $errors = $this->validationService->validateData($registerDTO);

            if (is_array($errors)) {
                return $errors;
            }

            $user = $this->userRepository->createUser($registerDTO);

            $errors = $this->validationService->validateData($user);

            if (is_array($errors)) {
                return $errors;
            }

            return $this->userDataAdapters->createUserDTO($user);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function login(LoginDTO $loginDTO): array|string
    {
        $errors = $this->validationService->validateData($loginDTO);

        if (is_array($errors)) {
            return $errors;
        }

        $user = $this->userRepository->findOneByEmail($loginDTO->email);

        if (!$user || !password_verify($loginDTO->getPassword(), $user->getPassword())) {
            return Message::INCORRECT_LOGIN_OR_PASSWORD;
        }

        return $this->JWTManager->create($user);
    }
}
