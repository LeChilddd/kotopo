<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use App\Service\Booking\BookingDto;
use App\Services\Booking\BookingEditor;
use App\Repository\BookingRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/booking')]
class BookingController extends AbstractController
{
    #[Route('/', name: 'app_booking_index', methods: ['GET'])]
    public function index(BookingRepository $bookingRepository): Response
    {
        $bookingsList = [];
        $bookings = $bookingRepository->findAll();

        foreach ($bookings as $booking) {
            $bookingsList[] = [
                "idBooking" => $booking->getId(),
                "beginAt" => $booking->getBeginAt()->format('Y-m-d H:i'),
                "endAt" => $booking->getEndAt()->format('Y-m-d H:i'),
                "title" => $booking->getTitle(),

            ];
        }
        return $this->render('booking/index.html.twig', [
            'bookings' => json_encode($bookingsList),
        ]);
    }

    #[Route('/new', name: 'app_booking_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BookingRepository $bookingRepository): Response
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bookingRepository->add($booking, true);

            return $this->redirectToRoute('app_booking_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('booking/new.html.twig', [
            'booking' => $booking,
            'form' => $form,
        ]);
    }

    #[Route('/show/{id}', name: 'app_booking_show', methods: ['GET'])]
    public function show(Booking $booking): Response
    {
        return $this->render('booking/show.html.twig', [
            'booking' => $booking,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_booking_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Booking $booking, BookingRepository $bookingRepository): Response
    {
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bookingRepository->add($booking, true);

            return $this->redirectToRoute('app_booking_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('booking/edit.html.twig', [
            'booking' => $booking,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_booking_delete', methods: ['POST'])]
    public function delete(Request $request, Booking $booking, BookingRepository $bookingRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$booking->getId(), $request->request->get('_token'))) {
            $bookingRepository->remove($booking, true);
        }

        return $this->redirectToRoute('app_booking_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/calendar', name: 'app_booking_calendar', methods: ['GET'])]
    public function calendar(): Response
    {
        return $this->render('booking/calendar.html.twig');
    }


    #[Route('/api/edit/{id}', name: 'api_booking_edit', methods: ['POST', 'GET'])]
    #[ParamConverter('booking', class: Booking::class)]
    public function bookingEdit(Request $request, Booking $booking ,BookingEditor $editor): JsonResponse
    {
     $content = json_decode($request->getContent(), true);
     return new JsonResponse($editor->updateUserProfile($booking, $content));

    }

}
