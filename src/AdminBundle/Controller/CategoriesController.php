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
    public function indexAction(Request $request, $page){
        
        $CategoryRepository = $this->getDoctrine()->getRepository('RankingowiecBundle:Category');
        $qb = $CategoryRepository->getQueryBuilder();

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
     *      name="admin_categoryForm",
     *      requirements={"id"="\d+"},
     *      defaults={"id"=NULL}
     * )
     *
     * @Template()
     */
    public function formAction(Request $Request, $id = NULL){

        if($id === NULL){
            $Category = new Category();
            $newCategory = true;
        }
        else{
            $Category = $this->getDoctrine()->getRepository('RankingowiecBundle:Category')->find($id);
        }

        $form = $this->createForm(new TaxonomyType(), $Category);
        $form->handleRequest($Request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($Category);
            $em->flush();

            $message = (isset($newCategory)) ? 'Poprawnie dodano nową kategorię!': 'Kategoria została poprawiona!';
            $this->get('session')->getFlashBag()->add('success', $message);

            return $this->redirect($this->generateUrl('admin_categoryForm', array('id' => $Category->getId())));
        }

        return array(
            'Category' => $Category,
            'Form' => $form->createView(),
        );
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
    public function deleteAction(Request $Request, Category $Category){
    //Zastosowanie paramConverter (zamiast dawać id kategori podaje obiekt)

        $form = $this->createForm(new CategoryDeleteType($Category));
        $form->handleRequest($Request);

        if($form->isValid()){

            $chosen = false;

            if(($NewCategory = $form->get('newCategory')->getData()) !== null){
                $newCategoryId = $NewCategory->getId();
                $chosen = true;
            }

            if($chosen){

                $RankObjectRepo = $this->getDoctrine()->getRepository('RankingowiecBundle:RankObject');
                $modifiedRankObject = $RankObjectRepo->moveToCategory($Category->getId(), $newCategoryId);

                $em = $this->getDoctrine()->getManager();
                $em->remove($Category);
                $em->flush();

                $Request->getSession()
                    ->getFlashBag()
                    ->add('success', sprintf('Kategoria została usunięta. %d Obiektów zostało zmodyfikowanych.', $modifiedRankObject));

                return $this->redirect($this->generateUrl('admin_categories'));

            }else{
                $Request->getSession()
                    ->getFlashBag()
                    ->add('error', 'Musisz wybrać nowa kategorię!');
            }


        }


        return array(
            'Category' => $Category,
            'Form' => $form->createView()
        );
    }



}