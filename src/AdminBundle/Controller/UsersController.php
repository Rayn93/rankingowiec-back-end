<?php


namespace AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;

use RankingowiecBundle\Entity\User;

use FOS\UserBundle\Model\UserManagerInterface;


class UsersController extends Controller{

    /**
     * @Route(
     *      "/lista/{page}",
     *      name="admin_users",
     *      defaults={"page"=1}
     * )
     *
     * @Template()
     */
    public function indexAction(Request $request, $page){

        $PageRepository = $this->getDoctrine()->getRepository('RankingowiecBundle:User');
        $qb = $PageRepository->findAll();

        $paginationLimit = $this->container->getParameter('admin.pagination_limit');
        $limitList = array(5, 10, 20, 50);
        $limit = $request->query->get('limit', $paginationLimit);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($qb, $page, $limit);


        return array(
            'Pagination' => $pagination,
            'currPage' => 'users',

            'currLimit' => $limit,
            'limitList' => $limitList,

        );
    }



    /**
     * @Route(
     *      "/formularz/{id}",
     *      name="admin_userForm",
     *      requirements={"id"="\d+"},
     *      defaults={"id"=NULL}
     * )
     *
     * @Template()
     */
    public function formAction(Request $Request, $id = NULL){

        if($id == null){
            $User = new User();
            $newUserForm = TRUE;
        }else{
            $User = $this->getDoctrine()->getRepository('RankingowiecBundle:User')->find($id);
        }

        $form = $this->createForm(new PageType(), $User);
        $form->handleRequest($Request);


        return array();
    }



    /**
     * @Route(
     *      "/usun/{id}",
     *      name="admin_userDelete",
     *      requirements={"id"="\d+"}
     * )
     *
     * @Template()
     */
    public function deleteAction(){
        return array();
    }



}