<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrganicReport
 *
 * @ORM\Table(name="apps_organic_daily")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrganicReportRepository")
 */
class OrganicReport
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
     * @ORM\Column(name="date", type="string", length=50)
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=50)
     */
    private $state;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer")
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="referrer", type="string", length=150)
     */
    private $referrer;

    /**
     * @var int
     *
     * @ORM\Column(name="count", type="integer")
     */
    private $count;

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
     * @return OrganicReport
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
     * Set date
     *
     * @param string $date
     *
     * @return OrganicReport
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return OrganicReport
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
     * Set type
     *
     * @param integer $type
     *
     * @return OrganicReport
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set referrer
     *
     * @param string $referrer
     *
     * @return OrganicReport
     */
    public function setReferrer($referrer)
    {
        $this->referrer = $referrer;

        return $this;
    }

    /**
     * Get referrer
     *
     * @return string
     */
    public function getReferrer()
    {
        return $this->referrer;
    }

    /**
     * Set count
     *
     * @param integer $count
     *
     * @return OrganicReport
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }
}

