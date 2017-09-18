<?php

namespace RankingowiecBundle\Controller;

use RankingowiecBundle\Entity\RankObject;
use RankingowiecBundle\RankingowiecBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class RankingController extends Controller{

    protected $itemsLimit = 9;
    protected $slideLimit = 8;


    /**
     * @Route(
     *     "/",
     *      name="ranking_index"
     * )
     *
     * @Template()
     */
    public function indexAction(){

        $popular = $this->getRankingQueryResult(array(
            'status' => 'published',
            'categorySlug' => 'popularne',
            'home_page' => true,
            'random' => true,
            'limit' => '10'
        ));

        $newest = $this->getRankingQueryResult(array(
            'status' => 'published',
            'orderBy' => 'r.published_date',
            'orderDir' => 'DESC',
            'home_page' => true,
            'limit' => '30'

        ));

        $sport = $this->getRankingQueryResult(array(
            'status' => 'published',
            'categorySlug' => 'sport',
            'home_page' => true,
            'random' => true,
            'limit' => '10'
        ));

        $people = $this->getRankingQueryResult(array(
            'status' => 'published',
            'categorySlug' => 'ludzie',
            'home_page' => true,
            'random' => true,
            'limit' => '10'
        ));

        $slides = $this->getRankingQueryResult(array(
            'status' => 'published',
            'random' => true,
            'slider' => true,
            'home_page' => true,
            'limit' => '5'
        ));


        return array(
            'Popular' => $popular,
            'Newest' => $newest,
            'Sport' => $sport,
            'People' => $people,
            'Slides' => $slides
        );
    }




    /**
     * @Route(
     *     "/ranking/{slug}",
     *      name="single_ranking"
     * )
     *
     * @Template()
     */
    public function rankingAction($slug){


        $RankRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:Ranking');
        $ItemsRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:RankingItem');

        $Ranking = $RankRepo->getPublishedRanking($slug);

        if($Ranking === NULL){
            throw $this->createNotFoundException('Ranking nie został odnaleziony');
        }
        else{

            $RankingId = $Ranking->getId();
            $Items = $ItemsRepo->getRankingObjects($RankingId);

            $total_votes = 0;

            foreach ($Items as $item){
                $total_votes += $item->getPlus();
                $total_votes += $item->getMinus();
            }

        }

        $request = $this->get('request');
        if($request->isXmlHttpRequest()) {
            $value = $request->request->get('sentValue');
        }

        return array(
            'Ranking' => $Ranking,
            'Objects' => $Items,
            'TotalVotes' => $total_votes
        );
    }



    /**
     * @Route(
     *     "/obiekt/{slug}",
     *      name="single_object"
     * )
     * @Template()
     */
    public function objectAction($slug){


        $ObjectRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:RankObject');
        $Object = $ObjectRepo->getPublishedObject($slug);


        if($Object === NULL){
            throw $this->createNotFoundException('Obiekt nie został odnaleziony');
        }
        else{

            $RankItemRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:RankingItem');
            $objectId = $Object->getId();

            $RankingsWithObject = $RankItemRepo->getRankingsWithItem($objectId);

        }



        return array(
            'Object' => $Object,
            'Rankings' => $RankingsWithObject
        );
    }




    /**
     * @Route(
     *     "/kategoria/{slug}/{page}",
     *      name="ranking_category",
     *     defaults = {"page" = 1},
     *     requirements = {"page" = "\d+"}
     * )
     * @Template("RankingowiecBundle:Ranking:rankingList.html.twig")
     */
    public function categoryAction($slug, $page){


        $RankRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:Ranking');
        $qb_all = $RankRepo->getQueryBuilder(array(
            'status' => 'published',
            'orderBy' => 'r.published_date',
            'orderDir' => 'DESC',
            'categorySlug' => $slug
        ));

        $slides = $this->getRankingQueryResult(array(
            'status' => 'published',
            'orderBy' => 'r.published_date',
            'orderDir' => 'DESC',
            'categorySlug' => $slug,
            'slider' => true,
            'limit' => $this->slideLimit
        ));

        $CategoryRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:Category');
        $Category = $CategoryRepo->findOneBySlug($slug);

        //Sprawdzenie czy kategoria istnieje i stworzenie odpowiednigo tytułu listy
        if($Category === null){
            $list_title = $slug;
        }
        else{
            $list_title = $Category->getName();
        }

        $paginator = $this->get('knp_paginator');
        $pagination_all = $paginator->paginate($qb_all, $page, $this->itemsLimit);

        $count_row = count($qb_all->getQuery()->getResult());

        return array(
            'Pagination' => $pagination_all,
            'Slides' => $slides,
            'ListTitle' => sprintf('Rankingi z kategori: %s', $list_title ),
            'Count' => $count_row
        );
    }




    /**
     * @Route(
     *     "/tag/{slug}/{page}",
     *      name="ranking_tag",
     *     defaults = {"page" = 1},
     *     requirements = {"page" = "\d+"}
     * )
     * @Template("RankingowiecBundle:Ranking:rankingList.html.twig")
     */
    public function tagAction($slug, $page)
    {
        $RankRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:Ranking');
        $qb_all = $RankRepo->getQueryBuilder(array(
            'status' => 'published',
            'orderBy' => 'r.published_date',
            'orderDir' => 'DESC',
            'tagSlug' => $slug
        ));

        $slides = $this->getRankingQueryResult(array(
            'status' => 'published',
            'orderBy' => 'r.published_date',
            'orderDir' => 'DESC',
            'tagSlug' => $slug,
            'slider' => true,
            'limit' => $this->slideLimit
        ));

        $TagRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:Tag');
        $Tag = $TagRepo->findOneBySlug($slug);

        //Sprawdzenie czy kategoria istnieje i stworzenie odpowiednigo tytułu listy
        if($Tag === null){
            $list_title = $slug;
        }
        else{
            $list_title = $Tag->getName();
        }

        $paginator = $this->get('knp_paginator');
        $pagination_all = $paginator->paginate($qb_all, $page, $this->itemsLimit);

        $count_row = count($qb_all->getQuery()->getResult());

        return array(
            'Pagination' => $pagination_all,
            'Slides' => $slides,
            'ListTitle' => sprintf('Rankingi z tagiem: %s', $list_title ),
            'Count' => $count_row

        );
    }




    /**
     * @Route(
     *     "/szukaj/{page}",
     *      name="ranking_search",
     *      defaults = {"page" = 1},
     *      requirements = {"page" = "\d+"}
     * )
     * @Template()
     */
    public function searchAction( \Symfony\Component\HttpFoundation\Request $reguest, $page){
        
        $search_param = $reguest->query->get('search');

        $RankRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:Ranking');
        $qb_all = $RankRepo->getQueryBuilder(array(
            'status' => 'published',
            'orderBy' => 'r.published_date',
            'orderDir' => 'DESC',
            'search_param' => $search_param
        ));

        $paginator = $this->get('knp_paginator');
        $pagination_all = $paginator->paginate($qb_all, $page, $this->itemsLimit);

        $count_row = count($qb_all->getQuery()->getResult());

        return array(
            'Pagination' => $pagination_all,
            'Search_phrase' => $search_param,
            'Count' => $count_row
        );
    }



    /**
     * @Route(
     *     "/mapa-strony",
     *      name="ranking_page_map"
     * )
     * @Template()
     */
    public function pageMapAction(){
        
        $PageRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:Page');
        $Page = $PageRepo->findOneBySlug('mapa-strony');

        $TagRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:Tag');
        $TagList = $TagRepo->findAll();
        
        return array(
            'Page' => $Page,
            'TagList' => $TagList
        );
    }



//Listowanie rankingów które nie są starsze niż 30 dni
    /**
     * @Route(
     *     "/najnowsze/{page}",
     *     name="ranking_newest",
     *     defaults = {"page" = 1},
     *     requirements = {"page" = "\d+"}
     * )
     *
     * @Template("RankingowiecBundle:Ranking:rankingList.html.twig")
     */
    public function newestRankingAction($page){

        $RankRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:Ranking');
        $qb_all = $RankRepo->getQueryBuilder(array(
            'status' => 'published',
            'orderBy' => 'r.published_date',
            'orderDir' => 'DESC',
            'only_new' => true
        ));

        $slides = $this->getRankingQueryResult(array(
            'status' => 'published',
            'orderBy' => 'r.published_date',
            'orderDir' => 'DESC',
            'only_new' => true,
            'slider' => true,
            'limit' => $this->slideLimit
        ));

        $paginator = $this->get('knp_paginator');
        $pagination_all = $paginator->paginate($qb_all, $page, $this->itemsLimit);

        $count_row = count($qb_all->getQuery()->getResult());

        return array(
            'Pagination' => $pagination_all,
            'Slides' => $slides,
            'ListTitle' => 'Najnowsze rankingi',
            'Count' => $count_row

        );


    }

//Logika głosowania
    /**
     * @Route(
     *     "/ajax/rankingvote/update/data",
     *     name="ranking_voting",
     *     options={"expose"=true}
     * )
     *
     */
    public function updateDataAction(Request $request)
    {
        $rankingId = $request->get('rankingId');
        $itemId = $request->get('itemId');
        $plus = $request->get('plus');
        $minus = $request->get('minus');

        //Dodawania punktów do wyników rankingów
        $ItemsRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:RankingItem');

        $Item = $ItemsRepo->findOneBy(array(
           'ranking' =>  $rankingId,
            'item' => $itemId
        ));

        $finalPlus = $Item->getPlus() + $plus;
        $finalMinus = $Item->getMinus() + $minus;
        $ItemsRepo->updateRankingResult($rankingId, $itemId, $finalPlus, $finalMinus);

        //Dodawanie punktów do Obiektów Rankingowych
        $RankObject = $this->getDoctrine()->getRepository('RankingowiecBundle:RankObject')->find($itemId);

        $totalResult = $RankObject->getTotalResult();

        $newTotalResult = array(
            $totalResult[0] => $totalResult[0] + $plus,
            $totalResult[1] => $totalResult[1] + $minus,
        );


        $RankObject->setTotalResult($newTotalResult);
        $em = $this->getDoctrine()->getManager();
        $em->persist($RankObject);
        $em->flush();

        $response = new JsonResponse();
        $response->setData(array(
            'plus' => $finalPlus,
            'minus' => $finalMinus,
            'total' => ($finalPlus - $finalMinus)
        ));
        return $response;
    }




    //Return a Query Results of Rankings
    protected function getRankingQueryResult(array $params = array()){
        $RankRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:Ranking');
        $qb = $RankRepo->getQueryBuilder($params);

        $query = $qb->getQuery();
        $result = $query->getResult();

        return $result;
    }



}
