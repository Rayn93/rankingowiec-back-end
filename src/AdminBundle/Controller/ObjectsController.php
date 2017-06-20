<?php


namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;

use RankingowiecBundle\Entity\RankObject;
//use Air\AdminBundle\Form\Type\PostType;

class ObjectsController extends Controller{

    private $delete_token_name = "delete-post-%d";

    /**
     * @Route(
     *      "/lista/{page}",
     *      name="admin_objects",
     *      defaults={"page"=1}
     * )
     *
     * @Template()
     */
    public function indexAction(Request $request, $page){

        $queryParams = array(

        );

        $ObjectRepository = $this->getDoctrine()->getRepository('RankingowiecBundle:RankObject');

        $qb = $ObjectRepository->getQueryBuilder($queryParams);

        $paginationLimit = $this->container->getParameter('admin.pagination_limit');
        $limits = array(2, 5, 10, 15);

        $limit = $request->query->get('limit', $paginationLimit);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($qb, $page, $limit);



        return array(
            'Pagination' => $pagination,
        );
    }


    /**
     * @Route(
     *      "/formularz/{id}",
     *      name="admin_objectForm",
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
     *      name="admin_objectDelete",
     *      requirements={"id"="\d+"}
     * )
     *
     * @Template()
     */
    public function deleteAction(){
        return array();
    }

}