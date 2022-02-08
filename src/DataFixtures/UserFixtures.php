<?php

namespace App\DataFixtures;

use App\Entity\Photo;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $userPasswordHasher;
    private const NB_OF_USERS = 10;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create();

        for ($i = 0; $i < self::NB_OF_USERS; $i++) {
            $user = new User();
            $user->setLastname($faker->lastName());
            $user->setFirstname($faker->firstName());
            $user->setEmail($faker->email());
            $user->setBirthdate($faker->dateTime());
            $user->setPseudo($faker->word());
            $user->setPostalCode('69' . sprintf("%03s", rand(0, 999)));
            $user->setIsActive(true);

            $user->setPassword($this->userPasswordHasher->hashPassword($user, 'toto123'));

            $user->setRegistrationDate($faker->dateTimeThisDecade());
            $user->setLastConnectionDate($faker->dateTimeThisDecade());

            $user->setPhoto((new Photo()));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
