<?php

// src/Controller/UserController.php
namespace App\Controller;

use App\Entity\User;
use App\Service\FileUploader;
use App\Entity\Doctor;
use App\Entity\Patient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    #[Route('/api/user_edit', name: 'user_edit', methods: ['POST'])]
    public function editUser(
        Request $request,
        EntityManagerInterface $em,
        ValidatorInterface $validator,
        FileUploader $fileUploader
    ): JsonResponse {
        // Получаем данные из form-data
        $userId = $request->request->get('userId');
        if (!$userId) {
            return new JsonResponse(['error' => 'User ID is required.', 'data' => $request->request->all()], 400);
        }

        // Ищем пользователя
        $user = $em->getRepository(User::class)->find($userId);
        if (!$user) {
            throw new NotFoundHttpException('User not found.');
        }

        // Массив для отслеживания обновленных полей
        $updatedFields = [];

        
        $doctor = $em->getRepository(Doctor::class)->findOneBy(['user' => $user]);
        $patient = $em->getRepository(Patient::class)->findOneBy(['user' => $user]);

        // Обрабатываем другие данные
        if ($fio = $request->request->get('fio')) {
            $user->setFio($fio);
            $updatedFields['fio'] = $fio;
        }

        if ($username = $request->request->get('username')) {
            $user->setUsername($username);
            $updatedFields['username'] = $username;
        }

        if ($gender = $request->request->get('gender')) {
            $user->setGender($gender);
            $updatedFields['gender'] = $gender;
        }

        if ($birthdate = $request->request->get('birthdate')) {
            $birthdate = \DateTime::createFromFormat('Y-m-d', $birthdate);
            if ($birthdate) {
                $user->setBirthdate($birthdate);
                $updatedFields['birthdate'] = $birthdate->format('Y-m-d');
            } else {
                return new JsonResponse(['error' => 'Invalid date format. Use Y-m-d.'], 400);
            }
        }

        // Обрабатываем загрузку файла
        if ($photo = $request->files->get('photo_user')) {
            $uploadedFile = $photo;
            $photoFilename = $fileUploader->upload($uploadedFile);
            $user->setPhotoUser('/uploads/photos/' . $photoFilename);
            $updatedFields['photo_user'] = '/uploads/photos/' . $photoFilename;
        }

        // Сохраняем изменения
        $em->flush();

        // Возвращаем ответ с обновленными данными и полями
        $userData = [
            'id' => $user->getUserId(),
            'ФИО' => $user->getFio(),
            'email' => $user->getEmail(),
            'username' => $user->getUsername(),
            'role' => $user->getRoles(),
            'gender' => $user->getGender(),
            'birthdate' => $user->getBirthdate() ? $user->getBirthdate()->format('Y-m-d') : null,
            'doctorId' => $doctor ? $doctor->getDoctorId() : null,
            'patientId' => $patient ? $patient->getPatientId() : null,
            'photo_user' => $user->getPhotoUser(),
            'updated_fields' => $updatedFields,  // Включаем обновленные поля
        ];

        return new JsonResponse(['status' => 'User updated successfully', 'data' => $userData], 200);
    }


    
}
