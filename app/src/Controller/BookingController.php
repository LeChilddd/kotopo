<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingSubscriptionType;
use App\Form\BookingType;
use App\Repository\SubscriberRepository;
use App\Services\Booking\BookingEditor;
use App\Repository\BookingRepository;
use App\Services\Booking\BookingRecurrencePersister;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
                "beginDate" => $booking->getBeginDate()->format('Y-m-d H:i'),
                "endDate" => $booking->getEndDate()->format('Y-m-d H:i'),
                "title" => $booking->getTitle(),
            ];
        }
        return $this->render('booking/index.html.twig', [
            'bookings' => json_encode($bookingsList),
        ]);
    }

    #[Route('/new', name: 'app_booking_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BookingRepository $bookingRepository, BookingRecurrencePersister $recurrencePersister): Response
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $bookingDuration = $booking->getBeginDate()->diff($booking->getEndDate());

            $recurrencePersister->persistBookingDates($booking, $bookingDuration);

            return $this->redirectToRoute('app_booking_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('booking/new.html.twig', [
            'booking' => $booking,
            'form' => $form,
        ]);
    }

    #[Route('/show/{booking}', name: 'app_booking_show', methods: ['GET', 'POST'])]
    #[ParamConverter('booking', options: ['mapping' => ['booking' => 'id']])]
    public function show(Request $request, Booking $booking, BookingRepository $repository, SubscriberRepository $subscriberRepository): Response
    {
        $subscriberList = [];
        $subscribers = $subscriberRepository->findBy(['booking' => $booking]);

        $form = $this->createForm(BookingSubscriptionType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($subscribers as $subscriber) {
                $booking->addSubscriber($subscriber);
            }

            $repository->add($booking, true);
            $this->addFlash('success', 'Votre inscription à bien été pris en compte');

            return $this->redirectToRoute('app_booking_show', ['booking' => $booking->getId()], Response::HTTP_SEE_OTHER);
        }

        foreach ($subscribers as $subscriber) {
            $subscriberList[] = [
                "firstname" => $subscriber->getFirstname(),
                "lastname" => $subscriber->getLastname(),
            ];
        }
        return $this->renderForm('booking/show.html.twig', [
            'booking' => $booking,
            'subscribers' => json_encode($subscriberList),
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_booking_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Booking $booking, BookingRepository $bookingRepository): Response
    {
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bookingRepository->add($booking, true);

            return $this->redirectToRoute("app_booking_show", ['booking' => $booking->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('booking/edit.html.twig', [
            'booking' => $booking,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_booking_delete', methods: ['POST'])]
    public function delete(Request $request, Booking $booking, BookingRepository $bookingRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $booking->getId(), $request->request->get('_token'))) {
            $bookingRepository->remove($booking, true);
        }

        return $this->redirectToRoute('app_booking_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/delete/{id}/all', name: 'app_booking_delete_all', methods: ['GET'])]
    public function deleteAll(Request $request, Booking $booking, BookingRepository $bookingRepository): Response
    {

        $bookings = $bookingRepository->findBy(['title' => $booking->getTitle()]);
        foreach ($bookings as $booking) {
            $bookingRepository->remove($booking, true);
        }

        return $this->redirectToRoute('app_booking_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/calendar', name: 'app_booking_calendar', methods: ['GET'])]
    public function calendar(): Response
    {
        return $this->render('booking/calendar.html.twig');
    }


    #[Route('/api/edit/{id}', name: 'api_booking_edit', methods: ['POST'])]
    #[ParamConverter('booking', class: Booking::class)]
    public function bookingEdit(Request $request, Booking $booking, BookingEditor $editor): JsonResponse
    {
        $content = json_decode($request->getContent(), true);
        return new JsonResponse($editor->updateBooking($booking, $content));

    }

}
