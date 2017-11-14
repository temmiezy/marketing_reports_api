<?php

namespace AppBundle\Controller;

use AppBundle\Entity\KpOrganicAppsDaily;
use AppBundle\Entity\KpOrganicCallsDaily;
use AppBundle\Entity\KpPpcReport;
use AppBundle\Entity\OrganicReport;
use AppBundle\Entity\PpcReport;
use AppBundle\Entity\AllLocalCalls;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use GuzzleHttp\Client;

class ReportController extends FOSRestController
{
    /**
     * @Rest\Get("/state_daily/graph/{state}/{type}/{year}/{month}")
     */
    public function getStateDailyAction($state, $type, $year, $month)
    {
        $rest = [];
        //$r = $this->get('app.report_service');
        //$restresult = $r->getStateDaily($state, $type, $year, $month);
        switch ($type){
            case 'all':
                $r = $this->get('app.report_service');
                $restresult = $r->getStateDaily($state, $type, $year, $month);
                break;
            case 'organic_apps':
                $restresult = $this->getDoctrine()->getRepository('AppBundle:KpOrganicAppsDaily')
                    ->getStateDaily($state, $type, $year, $month);
                break;
            case 'organic_calls':
                $restresult = $this->getDoctrine()->getRepository('AppBundle:KpOrganicCallsDaily')
                    ->getStateDaily($state, $type, $year, $month);
                break;
            case 'ppc_apps':
                $restresult = $this->getDoctrine()->getRepository('AppBundle:KpPpcReport')
                    ->getStateDaily($state, $type, $year, $month);
                break;
            case 'local_calls':
                $restresult = $this->getDoctrine()->getRepository('AppBundle:KpLocalCallsDaily')
                    ->getStateDaily($state, $type, $year, $month);
                break;
            default:
                $r = $this->get('app.report_service');
                $restresult = $r->getStateDaily($state, $type, $year, $month);
        }

        // Re-assigned the returned array to a multi-dimentional arrays..
        foreach ($restresult as $result){
            $rest["month"] = $result['month'];
            $rest["daily_count"][] = $result;
        }
        if ($restresult === null) {
            return new View("No report exist", Response::HTTP_NOT_FOUND);
        }
        return $rest;
    }

    /**
     * @Rest\Get("/state_daily/table/{state}/{year}/{month}")
     */
    public function getStateDailyTableAction($state, $year, $month)
    {
        $rest = [];
        $restresult = [];
        //This test if all is enter in the field for state..
        if($state == 'all'){
            $r = $this->getDoctrine()->getRepository('AppBundle:KpOrganicAppsDaily');
            $restresult = $r->getAllStateDailyTable($state, $year, $month);
        }else{
            $r = $this->get('app.report_service');
            $restresult = $r->getStateDailyTable($state, $year, $month);
        }
        if ($restresult === null) {
            return new View("No report exist", Response::HTTP_NOT_FOUND);
        }
        return $restresult;
    }

    /**
     * @Rest\Get("/apps_organic")
     */
    public function appsOrganicToDbAction()
    {

        $fetchLastDataId = $this->getDoctrine()->getRepository('AppBundle:OrganicReport')->getDataId();
        $lastDataId = $fetchLastDataId[0]['dataId'];
        echo "last data_ID is - ".$lastDataId;

        // Create a client with a base URI
        $client = new Client(['base_uri' => 'https://ezleadtracker.com/loantrack2/_api/marketing/organics/daily/']);
        // Send a request to ez
        $res = $client->request('POST', 'apps_organic',[
            'form_params' => [
                'api_key'=>'5aee93a7-456f-484c-a956-413719468cda',
                'last_max_data'=> $lastDataId
            ]
        ]);
        $result = json_decode($res->getBody()->getContents());

        // Creating an entity manager
        $em = $this->getDoctrine()->getManager();
        foreach($result as $result){
            // Insert into database
            $organicApps = new OrganicReport();
            $organicApps->setCount($result->count);
            $organicApps->setDate($result->date);
            $organicApps->setReferrer($result->referrer);
            $organicApps->setState($result->state);
            $organicApps->setType($result->type);
            $organicApps->setDataId($result->data_id);

            $em->persist($organicApps);
        }
        $em->flush();
        return new Response("Data inserted");
    }

    /**
     * @Rest\Get("/kp_organic_apps")
     */
    public function kpOrganicAppsToDbAction()
    {
        $fetchLastDataDate = $this->getDoctrine()->getRepository('AppBundle:KpOrganicAppsDaily')->getDataDate();
        $lastDataDate = $fetchLastDataDate[0]['dataDate'];
        echo "last data_date KP Oragnic Daily is - ".$lastDataDate;

        // Create a client with a base URI
        $client = new Client(['base_uri' => 'https://ezleadtracker.com/loantrack2/_api/marketing/organics/daily/']);
        // Send a request to ez
        $res = $client->request('POST', 'kp_organic_apps',[
            'form_params' => [
                'api_key'=>'5aee93a7-456f-484c-a956-413719468cda',
                'last_max_data'=> $lastDataDate
            ]
        ]);
        $result = json_decode($res->getBody()->getContents());

        // Creating an entity manager
        $em = $this->getDoctrine()->getManager();
        foreach($result as $result){
            // Insert into database
            $kpOrganicApps = new KpOrganicAppsDaily();
            $kpOrganicApps->setDayNum($result->day_num);
            $kpOrganicApps->setOrganicApps($result->organic_apps);
            $kpOrganicApps->setState($result->state);
            $kpOrganicApps->setMonth($result->month);
            $kpOrganicApps->setYear($result->year);
            $kpOrganicApps->setDataDate($result->data_date);

            $em->persist($kpOrganicApps);
        }
        $em->flush();
        return new Response("Data inserted");
    }

    /**
     * @Rest\Get("/kp_organic_calls")
     */
    public function kpOrganicCallsToDbAction()
    {
        $fetchLastDataDate = $this->getDoctrine()->getRepository('AppBundle:KpOrganicCallsDaily')->getDataDate();
        $lastDataDate = $fetchLastDataDate[0]['dataDate'];
        echo "last data_date KP Organic Calls is - ".$lastDataDate;

        // Create a client with a base URI
        $client = new Client(['base_uri' => 'https://ezleadtracker.com/loantrack2/_api/marketing/organics/daily/']);
        // Send a request to ez
        $res = $client->request('POST', 'kp_organic_calls',[
            'form_params' => [
                'api_key'=>'5aee93a7-456f-484c-a956-413719468cda',
                'last_max_data'=> $lastDataDate
            ]
        ]);
        $result = json_decode($res->getBody()->getContents());

        // Creating an entity manager
        $em = $this->getDoctrine()->getManager();
        foreach($result as $result){
            // Insert into database
            $kpOrganicCalls = new KpOrganicCallsDaily();
            $kpOrganicCalls ->setDayNum($result->day_num);
            $kpOrganicCalls ->setOrganicCalls($result->organic_calls);
            $kpOrganicCalls ->setState($result->state);
            $kpOrganicCalls ->setMonth($result->month);
            $kpOrganicCalls ->setYear($result->year);
            $kpOrganicCalls ->setDataDate($result->data_date);

            $em->persist($kpOrganicCalls );
        }
        $em->flush();
        return new Response("Data inserted");
    }

    /**
     * @Rest\Get("/ppc")
     */
    public function ppcToDbAction()
    {

        $fetchLastDataId = $this->getDoctrine()->getRepository('AppBundle:PpcReport')->getDataId();
        $lastDataId = $fetchLastDataId[0]['dataId'];
        echo "last data_ID ppc is - ".$lastDataId;

        // Create a client with a base URI
        $client = new Client(['base_uri' => 'https://ezleadtracker.com/loantrack2/_api/marketing/organics/daily/']);
        // Send a request to ez
        $res = $client->request('POST', 'ppc',[
            'form_params' => [
                'api_key'=>'5aee93a7-456f-484c-a956-413719468cda',
                'last_max_data'=> $lastDataId
            ]
        ]);
        $result = json_decode($res->getBody()->getContents());

        // Creating an entity manager
        $em = $this->getDoctrine()->getManager();
        foreach($result as $result){
            // Insert into database
            $ppc = new PpcReport();
            $ppc->setType($result->type);
            $ppc->setAppCount($result->app_count);
            $ppc->setDayNum($result->day_num);
            $ppc->setAppDate($result->app_date);
            $ppc->setAppState($result->app_state);
            $ppc->setDataId($result->data_id);

            $em->persist($ppc);
        }
        $em->flush();
        return new Response("PPC Data inserted");
    }

    /**
     * @Rest\Get("/kp_ppc_apps")
     */
    public function kpPpcAppsToDbAction()
    {
        $fetchLastDataDate = $this->getDoctrine()->getRepository('AppBundle:KpPpcReport')->getDataDate();
        $lastDataDate = $fetchLastDataDate[0]['dataDate'];
        echo "last data_date KP PPC Apps is - ".$lastDataDate;

        // Create a client with a base URI
        $client = new Client(['base_uri' => 'https://ezleadtracker.com/loantrack2/_api/marketing/organics/daily/']);
        // Send a request to ez
        $res = $client->request('POST', 'kp_ppc_apps',[
            'form_params' => [
                'api_key'=>'5aee93a7-456f-484c-a956-413719468cda',
                'last_max_data'=> $lastDataDate
            ]
        ]);
        $result = json_decode($res->getBody()->getContents());

        // Creating an entity manager
        $em = $this->getDoctrine()->getManager();
        foreach($result as $result){
            // Insert into database
            $kpPpc = new KpPpcReport();
            $kpPpc->setDayNum($result->day_num);
            $kpPpc->setPpcApps($result->ppc_apps);
            $kpPpc->setState($result->state);
            $kpPpc->setMonth($result->month);
            $kpPpc->setYear($result->year);
            $kpPpc->setDataDate($result->data_date);

            $em->persist($kpPpc);
        }
        $em->flush();
        return new Response("Data inserted");
    }

    /**
     * @Rest\Get("/local_calls")
     */
    public function allLocalCallsToDbAction()
    {
        $fetchLastDataDate = $this->getDoctrine()->getRepository('AppBundle:AllLocalCalls')->getDataDate();
        $lastDataDate = $fetchLastDataDate[0]['dataDate'];
        echo "last data_date for all_local_calls is - ".$lastDataDate;

        // Create a client with a base URI
        $client = new Client(['base_uri' => 'https://ezleadtracker.com/loantrack2/_api/marketing/organics/daily/']);
        // Send a request to ez
        $res = $client->request('POST', 'local_calls',[
            'form_params' => [
                'api_key'=>'5aee93a7-456f-484c-a956-413719468cda',
                'last_max_data'=> $lastDataDate
            ]
        ]);
        $result = json_decode($res->getBody()->getContents());

        // Creating an entity manager
        $em = $this->getDoctrine()->getManager();
        foreach($result as $result){
            // Insert into database
            $allLocalCalls = new AllLocalCalls();
            $allLocalCalls->setUniqueCalls($result->calls_unique);
            $allLocalCalls->setTotalLocalCalls($result->calls_local);
            $allLocalCalls->setCalldate($result->call_date);
            $allLocalCalls->setCompanyName($result->company_name);
            $allLocalCalls->setState($result->state);
            $allLocalCalls->setDataDate($result->data_date);

            $em->persist($allLocalCalls);
        }
        $em->flush();
        return new Response("Data inserted");
    }
}
