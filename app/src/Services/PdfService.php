<?php

namespace App\Services;

use Dompdf\Dompdf;
use Dompdf\Options;

class PdfService
{
    private Dompdf $domPdf;

    public function __construct(){

        $options = new Options();
        $options-> set('defaultFont', 'Open Sans');

        $this->domPdf = new DomPdf($options);
        $this->domPdf->setPaper('A4', 'portrait');
    }

    public function  showPdfFile($html): void
    {
         $this->domPdf->loadHtml($html);
         $this->domPdf->render();
         $this->domPdf->stream("Carte-Boisson-Kotopo.pdf", [
             'Attachement' => false
         ]);
    }
}