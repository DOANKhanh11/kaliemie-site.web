<?php

namespace App\Repository;

use App\Entity\Infirmiere;
use App\Entity\PersonneLogin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Infirmiere>
 */
class InfirmiereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Infirmiere::class);
    }

    public function findOneByPersonneLogin(PersonneLogin $personneLogin): ?Infirmiere
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.id = :id')
            ->setParameter('id', $personneLogin->getId())
            ->getQuery()
            ->getOneOrNullResult();
    }
}
