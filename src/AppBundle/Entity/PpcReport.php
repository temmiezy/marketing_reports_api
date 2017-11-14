<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PpcReport
 *
 * @ORM\Table(name="ppc_type_state")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PpcReportRepository")
 */
class PpcReport
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
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="app_count", type="integer")
     */
    private $appCount;

    /**
     * @var int
     *
     * @ORM\Column(name="day_num", type="integer")
     */
    private $dayNum;

    /**
     * @var string
     *
     * @ORM\Column(name="app_date", type="string", length=50)
     */
    private $appDate;

    /**
     * @var string
     *
     * @ORM\Column(name="app_state", type="string", length=50)
     */
    private $appState;

    /**
     * @var int
     *
     * @ORM\Column(name="data_id", type="integer")
     */
    private $dataId;


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
     * Set dataId
     *
     * @param integer $dataId
     *
     * @return PpcReport
     */
    public function setDataId($dataId)
    {
        $this->dataId = $dataId;

        return $this;

    }

    /**
     * Get dataId
     *
     * @return int
     */
    public function getDataId()
    {
        return $this->dataId;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return PpcReport
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set appCount
     *
     * @param integer $appCount
     *
     * @return PpcReport
     */
    public function setAppCount($appCount)
    {
        $this->appCount = $appCount;

        return $this;
    }

    /**
     * Get appCount
     *
     * @return int
     */
    public function getAppCount()
    {
        return $this->appCount;
    }

    /**
     * Set dayNum
     *
     * @param integer $dayNum
     *
     * @return PpcReport
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
     * Set appDate
     *
     * @param string $appDate
     *
     * @return PpcReport
     */
    public function setAppDate($appDate)
    {
        $this->appDate = $appDate;

        return $this;
    }

    /**
     * Get appDate
     *
     * @return string
     */
    public function getAppDate()
    {
        return $this->appDate;
    }

    /**
     * Set appState
     *
     * @param string $appState
     *
     * @return PpcReport
     */
    public function setAppState($appState)
    {
        $this->appState = $appState;

        return $this;
    }

    /**
     * Get appState
     *
     * @return string
     */
    public function getAppState()
    {
        return $this->appState;
    }
}

