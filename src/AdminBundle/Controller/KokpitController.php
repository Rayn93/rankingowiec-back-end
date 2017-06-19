<?php


namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class KokpitController extends Controller{

    /**
     * @Route(
     *      "/",
     *      name="admin_kokpit"
     * )
     *
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }



}