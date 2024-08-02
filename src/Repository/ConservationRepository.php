<?php

namespace App\Repository;

use App\Entity\Conservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Conservation>
 *
 * @method Conservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Conservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Conservation[]    findAll()
 * @method Conservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ConservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conservation::class);
    }

    public function save(Conservation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Conservation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getConservationByHrAndHre($hrep , $hre)
    {
        $hrep = round($hrep);
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery("SELECT c FROM App\Entity\Conservation c WHERE c.hr = :hr AND c.hre = :hre")
        ->setParameter('hr',$hre)
        ->setParameter('hre' ,$hrep);

        $result = $query->getResult();
        return $result[0]->getNbjour();
    }

//    /**
//     * @return Conservation[] Returns an array of Conservation objects
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

//    public function findOneBySomeField($value): ?Conservation
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
