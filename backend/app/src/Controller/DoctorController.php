<?php


// src/Controller/DoctorController.php
namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DoctorController extends AbstractController
{
    #[Route('/api/edit_doctor', name: 'edit_doctor', methods: ['POST'])]
    public function editDoctor(
        Request $request,
        EntityManagerInterface $em
    ): JsonResponse {
        // Получаем данные из form-data
        $doctorId = $request->request->get('doctorId');
        if (!$doctorId) {
            return new JsonResponse(['error' => 'Doctor ID is required.', 'data' => $request->request->all()], 400);
        }

        // Ищем врача
        $doctor = $em->getRepository(Doctor::class)->find($doctorId);
        if (!$doctor) {
            throw new NotFoundHttpException('Doctor not found.');
        }

        // Массив для отслеживания обновленных полей
        $updatedFields = [];

        // Обрабатываем данные
        if ($bio = $request->request->get('bio')) {
            $doctor->setBio($bio);
            $updatedFields['bio'] = $bio;
        }

        if ($education = $request->request->get('education')) {
            $doctor->setEducation($education);
            $updatedFields['education'] = $education;
        }

        if ($qualification = $request->request->get('qualification')) {
            $doctor->setQualification($qualification);
            $updatedFields['qualification'] = $qualification;
        }

        if ($experience = $request->request->get('experience')) {
            $doctor->setExperience((int) $experience);
            $updatedFields['experience'] = $experience;
        }

        if ($completeConsultation = $request->request->get('complete_consultation')) {
            $doctor->setCompleteConsultation((int) $completeConsultation);
            $updatedFields['complete_consultation'] = $completeConsultation;
        }

        // Обрабатываем связь с пользователем
        if ($userId = $request->request->get('userId')) {
            $user = $em->getRepository(User::class)->find($userId);
            if ($user) {
                $doctor->setUser($user);
                $updatedFields['user_id'] = $userId;
            }
        }

        // Сохраняем изменения
        $em->flush();

        // Возвращаем ответ с обновленными данными и полями
        $doctorData = [
            'id' => $doctor->getDoctorId(),
            'bio' => $doctor->getBio(),
            'education' => $doctor->getEducation(),
            'qualification' => $doctor->getQualification(),
            'experience' => $doctor->getExperience(),
            'complete_consultation' => $doctor->getCompleteConsultation(),
            'user_id' => $doctor->getUser()->getUserId(),
            'updated_fields' => $updatedFields,  // Включаем обновленные поля
        ];

        return new JsonResponse(['status' => 'Doctor updated successfully', 'data' => $doctorData], 200);
    }
}
