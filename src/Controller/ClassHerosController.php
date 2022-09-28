<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassHerosController extends AbstractController
{
    #[Route('/type', name: 'type_list')]
    public function index(): Response
    {
        return $this->render('class_heros/index.html.twig', [
            'controller_name' => 'ClassHerosController',
        ]);
    }
}
