<?php

namespace RankingowiecBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PagesController extends Controller
{
    /**
     * @Route(
     *     "/kontakt",
     *      name="contact_page"
     * )
     *
     * @Template()
     */
    public function contactAction()
    {
        return array();
    }

    /**
     * @Route(
     *     "/faq",
     *      name="faq_page"
     * )
     *
     * @Template()
     */
    public function faqAction()
    {
        return array();
    }

    /**
     * @Route(
     *     "/{slug}",
     *      name="static_page"
     * )
     * @Template("RankingowiecBundle:Pages:staticPage.html.twig")
     */
    public function staticPageAction($slug)
    {
        return array();
    }


}
