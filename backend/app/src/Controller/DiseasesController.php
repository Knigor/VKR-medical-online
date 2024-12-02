<?php

namespace App\Controller;

use App\Entity\Diseases;
use App\Entity\Doctor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DiseasesController extends AbstractController
{
    #[Route('/api/diseasesAll', name: 'get_all_diseases', methods: ['GET'])]
    public function getAllDiseases(EntityManagerInterface $em): JsonResponse
    {
        $diseases = $em->getRepository(Diseases::class)->findAll();

        $data = array_map(function (Diseases $disease) {
            return [
                'diseasesId' => $disease->getDiseasesId(),
                'typeDiseases' => $disease->getTypeDiseases(),
                'doctorId' => $disease->getDoctor()?->getDoctorId(),
            ];
        }, $diseases);

        return new JsonResponse(['status' => 'success', 'data' => $data], 200);
    }

    #[Route('/api/diseases', name: 'get_diseases_by_doctor', methods: ['GET'])]
    public function getDiseasesByDoctor(Request $request, EntityManagerInterface $em): JsonResponse
    {
        // Получаем doctorId из параметров запроса
        $doctorId = $request->query->get('doctorId');
    
        if (!$doctorId) {
            return new JsonResponse(['error' => 'doctorId is required.'], 400);
        }
    
        // Ищем доктора
        $doctor = $em->getRepository(Doctor::class)->find($doctorId);
        if (!$doctor) {
            return new JsonResponse(['error' => 'Doctor not found.'], 404);
        }
    
        // Получаем болезни, связанные с доктором
        $diseases = $em->getRepository(Diseases::class)->findBy(['doctor' => $doctor]);
    
        $data = array_map(function (Diseases $disease) {
            return [
                'diseasesId' => $disease->getDiseasesId(),
                'typeDiseases' => $disease->getTypeDiseases(),
                'doctorId' => $disease->getDoctor()?->getDoctorId(),
            ];
        }, $diseases);
    
        return new JsonResponse(['status' => 'success', 'data' => $data], 200);
    }
    

    #[Route('/api/diseases', name: 'create_disease', methods: ['POST'])]
    public function createDisease(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $doctorId = $request->request->get('doctorId');
        $typeDiseases = $request->request->get('typeDiseases');

        if (!$typeDiseases) {
            return new JsonResponse(['error' => 'typeDiseases is required.'], 400);
        }

        if ($doctorId) {
            $doctor = $em->getRepository(Doctor::class)->find($doctorId);
            if (!$doctor) {
                throw new NotFoundHttpException('Doctor not found.');
            }
        }

        $disease = new Diseases();
        $disease->setTypeDiseases($typeDiseases);

        if (isset($doctor)) {
            $disease->setDoctor($doctor);
        }

        $em->persist($disease);
        $em->flush();

        return new JsonResponse(['status' => 'Disease created successfully', 'data' => [
            'diseasesId' => $disease->getDiseasesId(),
            'typeDiseases' => $disease->getTypeDiseases(),
            'doctorId' => $disease->getDoctor()?->getDoctorId(),
        ]], 201);
    }
}
