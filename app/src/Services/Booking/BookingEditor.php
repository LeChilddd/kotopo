<?php

namespace App\Services\Booking;

use App\Entity\Booking;
use App\Exception\BadDataException;
use App\Helper\ApiMessages;
use App\Repository\BookingRepository;
use App\Service\Booking\BookingDto;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

class BookingEditor
{
    public function __construct(
        private readonly EntityManagerInterface     $em,
        private readonly LoggerInterface            $logger,
    )
    {
    }
    public function updateUserProfile(Booking $booking, $content): array
    {

        try {
            $booking->setBeginAt(new \DateTime($content['beginAt']))
                    ->setEndAt(new \DateTime($content['endAt']));
            $this->em->persist($booking);
            $this->em->flush();

            $result = ApiMessages::makeContent(
                ApiMessages::STATUS_SUCCESS,
                BookingDto::UPDATE_SUCCESS,
            );
        } catch (BadDataException $exception) {
            $result = ApiMessages::makeContent(
                ApiMessages::STATUS_WARNING,
                $exception->getMessage(),
            );
        } catch (\Throwable $exception) {
            $id = $booking->getId();
            $this->logger->error("An error occurred during user $id profile update");
            $this->logger->debug($exception->getTraceAsString());
            $result = ApiMessages::makeDefaultErrorContent();
        }

        return $result;
    }
}