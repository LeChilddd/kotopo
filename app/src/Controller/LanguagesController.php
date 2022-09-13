<?php

namespace App\Controller;

use App\Repository\LanguageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LanguagesController extends AbstractController
{
    #[Route('/languages', name: 'app_languages')]
    public function index(LanguageRepository $repository): Response
    {

        return $this->render('pages/activities/languages.html.twig', [
            'languages' => $repository->findAll(),
        ]);
    }
}
