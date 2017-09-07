<?php


namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;

use RankingowiecBundle\Entity\Tag;
use AdminBundle\Form\Type\TaxonomyType;


class TagsController extends Controller{

    /**
     * @Route(
     *      "/lista/{page}",
     *      name="admin_tags",
     *      defaults={"page"=1}
     * )
     *
     * @Template()
     */
    public function indexAction(Request $request, $page){

        $TagRepository = $this->getDoctrine()->getRepository('RankingowiecBundle:Tag');
        $qb = $TagRepository->getQueryBuilder(array(
            'countRankings' => true
        ));

        $paginationLimit = $this->container->getParameter('admin.pagination_limit');
        $limitList = array(5, 10, 20, 50);
        $limit = $request->query->get('limit', $paginationLimit);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($qb, $page, $limit);

        return array(
            'currPage' => 'taxonomies',
            'Pagination' => $pagination,

            'currLimit' => $limit,
            'limitList' => $limitList,
        );
    }



    /**
     * @Route(
     *      "/formularz/{id}",
     *      name="admin_tagForm",
     *      requirements={"id"="\d+"},
     *      defaults={"id"=NULL}
     * )
     *
     * @Template()
     */
    public function formAction(Request $Request, $id = NULL){

        if($id === NULL){
            $Tag = new Tag();
            $newTag = true;
        }
        else{
            $Tag = $this->getDoctrine()->getRepository('RankingowiecBundle:Tag')->find($id);
        }

        $form = $this->createForm(new TaxonomyType(), $Tag);
        $form->handleRequest($Request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($Tag);
            $em->flush();

            $message = (isset($newTag)) ? 'Poprawnie dodano nowy tag!': 'Tag został poprawiony!';
            $this->get('session')->getFlashBag()->add('success', $message);

            return $this->redirect($this->generateUrl('admin_tagForm', array('id' => $Tag->getId())));
        }

        return array(
            'Tag' => $Tag,
            'Form' => $form->createView(),
        );

    }



    /**
     * @Route(
     *      "/usun/{id}",
     *      name="admin_tagDelete",
     *      requirements={"id"="\d+"}
     * )
     *
     * @Template()
     */
    public function deleteAction($id){

        $Tag = $this->getDoctrine()->getRepository('RankingowiecBundle:Tag')->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Tag);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Poprawnie usunięto tag.');

        return $this->redirect($this->generateUrl('admin_tags'));
    }



}