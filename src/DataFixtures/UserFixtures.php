<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('lla@gmail.com');
        $user->setNom('jean');
        $user->setPassword('kev12345');
        $manager->persist($user);

        $manager->flush();
    }
}
