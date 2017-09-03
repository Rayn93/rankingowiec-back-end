<?php


namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use RankingowiecBundle\Entity\Category;
use AdminBundle\Form\Type\TaxonomyType;
use AdminBundle\Form\Type\CategoryDeleteType;

class CategoriesController extends Controller{

    /**
     * @Route(
     *      "/lista/{page}",
     *      name="admin_categories",
     *      defaults={"page"=1}
     * )
     *
     * @Template()
     */
    public function indexAction($page){
        
        $CategoryRepository = $this->getDoctrine()->getRepository('RankingowiecBundle:Category');
        $qb = $CategoryRepository->getQueryBuilder();

        $paginationLimit = $this->container->getParameter('admin.pagination_limit');

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($qb, $page, $paginationLimit);

        return array(
            'currPage' => 'taxonomies',
            'Pagination' => $pagination
        );
    }

    /**
     * @Route(
     *      "/formularz/{id}",
     *      name="admin_categoryForm",
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
     *      name="admin_categoryDelete",
     *      requirements={"id"="\d+"}
     * )
     *
     * @Template()
     */
    public function deleteAction(){
        return array();
    }



}