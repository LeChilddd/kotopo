<?php

namespace App\Services;

use Endroid\QrCode\Builder\BuilderInterface;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Font\NotoSans;

class QrCodeService
{

    protected $builder;

    public function __construct(BuilderInterface $builder)
    {
        $this->builder = $builder;
    }

    public function qrCodeKotopoContact(){
        $url = 'http://www.kotopo.net/nouscontacter.php?L=fr';

        $result = $this->builder
            ->data($url)
            ->encoding(new Encoding('UTF-8'))
            ->errorCorrectionLevel(new ErrorCorrectionLevelHigh())
            ->size(100)
            ->labelFont(new NotoSans(8))
            ->margin(0)
            ->labelText('Contact Kotopo')
            ->build()
        ;

     /*   // Create generic logo
        $logo = Logo::create(__DIR__.'/assets/img/logo.png')
            ->setResizeToWidth(50);*/

        $result->saveToFile((\dirname(__DIR__, levels: 2).'/assets/qr-code/qrcodeContact.png'));
        return $result->getDataUri();
    }

}