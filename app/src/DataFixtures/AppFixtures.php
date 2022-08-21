<?php

namespace App\DataFixtures;

use App\Entity\User;
//use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher){
        $this->hasher = $hasher;
    }

    public function load(
        ObjectManager $manager): void
    {

        # User
        for ($i = 0; $i < 5; $i++){
            $user = new User();
            $hashPassword = $this->hasher->hashPassword(
                $user,
                'pass'
            );

            $user->setFirstname('User ' . $i+1)
                ->setLastname('USERNAME ' . $i+1)
                ->setCardNumber(mt_rand(00000000, 99999999))
                ->setGender('M')
                ->setRoles(['ROLE_USER'])
                ->setEmail('user'. $i+1 .'@user.com')
                ->setPassword($hashPassword)
            ;

            $manager->persist($user);
        }

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
