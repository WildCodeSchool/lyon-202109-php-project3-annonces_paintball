<?php

namespace App\Repository;

use App\Entity\Advert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Collection;

/**
 * @method Advert|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advert|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advert[]    findAll()
 * @method Advert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Advert::class);
    }

    // /**
    //  * @return Advert[] Returns an array of Advert objects
    //  */
    public function findByUserAndStatus(int $userId, string $status)/**@phpstan-ignore-line */
    {
        $builder = $this->createQueryBuilder('a')
            ->andWhere('a.owner = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('a.id', 'ASC')
        ;

        if ($status != 'Toutes') {
            $builder
                ->andWhere('a.status = :status')
                ->setParameter('status', $status)
            ;
        }

        return $builder
            ->getQuery()
            ->getResult()
        ;
    }

    public function findBySomeField(string $category, string $brand, string $description, string $region): ?array
    {
        $regions = ['Auvergne-Rhône-Alpes' => ['01', '03', '07', '15', '26', '38', '42', '43', '63', '69', '73', '74'],
        'Bourgogne-Franche-Comté' => ['21', '25', '39', '58', '70', '71', '89', '90'],
        'Bretagne' => ['22', '29', '35', '56'],
        'Centre-Val de Loire' => ['18', '28', '36', '37', '41', '45'],
        'Corse' => ['2A', '2B'],
        'Grand Est' => ['08', '10', '51', '52', '54', '55', '57', '67', '68', '88'],
        'Hauts-de-France' => ['02', '59', '60', '62', '80'],
        'Ile-de-France' => ['75', '77','78', '91', '92', '93', '94', '95'],
        'Normandie' => ['14', '27', '50', '61', '76'],
        'Nouvelle-Aquitaine' => ['16', '17', '19', '23', '24', '33', '40', '47', '64', '79', '86', '87'],
        'Occitanie' => ['09', '11', '12', '30', '31', '32', '34', '46', '48', '65', '66', '81', '82'],
        'Pays de la Loire' => ['44', '49', '53', '72', '85'],
        'Provence-Alpes-Côte d’Azur' => ['04', '05', '06', '13', '83', '84'],];

        $query = $this->createQueryBuilder('a');

        if ($category != null) {
            $query->andWhere('a.category = :category')
            ->setParameter('category', $category);
        }
        if ($brand != null) {
            $query->andWhere('a.brand = :brand')
            ->setParameter('brand', $brand);
        }
        if ($description != null) {
            $query->andWhere('a.description = :description')
              ->setParameter('description', $description);
        }
        if ($region != null && array_key_exists($region, $regions)) {
            $query->andWhere('a.owner = :postalCode')
            ->setParameter('postalCode', $region);
        }
        $query->orderBy('a.id', 'ASC');
        return (array)$query->getQuery()->getResult();
    }
}
