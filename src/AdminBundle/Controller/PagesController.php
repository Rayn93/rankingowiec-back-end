<?php


namespace AdminBundle\Controller;

use AdminBundle\Form\Type\PageType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;

use RankingowiecBundle\Entity\Page;

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
    public function formAction(Request $Request, $id = NULL){

        if($id == null){
            $Page = new Page();
            $Page->setAuthor($this->getUser());
            $newPageForm = TRUE;
        }else{
            $Page = $this->getDoctrine()->getRepository('RankingowiecBundle:Page')->find($id);
        }

        $form = $this->createForm(new PageType(), $Page);
        $form->handleRequest($Request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($Page);
            $em->flush();

            $message = (isset($newPageForm)) ? 'Poprawnie dodano nową stronę!': 'Strona została zmodyfikowana!';
            $this->get('session')->getFlashBag()->add('success', $message);

            return $this->redirect($this->generateUrl('admin_pageForm', array('id' => $Page->getId())));
        }

        return array(
            'Form' => $form->createView(),
            'Page' => $Page,
            'currPage' => 'pages',
        );
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
    public function deleteAction($id){
        $Page = $this->getDoctrine()->getRepository('RankingowiecBundle:Page')->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($Page);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Poprawnie usunięto stronę');

        return $this->redirect($this->generateUrl('admin_pages'));
    }



}