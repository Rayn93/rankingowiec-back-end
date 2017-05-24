<?php

namespace RankingowiecBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class RankingController extends Controller{

    protected $itemsLimit = 3;
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
        $ObjectRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:RankObject');

        $Ranking = $RankRepo->getPublishedRanking($slug);

        $RankingItems = $Ranking->getItems();
        $Objects = $ObjectRepo->getRankingObjects($RankingItems);


//        foreach ($Objects as $object){
//            $titles[] = $object->getTitle();
//            $thumbnails[] = $object->getThumbnail();
//        }

        $results = $Ranking->getItemsResult();


        foreach($results as $title => $innerArray){
            $wyniki[] = array(
                $title => $innerArray['plus'] - $innerArray['minus']
            );
        }

//        $my_object_list = array(
//            'titles' => $titles,
//            '$thumbnails' => $thumbnails,
//            'wyniki' => $wyniki
//        );


        foreach ($Objects as $object){

            $my_object_list[] = array(
                'title' => $object->getTitle(),
                'thumbnail' => $object->getThumbnail(),
                'plus' => $results[$object->getTitle()]['plus'],
                'minus' => $results[$object->getTitle()]['minus'],
                'result' => $results[$object->getTitle()]['plus'] - $results[$object->getTitle()]['minus']
            );

        }

        $results2 = array();
        foreach ($my_object_list as $key => $row)
        {
            $results2[$key] = $row['result'];
        }
        array_multisort($results2, SORT_DESC, $my_object_list);


//        var_dump($my_object_list);


        if($Ranking === NULL){
            throw $this->createNotFoundException('Ranking nie został odnaleziony');
        }



        return array(
            'Ranking' => $Ranking,
            'Objects' => $my_object_list
        );
    }

    /**
     * @Route(
     *     "/obiekt",
     *      name="single_object"
     * )
     * @Template()
     */
    public function objectAction()
    {
        return array();
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

        $paginator = $this->get('knp_paginator');
        $pagination_all = $paginator->paginate($qb_all, $page, $this->itemsLimit);

        $count_row = count($qb_all->getQuery()->getResult());

        return array(
            'Pagination' => $pagination_all,
            'Slides' => $slides,
            'ListTitle' => sprintf('Rankingi z kategori: %s', $Category->getName() ),
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

        $paginator = $this->get('knp_paginator');
        $pagination_all = $paginator->paginate($qb_all, $page, $this->itemsLimit);

        $count_row = count($qb_all->getQuery()->getResult());

        return array(
            'Pagination' => $pagination_all,
            'Slides' => $slides,
            'ListTitle' => sprintf('Rankingi z tagiem: %s', $Tag->getName() ),
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
    public function pageMapAction()
    {
        return array();
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
