<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Patient;
use App\Entity\Doctor;
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
        $data = json_decode($request->getContent(), true);

        if (!isset($data['username'], $data['password'], $data['role'])) {
            return new JsonResponse(['error' => 'Missing username, password, or role'], Response::HTTP_BAD_REQUEST);
        }

        $existingUser = $entityManager->getRepository(User::class)->findOneBy(['username' => $data['username']]);
        if ($existingUser) {
            return new JsonResponse(['error' => 'Username already exists'], Response::HTTP_CONFLICT);
        }

        $existEmailUser = $entityManager->getRepository(User::class)->findOneBy(['email' => $data['email']]);
        if ($existEmailUser) {
            return new JsonResponse(['error' => 'Email already exists'], Response::HTTP_CONFLICT);
        }

        // Создаем нового пользователя
        $user = new User();
        $user->setUsername($data['username']);
        $user->setPassword($passwordHasher->hashPassword($user, $data['password']));
        $user->setGender($data['gender'] ?? null);
        $user->setEmail($data['email']);
        $user->setFio($data['fio']);

        // Устанавливаем роль
        $role = $data['role'];
        if (!in_array($role, ['ROLE_USER', 'ROLE_DOCTOR'], true)) {
            return new JsonResponse(['error' => 'Invalid role provided. Use ROLE_USER or ROLE_DOCTOR.'], Response::HTTP_BAD_REQUEST);
        }

        $user->setRole([$role]);

        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            return new JsonResponse(['error' => 'Validation failed', 'details' => (string) $errors], Response::HTTP_BAD_REQUEST);
        }

        $entityManager->persist($user);
        $entityManager->flush();

        // Если роль DOCTOR, создаем запись в таблице Doctor
        if ($role === 'ROLE_DOCTOR') {
            $doctor = new Doctor();
            $doctor->setUser($user);
            $entityManager->persist($doctor);
        }

        // Если роль USER, создаем запись в таблице Patient
        if ($role === 'ROLE_USER') {
            $patient = new Patient();
            $patient->setUser($user);
            $entityManager->persist($patient);
        }

        $entityManager->flush();

        return new JsonResponse(['message' => 'User successfully registered'], Response::HTTP_CREATED);
    }
}
