<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\Type\RankingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;

use RankingowiecBundle\Entity\Ranking;

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

        $paginationLimit = 20; //$this->container->getParameter('admin.pagination_limit');
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
    public function formAction(Request $Request, $id = NULL){

        if($id == null){
            $Ranking = new Ranking();
            $Ranking->setAuthor($this->getUser())->setNumbVisits(1);
            $newRankingForm = TRUE;
        }else{
            $Ranking = $this->getDoctrine()->getRepository('RankingowiecBundle:Ranking')->find($id);
        }

        $form = $this->createForm(new RankingType(), $Ranking);
        $form->handleRequest($Request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($Ranking);
            $em->flush();

            $message = (isset($newRankingForm)) ? 'Poprawnie dodano nowy ranking!': 'Ranking został poprawiony!';
            $this->get('session')->getFlashBag()->add('success', $message);

            return $this->redirect($this->generateUrl('admin_rankingForm', array('id' => $Ranking->getId())));
        }

        return array(
            'Form' => $form->createView(),
            'Ranking' => $Ranking,
            'currPage' => 'rankings',
        );
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