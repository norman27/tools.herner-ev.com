<?php

namespace App\Youngsters;

use App\Entity\Sponsor\YoungstersMicroSponsor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MicroSponsorsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, YoungstersMicroSponsor::class);
    }

    public function findAllIndexed()
    {
        $qb = $this->createQueryBuilder('YoungstersMicroSponsors');
        $query = $qb->indexBy('YoungstersMicroSponsors', 'YoungstersMicroSponsors.id')->getQuery();
        return $query->getResult();
    }
}