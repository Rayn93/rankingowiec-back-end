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
     *      name="ranking_slug"
     * )
     *
     * @Template()
     */
    public function rankingAction()
    {
        return array();
    }

    /**
     * @Template()
     */
    public function objectAction()
    {
        return array();
    }

    /**
     * @Template()
     */
    public function categoryAction()
    {
        return array();
    }

    /**
     * @Template()
     */
    public function tagAction()
    {
        return array();
    }

    /**
     * @Template()
     */
    public function searchAction()
    {
        return array();
    }
}
