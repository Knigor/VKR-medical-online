<?php

namespace App\Security;

use App\Entity\User;
use App\Entity\Doctor;
use App\Entity\Patient;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\HttpFoundation\Request;

class CustomAuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private JWTTokenManagerInterface $jwtManager;
    private EntityManagerInterface $entityManager;

    public function __construct(
        JWTTokenManagerInterface $jwtManager,
        EntityManagerInterface $entityManager
    ) {
        $this->jwtManager = $jwtManager;
        $this->entityManager = $entityManager;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token): Response
    {
        // Получаем пользователя из токена
        $user = $token->getUser();

        if ($user === null) {
            throw new \LogicException('User not found in token');
        }

        // Проверяем, является ли пользователь доктором
        $doctor = $this->entityManager->getRepository(Doctor::class)->findOneBy(['user' => $user]);
        $patient = $this->entityManager->getRepository(Patient::class)->findOneBy(['user' => $user]);

        // Генерация JWT токена
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
            'doctorId' => $doctor ? $doctor->getDoctorId() : null,
            'patientId' => $patient ? $patient->getPatientId() : null,
            'birthdate' => $user->getBirthdate()->format('Y-m-d'),
            'photo_user' => $user->getPhotoUser(),
        ];

        // Возвращаем кастомный JSON ответ
        return new JsonResponse($data);
    }
}
