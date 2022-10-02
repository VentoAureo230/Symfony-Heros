<?php

namespace App\Controller;

use App\Entity\ClassHeros;
use App\Repository\ClassHerosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use LDAP\Result;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassHerosController extends AbstractController
{
    #[Route('/type', name: 'type_list')]
    public function showClass(ClassHerosRepository $repository): Response
    {
        $classHeros = $repository->findAll();
        return $this->render('class_heros/index.html.twig', [
            'classHeros' => $classHeros,
        ]);
    }

    #[Route('/type/add', name:'add_class')]
    #[Route('/type/edit/{id}', name:'edit_class')]
    public function form(ClassHeros $classHero = null, Request $request, ManagerRegistry $manager)
    {
        if(!$classHero){
            $classHero = new ClassHeros();
        }

        $form = $this->createFormBuilder($classHero)
            ->add('className')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $manager->getManager();
            $em->persist($classHero);
            $em->flush();

            return $this->redirectToRoute('type_list', ['id' => $classHero->getId()]);
    }

    return $this->render('class_heros/create.html.twig', ['formClass' => $form->createView(),
    'editMode' => $classHero->getId() !== null
    ]);
    }

    #[Route('type/delete/{id}', name:'delete_class')]
    public function deleteClass(ClassHeros $classHero, ManagerRegistry $manager): Response
    {
        $em = $manager->getManager();
        $em->remove($classHero);
        $em->flush();

        return $this->redirectToRoute(route: "type_list");
    }
}