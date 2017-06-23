<?php


namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;

use RankingowiecBundle\Entity\RankObject;
use AdminBundle\Form\Type\RankObjectType;

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



        $paginationLimit = $this->container->getParameter('admin_pagination_limit');
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