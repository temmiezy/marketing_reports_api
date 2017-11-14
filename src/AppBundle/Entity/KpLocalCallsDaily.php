<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KpLocalCallsDaily
 *
 * @ORM\Table(name="kp_local_calls_daily")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\KpLocalCallsDailyRepository")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\KpLocalCallsDailyRepository")
 */
class KpLocalCallsDaily
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="day_num", type="integer")
     */
    private $dayNum;

    /**
     * @var int
     *
     * @ORM\Column(name="calls_locals", type="integer")
     */
    private $callsLocals;

    /**
     * @var int
     *
     * @ORM\Column(name="month", type="integer")
     */
    private $month;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer")
     */
    private $year;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set dayNum
     *
     * @param integer $dayNum
     *
     * @return KpLocalCallsDaily
     */
    public function setDayNum($dayNum)
    {
        $this->dayNum = $dayNum;

        return $this;
    }

    /**
     * Get dayNum
     *
     * @return int
     */
    public function getDayNum()
    {
        return $this->dayNum;
    }

    /**
     * Set callsLocals
     *
     * @param integer $callsLocals
     *
     * @return KpLocalCallsDaily
     */
    public function setCallsLocals($callsLocals)
    {
        $this->callsLocals = $callsLocals;

        return $this;
    }

    /**
     * Get callsLocals
     *
     * @return int
     */
    public function getCallsLocals()
    {
        return $this->callsLocals;
    }

    /**
     * Set month
     *
     * @param integer $month
     *
     * @return KpLocalCallsDaily
     */
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Get month
     *
     * @return int
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return KpLocalCallsDaily
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }
}

