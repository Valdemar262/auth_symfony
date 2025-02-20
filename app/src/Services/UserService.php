<?php

namespace App\Services;

use App\DataAdapters\UserDataAdapter;
use App\DTO\UpdateUserDTO;
use App\DTO\UserDTO;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Serializer\SerializerInterface;
use App\Enums\Message;

readonly class UserService
{
    public function __construct(
        private TokenStorageInterface $tokenStorage,
        private UserRepository        $userRepository,
        private UserDataAdapter       $userDataAdapter,
        private SerializerInterface   $serializer,
        private ValidationService     $validationService,
    ) {}

    public function getCurrentUser(): UserDTO
    {
        $token = $this->tokenStorage->getToken();

        return $this->userDataAdapter->createUserDTO($token->getUser());
    }

    public function getAllUsers(): string
    {
        $users = $this->userRepository->findAll();

        return $this->serializer->serialize(
            $users,
            'json',
            ['groups' => 'user_list']
        );
    }

    public function update(UpdateUserDTO $updateUserDTO): array|string
    {
        try {
            $errors = $this->validationService->validateData($updateUserDTO);

            if (is_array($errors)) {
                return $errors;
            }

            $user = $this->userRepository->findOneByEmail($updateUserDTO->getEmail());

            $user->setName($updateUserDTO->getName());
            $user->setEmail($updateUserDTO->getEmail());
            $user->setAge($updateUserDTO->getAge());

            return $this->serializer->serialize(
                $user,
                'json',
                ['groups' => 'user_list']
            );
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function delete(int $id): string
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            return Message::USER_NOT_FOUND;
        }

        $this->userRepository->delete($user);

        return Message::USER_DELETED_SUCCESSFULLY;
    }
}
