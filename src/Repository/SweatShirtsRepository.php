<?php

namespace App\Repository;

use App\Entity\SweatShirts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SweatShirts>
 */
class SweatShirtsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SweatShirts::class);
    }

    //    /**
    //     * @return SweatShirts[] Returns an array of SweatShirts objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?SweatShirts
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }


    public function findByPriceRanges(?string $priceRange)
    {
        $qb = $this->createQueryBuilder('s');

        if ($priceRange && strpos($priceRange, '-') !== false) {
            [$minPrice, $maxPrice] = explode('-', $priceRange);

            $qb->andWhere('s.price >= :minPrice')
                ->andWhere('s.price <= :maxPrice')
                ->setParameter('minPrice', $minPrice)
                ->setParameter('maxPrice', $maxPrice);
        } else {
            // Gérer le cas où il n'y a pas de plage de prix valide sélectionnée
            // (Par exemple, retourner tous les produits ou une autre logique)
            $qb->andWhere('1=1'); // Retourner tous les produits
        }

        return $qb->getQuery()->getResult();
    }
}
