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
        return array(
            new \Twig_SimpleFunction('printRankingSidebar', array($this, 'printRankingSidebar'),
                array(
                    'needs_environment' => true,
                    'is_safe' => array('html')
                ))
        );
    }

    public function getFilters(){
        return array(
             new \Twig_SimpleFilter('cutText', array($this, 'cutText'), array('is_safe' => array('html'))),
            new \Twig_SimpleFilter('restyleNumber', array($this, 'restyleNumber'), array('is_safe' => array('html'))),
        );
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
            'limit' => '8'
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

    //Filtr twiga który skraca tekst o zadaną wartość znaków
    public function cutText($text, $length = 200, $wrapTag = 'p'){

        $text = strip_tags($text);
        $text = substr($text, 0, $length).' [...]';

        if($wrapTag == ''){
            return $text;
        }
        else{
            $open_tag = '<'.$wrapTag.'>';
            $close_tag = '</'.$wrapTag.'>';
            return $open_tag.$text.$close_tag;
        }

    }

    //Filtr który zmienia 1000 -> 1 tyś itd.
    public function restyleNumber($input){
        $input = number_format($input);
        $input_count = substr_count($input, ',');

        if($input_count != '0'){
            if($input_count == '1'){
                return substr($input, 0, -4).' tyś';
            } else if($input_count == '2'){
                return substr($input, 0, -8).' mil';
            } else if($input_count == '3'){
                return substr($input, 0,  -12).' mld';
            } else {
                return;
            }
        } else {
            return $input;
        }
    }





}