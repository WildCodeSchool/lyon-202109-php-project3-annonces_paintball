<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixture extends Fixture
{
    public const CATEGORIES = [
        'Accessoires pour lanceurs',
        'Air comprimé et CO2',
        'Bagages et housses',
        'Canons',
        'Covoiturage',
        'Divers',
        'Kits et packages',
        'Lanceurs de scénario',
        'Lanceur de compétition',
        'Lanceurs de loisir',
        'Loaders et accessoires',
        'Masques et écrans',
        'Recrutements',
        'Tournois',
        'Terrains et accessoires',
        'Vetements de jeu',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES as $key => $categorieName) {
            $categorie = new Categorie();
            $categorie->setName($categorieName);
            $manager->persist($categorie);
            $this->addReference('category_' . $key, $categorie);
        }
        $manager->flush();
    }
}
