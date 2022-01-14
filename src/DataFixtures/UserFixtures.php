<?php

namespace App\DataFixtures;

use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('falou40@gmail.com');
        $user->setRoles(['USER']);
        $user->setPassword('marche1');
        $user->setLastname('Scarpari');
        $user->setFirstname('Gilles');
        $user->setBirthdate(new DateTime('1996-03-15'));
        $user->setPseudo('paintball');
        $user->setPostalCode('69150');
        $user->setMobilePhone('0659348769');
        $user->setIsActive(true);
        $user->setRegistrationDate(new DateTime('1996-03-15'));
        $user->setLastConnectionDate(new DateTime('1996-03-15'));
        $manager->persist($user);
        $manager->flush();
    }
}
