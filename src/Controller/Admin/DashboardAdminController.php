<?php

namespace App\Controller\Admin;

use App\Entity\CategoriesOfPlat;
use App\Entity\FormuleInMenu;
use App\Entity\Hours;
use App\Entity\Picture;
use App\Entity\PlatOfRestaurant;
use App\Entity\Reservation;
use App\Entity\Restaurant;
use App\Entity\TypeOfMenu;
use App\Entity\User;
use App\Entity\UserClient;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted as ConfigurationIsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class DashboardAdminController extends AbstractDashboardController
{

    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(ReservationCrudController::class)->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('App Restaurant');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'app_home');
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Restaurant', 'fa-solid fa-utensils', Restaurant::class);
        yield MenuItem::linkToCrud('Heure d\'ouverture', 'fa-regular fa-clock', Hours::class);
        yield MenuItem::linkToCrud('Reservation', 'fa-solid fa-check-to-slot', Reservation::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fa-regular fa-user', UserClient::class);
        yield MenuITem::linkToCrud('User', 'fa-regular fa-user', User::class)->setPermission('ROLE_SUPER_ADMIN');
        yield MenuItem::linkToCrud('Plats', 'fa-solid fa-plate-wheat', PlatOfRestaurant::class);
        yield MenuItem::linkToCrud('Catégories des plats', 'fa-solid fa-check-to-slot', CategoriesOfPlat::class);
        yield MenuItem::linkToCrud('Formule dans menus', 'fa-solid fa-check-to-slot', FormuleInMenu::class);
        yield MenuItem::linkToCrud('Type de menus', 'fa-solid fa-check-to-slot', TypeOfMenu::class);
        yield MenuItem::linkToCrud('Photos acceuil', 'fa-regular fa-image', Picture::class);
    }
}
