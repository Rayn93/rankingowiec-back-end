<?php

namespace RankingowiecBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class RankingController extends Controller
{
    /**
     * @Route(
     *     "/",
     *      name="ranking_index"
     * )
     *
     * @Template()
     */
    public function indexAction()
    {

        return array();
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
     *     "/kategoria",
     *      name="ranking_category"
     * )
     * @Template()
     */
    public function categoryAction()
    {
        return array();
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
