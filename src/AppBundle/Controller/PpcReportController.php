<?php

namespace AppBundle\Controller;

use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\PpcReport;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PpcReportController extends FOSRestController
{
    /**
     * @Rest\Get("/ppc/app_ppc_manual_type_all/{year}/{month}")
     */
    public function getAllByTypeDateAction($year, $month)
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:PpcReport')
            ->getAllCount($year, $month);

        if ($restresult === null) {
            return new View("No report exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }
    /**
     * @Rest\Get("/ppc/app_ppc_total_manual_by_type/{year}/{month}")
     */
    public function getByTypeAction($year,$month)
    {
        $rest = [];
        $restresult = $this->getDoctrine()->getRepository('AppBundle:PpcReport')
            ->getByType($year, $month);

        foreach($restresult as $result){
            $rest[$result['type']][] = $result;
        }

        if ($rest === null) {
            return new View("No report exist", Response::HTTP_NOT_FOUND);
        }
        return $rest;
    }
    /**
     * @Rest\Get("/ppc/app_ppc_manual_by_states/{state}/{type}/{year}/{month}")
     */
    public function getStateAction($state, $type, $year,$month)
    {
        $rest = [];
        $restresult = $this->getDoctrine()->getRepository('AppBundle:PpcReport')
            ->getByAllState($state,$type, $year,$month);

        foreach ($restresult as $result){
            $rest[$result['state']][] = $result;
        }
        if ($rest === null) {
            return new View("No report exist", Response::HTTP_NOT_FOUND);
        }
        return $rest;
    }
}
