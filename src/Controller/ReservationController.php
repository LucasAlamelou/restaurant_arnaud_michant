<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\HoursRepository;
use App\Repository\ReservationRepository;
use DateTime;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation', methods: ['GET|POST'])]
    public function reservation(
        Request $request,
        ManagerRegistry $doctrine,
        HoursRepository $hoursRepository,
    ): Response {
        $user = $this->getUser();

        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $doctrine->getManager();
            $em->persist($reservation);
            $em->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->render('reservation/index.html.twig', [
            'form' => $form->createView(),
            'hours' => $hoursRepository->findAll(),
            'user' => $user
        ]);
    }

    #[Route('/getReservationJour', name: 'app_check_place', methods: ['POST'])]
    public function checkOfPlaces(
        Request $request,
        ReservationRepository $reservationRepository,
        SerializerInterface $serializer
    ): JsonResponse {
        $bodyEncode = $request->getContent();
        $body = json_decode($bodyEncode, true);
        if (!$body) {
            return $this->json([], 204);
        }
        $day = $body['date'];
        $date = new DateTime($day);
        $slots = $reservationRepository->findBy(['date' => $date], ['date' => 'ASC']);
        return $this->json(['reservations' => $serializer->serialize($slots, 'json')], 200);
    }
}
