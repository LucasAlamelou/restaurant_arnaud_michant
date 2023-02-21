<?php

namespace App\Controller;

use App\Repository\FormuleInMenuRepository;
use App\Repository\HoursRepository;
use App\Repository\PictureRepository;
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
        HoursRepository $hoursRepository,
        PictureRepository $pictureRepository
    ): Response {
        return $this->render('home/home.html.twig', [
            'type_of_menu' => $typeOfMenuRepository->findAll(),
            'formule_in_menu' => $formuleInMenuRepository->findAll(),
            'hours' => $hoursRepository->findAll(),
            'pictures' => $pictureRepository->findAll()
        ]);
    }

    #[Route('/mentions', name: 'app_mentions', methods: ['GET'])]
    public function mentions(): Response
    {
        return $this->render('mentions/mentions.html.twig', []);
    }

    #[Route('/confidentialite', name: 'app_confidentialite', methods: ['GET'])]
    public function confidentialite(): Response
    {
        return $this->render('confidentialite/confidentialite.html.twig', []);
    }
}
