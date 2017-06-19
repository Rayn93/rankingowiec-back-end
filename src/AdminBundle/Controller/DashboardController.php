<?php


namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class DashboardController extends Controller{

    /**
     * @Route(
     *      "/",
     *      name="admin_dashboard"
     * )
     *
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }



}