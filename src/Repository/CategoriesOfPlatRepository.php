<?php

namespace App\Repository;

use App\Entity\CategoriesOfPlat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CategoriesOfPlat>
 *
 * @method CategoriesOfPlat|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoriesOfPlat|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoriesOfPlat[]    findAll()
 * @method CategoriesOfPlat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesOfPlatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoriesOfPlat::class);
    }

    public function save(CategoriesOfPlat $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CategoriesOfPlat $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CategoriesOfPlat[] Returns an array of CategoriesOfPlat objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CategoriesOfPlat
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
