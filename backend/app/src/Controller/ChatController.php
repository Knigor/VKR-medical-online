<?php

namespace App\Controller;

use App\Entity\Chat;
use App\Entity\Message;
use App\Entity\Patient;
use App\Entity\Doctor;
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

    #[Route('/api/chat/{chatId}/messages', methods: ['GET'])]
    public function getChatMessages(int $chatId, EntityManagerInterface $em): JsonResponse
    {
        $chat = $em->getRepository(Chat::class)->find($chatId);
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
        $patient = $em->getRepository(Patient::class)->find($data['patientId']);
        $doctor = $em->getRepository(Doctor::class)->find($data['doctorId']);

        if (!$patient || !$doctor) {
            return $this->json(['error' => 'Invalid patient or doctor'], 400);
        }

        $existingChat = $em->getRepository(Chat::class)->findOneBy([
            'patient' => $patient,
            'doctor' => $doctor,
        ]);

        if ($existingChat) {
            return $this->json([
                'message' => 'Chat already exists',
                'chatId' => $existingChat->getChatsId(),
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
        ], 201);
    }

    #[Route('/api/chat/send-message', methods: ['POST'])]
    public function sendMessage(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['chatId'], $data['senderId'], $data['message'])) {
            return $this->json(['error' => 'Invalid data'], 400);
        }

        $chat = $em->getRepository(Chat::class)->find($data['chatId']);
        if (!$chat) {
            return $this->json(['error' => 'Chat not found'], 404);
        }

        $message = new Message();
        $message->setChat($chat);
        $message->setUser($data['senderId']);
        $message->setMessage($data['message']);
        $message->setTimestamp(new \DateTime());

        $em->persist($message);
        $em->flush();

        // Отправка в WebSocket (Mercure)
        $this->httpClient->request('POST', 'http://localhost:5000/socket.io/', [
            'json' => [
                'chatId' => $data['chatId'],
                'message' => $data['message'],
                'senderId' => $data['senderId']
            ]
        ]);

        return $this->json(['status' => 'Message sent']);
    }
}
