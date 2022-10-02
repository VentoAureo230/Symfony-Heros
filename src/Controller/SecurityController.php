<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * Ce controlleur permet la connexion d'un compte exitant au site
     */
    #[Route('/connexion', name: 'security.login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' =>$authenticationUtils->getLastAuthenticationError()
        ]);
    }
    /**
     * Ce controlleur permet la déconnexion d'un compte du site
     */
    #[Route('/deconnexion', name:'security.logout')]
    public function logout()
    {
        // Nothing to do here
    }

    /**
     * Ce controlleur permet l'enregistrement d'un nouvel utilisateur au site
     */
    #[Route('/inscription', name:'security.registration', methods: ['GET', 'POST'])]
    public function registration(Request $request, ManagerRegistry $manager): Response
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']); // Permet de trier entre les roles admin et user dans la bdd

        $form = $this->createForm(RegistrationType::class, $user); //Form fait avec make:form

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();

            $this->addFlash(
                'success',
                'Votre compte à été créé.'
            );

            $em = $manager->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('security.login');
        }
        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
