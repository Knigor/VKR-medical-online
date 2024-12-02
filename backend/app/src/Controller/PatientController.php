<?php

// src/Controller/PatientController.php
namespace App\Controller;

use App\Entity\Patient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PatientController extends AbstractController
{
    #[Route('/api/edit_pacient', name: 'edit_pacient', methods: ['POST'])]
    public function editPatient(
        Request $request,
        EntityManagerInterface $em
    ): JsonResponse {
        // Получаем данные из form-data
        $patientId = $request->request->get('patientId');
        if (!$patientId) {
            return new JsonResponse(['error' => 'Patient ID is required.', 'data' => $request->request->all()], 400);
        }

        // Ищем пациента
        $patient = $em->getRepository(Patient::class)->find($patientId);
        if (!$patient) {
            throw new NotFoundHttpException('Patient not found.');
        }

        // Массив для отслеживания обновленных полей
        $updatedFields = [];

        // Обрабатываем другие данные
        if ($policyNumber = $request->request->get('policy_number')) {
            $patient->setPolicyNumber($policyNumber);
            $updatedFields['policy_number'] = $policyNumber;
        }

        if ($bloodType = $request->request->get('blood_type')) {
            $patient->setBloodType($bloodType);
            $updatedFields['blood_type'] = $bloodType;
        }

        if ($allergies = $request->request->get('allergies')) {
            $patient->setAllergies($allergies);
            $updatedFields['allergies'] = $allergies;
        }

        if ($chronicConditions = $request->request->get('chronic_conditions')) {
            $patient->setChronicConditions($chronicConditions);
            $updatedFields['chronic_conditions'] = $chronicConditions;
        }


        // Сохраняем изменения
        $em->flush();

        // Возвращаем ответ с обновленными данными и полями
        $patientData = [
            'id' => $patient->getPatientId(),
            'policy_number' => $patient->getPolicyNumber(),
            'blood_type' => $patient->getBloodType(),
            'allergies' => $patient->getAllergies(),
            'chronic_conditions' => $patient->getChronicConditions(),
            'user_id' => $patient->getUser()->getUserId(),
            'updated_fields' => $updatedFields,  // Включаем обновленные поля
        ];

        return new JsonResponse(['status' => 'Patient updated successfully', 'data' => $patientData], 200);
    }
}
