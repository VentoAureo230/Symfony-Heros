<?php

namespace App\Controller;


use App\Entity\Heros;
use App\Repository\HerosRepository;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HeroController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('homepage.html.twig',);
    }

    #[Route('/character', name: 'show_character')]
    public function show(HerosRepository $repository): Response
    {
        $allHeroes = $repository->findAll();
        return $this->render('hero/index.html.twig', [
            'heroes' => $allHeroes,
        ]);
    }

    #[Route('/character/add', name:'add_character')]
    #[Route('/character/edit/{id}', name:'edit_character')]
    public function form(Heros $hero = null, Request $request, ManagerRegistry $manager)
    {
        if(!$hero){
            $hero = new Heros();
        }

        $form = $this->createFormBuilder($hero)
            ->add('name')
            ->add('birthdate', DateTimeType::class, [
                'date_label' => 'Starts on'
            ])
            ->add('classHeros')
            // ->add('skillName')
            ->add('description')
            ->add('level')
            ->add('experience')
            ->add('healtpoint')
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $manager->getManager();
            $em->persist($hero);
            $em->flush();

            return $this->redirectToRoute('show_character', ['id' => $hero->getId()]);
        }
        
        return $this->render('hero/create.html.twig', ['formHero' => $form->createView(),
        'editMode' => $hero->getId() !== null
    ]); 
    }

    #[Route('/character/delete/{id}', name:'delete_character')]
    public function delete(Heros $hero, ManagerRegistry $manager): RedirectResponse
    {
        $em = $manager->getManager();
        $em->remove($hero);
        $em->flush();

        return $this->redirectToRoute(route: "home");
    }
}