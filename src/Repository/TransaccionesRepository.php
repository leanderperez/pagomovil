<?php

namespace App\Repository;

use App\Entity\Transacciones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Transacciones>
 *
 * @method Transacciones|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transacciones|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transacciones[]    findAll()
 * @method Transacciones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransaccionesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transacciones::class);
    }

    //    /**
    //     * @return Transacciones[] Returns an array of Transacciones objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('t.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Transacciones
    //    {
    //        return $this->createQueryBuilder('t')
    //            ->andWhere('t.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
