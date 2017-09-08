<?php


namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;

use RankingowiecBundle\Entity\Page;
//use AdminBundle\Form\Type\RankObjectType;

class PagesController extends Controller{

    /**
     * @Route(
     *      "/lista/{status}/{page}",
     *      name="admin_pages",
     *      defaults={"status"="all", "page"=1}
     * )
     *
     * @Template()
     */
    public function indexAction(Request $request, $status, $page){

        $queryParams = array(
            'titleLike' => $request->query->get('titleLike'),
            'status' => $status
        );

        $PageRepository = $this->getDoctrine()->getRepository('RankingowiecBundle:Page');
        $qb = $PageRepository->getQueryBuilder($queryParams);

        $paginationLimit = $this->container->getParameter('admin.pagination_limit');
        $limitList = array(5, 10, 20, 50);
        $limit = $request->query->get('limit', $paginationLimit);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($qb, $page, $limit);

        $statusList = array(
            'all' => 'Wszystkie',
            'published' => 'Opublikowane',
            'unpublished' => 'Nieopublikowane'
        );

        $currStatus = $status;
        $statistic = $PageRepository->getStatistics();


        return array(
            'Pagination' => $pagination,
            'currPage' => 'pages',
            'queryParams' => $queryParams,

            'currLimit' => $limit,
            'limitList' => $limitList,

            'statusList' => $statusList,
            'currStatus' => $currStatus,
            'statistic' => $statistic
        );

    }



    /**
     * @Route(
     *      "/formularz/{id}",
     *      name="admin_pageForm",
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
     *      "/usun/{id}",
     *      name="admin_pageDelete",
     *      requirements={"id"="\d+"}
     * )
     *
     * @Template()
     */
    public function deleteAction(){
        return array();
    }



}