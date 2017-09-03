<?php


namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;

use RankingowiecBundle\Entity\RankObject;
use AdminBundle\Form\Type\RankObjectType;

class ObjectsController extends Controller{

    /**
     * @Route(
     *      "/lista/{status}/{page}",
     *      name="admin_objects",
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

        $ObjectRepository = $this->getDoctrine()->getRepository('RankingowiecBundle:RankObject');
        $qb = $ObjectRepository->getQueryBuilder($queryParams);

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

        $statistic = $ObjectRepository->getStatistics();


        return array(
            'Pagination' => $pagination,

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
     *      name="admin_objectForm",
     *      requirements={"id"="\d+"},
     *      defaults={"id"=NULL}
     * )
     *
     * @Template()
     */
    public function formAction(Request $Request, $id = NULL){

        if($id == null){
            $RankObject = new RankObject();
            $RankObject->setAuthor($this->getUser());
            $newRankObjectForm = TRUE;
        }else{
            $RankObject = $this->getDoctrine()->getRepository('RankingowiecBundle:RankObject')->find($id);
        }

        $form = $this->createForm(new RankObjectType(), $RankObject);
        $form->handleRequest($Request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($RankObject);
            $em->flush();

            $message = (isset($newRankObjectForm)) ? 'Poprawnie dodano nowy obiekt!': 'Obiekt został poprawiony!';
            $this->get('session')->getFlashBag()->add('success', $message);

            return $this->redirect($this->generateUrl('admin_objectForm', array('id' => $RankObject->getId())));
        }

        return array(
            'Form' => $form->createView(),
            'RankObject' => $RankObject
        );
    }



    /**
     * @Route(
     *      "/usun/{id}",
     *      name="admin_objectDelete",
     *      requirements={"id"="\d+"}
     * )
     *
     * @Template()
     */
    public function deleteAction($id){


        $Object = $this->getDoctrine()->getRepository('RankingowiecBundle:RankObject')->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Object);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Poprawnie usunięto obiekt');

        return $this->redirect($this->generateUrl('admin_objects'));

    }

}