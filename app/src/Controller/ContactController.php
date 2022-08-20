<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(
        Request $request,
        EntityManagerInterface $manager,
        MailerInterface $mailer

    ): Response
    {
        $contact = new Contact();

        if($this->getUser()) {
            $contact->setFirstname($this->getUser()->getFirstname())
                 ->setLastname($this->getUser()->getLastname())
                 ->setEmail($this->getUser()->getEmail());
        }

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {

            $contact = $form->getData();

            $manager->persist($contact);
            $manager->flush();


            $email = (new Email())
                ->from($contact->getEmail())
                ->to('admin@kotopo.com')
                ->subject($contact->getSubject())
                ->html($contact->getMessage());

            $mailer->send($email);


            $this->addFlash(
                'success',
                'Votre message à bien été envoyé',
            );
            return $this->redirectToRoute('app_contact');
        }

        return $this->render('pages/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
