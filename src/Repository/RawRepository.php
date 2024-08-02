<?php

namespace App\Repository;

use App\Entity\Raw;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Raw>
 *
 * @method Raw|null find($id, $lockMode = null, $lockVersion = null)
 * @method Raw|null findOneBy(array $criteria, array $orderBy = null)
 * @method Raw[]    findAll()
 * @method Raw[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RawRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Raw::class);
    }

    public function QuerryRawList()
    {
        return $this->createQueryBuilder('ra')
        ->select('ra')
        ->orderBy('ra.nommp', 'ASC')
        ->getQuery()
        ->getResult();
    
    }

    public function save(Raw $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Raw $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getRawById($id){
        $userQuery = $this->getEntityManager();
        $query = $userQuery->createQuery(
            'SELECT r FROM App\Entity\Raw r
            WHERE r.id = :id')
            ->setParameter('id', $id);

        return $query->getOneOrNullResult();
    }

//    /**
//     * @return Raw[] Returns an array of Raw objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Raw
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
