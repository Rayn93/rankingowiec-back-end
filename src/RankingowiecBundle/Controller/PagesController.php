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
     *     "/{slug}",
     *      name="static_page"
     * )
     * @Template("RankingowiecBundle:Pages:staticPage.html.twig")
     */
    public function staticPageAction($slug){

        $PageRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:Page');
        $Page = $PageRepo->findOneBySlug($slug);

        if($Page === NULL){
            throw $this->createNotFoundException('Taka strona nie istnieje');
        }

        return array(
            'Page' => $Page
        );
    }


}
