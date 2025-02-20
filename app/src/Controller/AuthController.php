<?php

namespace App\Controller;

use App\DataAdapters\AuthDataAdapter;
use App\Enums\Message;
use App\Services\AuthService;
use App\Services\ResponseHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api', name: 'api_')]
class AuthController extends AbstractController
{
    public function __construct(
        private readonly ResponseHelper  $responseHelper,
        private readonly AuthService     $authService,
        private readonly AuthDataAdapter $authDataAdapter
    ) {}

    #[Route('/register', name: 'app_register', methods: 'post')]
    public function register(Request $request): JsonResponse
    {
        return $this->responseHelper->createSuccessResponse(
            $this->authService->register(
                $this->authDataAdapter->createRegisterDTO($request)
            )
        );
    }

    #[Route('/login_check', name: 'app_login_check', methods: 'post')]
    public function login(Request $request): JsonResponse
    {
        return $this->responseHelper->createSuccessResponse(
            $this->authService->login(
                $this->authDataAdapter->createLoginDTO($request)
            )
        );
    }

    #[Route('/logout', name: 'app_logout', methods: 'get')]
    public function logout(): JsonResponse
    {
        return $this->responseHelper->createSuccessResponse(Message::YOU_SUCCESSFULLY_LEFT);
    }
}
