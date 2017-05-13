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



        return array(

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

        $slide_query = $qb_slider->getQuery();
        $slides = $slide_query->getResult();

        return array(
            'Pagination' => $pagination_all,
            'Slides' => $slides,
            'ListTitle' => sprintf('Rankingi z kategori: %s', $Category->getName() )
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

        return array(
            'Pagination' => $pagination_all,
            'Slides' => $slides,
            'ListTitle' => sprintf('Rankingi z tagiem: %s', $Tag->getName() )
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
