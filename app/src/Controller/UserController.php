<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Form\{UserPasswordType, UserType};
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\{HttpFoundation\Request,
    HttpFoundation\Response,
    PasswordHasher\Hasher\UserPasswordHasherInterface,
    Routing\Annotation\Route};

class UserController extends AbstractController
{
    /**
     * @param User $choosenUser
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserPasswordHasherInterface $hasher
     * @return Response
     */
    #[Security("user === choosenUser")]
    #[Route('/user/{id}/update', name: 'app_update_profil', methods: ['GET', 'POST'])]
    public function updateProfil(
        User $choosenUser,
        Request $request,
        EntityManagerInterface $manager,
        UserPasswordHasherInterface $hasher,
        UserRepository $repository,
        int $id
    ): Response
    {
        $user = $repository->findOneBy(["id" =>$id]);

        $form = $this->createForm(UserType::class, $choosenUser);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            if ($hasher->isPasswordValid($choosenUser, $form->getData()->getPlainPassword())){
                $user = $form->getData();
                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'Vos modifications ont bien été prises enregistrées'
                );
                return $this->redirectToRoute('app_home');
            }else {
                $this->addFlash(
                    'warning',
                    'Le mot de passe est incorrect'
                );
            }
        }

        return $this->render('pages/user_profil.html.twig', [
            'form' => $form->createView(),
            'user' => $user->getExpiredAt()
        ]);
    }






    /**
     * @param User $choosenUser
     * @param Request $request
     * @param UserPasswordHasherInterface $hasher
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Security("user === choosenUser")]
    #[Route('/user/{id}/password', 'app_update_password', methods: ['GET', 'POST'])]
    public function updatePassword(
        User $choosenUser,
        Request $request,
        UserPasswordHasherInterface $hasher,
        EntityManagerInterface $manager,
    ): Response {

        $form = $this->createForm(UserPasswordType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            if($hasher->isPasswordValid($choosenUser, $form->getData()['plainPassword'])){
                $choosenUser->setLastLogin(new \DateTime());
                $choosenUser->setPlainPassword(
                    $form->getData()['newPassword']
                );

                $manager->persist($choosenUser);
                $manager->flush();

                $this->addFlash(
                    'success',
                    'Votre mot de passe a été enregistrées'
                );
                return $this->redirectToRoute('app_home');
            }else {
                $this->addFlash(
                    'warning',
                    'Le mot de passe est incorrect'
                );
            }
        }

        return $this->render('pages/update_password.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
