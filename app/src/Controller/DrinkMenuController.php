<?php

namespace App\Controller;

use App\Services\PdfService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DrinkMenuController extends AbstractController
{
    // FOR DEVELOPPER : this Route is for see the modifications for pdf render
    // to uncomment for work

//    #[Route('/drink-menu', name: 'app_drink_menu')]
//    public function index(): Response
//    {
//        return $this->render('drink_menu/drink_menu.html.twig', [
//        ]);
//    }

    #[Route(path: '/drink-menu-pdf', name: 'drink_menu.pdf')]
    public function test(PdfService $pdf): void {
        $html = $this->render('drink_menu/drink_menu.html.twig');
        $pdf->showPdfFile($html);
    }
}
