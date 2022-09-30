<?php

namespace App\Controller;

use App\Entity\ClassHeros;
use App\Entity\Heros;
use App\Repository\HerosRepository;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Doctrine\Persistence\ManagerRegistry;
// use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HeroController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('base.html.twig',);
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
    #[Route('/character/delete/{id}', name:'delete_character')]
    public function form(Heros $hero = null, Request $request, ManagerRegistry $manager) {
        
        if(!$hero){
            $hero = new Heros();
        }

        $form = $this->createFormBuilder($hero)
            ->add('name')
            ->add('birthdate', DateTimeType::class, [
                'date_label' => 'Starts on'
            ])
            ->add('classHeros')
            ->add('description')
            ->add('level')
            ->add('experience')
            ->add('healtpoint')
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $manager->getManager();
            $em->persist($hero);
            $em->flush();

            return $this->redirectToRoute('hero_list', ['id' => $hero->getId()]);
        }


        return $this->render('hero/create.html.twig', ['formHero' => $form->createView(),
        'editMode' => $hero->getId() !== null
    ]);
    }

    
}
