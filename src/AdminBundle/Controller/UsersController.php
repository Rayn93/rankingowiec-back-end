<?php


namespace AdminBundle\Controller;

use AdminBundle\Form\Type\UserType;
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

        $queryParams = array(
            'usernameLike' => $request->query->get('usernameLike'),
        );

        $UserRepository = $this->getDoctrine()->getRepository('RankingowiecBundle:User');
        $qb = $UserRepository->getQueryBuilder($queryParams);

        $paginationLimit = $this->container->getParameter('admin.pagination_limit');
        $limitList = array(5, 10, 20, 50);
        $limit = $request->query->get('limit', $paginationLimit);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($qb, $page, $limit);


        return array(
            'Pagination' => $pagination,
            'currPage' => 'users',
            'queryParams' => $queryParams,

            'currLimit' => $limit,
            'limitList' => $limitList,

        );
    }



    /**
     * @Route(
     *      "/formularz/{id}",
     *      name="admin_userForm",
     *      requirements={"id"="\d+"},
     * )
     *
     * @Template()
     */
    public function formAction(Request $Request, $id ){

        $User = $this->getDoctrine()->getRepository('RankingowiecBundle:User')->find($id);

        $form = $this->createForm(new UserType(), $User);
        $form->handleRequest($Request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($User);
            $em->flush();

            $message = 'Poprawnie zmodyfikowano użytkownika!';
            $this->get('session')->getFlashBag()->add('success', $message);

            return $this->redirect($this->generateUrl('admin_userForm', array('id' => $User->getId())));
        }


        return array(
            'Form' => $form->createView(),
            'User' => $User,
            'currPage' => 'users',
        );
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
    public function deleteAction($id){

        $User = $this->getDoctrine()->getRepository('RankingowiecBundle:User')->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($User);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Poprawnie usunięto użytkownika');

        return $this->redirect($this->generateUrl('admin_users'));
    }



}