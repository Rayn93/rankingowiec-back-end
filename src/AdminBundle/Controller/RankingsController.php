<?php


namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;

use RankingowiecBundle\Entity\Ranking;
//use AdminBundle\Form\Type\RankingType;

class RankingsController extends Controller{

    /**
     * @Route(
     *      "/lista/{status}/{page}",
     *      name="admin_rankings",
     *      defaults={"status"="all", "page"=1}
     * )
     *
     * @Template()
     */
    public function indexAction(Request $request, $status, $page){

        $queryParams = array(
            'titleLike' => $request->query->get('titleLike'),
            'categoryId' => $request->query->get('categoryId'),
            'status' => $status
        );

        $RankingRepository = $this->getDoctrine()->getRepository('RankingowiecBundle:Ranking');
        $qb = $RankingRepository->getQueryBuilder($queryParams);

        $paginationLimit = $this->container->getParameter('admin.pagination_limit');
        $limitList = array(5, 10, 20, 50);
        $limit = $request->query->get('limit', $paginationLimit);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($qb, $page, $limit);

        $CategoryList = $this->getDoctrine()->getRepository('RankingowiecBundle:Category')->getAsArray();

        $statusList = array(
            'all' => 'Wszystkie',
            'published' => 'Opublikowane',
            'unpublished' => 'Nieopublikowane'
        );

        $currStatus = $status;

        $statistic = $RankingRepository->getStatistics();


        return array(
            'Pagination' => $pagination,
            'currPage' => 'rankings',
            'queryParams' => $queryParams,
            'categoryList' => $CategoryList,

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
     *      "/usun/{id}",
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