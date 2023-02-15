<?php

namespace App\DataFixtures;

use App\Entity\CategoriesOfPlat;
use App\Entity\FormuleInMenu;
use App\Entity\PlatOfRestaurant;
use App\Entity\Restaurant;
use App\Entity\TypeOfMenu;
use App\Entity\User;
use App\Entity\UserClient;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Restaurant table
        $restaurant = new Restaurant();
        $restaurant->setName('Arnaud-Michant');
        $restaurant->setCapacityMax(25);
        $manager->persist($restaurant);

        $user = new User($this->passwordHasher);
        $userClient = new UserClient();
        $userClient->setFirstName('Alamelou')->setLastName('Lucas');
        $userClient->setNbCouvertDefault(2);
        $user->setEmail('lucas.alamelou@gmail.com');
        $user->setPassword('admin');
        $user->setRoles(array('ROLE_ADMIN'));
        $user->setUserClient($userClient);
        $manager->persist($user);

        $user1 = new User($this->passwordHasher);
        $userClient1 = new UserClient();
        $userClient1->setFirstName('User1')->setLastName('User1');
        $userClient1->setNbCouvertDefault(0)->setAllergns(array('Tomate', 'Gluten'));
        $user1->setEmail('user@user.com')->setPassword('admin');
        $user1->setUserClient($userClient1);
        $manager->persist($user1);


        $categorieArray = array('Entrées', 'Plats', 'Desserts', 'Spécialité');

        $categorie = new CategoriesOfPlat();
        $categorie->setName($categorieArray[0]);
        $manager->persist($categorie);
        for ($i = 0; $i < 3; $i++) {
            $plat = new PlatOfRestaurant();
            $plat->setTitle($categorie->getName() . $i);
            $plat->setDescription('Une petite description du plat..' . $i);
            $plat->setPrice(mt_rand(0, 25));
            $plat->setCategoriesOfPlat($categorie);
            $manager->persist($plat);
        }

        $categorie = new CategoriesOfPlat();
        $categorie->setName($categorieArray[1]);
        $manager->persist($categorie);
        for ($i = 0; $i < 3; $i++) {
            $plat = new PlatOfRestaurant();
            $plat->setTitle($categorie->getName() . $i);
            $plat->setDescription('Une petite description du plat..' . $i);
            $plat->setPrice(mt_rand(0, 25));
            $plat->setCategoriesOfPlat($categorie);
            $manager->persist($plat);
        }

        $categorie = new CategoriesOfPlat();
        $categorie->setName($categorieArray[2]);
        $manager->persist($categorie);
        for ($i = 0; $i < 3; $i++) {
            $plat = new PlatOfRestaurant();
            $plat->setTitle($categorie->getName() . $i);
            $plat->setDescription('Une petite description du plat..' . $i);
            $plat->setPrice(mt_rand(0, 25));
            $plat->setCategoriesOfPlat($categorie);
            $manager->persist($plat);
        }

        $categorie = new CategoriesOfPlat();
        $categorie->setName($categorieArray[3]);
        $manager->persist($categorie);
        for ($i = 0; $i < 3; $i++) {
            $plat = new PlatOfRestaurant();
            $plat->setTitle($categorie->getName() . $i);
            $plat->setDescription('Une petite description du plat..' . $i);
            $plat->setPrice(mt_rand(15, 25));
            $plat->setCategoriesOfPlat($categorie);
            $manager->persist($plat);
        }

        $menuArray = array('Menu du midi', 'Menu du soir');
        $menu = new TypeOfMenu();
        $menu->setTitle($menuArray[0]);
        $manager->persist($menu);
        for ($i = 0; $i < 2; $i++) {
            $formule = new FormuleInMenu();
            $formule->setDescription('Une petite description de la formule Entrée + Plat.. ' . $i);
            $formule->setPrice(mt_rand(20, 40));
            $formule->setTypeOfMenu($menu);
            $manager->persist($formule);
        }

        $menu = new TypeOfMenu();
        $menu->setTitle($menuArray[1]);
        $manager->persist($menu);
        for ($i = 0; $i < 2; $i++) {
            $formule = new FormuleInMenu();
            $formule->setDescription('Une petite description de la formule Entrée + Plat.. ' . $i);
            $formule->setPrice(mt_rand(20, 40));
            $formule->setTypeOfMenu($menu);
            $manager->persist($formule);
        }
        $manager->flush();
    }
}
