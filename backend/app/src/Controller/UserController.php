<?php

// src/Controller/UserController.php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class UserController extends AbstractController
{
    #[Route("/api/addUser", name: "add_user", methods: ["POST"])]
    public function addUser(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {
        // Получаем данные из тела запроса
        $data = json_decode($request->getContent(), true);

        // Проверка, что все необходимые данные присутствуют
        if (empty($data['fio']) || empty($data['login']) || empty($data['password']) || empty($data['email'])) {
            return $this->json(['error' => 'Missing parameters'], Response::HTTP_BAD_REQUEST);
        }

        // Создаем новый объект пользователя
        $user = new User();
        $user->setFio($data['fio']);
        $user->setLogin($data['login']);
        $user->setEmail($data['email']);
        $user->setHashPassword(password_hash($data['password'], PASSWORD_BCRYPT)); // Применяем хеширование пароля
        $user->setRole('user'); // Можно добавить стандартную роль

        // Сохраняем пользователя в базе данных
        $entityManager->persist($user);
        $entityManager->flush();

        // Сериализация данных пользователя с указанием группы 'user:read'
        $userData = $serializer->normalize($user, null, ['groups' => ['user:read']]);

        return $this->json([
            'message' => 'User created successfully',
            'user' => $userData,
        ], Response::HTTP_CREATED);
    }
}
