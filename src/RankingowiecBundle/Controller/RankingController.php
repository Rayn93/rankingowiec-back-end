<?php

namespace RankingowiecBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class RankingController extends Controller{

    protected $itemsLimit = 3;


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
     *     "/kategoria/{page}",
     *      name="ranking_category",
     *     defaults = {"page" = 1},
     *     requirements = {"page" = "\d+"}
     * )
     * @Template()
     */
    public function categoryAction($page){


        $RankRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:Ranking');
        $qb = $RankRepo->getQueryBuilder(array(
            'status' => 'published',
            'orderBy' => 'r.published_date',
            'orderDir' => 'DESC'
        ));

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($qb, $page, $this->itemsLimit);


        return array(
            'Pagination' => $pagination
        );


    }

    /**
     * @Route(
     *     "/tag",
     *      name="ranking_tag"
     * )
     * @Template()
     */
    public function tagAction()
    {
        return array();
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
