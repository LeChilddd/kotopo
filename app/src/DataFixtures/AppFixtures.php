<?php

namespace App\DataFixtures;

use App\Entity\Language;
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

        $languages = [
            'Allemand A1',
            'Allemand A2',
            'Anglais B1',
            'Anglais B2',
            'Arabe moderne A1',
            'Arabe moderne A2',
            'Berbère kabyle A1',
            'Chinois A1',
            'Coréen A1',
            'Coréen A1/B2',
            'Croate A1',
            'Croate A2/B1',
            'Espagnol A1',
            'Espagnol A2/B1',
            'Espagnol B2/C1',
            'Espéranto A1',
            'Grec A1',
            'Japonais A1.1',
            'Japonais A1.2',
            'LSF A1.1+2',
            'LSF A1.3+4',
            'LSF A2.1+2',
            'Néerlandais A1',
            'Néerlandais A2/B1',
            'Portugais du Brésil A1',
            'Portugais du Portugal A1',
            'Russe A1',
            'Russe A2',
            'Tchèque A1.2/A2',
            'Tchèque B1'
        ];

        for ($i = 0; $i < count($languages); $i++){
            $language = new Language();
            $language->setName($languages[$i]);
            $manager->persist($language);
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