<?php

namespace App\DataFixtures;

use App\Entity\Utilisateurs;
//use App\Entity\Article;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UtilisateursFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        $faker = \Faker\Factory::create('fr_FR');

        // Creer 3 Categories de Fake

        for ($i=0; $i <=10 ; $i++) 
        {
            $utilisateurs = new Utilisateurs();
            $utilisateurs->setNoms($faker->firstNameMale())
                        ->setPrenoms($faker->lastName ())
                        ->setDatenaiss($faker->lastName ())
                        ->setEmail($faker->lastName ());
                    
                       $manager-> persist($utilisateurs);
        }
        
        $manager->flush();
    }
}
