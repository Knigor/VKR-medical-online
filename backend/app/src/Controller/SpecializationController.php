<?php

namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\Specialization;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SpecializationController extends AbstractController
{
    // GET: Получение специализаций по ID доктора
    #[Route('/api/specializations', name: 'get_specializations', methods: ['GET'])]
    public function getSpecializations(
        Request $request,
        EntityManagerInterface $em
    ): JsonResponse {
        // Получаем doctorId из query-параметров
        $doctorId = $request->query->get('doctorId');
        if (!$doctorId) {
            return new JsonResponse(['error' => 'doctorId is required.'], 400);
        }

        // Ищем доктора
        $doctor = $em->getRepository(Doctor::class)->find($doctorId);
        if (!$doctor) {
            throw new NotFoundHttpException('Doctor not found.');
        }

        // Получаем специализации доктора
        $specializations = $em->getRepository(Specialization::class)->findBy(['doctor' => $doctor]);

        // Формируем ответ
        $specializationData = array_map(function (Specialization $specialization) {
            return [
                'specializationId' => $specialization->getSpecializationId(),
                'nameSpecialization' => $specialization->getNameSpecialization(),
            ];
        }, $specializations);

        return new JsonResponse(['status' => 'success', 'data' => $specializationData], 200);
    }

    // POST: Добавление новой специализации для доктора
    #[Route('/api/specializations', name: 'add_specialization', methods: ['POST'])]
    public function addSpecialization(
        Request $request,
        EntityManagerInterface $em
    ): JsonResponse {
        // Получаем doctorId из form-data
        $doctorId = $request->request->get('doctorId');
        if (!$doctorId) {
            return new JsonResponse(['error' => 'doctorId is required.'], 400);
        }

        // Ищем доктора
        $doctor = $em->getRepository(Doctor::class)->find($doctorId);
        if (!$doctor) {
            throw new NotFoundHttpException('Doctor not found.');
        }

        // Получаем имя специализации из form-data
        $nameSpecialization = $request->request->get('nameSpecialization');
        if (!$nameSpecialization) {
            return new JsonResponse(['error' => 'nameSpecialization is required.'], 400);
        }

        // Создаем новую специализацию
        $specialization = new Specialization();
        $specialization->setDoctor($doctor);
        $specialization->setNameSpecialization($nameSpecialization);

        // Сохраняем специализацию
        $em->persist($specialization);
        $em->flush();

        return new JsonResponse(['status' => 'Specialization added successfully', 'data' => [
            'specializationId' => $specialization->getSpecializationId(),
            'nameSpecialization' => $specialization->getNameSpecialization(),
        ]], 201);
    }
}
