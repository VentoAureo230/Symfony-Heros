<?php

namespace App\Controller;

use App\Entity\ClassSkills;
use App\Repository\ClassSkillsRepository;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassSkillController extends AbstractController
{
    #[Route('/skills', name: 'show_skills')]
    public function showSkills(ClassSkillsRepository $repository): Response
    {
        $classSkill = $repository->findAll();
        return $this->render('class_skill/index.html.twig', [
        'classSkills' => $classSkill,
        ]);
    }

    #[Route('skills/add', name:'add_skills')]
    #[Route('skills/edit/{id}', name:'edit_skills')]
    public function form(ClassSkills $classSkill = null, Request $request, ManagerRegistry $manager)
    {
        if(!$classSkill){
            $classSkill = new ClassSkills();
        }

        $form = $this->createFormBuilder($classSkill)
                    ->add('skillName')
                    ->add('description')
                    ->add('classHeros')
                    ->getForm();
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $manager->getManager();
            $em->persist($classSkill);
            $em->flush();

            return $this->redirectToRoute('show_skills', ['id' => $classSkill->getId()]);
        }
    
    return $this->render('class_skill/create.html.twig', ['formSkill' => $form->createView(),
    'editMode' => $classSkill->getId() !== null
    ]);
    }

    #[Route('/skills/delete/{id}', name:'delete_skills')]
    public function deleteSkills(ClassSkills $skill, ManagerRegistry $manager): RedirectResponse
    {
        $em = $manager->getManager();
        $em->remove($skill);
        $em->flush();

        return $this->redirectToRoute(route: "show_skills");
    }
}
