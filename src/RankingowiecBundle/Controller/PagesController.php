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
     *     "/jak-to-dziala",
     *      name="static_page"
     * )
     * @Template()
     */
    public function staticPageAction()
    {
        return array();
    }


}
