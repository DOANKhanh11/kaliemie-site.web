<?php
namespace App\Repository;

use App\Entity\Patient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Indisponibilite>
 */
class PatientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patient::class);
    }

    public function findByPersonneLogin(string $personneLogin)
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.personneLogin', 'pl')
            ->where('pl.login = :login') 
            ->setParameter('login', $personneLogin)
            ->getQuery()
            ->getOneOrNullResult(); 
    }
}