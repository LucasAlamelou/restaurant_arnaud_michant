<?php

namespace App\Controller;

use App\Repository\CategoriesOfPlatRepository;
use App\Repository\HoursRepository;
use App\Repository\PlatOfRestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlatsController extends AbstractController
{
    #[Route('/plats', name: 'app_plats', methods: ['GET'])]
    public function index(
        PlatOfRestaurantRepository $platOfRestaurantRepository,
        CategoriesOfPlatRepository $categoriesOfPlatRepository,
        HoursRepository $hoursRepository
    ): Response {

        return $this->render('plats/index.html.twig', [
            'plats' => $platOfRestaurantRepository->findAll(),
            'categories_plats' => $categoriesOfPlatRepository->findAll(),
            'hours' => $hoursRepository->findAll()
        ]);
    }
}
