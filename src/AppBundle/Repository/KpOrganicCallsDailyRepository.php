<?php

namespace AppBundle\Repository;

/**
 * KpOrganicCallsDailyRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class KpOrganicCallsDailyRepository extends \Doctrine\ORM\EntityRepository
{
    public function getStateDaily($state, $type, $year, $month)
    {
        $qb = $this->createQueryBuilder('r');
        $query = $qb->select(
            "r.dayNum as day, SUM(r.organicCalls) as total_count, r.month as month"
        )
            ->where("r.month = :month")
            ->andWhere("r.year = :year")
            ->andWhere('r.state = :state')
            ->groupBy('r.dayNum')
            ->orderBy('r.dayNum')
            ->setParameter('month', $month)
            ->setParameter('year', $year)
            ->setParameter('state', $state)
        ;
        $restresult = $query->getQuery()->getResult();
        return $restresult;
    }

    public function getDataDate(){
        $qb = $this->createQueryBuilder('r');
        $query = $qb->select("r.dataDate")
            ->orderBy('r.dataDate', 'DESC')
            ->setMaxResults(1);
        $result = $query->getQuery()->getResult();

        return $result;
    }
}
