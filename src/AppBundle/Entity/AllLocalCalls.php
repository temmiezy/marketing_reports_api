<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AllLocalCalls
 *
 * @ORM\Table(name="all_local_calls")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AllLocalCallsRepository")
 */
class AllLocalCalls
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
     * @ORM\Column(name="state", type="string", length=50)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="company_name", type="string", length=50)
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="call_date", type="string", length=50)
     */
    private $callDate;

    /**
     * @var int
     *
     * @ORM\Column(name="total_local_calls", type="integer")
     */
    private $totalLocalCalls;

    /**
     * @var int
     *
     * @ORM\Column(name="unique_calls", type="integer")
     */
    private $uniqueCalls;

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
     * @return AllLocalCalls
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
     * Set state
     *
     * @param string $state
     *
     * @return AllLocalCalls
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
     * Set companyName
     *
     * @param string $companyName
     *
     * @return AllLocalCalls
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set callDate
     *
     * @param string $callDate
     *
     * @return AllLocalCalls
     */
    public function setCallDate($callDate)
    {
        $this->callDate = $callDate;

        return $this;
    }

    /**
     * Get callDate
     *
     * @return string
     */
    public function getCallDate()
    {
        return $this->callDate;
    }

    /**
     * Set totalLocalCalls
     *
     * @param string $totalLocalCalls
     *
     * @return AllLocalCalls
     */
    public function setTotalLocalCalls($totalLocalCalls)
    {
        $this->totalLocalCalls = $totalLocalCalls;

        return $this;
    }

    /**
     * Get totalLocalCalls
     *
     * @return string
     */
    public function getTotalLocalCalls()
    {
        return $this->totalLocalCalls;
    }

    /**
     * Set uniqueCalls
     *
     * @param string $uniqueCalls
     *
     * @return AllLocalCalls
     */
    public function setUniqueCalls($uniqueCalls)
    {
        $this->uniqueCalls = $uniqueCalls;

        return $this;
    }

    /**
     * Get uniqueCalls
     *
     * @return string
     */
    public function getUniqueCalls()
    {
        return $this->uniqueCalls;
    }
}

