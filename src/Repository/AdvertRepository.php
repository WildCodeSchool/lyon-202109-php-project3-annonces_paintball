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


    // /**
    //  * @return Advert[] Returns an array of Advert objects
    //  */
    public function findLastAdverts()/**@phpstan-ignore-line */
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.creationDate', 'DESC')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findBySomeField(
        string $category,
        string $brand,
        string $description,
        string $region,
        string $useCondition
        ): ?array
    {
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
        if ($region != null) {
            $query->andWhere("a.region = :region")
            ->setParameter('region', $region);
        }
        if ($useCondition != null) {
            $query->andWhere('a.useCondition = :useCondition')
            ->setParameter('useCondition', $useCondition);
        }
        $query->orderBy('a.id', 'ASC');
        return (array)$query->getQuery()->getResult();
    }
}
