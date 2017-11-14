<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * KpPpcReport
 *
 * @ORM\Table(name="kp_ppc_apps_daily")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\KpPpcReportRepository")
 */
class KpPpcReport
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
     * @ORM\Column(name="ppc_apps", type="integer")
     */
    private $ppcApps;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=50)
     */
    private $state;

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
     * @var string
     *
     * @ORM\Column(name="data_date", type="string", length=50)
     */
    private $dataDate;


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
     * Set dataDate
     *
     * @param string $dataDate
     *
     * @return KpPpcReport
     */
    public function setDataDate($dataDate)
    {
        $this->dataDate = $dataDate;

        return $this;

    }

    /**
     * Get dataDate
     *
     * @return string
     */
    public function getDataDate()
    {
        return $this->dataDate;
    }

    /**
     * Set dayNum
     *
     * @param integer $dayNum
     *
     * @return KpPpcReport
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
     * Set ppcApps
     *
     * @param integer $ppcApps
     *
     * @return KpPpcReport
     */
    public function setPpcApps($ppcApps)
    {
        $this->ppcApps = $ppcApps;

        return $this;
    }

    /**
     * Get ppcApps
     *
     * @return int
     */
    public function getPpcApps()
    {
        return $this->ppcApps;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return KpPpcReport
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set month
     *
     * @param integer $month
     *
     * @return KpPpcReport
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
     * @return KpPpcReport
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

