<?php

namespace App\Controller;

use App\Repository\HoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class HoursController extends AbstractController
{
    #[Route('/getHours', name: 'app_hours', methods: 'POST')]
    public function getHours(
        Request $request,
        HoursRepository $hoursRepository,
        SerializerInterface $serializer
    ): JsonResponse {
        $bodyEncode = $request->getContent();
        $body = json_decode($bodyEncode, true);
        if (!$body['day']) {
            return $this->json(['error' => 'champs manquant'], 204);
        }
        $hoursOfDay = $hoursRepository->findBy(['day' => $body['day']]);
        if (count($hoursOfDay) === 0) {
            return $this->json(['hours' => ['Fermé']], 200);
        }
        $result = [];
        foreach ($hoursOfDay as $hour) {
            array_push($result, array('day' => $hour->getDay(), 'startHour' => $hour->getStartHour(), 'endHour' => $hour->getEndHour()));
        }
        $nbPlaces = $hoursOfDay[0]->getRestaurant()->getCapacityMax();
        return $this->json(['hours' => $result, 'nbPlace' => $nbPlaces], 200);
    }
}
