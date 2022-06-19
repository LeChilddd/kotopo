<?php

namespace App\Repository;

use App\Entity\UserLanguageLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<UserLanguageLevel>
 *
 * @method UserLanguageLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserLanguageLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserLanguageLevel[]    findAll()
 * @method UserLanguageLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserLanguageLevelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserLanguageLevel::class);
    }

    public function add(UserLanguageLevel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(UserLanguageLevel $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return UserLanguageLevel[] Returns an array of UserLanguageLevel objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?UserLanguageLevel
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
