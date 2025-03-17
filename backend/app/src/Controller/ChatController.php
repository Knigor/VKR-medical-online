<?php

namespace App\Controller;

use App\Entity\Chat;
use App\Entity\Message;
use App\Entity\Patient;
use App\Entity\Doctor;
use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ChatController extends AbstractController
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    #[Route('/api/chat/messages', methods: ['GET'])]
    public function getChatMessages(Request $request, EntityManagerInterface $em): JsonResponse
    {
       
        $chat = $request->query->get('chatId');

        if (!$chat) {
            return $this->json(['error' => 'Chat not found'], 404);
        }

        $messages = $em->getRepository(Message::class)->findBy(['chat' => $chat]);
        return $this->json($messages, 200, [], ['groups' => 'message:read']);
    }

    #[Route('/api/chat/start', methods: ['POST'])]
    public function startChat(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
    
        if (!isset($data['patientId'], $data['doctorId'])) {
            return $this->json(['error' => 'patientId and doctorId are required'], 400);
        }
    
        $patient = $em->getRepository(Patient::class)->find($data['patientId']);
        $doctor = $em->getRepository(Doctor::class)->find($data['doctorId']);
    
        if (!$patient || !$doctor) {
            return $this->json(['error' => 'Invalid patient or doctor'], 400);
        }
    
        // Получаем объекты User из Patient и Doctor
        $patientUser = $patient->getUser();
        $doctorUser = $doctor->getUser();
    
        if (!$patientUser || !$doctorUser) {
            return $this->json(['error' => 'Patient or Doctor user not found'], 400);
        }
    
        $existingChat = $em->getRepository(Chat::class)->findOneBy([
            'patient' => $patient,
            'doctor' => $doctor,
        ]);
    
        if ($existingChat) {

            // если чат уже существует но у него есть false статус
            if (!$existingChat->getStatusChats()) {
                $existingChat->setStatusChats(true);
                $em->flush(); // Сохраняем изменения в базе данных
            }

            return $this->json([
                'message' => 'Chat already exists',
                'chatId' => $existingChat->getChatsId(),
                'patientId' => $patient->getPatientId(),  
                'doctorId' => $doctor->getDoctorId(),    
                'patientUsername' => $patientUser->getFio(),
                'doctorUsername' => $doctorUser->getFio(),
                'statusChat' => $existingChat->getStatusChats(),
            ], 200);
        }
    
        $chat = new Chat();
        $chat->setPatient($patient);
        $chat->setDoctor($doctor);
        $chat->setCreatedAt(new \DateTime());
        $chat->setUpdatedAt(new \DateTime());
        $chat->setStatusChats(true);
    
        $em->persist($chat);
        $em->flush();
    
        return $this->json([
            'message' => 'Chat created successfully',
            'chatId' => $chat->getChatsId(),
            'patientId' => $patient->getPatientId(), 
            'doctorId' => $doctor->getDoctorId(),    
            'patientUsername' => $patientUser->getFio(),
            'doctorUsername' => $doctorUser->getFio(),
            'statusChat' => $chat->getStatusChats(),
        ], 201);
    }


    #[Route('/api/chats', methods: ['GET'])]
    public function getChats(Request $request, EntityManagerInterface $em): JsonResponse
    {
        // Получаем query параметры
        $patientId = $request->query->get('patientId');
        $doctorId = $request->query->get('doctorId');

        // Проверяем, что хотя бы один из параметров передан
        if (!$patientId && !$doctorId) {
            return $this->json(['error' => 'patientId or doctorId is required'], 400);
        }

        // Формируем условие для поиска чатов
        $criteria = [];
        
        if ($patientId) {
            $patient = $em->getRepository(Patient::class)->find($patientId);
            if (!$patient) {
                return $this->json(['error' => 'Invalid patientId'], 400);
            }
            $criteria['patient'] = $patient;
        }

        if ($doctorId) {
            $doctor = $em->getRepository(Doctor::class)->find($doctorId);
            if (!$doctor) {
                return $this->json(['error' => 'Invalid doctorId'], 400);
            }
            $criteria['doctor'] = $doctor;
        }

        // Ищем чаты по заданным критериям
        $chats = $em->getRepository(Chat::class)->findBy($criteria);

        // Если чатов нет
        if (!$chats) {
            return $this->json(['message' => 'No chats found'], 200);
        }

        // Формируем ответ с чатом и информацией о пользователе
        $chatData = [];
        foreach ($chats as $chat) {
            $patientUser = $chat->getPatient()->getUser();
            $doctorUser = $chat->getDoctor()->getUser();
            
            $chatData[] = [
                'chatId' => $chat->getChatsId(),
                'patientId' => $chat->getPatient()->getPatientId(),
                'doctorId' => $chat->getDoctor()->getDoctorId(),
                'patientUsername' => $patientUser ? $patientUser->getFio() : 'N/A',
                'doctorUsername' => $doctorUser ? $doctorUser->getFio() : 'N/A',
                'statusChat' => $chat->getStatusChats(),
            ];
        }

        return $this->json($chatData, 200);
    }

    #[Route('/api/chat/close', methods: ['POST'])]
    public function closeChat(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $chatId = $request->request->get('chatId');
    
        if (!$chatId) {
            return $this->json(['error' => 'Chat not found'], 404);
        }
    
        $chat = $em->getRepository(Chat::class)->find($chatId);
    
        if (!$chat) {
            return $this->json(['error' => 'Chat not found'], 404);
        }
    
        $chat->setStatusChats(false);
        $em->flush();
    
        return $this->json(['message' => 'Chat closed successfully', 'chatId' => $chat->getChatsId()], 200);
    }


}
