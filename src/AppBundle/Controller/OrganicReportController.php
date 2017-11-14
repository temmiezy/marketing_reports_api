<?php

namespace AppBundle\Controller;

use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\OrganicReport;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrganicReportController extends FOSRestController
{
    /**
     * @Rest\Get("/organic/graph/{year}/{month}")
     */
    public function getAllReportAction($year, $month)
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:OrganicReport')->getByCountDayMonth($year, $month);
        if ($restresult === null) {
            return new View("there are no reports exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }
    /**
     * @Rest\Get("/organic/states/{year}/{month}")
     */
    public function getAllState($year, $month)
    {
        $rest = [];
        $restresult = $this->getDoctrine()->getRepository('AppBundle:OrganicReport')->getAllState($year, $month);
        foreach ($restresult as $result){
            $rest[$result['state']][] = $result;
        }
        if ($rest === null) {
            return new View("No report exist", Response::HTTP_NOT_FOUND);
        }
        return $rest;
    }
    /**
     * @Rest\Get("/organic/all")
     */
    /*
     * Organic Report Api for graph..
     */
    public function getOrganicReportAction()
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:OrganicReport')->findAll();
        if ($restresult === null) {
            return new View("No report exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }
    /**
     * @Rest\Get("/organic/{year}/{month}")
     */
    public function getByYearMonthAction($year, $month)
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:OrganicReport')
            ->getByYearMonthAction($year, $month);

        if ($restresult === null) {
            return new View("No report exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }
    /**
     * @Rest\Get("/report/{state}/{year}/{month}", requirements={"state": "[a-zA-Z]+"})
     */
    public function getByStateAction($state,$year,$month)
    {
        $restResult = $this->getDoctrine()->getRepository('AppBundle:OrganicReport')->getByState($state,$year, $month);

        if ($restResult === null) {
            return new View("No report exist", Response::HTTP_NOT_FOUND);
        }
        return $restResult;
    }

    /**
     * @Rest\Get("/report/{year}/{month}/{day}", requirements={"year": "\d+"})
     */
    public function getOneByYearMonthDayAction($year, $month, $day)
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:OrganicReport')->getOneByYearMonthDay($year, $month, $day);
        if ($restresult === null) {
            return new View("No report exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/report/{state}/{year}/{month}/{day}")
     */
    public function getOneByStateYearMonthDayAction($state, $year, $month, $day)
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:OrganicReport')->getOneByStateYearMonthDay($state, $year, $month, $day);
        if ($restresult === null) {
            return new View("No report exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }
}
