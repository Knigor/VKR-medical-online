<?php


// src/Controller/DoctorController.php
namespace App\Controller;

use App\Entity\Doctor;
use App\Entity\User;
use App\Entity\Specialization;
use App\Entity\ScheduleDoctors;
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
        $doctorId = $request->request->get('doctorId');
        if (!$doctorId) {
            return new JsonResponse(['error' => 'Doctor ID is required.', 'data' => $request->request->all()], 400);
        }
    
        // Ищем врача
        $doctor = $em->getRepository(Doctor::class)->find($doctorId);
        if (!$doctor) {
            throw new NotFoundHttpException('Doctor not found.');
        }
    
        $updatedFields = [];
    
        // Обновление данных врача
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
    
        // Обновление пользователя
        if ($userId = $request->request->get('userId')) {
            $user = $em->getRepository(User::class)->find($userId);
            if ($user) {
                $doctor->setUser($user);
                $updatedFields['user_id'] = $userId;
            }
        }
    
        // Обновление или создание специализации
        if ($specializationName = $request->request->get('specializationName')) {
            $specializations = $em->getRepository(Specialization::class)->findBy(['doctor' => $doctor]);
    
            if (!empty($specializations)) {
                // Обновляем первую специализацию в списке
                $firstSpecialization = $specializations[0];
                $firstSpecialization->setNameSpecialization($specializationName);
                $updatedFields['first_specialization_name'] = $specializationName;
            } else {
                // Создаём новую специализацию, если у врача их нет
                $newSpecialization = new Specialization();
                $newSpecialization->setNameSpecialization($specializationName);
                $newSpecialization->setDoctor($doctor);
                $em->persist($newSpecialization);
                $updatedFields['new_specialization_name'] = $specializationName;
            }
        }
    
        // Сохранение всех изменений
        $em->flush();
    
        // Формируем ответ с расписанием и специализациями
        $schedules = $em->getRepository(ScheduleDoctors::class)->findBy(['doctor' => $doctor]);
        $scheduleData = array_map(fn(ScheduleDoctors $s) => [
            'scheduleDoctorsId' => $s->getScheduleDoctorsId(),
            'time_schedule' => $s->getTimeSchedule()->format('Y-m-d H:i'),
        ], $schedules);
    
        $specializations = $em->getRepository(Specialization::class)->findBy(['doctor' => $doctor]);
        $specializationData = array_map(fn(Specialization $s) => [
            'specializationId' => $s->getSpecializationId(),
            'nameSpecialization' => $s->getNameSpecialization(),
        ], $specializations);
    
        return new JsonResponse([
            'status' => 'Doctor updated successfully',
            'data' => [
                'id' => $doctor->getDoctorId(),
                'bio' => $doctor->getBio(),
                'education' => $doctor->getEducation(),
                'qualification' => $doctor->getQualification(),
                'experience' => $doctor->getExperience(),
                'complete_consultation' => $doctor->getCompleteConsultation(),
                'user_id' => $doctor->getUser() ? $doctor->getUser()->getUserId() : null,
                'schedule' => $scheduleData,
                'specializations' => $specializationData,
                'updated_fields' => $updatedFields,
            ]
        ], 200);
    }

    #[Route('/api/doctor', name: 'get_doctor', methods: ['GET'])]
    public function getDoctor(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $doctorId = $request->query->get('doctorId');
        
        if (!$doctorId) {
            return new JsonResponse(['error' => 'Doctor ID is required.'], 400);
        }
        
        $doctor = $em->getRepository(Doctor::class)->find($doctorId);
        
        if (!$doctor) {
            throw new NotFoundHttpException('Doctor not found.');
        }
        
        // Получаем расписание для доктора
        $schedules = $em->getRepository(ScheduleDoctors::class)->findBy(['doctor' => $doctor]);
        
        $scheduleData = array_map(function (ScheduleDoctors $schedule) {
            return [
                'scheduleDoctorsId' => $schedule->getScheduleDoctorsId(),
                'time_schedule' => $schedule->getTimeSchedule()->format('Y-m-d H:i'),
            ];
        }, $schedules);
    
        // Получаем специализации доктора
        $specializations = $em->getRepository(Specialization::class)->findBy(['doctor' => $doctor]);
    
        $specializationData = array_map(function (Specialization $specialization) {
            return [
                'specializationId' => $specialization->getSpecializationId(),
                'nameSpecialization' => $specialization->getNameSpecialization(),
            ];
        }, $specializations);
    
                 // Получаем пользователя через репозиторий Doctor
                 $doctorEntity = $em->getRepository(Doctor::class)->findOneBy(['doctorId' => $doctor->getDoctorId()]);
                 $user = $doctorEntity ? $doctorEntity->getUser() : null;
     
    

        $doctorData = [
            'id' => $doctor->getDoctorId(),
            'bio' => $doctor->getBio(),
            'education' => $doctor->getEducation(),
            'qualification' => $doctor->getQualification(),
            'experience' => $doctor->getExperience(),
            'complete_consultation' => $doctor->getCompleteConsultation(),
            'user_id' => $doctor->getUser() ? $doctor->getUser()->getUserId() : null,
            'schedule' => $scheduleData,
            'specializations' => $specializationData, // Добавили специализации
            'fullName' => $user->getFio(),
            'photo_user' => $user->getPhotoUser(),
        ];
        
        return new JsonResponse(['status' => 'success', 'data' => $doctorData], 200);
    }


    #[Route('/api/specializations/search', name: 'search_specializations', methods: ['GET'])]
    public function searchSpecializations(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $query = $request->query->get('query');
    
        if (!$query) {
            return new JsonResponse(['error' => 'Query parameter is required.'], 400);
        }
    
        $specializations = $em->getRepository(Specialization::class)->createQueryBuilder('s')
            ->where('s.nameSpecialization LIKE :query')
            ->setParameter('query', '%' . $query . '%')
            ->getQuery()
            ->getResult();
    
        $results = [];
    
        foreach ($specializations as $specialization) {
            $doctor = $specialization->getDoctor();
            if ($doctor) {
                $schedules = $em->getRepository(ScheduleDoctors::class)->findBy(['doctor' => $doctor]);
    
                $scheduleData = array_map(fn(ScheduleDoctors $schedule) => [
                    'scheduleDoctorsId' => $schedule->getScheduleDoctorsId(),
                    'time_schedule' => $schedule->getTimeSchedule()->format('Y-m-d H:i'),
                ], $schedules);
    
                // Получаем пользователя через репозиторий Doctor
                $doctorEntity = $em->getRepository(Doctor::class)->findOneBy(['doctorId' => $doctor->getDoctorId()]);
                $user = $doctorEntity ? $doctorEntity->getUser() : null;
    
                $userData = $user ? [
                    'fullName' => $user->getFio(),
                    'email' => $user->getEmail(),
                    'photo_user' => $user->getPhotoUser(),
                ] : [
                    'fullName' => null,
                    'email' => null,
                    'photo_user' => null,
                ];
    
                $results[] = [
                    'nameSpecialization' => $specialization->getNameSpecialization(),
                    'doctorId' => $doctor->getDoctorId(),
                    'data' => array_merge([
                        'id' => $doctor->getDoctorId(),
                        'bio' => $doctor->getBio(),
                        'education' => $doctor->getEducation(),
                        'qualification' => $doctor->getQualification(),
                        'experience' => $doctor->getExperience(),
                        'complete_consultation' => $doctor->getCompleteConsultation(),
                        'user_id' => $user ? $user->getUserId() : null,
                        'schedule' => $scheduleData,
                    ], $userData),
                ];
            }
        }
    
        return new JsonResponse(['status' => 'success', 'data' => $results], 200);
    }
    
    

}
