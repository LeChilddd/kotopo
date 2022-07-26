<?php

namespace App\Controller;

use App\Services\PdfService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DrinkMenuController extends AbstractController
{
    #[Route('/drink-menu', name: 'app_drink_menu')]
    public function index(): Response
    {
        return $this->render('drink_menu/drink_menu.html.twig', [
            'controller_name' => 'DrinkMenuController',
        ]);
    }

    #[Route(path: '/drink-menu-pdf', name: 'drink_menu.pdf')]
    public function test(PdfService $pdf): void {
        $html = 'test';
        $pdf->showPdfFile($html);
    }
}
