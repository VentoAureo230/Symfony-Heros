<?php

namespace App\Controller;

use App\Entity\Heros;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HeroController extends AbstractController
{
    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        return $this->render('hero/index.html.twig', [
            'controller_name' => 'HeroController',
        ]);
    }

    #[Route('/home/create-hero', name:'create_hero')]
    #[Route('/home/{id}/edit', name:'edit_hero')]
    public function form(Heros $hero = null, Request $request, ObjectManager $manager) {
        
        if(!$hero){
            $hero = new Heros();
        }

        $form = $this->createFormBuilder($hero)
                     ->add('name')
                     ->add('description')
                     ->add('level')
                     ->add('experience')
                     ->add('health')
                     ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($hero);
            $manager->flush();

            return $this->redirectToRoute('hero_list', ['id' => $hero->getId()]);
        }


        return $this->render('hero/create.html.twig', ['formHero' => $form->createView(),
        'editMode' => $hero->getId() !== null
    ]);
    }
}
