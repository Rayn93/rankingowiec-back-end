<?php


namespace RankingowiecBundle\Twig\Extension;

//Rozszerzenia dla szablonów Twig
class RankingExtension extends \Twig_Extension {


    /**
     * @var \Doctrine\Bundle\DoctrineBundle\Registry
     */
    private $doctrine;

//    /**
//     * @var \Twig_Environment
//     */
//    private $environment;

    /**
     * RankingExtension constructor.
     * @param \Doctrine\Bundle\DoctrineBundle\Registry $doctrine
     */
    public function __construct(\Doctrine\Bundle\DoctrineBundle\Registry $doctrine){
        $this->doctrine = $doctrine;
    }


    public function getFunctions(){
        return [
            new \Twig_SimpleFunction('printRankingSidebar', [$this, 'printRankingSidebar'], [
                'needs_environment' => true,
                'is_safe' => ['html']
            ])
        ];
    }


    public function getName(){
        return 'rankingowiec_extension';
    }



    public function printRankingSidebar(\Twig_Environment $environment){

        $RankRepo = $this->doctrine->getRepository('RankingowiecBundle:Ranking');
        $qb = $RankRepo->getQueryBuilder(array(
            'status' => 'published',
            'categorySlug' => 'popularne',
            'random' => true,
            'limit' => '10'
        ));

        $query = $qb->getQuery();
        $RankingResult = $query->getResult();


        return $environment->render('RankingowiecBundle:Template:rankingSidebar.html.twig', array(
            'SidebarRankings' => $RankingResult
        ));

    }


//    public function printFooterMenu(\Twig_Environment $environment){
//
//
//
//
//        return $environment->render('RankingowiecBundle:Template:rankingSidebar.html.twig', array(
//            'SidebarRankings' => ''
//        ));
//
//    }





}