<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LanguagesController extends AbstractController
{
    #[Route('/languages', name: 'app_languages')]
    public function index(): Response
    {
        return $this->render('pages/activities/languages.html.twig', [
            'controller_name' => 'LanguagesController',
        ]);
    }
}
