<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegistrationController extends AbstractController
{
    #[Route('/api/register', name: 'api_register', methods: ['POST'])]
    public function register(
        Request $request,
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher,
        ValidatorInterface $validator
    ): JsonResponse {   
        // Декодируем JSON запрос
        $data = json_decode($request->getContent(), true);

        // Проверяем наличие обязательных данных
        if (!isset($data['username'], $data['password'])) {
            return new JsonResponse(['error' => 'Missing username or password'], Response::HTTP_BAD_REQUEST);
        }

        // Проверяем уникальность пользователя
        $existingUser = $entityManager->getRepository(User::class)->findOneBy(['username' => $data['username']]);
        if ($existingUser) {
            return new JsonResponse(['error' => 'Username already exists'], Response::HTTP_CONFLICT);
        }
        
        // проверяем уникальность на email пользователя
        $existEmailUser = $entityManager->getRepository(User::class)->findOneBy(['email' => $data['email']]);
        if ($existEmailUser) {
            return new JsonResponse(['error' => 'Email already exists'], Response::HTTP_CONFLICT);
        }

        // Создаем нового пользователя
        $user = new User();
        $user->setUsername($data['username']);
        $user->setPassword(
            $passwordHasher->hashPassword($user, $data['password'])
        );

        $role = ['ROLE_USER']; // default role

        $user->setRole($role);

        $user->setGender($data['gender']);

        // Добавляем дополнительные данные, если они есть
        if (isset($data['email'])) {
            $user->setEmail($data['email']);
        }

        if (isset($data['fio'])) {
            $user->setFio($data['fio']);
        }

        

        // Проверяем валидность сущности (если есть аннотации валидации)
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            return new JsonResponse([
                'error' => 'Validation failed',
                'details' => (string) $errors,
            ], Response::HTTP_BAD_REQUEST);
        }

        // Сохраняем пользователя в базе данных
        $entityManager->persist($user);
        $entityManager->flush();

        // Возвращаем успешный ответ
        return new JsonResponse(['message' => 'User successfully registered'], Response::HTTP_CREATED);
    }
}
