<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\UserClient;
use App\Form\RegisterType;
use App\Repository\UserClientRepository;
use App\Security\UserAuthenticator;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;

class ClientUserController extends AbstractController
{
    #[Route('/client/user', name: 'app_client_user')]
    public function index(): Response
    {
        return $this->render('client_user/index.html.twig', [
            'controller_name' => 'ClientUserController',
        ]);
    }

    #[Route('/register', name: 'app_register', methods: 'GET|POST')]
    public function createUser(
        UserPasswordHasherInterface $userPasswordHasher,
        Request $request,
        ManagerRegistry $doctrine,
        UserAuthenticator $authenticator,
        UserAuthenticatorInterface $userAuthenticator
    ): Response {
        $userClient = new UserClient();
        $user = new User($userPasswordHasher);

        $form = $this->createForm(RegisterType::class, ['user' => $user, 'userClient' => $userClient]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setUserClient($userClient);
            $userClient->setUser($user);
            $em = $doctrine->getManager();
            $em->persist($userClient);
            $em->flush();
            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }
        return $this->render('register/register.html.twig', [
            'form' => $form,
        ]);
    }
}
