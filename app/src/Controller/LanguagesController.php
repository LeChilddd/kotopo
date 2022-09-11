<?php

namespace App\Controller;

use App\Repository\LanguageRepository;
use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LanguagesController extends AbstractController
{
    #[Route('/languages', name: 'app_languages')]
    public function index(SessionRepository $repository): Response
    {
        $session = $repository->findAll();
        dd($session);

        return $this->render('pages/activities/languages.html.twig', [
            'controller_name' => 'LanguagesController',
        ]);
    }
}
