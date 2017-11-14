<?php

namespace AppBundle\Controller;

use AppBundle\Entity\KpOrganicAppsDaily;
use AppBundle\Entity\KpOrganicCallsDaily;
use AppBundle\Entity\KpPpcReport;
use AppBundle\Entity\OrganicReport;
use AppBundle\Entity\PpcReport;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GuzzleHttp\Client;

class AllLocalCallsController extends FOSRestController
{
    /**
     * @Rest\Get("/all_local_calls/graph/{year}/{month}")
     */
    public function getAllLocalCallsAction($year, $month)
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:AllLocalCalls')
            ->getAllLocalCalls($year, $month);

        if ($restresult === null) {
            return new View("No report exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/all_local_calls/table/{year}/{month}")
     */
    public function getAllLocalCallsTableAction($year, $month)
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:AllLocalCalls')
            ->getAllLocalCallsTable($year, $month);

        if ($restresult === null) {
            return new View("No report exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/all_local_calls/table/{state}/{year}/{month}")
     */
    public function getAllLocalCallsTableStateAction($state, $year, $month)
    {
        $restresult = $this->getDoctrine()->getRepository('AppBundle:AllLocalCalls')
            ->getAllLocalCallsTable($year, $month);

        if ($restresult === null) {
            return new View("No report exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }
}
