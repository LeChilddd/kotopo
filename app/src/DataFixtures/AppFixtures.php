<?php

namespace App\DataFixtures;

//use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

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
