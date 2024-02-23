<?php

namespace App\Repository;

use App\Entity\Directorio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Directorio>
 *
 * @method Directorio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Directorio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Directorio[]    findAll()
 * @method Directorio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DirectorioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Directorio::class);
    }

    //    /**
    //     * @return Directorio[] Returns an array of Directorio objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Directorio
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
