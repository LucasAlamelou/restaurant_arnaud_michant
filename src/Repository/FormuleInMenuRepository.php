<?php

namespace App\Repository;

use App\Entity\FormuleInMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FormuleInMenu>
 *
 * @method FormuleInMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormuleInMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormuleInMenu[]    findAll()
 * @method FormuleInMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormuleInMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormuleInMenu::class);
    }

    public function save(FormuleInMenu $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FormuleInMenu $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return FormuleInMenu[] Returns an array of FormuleInMenu objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FormuleInMenu
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
