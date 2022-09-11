<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        # User Admin
        $admin = new User();
        $admin->setFirstname('Admin')
            ->setLastname('ADMIN')
            ->setCardNumber(mt_rand(00000000, 99999999))
            ->setGender('M')
            ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
            ->setEmail('admin@admin.com')
            ->setPlainPassword('pass')
        ;
        $manager->persist($admin);

        for ($i = 0; $i < 5; $i++){
            $user = new User();
            $user->setFirstname('User ' . $i+1)
                ->setLastname('USERNAME ' . $i+1)
                ->setCardNumber(mt_rand(00000000, 99999999))
                ->setGender('M')
                ->setRoles(['ROLE_USER'])
                ->setEmail('user'. $i+1 .'@user.com')
                ->setPlainPassword('pass')
            ;
            $manager->persist($user);
        }

        // Contact
           for ($i = 0; $i < 5; $i++) {
           $contact = new Contact();
             $contact
                 ->setLastname('User ' . $i+1)
                 ->setFirstname('USERNAME ' . $i+1)
                 ->setEmail('user'. $i+1 .'@user.com')
                 ->setSubject('Demande n°' . ($i+1))
                 ->setMessage("
What is Lorem Ipsum?
Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
               ");
             $manager->persist($contact);
         }

        $manager->flush();
    }
}