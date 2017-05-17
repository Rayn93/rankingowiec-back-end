<?php

namespace RankingowiecBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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

        $RankRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:Ranking');

        $qb_popular = $RankRepo->getQueryBuilder(array(
            'status' => 'published',
            'categorySlug' => 'popularne',
            'home_page' => true,
            'random' => true,
            'limit' => '10'
        ));

        $popular_query = $qb_popular->getQuery();
        $papular = $popular_query->getResult();

        $qb_new = $RankRepo->getQueryBuilder(array(
            'status' => 'published',
            'orderBy' => 'r.published_date',
            'orderDir' => 'DESC',
            'home_page' => true,
            'limit' => '30'

        ));

        $newest_query = $qb_new->getQuery();
        $newest = $newest_query->getResult();

        $qb_sport = $RankRepo->getQueryBuilder(array(
            'status' => 'published',
            'categorySlug' => 'sport',
            'home_page' => true,
            'random' => true,
            'limit' => '10'
        ));

        $sport_query = $qb_sport->getQuery();
        $sport = $sport_query->getResult();

        $qb_people = $RankRepo->getQueryBuilder(array(
            'status' => 'published',
            'categorySlug' => 'ludzie',
            'home_page' => true,
            'random' => true,
            'limit' => '10'
        ));

        $people_query = $qb_people->getQuery();
        $people = $people_query->getResult();

        $qb_slider = $RankRepo->getQueryBuilder(array(
            'status' => 'published',
            'random' => true,
            'slider' => true,
            'home_page' => true,
            'limit' => '5'
        ));

        $slide_query = $qb_slider->getQuery();
        $slides = $slide_query->getResult();

        return array(
            'Popular' => $papular,
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

        $qb_slider = $RankRepo->getQueryBuilder(array(
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

        $slide_query = $qb_slider->getQuery();
        $slides = $slide_query->getResult();



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

        $qb_slider = $RankRepo->getQueryBuilder(array(
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

        $slide_query = $qb_slider->getQuery();
        $slides = $slide_query->getResult();

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
     *     "/szukaj",
     *      name="ranking_search"
     * )
     * @Template()
     */
    public function searchAction()
    {
        return array();
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



}
