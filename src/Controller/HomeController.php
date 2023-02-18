<?php

namespace App\Controller;

use App\Repository\FormuleInMenuRepository;
use App\Repository\HoursRepository;
use App\Repository\TypeOfMenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function Home(
        TypeOfMenuRepository $typeOfMenuRepository,
        FormuleInMenuRepository $formuleInMenuRepository,
        HoursRepository $hoursRepository
    ): Response {
        return $this->render('home/home.html.twig', [
            'type_of_menu' => $typeOfMenuRepository->findAll(),
            'formule_in_menu' => $formuleInMenuRepository->findAll(),
            'hours' => $hoursRepository->findAll()
        ]);
    }
}
