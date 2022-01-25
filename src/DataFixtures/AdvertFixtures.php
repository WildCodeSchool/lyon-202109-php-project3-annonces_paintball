<?php

namespace App\DataFixtures;

use App\Entity\Advert;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class AdvertFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create();

        $categories = Advert::$CATEGORIES;
        $conditions = Advert::$USECONDITIONS;
        $listOfStatus = Advert::$STATUS;

        for ($i = 0; $i < UserFixtures::NB_OF_USERS; $i++) {
            $user = $this->getReference('user_' . $i);
            $nbAdverts = rand(0, 40);
            for ($j = 0; $j < $nbAdverts; $j++) {
                $advert = new Advert();
                $advert->setTitle($faker->sentence())
                ->setDescription($faker->text())
                ->setPrice($faker->randomFloat(2, 20, 500))
                ->setCreationDate($faker->dateTime())
                ->setUpdateDate($faker->dateTime())
                ->setEndDate($faker->dateTime())
                ->setBrand($faker->word())
                ->setCategory($categories[array_rand($categories)])
                ->setUseCondition($conditions[array_rand($conditions)])
                ->setStatus($listOfStatus[array_rand($listOfStatus)])
                ->setOwner($user)
                ;

                $manager->persist($advert);
                $manager->flush();
            }
        }
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
