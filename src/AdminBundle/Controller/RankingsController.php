<?php


namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class RankingsController extends Controller{

    /**
     * @Route(
     *      "/lista/{page}",
     *      name="admin_rankings",
     *      defaults={"page"=1}
     * )
     *
     * @Template()
     */
    public function indexAction(){
        return array();
    }


    /**
     * @Route(
     *      "/formularz/{id}",
     *      name="admin_rankingForm",
     *      requirements={"id"="\d+"},
     *      defaults={"id"=NULL}
     * )
     *
     * @Template()
     */
    public function formAction(){
        return array();
    }



    /**
     * @Route(
     *      "/usun/{id}/{token}",
     *      name="admin_rankingDelete",
     *      requirements={"id"="\d+"}
     * )
     *
     * @Template()
     */
    public function deleteAction(){
        return array();
    }



}