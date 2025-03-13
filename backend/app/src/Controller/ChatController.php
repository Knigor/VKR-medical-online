<?php

namespace App\Controller;

use App\Entity\Chat;
use App\Entity\Message;
use App\Entity\User;
use App\Entity\Patient;
use App\Entity\Doctor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ChatController extends AbstractController
{
    #[Route('/api/chat/patient', methods: ['GET'])]
    public function getPatientChats(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $patientId = $request->query->get('patient_id');
        $chats = $em->getRepository(Chat::class)->findBy(['user' => $patientId]);
        return $this->json($chats, 200, [], ['groups' => 'chat:read']);
    }

    #[Route('/api/chat/doctor', methods: ['GET'])]
    public function getDoctorChats(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $doctorId = $request->query->get('doctor_id');
        $chats = $em->getRepository(Chat::class)->findBy(['doctor' => $doctorId]);
        return $this->json($chats, 200, [], ['groups' => 'chat:read']);
    }

    #[Route('/api/chat/start', methods: ['POST'])]
    public function startChat(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = $request->request->all() ?: json_decode($request->getContent(), true);
        $patient = $em->getRepository(Patient::class)->find($data['patientId']);
        $doctor = $em->getRepository(Doctor::class)->find($data['doctorId']);
    
        if (!$patient || !$doctor) {
            return $this->json(['error' => 'Invalid user or doctor'], 400);
        }
    
        // Проверяем, существует ли уже чат между этим пациентом и врачом
        $existingChat = $em->getRepository(Chat::class)->findOneBy([
            'patient' => $patient,
            'doctor' => $doctor,
        ]);
    
        if ($existingChat) {
            return $this->json([
                'error' => 'Chat already exists',
                'chatId' => $existingChat->getChatsId(),
            ], 400);
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
        $data = $request->request->all() ?: json_decode($request->getContent(), true);
        $chat = $em->getRepository(Chat::class)->find($data['chat_id']);
        $user = $em->getRepository(User::class)->find($data['user_id']);

        if (!$chat || !$user) {
            return $this->json(['error' => 'Invalid chat or user'], 400);
        }

        $message = new Message();
        $message->setChat($chat);
        $message->setUser($user);
        $message->setMessage($data['message'] ?? null);
        $message->setTimestamp(new \DateTime());

        if ($request->files->get('image')) {
            /** @var UploadedFile $image */
            $image = $request->files->get('image');
            $uploadsDir = $this->getParameter('kernel.project_dir') . '/public/uploads/messages';
            $filename = uniqid() . '.' . $image->guessExtension();
            
            try {
                $image->move($uploadsDir, $filename);
                $message->setMessagesImage('/uploads/messages/' . $filename);
            } catch (FileException $e) {
                return $this->json(['error' => 'File upload failed'], 500);
            }
        }

        $em->persist($message);
        $em->flush();

        return $this->json($message, 201, [], ['groups' => 'message:read']);
    }
}