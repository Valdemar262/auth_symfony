<?php

namespace App\Controller;

use App\DataAdapters\UserDataAdapter;
use App\Services\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api', name: 'api_')]
class UserController extends AbstractController
{
    public function __construct(
        private readonly UserService     $userService,
        private readonly UserDataAdapter $userDataAdapter
    ) {}

    #[Route('/getCurrentUser', name: 'app_getCurrentUser')]
    public function getCurrentUser(): JsonResponse
    {
        return new JsonResponse(
            $this->userService->getCurrentUser(),
            Response::HTTP_OK,
            []
        );
    }

    #[Route('/allUsers', name: 'app_allUsers', methods: 'GET')]
    public function allUsers(): JsonResponse
    {
        return new JsonResponse(
            $this->userService->getAllUsers(),
            Response::HTTP_OK,
            [],
            true
        );
    }

    #[Route('/update', name: 'api_user_update', methods: ['PUT', 'PATCH'])]
    public function updateUser(Request $request): JsonResponse
    {
        return new JsonResponse(
            $this->userService->update(
                $this->userDataAdapter->createUpdateUserDTO($request)
            ),
            Response::HTTP_OK,
            [],
            true
        );
    }

    #[Route('/delete/{id}', name: 'api_user_delete', methods: ['DELETE'])]
    public function deleteUser(int $id): JsonResponse
    {
        return new JsonResponse(
            $this->userService->delete($id)
        );
    }
}
