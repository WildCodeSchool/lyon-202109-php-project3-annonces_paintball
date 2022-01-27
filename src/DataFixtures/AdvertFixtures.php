<?php

namespace App\DataFixtures;

use App\Entity\Advert;
use App\Entity\Photo;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

/**
 * @codingStandardsIgnoreStart
 */
class AdvertFixtures extends Fixture implements DependentFixtureInterface
{
    private array $photos = [
        'https://www.funpaintball.com/photos/funpaintball.com/grand/749.jpg',
        'https://media.paruvendu.fr/image/lanceur-paintball/WB16/3/4/WB163473700_1.jpeg',
        'https://www.paintball-atlantic.com/46995-large_default/location-paintball-bordeaux.jpg',
        'https://paintball-comparateur.fr/images/produits/Dye-M3S-Deep-Waters_l.png',
        'https://paintball-comparateur.fr/images/produits/bt-delta_l.png',
        'https://www.paintball-select-shop.com/140-thickbox_default/lanceur-tippmann-tpx-noir.jpg',
        'https://media.paruvendu.fr/image/lanceur-paintball-long/WB16/1/5/WB161598042_1.jpeg',
        'https://www.paintball-atlantic.com/4827-large_default/lanceur-paintball-tippmann-cronus-tactical.jpg',
        'https://www.paintballsports.fr/media/catalog/product/cache/7/image/9df78eab33525d08d6e5fb8d27136e95/D/y/Dye_M3__Paintball_Markierer_Pin_Up_DE_16107_750x750.jpg',
        'http://www.paintball-camp.com/wp-content/uploads/2010/11/Regal2.jpg',
        'https://www.neozone.org/blog/wp-content/uploads/schema-and-structured-data-for-wp/lanceur-de-paintball-frelon-asiatique-1200x900.jpg',
        'https://media.paruvendu.fr/image/lanceur-paintball/WB16/3/4/WB163473700_1.jpeg',
        'https://img.fr.clasf.com/2021/06/21/lanceur-paintball-marauder-20210621064713.6503320015.jpg',
        'https://m.media-amazon.com/images/I/61IY39J78CL._AC_SX425_.jpg',
        'https://www.paintballsports.fr/media/catalog/product/cache/7/image/9df78eab33525d08d6e5fb8d27136e95/W/A/WARQ_Paintball_Tactical_Helm_FALLOUT_Special_Edition_14814_750x750.jpg',
        'https://www.bubble-diving.com/media/catalog/product/cache/12/image/9df78eab33525d08d6e5fb8d27136e95/c/a/casque_warq_paintball_tan.jpg',
        'https://www.paintballsports.fr/media/catalog/product/cache/7/image/9df78eab33525d08d6e5fb8d27136e95/W/A/WARQ_Paintball_Tactical_Helm_Deutscher_Flecktarn_Special_Edition_14818_750x750.jpg',
        'https://www.funpaintball.com/photos/funpaintball.com/grand/6172.jpg',
        'https://fr.shopping.rakuten.com/photo/923985039_L.jpg',
        'https://images1.vinted.net/t/01_02258_b9khH3R1aiANeSvMUXKAwCNm/f800/1600523683.jpeg?s=dfdc34d8e877e251e7f3417443e9bc2f2e6f09c1',
        'https://one.nbstatic.fr/uploaded/20211201/8613772/thumbs/450h300f_00001_Masque-Paintball-Double-Ecran--One-.jpg',
        'https://img.joomcdn.net/8791ae3aa18a97d6775a5e8369c9f93b23f46fe2_original.jpeg',
        'https://www.paintballgames62.com/21894-large_default/masque-empire-evs-tiger-stripe.jpg',
        'https://m.media-amazon.com/images/I/614Df03gltL._AC_SX425_.jpg',
        'https://img.joomcdn.net/1f7ecdc0390db50d060d1538178fe9d82ad33ee0_original.jpeg',
        'https://www.paintballsports.fr/media/catalog/product/cache/7/thumbnail/9df78eab33525d08d6e5fb8d27136e95/P/a/Paintball_Airsoft_Tactical_Weste_Milticam_Tarn_10793_550x550.jpg',
        'https://www.cdiscount.com/pdt2/0/9/1/1/700x700/auc6259207061091/rw/tactique-gilet-militaire-veste-molle-combat-paintb.jpg',
        'https://image.made-in-china.com/2f0j10jJltnqozkigd/-Gilet-tactique-Molle-Airsoft-Paintball-Soft-Veste-.jpg',
        'https://www.cdiscount.com/pdt2/6/9/2/1/700x700/auc6913280734692/rw/gilet-veste-en-nylon-camouflage-molle-tactique.jpg',
        'https://homyshirt.com/30067-large_default/veste-tactique-airsolf-paintball-arm%C3%A9e-police-swat.jpg',
        'https://fr.shopping.rakuten.com/photo/871131037_L.jpg',
        'https://sc04.alicdn.com/kf/U06a1552baf494c029c6a9497bf72f273O.jpg',
        'https://one.nbstatic.fr/uploaded/20210501/7936952/thumbs/450h300f_00001_Pantalon-Dye-LT-rouge.jpg',
    ];

    /**
     * @codingStandardsIgnoreEnd
     */
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

                $advert->addPhoto((new Photo())->setUrl($this->photos[array_rand($this->photos)]));

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
