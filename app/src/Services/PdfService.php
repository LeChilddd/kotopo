<?php

namespace App\Services;

use Dompdf\Dompdf;
//use Dompdf\Options;

class PdfService
{
    private Dompdf $domPdf;

    public function __construct(){
        $this->domPdf = new DomPdf();

//        $pdfOptions = new Options();
//
//        $pdfOptions->set('defaultFont', 'Courier');
////        $pdfOptions->set('isRemoteEnabled', true);
//
//        $this->domPdf->setOptions($pdfOptions);
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