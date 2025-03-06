<?php

// src/Controller/ScheduleController.php
namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\ScheduleDoctors;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ScheduleController extends AbstractController
{
    #[Route('/api/schedule', name: 'get_schedule', methods: ['GET'])]
    public function getSchedule(
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
    
        // Получаем расписание для доктора
        $schedules = $em->getRepository(ScheduleDoctors::class)->findBy(['doctor' => $doctor]);
    
        // Формируем ответ
        $scheduleData = array_map(function (ScheduleDoctors $schedule) {
            return [
                'scheduleDoctorsId' => $schedule->getscheduleDoctorsId(),
                'time_schedule' => $schedule->getTimeSchedule()->format('Y-m-d H:i'),
            ];
        }, $schedules);
    
        return new JsonResponse(['status' => 'success', 'data' => $scheduleData], 200);
    }

    #[Route('/api/schedule', name: 'create_schedule', methods: ['POST'])]
    public function createSchedule(
        Request $request,
        EntityManagerInterface $em
    ): JsonResponse {
        $data = json_decode($request->getContent(), true); // Читаем JSON
    
        $doctorId = $data['doctorId'] ?? null;
        if (!$doctorId) {
            return new JsonResponse(['error' => 'doctorId is required.'], 400);
        }
    
        $doctor = $em->getRepository(Doctor::class)->find($doctorId);
        if (!$doctor) {
            return new JsonResponse(['error' => 'Doctor not found.'], 404);
        }
    
        $timeSchedules = $data['time_schedule'] ?? [];
        if (!is_array($timeSchedules) || empty($timeSchedules)) {
            return new JsonResponse(['error' => 'time_schedule must be a non-empty array.'], 400);
        }
    
        $createdSchedules = [];
    
        foreach ($timeSchedules as $timeSchedule) {
            $dateTime = \DateTime::createFromFormat('Y-m-d H:i', $timeSchedule);
            if (!$dateTime) {
                return new JsonResponse(['error' => "Invalid time format: $timeSchedule. Use 'Y-m-d H:i'."], 400);
            }
    
            $schedule = new ScheduleDoctors();
            $schedule->setDoctor($doctor);
            $schedule->setTimeSchedule($dateTime);
    
            $em->persist($schedule);
            $createdSchedules[] = [
                'time_schedule' => $schedule->getTimeSchedule()->format('Y-m-d H:i'),
            ];
        }
    
        $em->flush();
    
        return new JsonResponse([
            'status' => 'Schedules created successfully',
            'data' => $createdSchedules
        ], 201);
    }
    

    #[Route('/api/schedule/delete', name: 'delete_schedule', methods: ['DELETE'])]
public function deleteSchedule(
    Request $request,
    EntityManagerInterface $em
): JsonResponse {
    $data = json_decode($request->getContent(), true);
    $doctorId = $data['doctorId'] ?? null;

    if (!$doctorId) {
        return new JsonResponse(['error' => 'doctorId is required.'], 400);
    }

    $doctor = $em->getRepository(Doctor::class)->find($doctorId);
    if (!$doctor) {
        return new JsonResponse(['error' => 'Doctor not found.'], 404);
    }

    $schedules = $em->getRepository(ScheduleDoctors::class)->findBy(['doctor' => $doctor]);

    if (empty($schedules)) {
        return new JsonResponse(['message' => 'No schedules found for this doctor.'], 200);
    }

    foreach ($schedules as $schedule) {
        $em->remove($schedule);
    }

    $em->flush();

    return new JsonResponse(['status' => 'All schedules deleted successfully'], 200);
}

}
