<?php

namespace App\Controller;

use App\Services\PdfService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DrinkMenuController extends AbstractController
{
    #[Route(path: '/drink-menu-pdf', name: 'drink_menu.pdf')]
    public function pdf(PdfService $pdf): void
    {
        $html = $this->render('drink_menu/drink_menu.html.twig');
        $pdf->showPdfFile($html);
    }
}
