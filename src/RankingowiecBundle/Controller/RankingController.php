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
     *     "/ranking",
     *      name="single_ranking"
     * )
     *
     * @Template()
     */
    public function rankingAction()
    {
        return array();
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
