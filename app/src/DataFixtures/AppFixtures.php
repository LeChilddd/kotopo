<?php

namespace App\DataFixtures;

use App\Entity\Language;
use App\Entity\Session;
use App\Entity\User;
//use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        # Users
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

        $teacher = new User();
        $teacher->setFirstname('Teacher')
            ->setLastname('T')
            ->setCardNumber(mt_rand(00000000, 99999999))
            ->setGender('M')
            ->setRoles(['ROLE_USER'])
            ->setEmail('teach@teach.com')
            ->setPlainPassword('pass')
        ;
        $manager->persist($teacher);

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

        # Languages
            $language = new Language();
            $language->setName('Anglais');

            $manager->persist($language);


        /*$dateTime = \DateTime::createFromFormat()
        # Session
        $session = new Session();
        $session->setDate( 	2022-09-11);
*/


            // Contact
        /*   for ($i = 0; $i < 5; $i++) {
           $contact = new Contact();
             $contact
                 ->setLastname($this->faker->lastname())
                 ->setFirstname($this->faker->firstname())
                 ->setEmail($this->faker->email())
                 ->setSubject('Demande n°' . ($i+1))
                 ->setMessage($this->faker->text());
             $manager->persist($contact);
         }*/

        $manager->flush();
    }
}