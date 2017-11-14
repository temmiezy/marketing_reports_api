<?php

namespace AppBundle\Repository;

/**
 * AllLocalCallsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AllLocalCallsRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAllLocalCalls($year, $month)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT DAY(STR_TO_DATE(call_date, '%m/%d/%Y')) as day, MONTH(STR_TO_DATE(call_date, '%m/%d/%Y')) as month,
         (SELECT SUM(unique_calls) from all_local_calls WHERE MONTH(STR_TO_DATE(call_date, '%m/%d/%Y'))=:month AND YEAR(STR_TO_DATE(call_date, '%m/%d/%Y'))=:year AND day(STR_TO_DATE(call_date, '%m/%d/%Y'))=day) as unique_calls_for_day,
         (SELECT SUM(total_local_calls) from all_local_calls WHERE MONTH(STR_TO_DATE(call_date, '%m/%d/%Y'))=:month AND YEAR(STR_TO_DATE(call_date, '%m/%d/%Y'))=:year AND day(STR_TO_DATE(call_date, '%m/%d/%Y'))=day) as call_count_for_day
         FROM all_local_calls WHERE MONTH(STR_TO_DATE(call_date, '%m/%d/%Y'))=:month AND YEAR(STR_TO_DATE(call_date, '%m/%d/%Y'))=:year GROUP BY day";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue('month', $month);
        $stmt->bindValue('year' , $year);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllLocalCallsTable($year, $month)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT l.state,
         (SELECT SUM(unique_calls) from all_local_calls lr WHERE MONTH(STR_TO_DATE(call_date, '%m/%d/%Y'))=:month AND YEAR(STR_TO_DATE(call_date, '%m/%d/%Y'))=:year AND l.state= lr.state) as unique_calls_for_day,
         (SELECT SUM(total_local_calls) from all_local_calls ls WHERE MONTH(STR_TO_DATE(call_date, '%m/%d/%Y'))=:month AND YEAR(STR_TO_DATE(call_date, '%m/%d/%Y'))=:year AND l.state=ls.state) as call_count_for_day
         FROM all_local_calls l WHERE MONTH(STR_TO_DATE(call_date, '%m/%d/%Y'))=:month AND YEAR(STR_TO_DATE(call_date, '%m/%d/%Y'))=:year GROUP BY state";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue('month', $month);
        $stmt->bindValue('year' , $year);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getAllLocalCallsTableState($state, $year, $month)
    {
        $conn = $this->getEntityManager()->getConnection();
        $sql = "SELECT l.state,
         (SELECT SUM(unique_calls) from all_local_calls lr WHERE MONTH(STR_TO_DATE(call_date, '%m/%d/%Y'))=:month AND YEAR(STR_TO_DATE(call_date, '%m/%d/%Y'))=:year AND l.state= lr.state) as unique_calls_for_day,
         (SELECT SUM(total_local_calls) from all_local_calls ls WHERE MONTH(STR_TO_DATE(call_date, '%m/%d/%Y'))=:month AND YEAR(STR_TO_DATE(call_date, '%m/%d/%Y'))=:year AND l.state= ls.state) as call_count_for_day
         FROM all_local_calls l WHERE l.state=:state MONTH(STR_TO_DATE(call_date, '%m/%d/%Y'))=:month AND YEAR(STR_TO_DATE(call_date, '%m/%d/%Y'))=:year GROUP BY state";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue('month', $month);
        $stmt->bindValue('year' , $year);
        $stmt->execute();
        return $stmt->fetchAll();
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