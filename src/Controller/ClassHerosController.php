<?php

namespace App\Controller;

use App\Entity\ClassHeros;
use App\Repository\ClassHerosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassHerosController extends AbstractController
{
    /**
     * Affiche tout les héros dans la BDD - Todo : Affichez les héros appartenant au compte utilisateur (et donc créer des équipes de héros)
     */
    #[Route('/type', name: 'type_list')]
    public function showClass(ClassHerosRepository $repository, LoggerInterface $logger): Response
    {
        $logger->debug('Accession sur la route /type');
        $classHeros = $repository->findAll();
        return $this->render('class_heros/index.html.twig', [
            'classHeros' => $classHeros,
        ]);
    }

    /**
     * Fonction d'ajout et de modification des héros existant
     */
    #[Route('/type/add', name: 'add_class')]
    #[Route('/type/edit/{id}', name: 'edit_class')]
    public function form(ClassHeros $classHero = null, Request $request, ManagerRegistry $manager)
    {
        if (!$classHero) {
            $classHero = new ClassHeros();
        }

        $form = $this->createFormBuilder($classHero)
            ->add('className')
            ->add('description')
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $manager->getManager();
            $em->persist($classHero);
            $em->flush();

            return $this->redirectToRoute('type_list', ['id' => $classHero->getId()]);
        }
        return $this->render('class_heros/create.html.twig', [
            'formClass' => $form->createView(),
            'editMode' => $classHero->getId() !== null
        ]);
    }

    /**
     * Fonction de supression des héros
     */
    #[Route('type/delete/{id}', name: 'delete_class')]
    public function deleteClass(ClassHeros $classHero, ManagerRegistry $manager): Response
    {
        $em = $manager->getManager();
        $em->remove($classHero);
        $em->flush();

        return $this->redirectToRoute(route: "type_list");
    }
}
