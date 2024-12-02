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

        // Получаем время из запроса
        $timeSchedule = $request->request->get('time_schedule');
        if (!$timeSchedule) {
            return new JsonResponse(['error' => 'time_schedule is required.'], 400);
        }

        // Проверяем формат времени
        $dateTime = \DateTime::createFromFormat('Y-m-d H:i', $timeSchedule);
        if (!$dateTime) {
            return new JsonResponse(['error' => 'Invalid time format. Use "Y-m-d H:i".'], 400);
        }

        // Создаем новую запись расписания
        $schedule = new ScheduleDoctors();
        $schedule->setDoctor($doctor);
        $schedule->setTimeSchedule($dateTime);

        // Сохраняем в базе
        $em->persist($schedule);
        $em->flush();

        return new JsonResponse(['status' => 'Schedule created successfully', 'data' => [
            'scheduleDoctorsId' => $schedule->getscheduleDoctorsId(),
            'time_schedule' => $schedule->getTimeSchedule()->format('Y-m-d H:i'),
        ]], 201);
    }
}
