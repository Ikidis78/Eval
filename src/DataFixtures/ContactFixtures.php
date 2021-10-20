<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Contact;
use App\Entity\Categorie;
use Doctrine\Persistence\ObjectManager;
use SebastianBergmann\FileIterator\Facade;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        $categorie1 = new Categorie();
        $categorie1->setDesignation("amis");
        $manager->persist($categorie1);
        
        $categorie2 = new Categorie();
        $categorie2->setDesignation("connaissance");
        $manager->persist($categorie2);

        $categorie3 = new Categorie();
        $categorie3->setDesignation("professionnel");
        $manager->persist($categorie3);

        $cats = [$categorie1,$categorie2,$categorie3];

        $faker=Factory::create("fr_FR");

        for($i = 0; $i <=20; $i++){

            $contact = new Contact();

            $Image = $faker->imageUrl(80, 80);
            $adresse = $faker->address;
            $prenom = $faker->name;
            $nom = $faker->lastName;
            $ville = $faker->city;
            $tele = $faker->phoneNumber;
            $email = $faker->email;
            $postale = $faker->countryCode;

            $contact->setNom($nom) 
                    ->setPrenom($prenom)
                    ->setAdresse($adresse)
                    ->setCodePostal($postale)
                    ->setVille($ville)
                    ->setNumTel($tele)
                    ->setAdresseMail($email)
                    ->setAvatar($Image)
                    ->setCategorie($cats[mt_rand(0,2)]);

            $manager->persist($contact);
        }



        $manager->flush();
    }
}
