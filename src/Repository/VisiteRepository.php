<?php

namespace App\Repository;

use App\Entity\Visite;
use App\Entity\Infirmiere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Visite>
 */
class VisiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visite::class);
    }

    public function findByInfirmiere($infirmiereId)
{
    return $this->createQueryBuilder('v')
        ->andWhere('v.infirmiere = :id')
        ->setParameter('id', $infirmiereId)
        ->orderBy('v.date_prevue', 'ASC')
        ->getQuery()
        ->getResult();
}


public function findVisitesWithPatientInfo(Infirmiere $infirmiere): array
{
    $queryResult = $this->createQueryBuilder('v')
        ->leftJoin('v.patient', 'p') 
        ->addSelect('p') 
        ->andWhere('v.infirmiere = :infirmiere')
        ->setParameter('infirmiere', $infirmiere)
        ->orderBy('v.datePrevue', 'ASC')
        ->getQuery()
        ->getResult();

        return $queryResult;
}
 public function findVisitesWithDetails(Infirmiere $infirmiere): array
 {
    return $this->createQueryBuilder('v')
        ->leftJoin('v.patient', 'p')->addSelect('p')
        ->leftJoin('v.soinsVisite', 'sv')->addSelect('sv')
        ->leftJoin('sv.soins', 's')->addSelect('s')
        ->andWhere('v.infirmiere = :infirmiere')
        ->setParameter('infirmiere', $infirmiere)
        ->orderBy('v.datePrevue', 'ASC')
        ->getQuery()
        ->getResult();

        foreach ($visites as $visite) {
            $visite->getSoinsVisite()->initialize();  // Initialize the relation
        }
    
        return $visites;
 }

    // Custom query example (tuỳ ý):
    // public function findByInfirmiereId(int $infirmiereId): array
    // {
    //     return $this->createQueryBuilder('v')
    //         ->andWhere('v.infirmiere = :id')
    //         ->setParameter('id', $infirmiereId)
    //         ->orderBy('v.datePrevue', 'ASC')
    //         ->getQuery()
    //         ->getResult();
    // }
}
