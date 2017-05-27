<?php


namespace RankingowiecBundle\Twig\Extension;

//Developerskie Rozszerzenia dla szablonów Twig
class RankingExtension extends \Twig_Extension {


    /**
     * @var \Doctrine\Bundle\DoctrineBundle\Registry
     */
    private $doctrine;

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


    // Renderuje sidebar dla stron z rankingiem
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

        $TagCload = $this->getTagCload(30);


        return $environment->render('RankingowiecBundle:Template:rankingSidebar.html.twig', array(
            'SidebarRankings' => $RankingResult,
            'SidebarTags' => $TagCload
        ));

    }


    //Zwraca losową chmurę tagów
    private function getTagCload($limit){

        $TagRepo = $this->doctrine->getRepository('RankingowiecBundle:Tag');
        $qb = $TagRepo->getQueryBuilder(array(
            'random' => true,
            'limit' => $limit
        ));

        $query = $qb->getQuery();
        $TagList = $query->getResult();


        return $TagList;

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