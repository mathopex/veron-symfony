<?php

namespace App\Repository;

use App\Entity\Eshre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Eshre>
 *
 * @method Eshre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Eshre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Eshre[]    findAll()
 * @method Eshre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EshreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Eshre::class);
    }

    public function save(Eshre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Eshre $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getEshre($es)
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery('SELECT e.hre FROM App\Entity\Eshre e WHERE e.es = :es')
                ->setParameter('es',$es);

        $result = $query->getResult();
        return  $result[0]['hre'];
    }

//    /**
//     * @return Eshre[] Returns an array of Eshre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Eshre
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
