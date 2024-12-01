<?php

namespace App\Security;

use App\Entity\User;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;

class CustomAuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private JWTTokenManagerInterface $jwtManager;

    public function __construct(JWTTokenManagerInterface $jwtManager)
    {
        $this->jwtManager = $jwtManager;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): Response
    {
        // Получаем пользователя из токена
        $user = $token->getUser();

        if ($user === null) {
            throw new \LogicException('User not found in token');
        }

        // Генерация JWT токена, если он не передан
        $jwt = $this->jwtManager->create($user);

        // Формирование данных ответа
        $data = [
            'token' => $jwt,
            'ФИО' => $user->getFio(),
            'email' => $user->getEmail(),
            'username' => $user->getUsername(),
            'id' => $user->getUserId(),
            'role' => $user->getRoles(),
            'gender' => $user->getGender(),
        ];

        // Возвращаем кастомный JSON ответ
        return new JsonResponse($data);
    }
}

