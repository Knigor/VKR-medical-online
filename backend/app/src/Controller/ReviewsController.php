<?php

namespace App\Controller;

use App\Entity\Reviews;
use App\Entity\Doctor;
use App\Entity\Patient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReviewsController extends AbstractController
{
    #[Route('/api/reviews', name: 'get_all_reviews', methods: ['GET'])]
    public function getAllReviews(EntityManagerInterface $em): JsonResponse
    {
        $reviews = $em->getRepository(Reviews::class)->findAll();

        $data = array_map(function (Reviews $review) {
            return [
                'reviewsId' => $review->getReviewsId(),
                'rating' => $review->getRating(),
                'doctorId' => $review->getDoctor()?->getDoctorId(),
                'patientId' => $review->getPatient()?->getPatientId(),
            ];
        }, $reviews);

        return new JsonResponse(['status' => 'success', 'data' => $data], 200);
    }

    #[Route('/api/reviews/doctor', name: 'get_reviews_by_doctor', methods: ['GET'])]
    public function getReviewsByDoctor(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $doctorId = $request->query->get('doctorId');
        if (!$doctorId) {
            return new JsonResponse(['error' => 'doctorId is required.'], 400);
        }

        $doctor = $em->getRepository(Doctor::class)->find($doctorId);
        if (!$doctor) {
            return new JsonResponse(['error' => 'Doctor not found.'], 404);
        }

        $reviews = $em->getRepository(Reviews::class)->findBy(['doctor' => $doctor]);

        $data = array_map(function (Reviews $review) {
            return [
                'reviewsId' => $review->getReviewsId(),
                'rating' => $review->getRating(),
                'doctorId' => $review->getDoctor()?->getDoctorId(),
                'patientId' => $review->getPatient()?->getPatientId(),
            ];
        }, $reviews);

        return new JsonResponse(['status' => 'success', 'data' => $data], 200);
    }

    #[Route('/api/reviews', name: 'create_review', methods: ['POST'])]
    public function createReview(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $doctorId = $request->request->get('doctorId');
        $patientId = $request->request->get('patientId');
        $rating = $request->request->get('rating');
    
        if (!$rating) {
            return new JsonResponse(['error' => 'Rating is required.'], 400);
        }
    
        if (!$doctorId) {
            return new JsonResponse(['error' => 'DoctorId is required.'], 400);
        }
    
        if (!$patientId) {
            return new JsonResponse(['error' => 'PatientId is required.'], 400);
        }
    
        $doctor = $em->getRepository(Doctor::class)->find($doctorId);
        if (!$doctor) {
            return new JsonResponse(['error' => 'Doctor not found.'], 404);
        }
    
        $patient = $em->getRepository(Patient::class)->find($patientId);
        if (!$patient) {
            return new JsonResponse(['error' => 'Patient not found.'], 404);
        }
    
        // Проверка: уже существует отзыв от данного пациента к этому доктору
        $existingReview = $em->getRepository(Reviews::class)->findOneBy([
            'doctor' => $doctor,
            'patient' => $patient,
        ]);
    
        if ($existingReview) {
            return new JsonResponse(['error' => 'You have already reviewed this doctor.'], 400);
        }
    
        $review = new Reviews();
        $review->setRating((int) $rating);
        $review->setDoctor($doctor);
        $review->setPatient($patient);
    
        $em->persist($review);
        $em->flush();
    
        return new JsonResponse(['status' => 'Review created successfully', 'data' => [
            'reviewsId' => $review->getReviewsId(),
            'rating' => $review->getRating(),
            'doctorId' => $review->getDoctor()?->getDoctorId(),
            'patientId' => $review->getPatient()?->getPatientId(),
        ]], 201);
    }
    
}
