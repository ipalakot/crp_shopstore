<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    { 
        $this->encoder =$encoder;
    }
    
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        $user = new User();
        $user->setUsername('ipalakot');
        $user->setPassword($this->encoder->EncodePassword($user, 'ipalakot'));
                
        $manager-> persist($user);

        $manager->flush();
    }
}
