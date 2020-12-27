<?php declare(strict_types=1);

namespace App\Youngsters;

use App\Entity\Sponsor\YoungstersMicroSponsor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\Query\QueryException;

class MicroSponsorsRepository extends ServiceEntityRepository
{
    /**
     * @param Registry $registry
     */
    public function __construct(Registry $registry)
    {
        parent::__construct($registry, YoungstersMicroSponsor::class);
    }

    /**
     * @return YoungstersMicroSponsor[]
     * @throws QueryException
     */
    public function findAllIndexed(): array
    {
        $qb = $this->createQueryBuilder('YoungstersMicroSponsors');
        $query = $qb->indexBy('YoungstersMicroSponsors', 'YoungstersMicroSponsors.id')->getQuery();
        return $query->getResult();
    }
}