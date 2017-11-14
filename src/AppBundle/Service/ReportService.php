<?php
/**
 * Created by PhpStorm.
 * User: chris
 * Date: 10/4/2017
 * Time: 9:41 PM
 */

namespace AppBundle\Service;

use AppBundle\Entity\OrganicReport;
use AppBundle\Entity\PpcReport;
use AppBundle\Entity\KpLocalCallsDaily;
use AppBundle\Entity\KpOrganicAppsDaily;
use AppBundle\Entity\KpOrganicCallsDaily;
use AppBundle\Entity\KpPpcReport;
use Doctrine\ORM\EntityManager;
class ReportService
{
    protected $em;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function getStateDaily($state, $type, $year, $month)
    {
        $qb = $this->em->createQueryBuilder();
        $query = $qb->select(
            "r.dayNum as day,(SUM(r.organicApps) + SUM(a.organicCalls) + SUM(p.ppcApps)) as total_count, r.month"
        )
            ->from('AppBundle:KpOrganicAppsDaily','r')
            ->leftJoin("AppBundle:KpOrganicCallsDaily", 'a', 'WITH', 'r.dayNum = a.dayNum AND r.month = a.month AND r.year = a.year AND r.state = a.state')
            ->leftJoin("AppBundle:KpPpcReport", 'p', 'WITH', 'r.dayNum = p.dayNum AND r.month = p.month AND r.year = p.year AND r.state = p.state')
            ->where("r.month = :month")
            ->andWhere("r.year = :year")
            ->andWhere('r.state = :state')
            ->groupBy('r.dayNum')
            ->orderBy('r.dayNum')
            ->setParameter('month', $month)
            ->setParameter('year', $year)
            ->setParameter('state', $state)
        ;
        $restresult = $query->getQuery()->getResult();
        return $restresult;
    }

    public function getStateDailyTable($state, $year, $month)
    {
        $qb = $this->em->createQueryBuilder();
        $query = $qb->select(
            "r.dayNum as day, r.month as month, r.year as year, 
            SUM(r.organicApps) as orgaic_apps, SUM(a.organicCalls) as organic_calls, SUM(p.ppcApps) as ppc,
            (SUM(r.organicApps) + SUM(a.organicCalls) + SUM(p.ppcApps)) as total
            "
        )
            ->from('AppBundle:KpOrganicAppsDaily','r')
            ->leftJoin("AppBundle:KpOrganicCallsDaily", 'a', 'WITH', 'r.dayNum = a.dayNum AND r.month = a.month AND r.year = a.year AND r.state = a.state')
            ->leftJoin("AppBundle:KpPpcReport", 'p', 'WITH', 'r.dayNum = p.dayNum AND r.month = p.month AND r.year = p.year AND r.state = p.state')
            //->leftJoin("AppBundle:KpLocalCallsDaily", 'l', 'WITH', 'r.dayNum = l.dayNum AND r.month = l.month AND r.year = l.year')
            ->where("r.month = :month")
            ->andWhere("r.year = :year")
            ->andWhere('r.state = :state')
            ->groupBy('r.dayNum')
            ->orderBy('r.dayNum')
            ->setParameter('month', $month)
            ->setParameter('year', $year)
            ->setParameter('state', $state)
        ;
        $restresult = $query->getQuery()->getResult();
        return $restresult;
    }

    public function appsOrganicToDbAction()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'https://qa-server.ezleadtracker.com/loantrack2/_api/marketing/organics/daily/']);
        // Send a request to ez
        $res = $client->request('POST', 'apps_organic',[
            'form_params' => [
                'api_key'=>'5aee93a7-456f-484c-a956-413719468cda'
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

            $em->persist($organicApps);
        }
        $em->flush();
        return new Response("Data inserted");
    }

    public function kpOrganicAppsToDbAction()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'https://qa-server.ezleadtracker.com/loantrack2/_api/marketing/organics/daily/']);
        // Send a request to ez
        $res = $client->request('POST', 'kp_organic_apps',[
            'form_params' => [
                'api_key'=>'5aee93a7-456f-484c-a956-413719468cda'
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

            $em->persist($kpOrganicApps);
        }
        $em->flush();
        return new Response("Data inserted");
    }

    public function kpOrganicCallsToDbAction()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'https://qa-server.ezleadtracker.com/loantrack2/_api/marketing/organics/daily/']);
        // Send a request to ez
        $res = $client->request('POST', 'kp_organic_calls',[
            'form_params' => [
                'api_key'=>'5aee93a7-456f-484c-a956-413719468cda'
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

            $em->persist($kpOrganicCalls );
        }
        $em->flush();
        return new Response("Data inserted");
    }

    public function ppcToDbAction()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'https://qa-server.ezleadtracker.com/loantrack2/_api/marketing/organics/daily/']);
        // Send a request to ez
        $res = $client->request('POST', 'ppc',[
            'form_params' => [
                'api_key'=>'5aee93a7-456f-484c-a956-413719468cda'
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

            $em->persist($ppc);
        }
        $em->flush();
        return new Response("Data inserted");
    }

    public function kpPpcAppsToDbAction()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'https://qa-server.ezleadtracker.com/loantrack2/_api/marketing/organics/daily/']);
        // Send a request to ez
        $res = $client->request('POST', 'kp_ppc_apps',[
            'form_params' => [
                'api_key'=>'5aee93a7-456f-484c-a956-413719468cda'
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

            $em->persist($kpPpc);
        }
        $em->flush();
        return new Response("Data inserted");
    }

    public function allLocalCallsToDbAction()
    {
        // Create a client with a base URI
        $client = new Client(['base_uri' => 'https://qa-server.ezleadtracker.com/loantrack2/_api/marketing/organics/daily/']);
        // Send a request to ez
        $res = $client->request('POST', 'local_calls',[
            'form_params' => [
                'api_key'=>'5aee93a7-456f-484c-a956-413719468cda'
            ]
        ]);
        $result = json_decode($res->getBody()->getContents());

        // Creating an entity manager
        $em = $this->getDoctrine()->getManager();
        foreach($result as $result){
            // Insert into database
            $AllLocalCalls = new PpcReport();
            $AllLocalCalls->setType($result->type);
            $AllLocalCalls->setAppCount($result->app_count);
            $AllLocalCalls->setDayNum($result->day_num);
            $AllLocalCalls->setAppDate($result->app_date);
            $AllLocalCalls->setAppState($result->app_state);

            $em->persist($AllLocalCalls);
        }
        $em->flush();
        return new Response("Data inserted");
    }

}