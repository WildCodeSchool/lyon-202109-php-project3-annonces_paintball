<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('falou40@gmail.com');
        $user->setPassword('marche1');
        $user->setStatut('Particulier');
        $user->setPseudo('paintball');
        $user->setFirstname('Gilles');
        $user->setLastname('Scarpari');
        $user->setMobile('0659348769');
        $user->setAddress('LYON');
        $user->setSex('Male');
        $user->setDateofbirth('14152021');
        $manager->persist($user);
        $manager->flush();
    }
}
